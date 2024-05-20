document.addEventListener('DOMContentLoaded', (e) => {

    // window.ResizeObserver = ResizeObserver;

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const formElement = this.closest('form');
            if (!formElement) {
                console.error('Formulario no encontrado para el botón.');
                return;
            }

            const productId = formElement.querySelector('input[name="id"]').value;
            const quantityInput = formElement.querySelector('input[name="quantity"]');
            const requestedQuantity = parseInt(quantityInput.value);
            const maxNationalStock = parseInt(quantityInput.getAttribute('data-national-quantity'));
            const maxLocalStock = parseInt(quantityInput.getAttribute('data-local-quantity'));

            console.log(requestedQuantity, maxLocalStock);

            if (!maxLocalStock && !maxNationalStock) {
                console.log("Entra hdpt")
                const assistanceModal = new bootstrap.Modal(document.getElementById('assistanceModal'));
                assistanceModal.show();
                return;
            }

            if(requestedQuantity <= maxLocalStock) {
                console.log(`La cantidad solicitada ${requestedQuantity} <= a la cantidad total: ${maxLocalStock}`)
                formElement.submit();
            }
            else {
                const modalElement = document.getElementById('selectQuantityModal');
                let modalInstance = new bootstrap.Modal(modalElement); // Mover aquí

                fetch(`/cart/product/${productId}/stock`)
                    .then(response => response.json())
                    .then(data => {
                        const modalBody = modalElement.querySelector('.modal-body');
                        modalBody.innerHTML = '';
                        const { localStock, nationalStock } = data;
                        [localStock, nationalStock].forEach(stock => {
                            if (stock) {
                                const label = document.createElement('label');
                                label.textContent = `${stock.name} (cantidad disponible: ${stock.quantity})`;
                                const input = document.createElement('input');
                                input.type = 'number';
                                input.className = 'form-control';
                                input.name = `${stock.name}`;
                                input.min = 0;
                                input.max = stock.quantity;
                                input.value = 1;
                                modalBody.appendChild(label);
                                modalBody.appendChild(input);
                            }
                        });

                        modalInstance.show();
                    });

                // Manejo del evento de envío del formulario desde el modal
                modalElement.querySelector('#quantitySelectionForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const quantities = {};
                    modalElement.querySelectorAll('input[type="number"]').forEach(input => {
                        quantities[input.name] = input.value;
                    });

                    const quantitiesInput = document.createElement('input');
                    quantitiesInput.type = 'hidden';
                    quantitiesInput.name = 'quantities';
                    quantitiesInput.value = JSON.stringify(quantities);
                    formElement.appendChild(quantitiesInput);

                    modalInstance.hide();
                    formElement.submit();
                });
            }


        });
    });

    document.getElementById('assistanceForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('/customer-requests', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            alert('Solicitud enviada correctamente.');
            this.reset();
            const assistanceModal = bootstrap.Modal.getInstance(document.getElementById('assistanceModal'));
            assistanceModal.hide();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al enviar la solicitud.');
        });
    });
})