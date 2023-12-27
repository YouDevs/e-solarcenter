<div class="steps steps-light pt-2 pb-3 mb-5">
    <a class="step-item {{ $step == 1 ? 'active current' : ($step > 1 ? 'active' : '') }}" href="{{route('cart.list')}}">
        <div class="step-progress"><span class="step-count">1</span></div>
        <div class="step-label"><i class="ci-cart"></i>Carrito</div>
    </a>
    <a class="step-item {{ $step == 2 ? 'active current' : ($step > 2 ? 'active' : '') }}" href="{{route('checkout.details')}}">
        <div class="step-progress"><span class="step-count">2</span></div>
        <div class="step-label"><i class="ci-user-circle"></i>A tener en cuenta</div>
    </a>
    <a class="step-item {{ $step == 3 ? 'active current' : ($step > 3 ? 'active' : '') }}" href="{{route('checkout.shipping')}}">
        <div class="step-progress"><span class="step-count">3</span></div>
        <div class="step-label"><i class="ci-package"></i>Envío</div>
    </a>
    <a class="step-item {{ $step == 4 ? 'active current' : ($step > 4 ? 'active' : '') }}" href="{{route('checkout.payment')}}">
        <div class="step-progress"><span class="step-count">4</span></div>
        <div class="step-label"><i class="ci-card"></i>Pago</div>
    </a>
    <a class="step-item {{ $step == 5 ? 'active current' : ($step > 5 ? 'active' : '') }}" style="cursor: default;" href="javascript:void(0);">
        <div class="step-progress"><span class="step-count">5</span></div>
        <div class="step-label"><i class="ci-check-circle"></i>Finalizado</div>
    </a>
</div>
