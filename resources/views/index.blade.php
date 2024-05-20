@extends('layouts.base')

@section('head')
@vite([
    'resources/js/sliders.js',
])
<style>
.background-image-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 110px;
    height: 110px;
    background-size: cover;
    background-position: center;
    text-align: center;
}

.overlay-text {
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
}
</style>
@endsection

@section('content')

@if (!request()->has('category_id') && !request()->has('brand'))
<section class="bg-secondary py-4 pt-md-5">
    <div class="container py-xl-2">
        <div class="row">
            <!-- Slider -->
            <div class="col-xl-9 pt-xl-4 order-xl-2">
                <div class="tns-carousel">
                    <div class="tns-carousel-hero">
                        <div>
                            <div class="row align-items-center">
                                <div class="col-md-6 order-md-2">
                                    <img class="d-block mx-auto img-fluid" src="{{asset('images/test3.png')}}" alt="VR Collection">
                                </div>
                                <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                    <h2 class="fw-light pb-1 from-bottom">Transformar a México a Través de la </h2>
                                    <h1 class="display-4 from-bottom delay-1">Energía Solar</h1>
                                    <h5 class="fw-light pb-3 from-bottom delay-2">
                                        Elige Entre las Mejores Marcas
                                    </h5>
                                    <div class="d-table scale-up delay-4 mx-auto mx-md-0">
                                        <a class="btn btn-primary btn-shadow" href="{{route('product-filter')}}">Comprar Ahora<i class="bi bi-chevron-right ms-2 me-n1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row align-items-center">
                                <div class="col-md-6 order-md-2">
                                    <img class="d-block mx-auto" src="{{asset('images/banner/Categoria.png')}}" alt="Descargar Catalogo">
                                </div>
                                <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                    <h2 class="fw-light pb-1 from-start">Catálogo 2024</h2>
                                    <h1 class="display-4 from-start delay-1">Conoce nuestros</h1>
                                    <h5 class="fw-light pb-3 from-start delay-2">Productos y Servicios</h5>
                                    <div class="d-table scale-up delay-4 mx-auto mx-md-0">
                                        <a class="btn btn-primary btn-shadow" href="{{asset('catalogo/solar-center-24.pdf')}}" download>
                                            Descargalo aquí!<i class="bi ci-chevron-right ms-2 me-n1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row align-items-center">
                                <div class="col-md-6 order-md-2">
                                    <img class="d-block mx-auto" src="{{asset('images/inverter_test.png')}}" alt="VR Collection">
                                </div>
                                <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                                    <h2 class="fw-light pb-1 from-start">Somos el Centro de</h2>
                                    <h1 class="display-4 from-start delay-1">Distribución Solar</h1>
                                    <h5 class="fw-light pb-3 from-start delay-2">Más Completo del País</h5>
                                    <div class="d-table scale-up delay-4 mx-auto mx-md-0">
                                        <a class="btn btn-primary btn-shadow" href="{{route('product-filter')}}">
                                            Comprar Ahora<i class="bi ci-chevron-right ms-2 me-n1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner group-->
            <div class="col-xl-3 order-xl-1 pt-4 mt-3 mt-xl-0 pt-xl-0">
                <div class="table-responsive" data-simplebar>
                    <div class="d-flex d-xl-block">
                        <a class="d-flex align-items-center rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0 banner-group-item" href="#">
                            <img src="{{asset('images/is_new_1.png')}}" alt="Banner">
                            <div class="py-4 px-2">
                                <h5 class="mb-2 "><span class="fw-light">Panel LonGi</span><br>Hi-MO <span class="fw-light">X6</span><br>Explorer</h5>
                                <div class="text-white fs-sm">Ver<i class="bi bi-plus fs-xs ms-1"></i></div>
                            </div>
                        </a>
                        <a class="d-flex align-items-center rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0 banner-group-item" href="#">
                            <img src="{{asset('images/is_new_2.png')}}" alt="Banner">
                            <div class="py-4 px-2">
                                <h5 class="mb-2"><span class="fw-light">Inversor</span><br>Residencial <span class="fw-light">MIC</span> 1000</h5>
                                <div class="text-white fs-sm">Ver<i class="bi bi-plus fs-xs ms-1"></i></div>
                            </div>
                        </a>
                        <a class="d-flex align-items-center rounded-3 pt-2 ps-2 mb-4 banner-group-item" href="#">
                            <img src="{{asset('images/is_new_3.png')}}" alt="Banner">
                            <div class="py-4 px-2">
                                <h5 class="mb-2"><span class="fw-light">Hoymiles</span><br>Microinversor <span class="fw-light">HTM</span> 2000-4T</h5>
                                <div class="text-white fs-sm">Ver<i class="bi bi-plus fs-xs ms-1"></i></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<div class="container">

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 mb-2">
        <h2 class="h3 mb-0 pt-3 me-2">Productos</h2>
        <div class="pt-3">
            <a class="btn btn-outline-blue-gray btn-sm" href="{{route('product-filter')}}">
                Más Productos <i class="bi bi-chevron-right ms-1 me-n1"></i>
            </a>
        </div>
    </div>

    <div class="row justify-content-center align-items-md-center" id="grid-products">
        @foreach ($products as $product)
            <x-product.product-card :product="$product" />
        @endforeach
    </div>

    <div class="row justify-content-center mb-3">
        <div class="tns-carousel pt-3">
            {{-- Brands Carousel --}}
            <div class="tns-carousel-brands">
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/longi.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solis.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/risen.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/s5.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/huawei.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/victron.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/trina.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/growatt.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/znshine.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/unirac.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/tw-solar.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/fronius.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/soluna.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/gosolar.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/pylontech.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/srne.webp')}}" class="d-block mx-auto" style="max-width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/yassion.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/zbeny.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/parts-master.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/xpower.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/ultrastart.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/yassion.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/zbeny.webp')}}" class="d-block img-fluid mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Selección Cantidad x Ubicación -->
@include('partials.select-quantity-by-location')

@endsection

@section('scripts')
@if (session('message'))
<script>
    Swal.fire({
        position: "center",
        icon: "{{ session('icon') }}",
        title: "{{ session('message') }}",
        showConfirmButton: false,
        timer: 2000,
    });
</script>
@endif

<script>
    function formattedAmount(amount) {
        const formatter = new Intl.NumberFormat('es-ES', {
            style: 'currency',
            currency: 'MXN', // Ajusta esto a tu moneda local
            minimumFractionDigits: 2
        });

        // Extraemos la parte entera y decimal del monto formateado
        const parts = formatter.formatToParts(amount);
        let whole = '';
        let decimal = '';

        parts.forEach(part => {
            if (part.type === 'integer' || part.type === 'group') {
                whole += part.value;
            } else if (part.type === 'decimal') {
                decimal = part.value;
            } else if (part.type === 'fraction') {
                decimal += part.value;
            }
        });

        // Devuelve un objeto con las partes entera y decimal
        return {
            whole: whole,
            decimal: decimal
        };
    }
</script>

@endsection
