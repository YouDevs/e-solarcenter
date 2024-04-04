@extends('layouts.base')

@section('content')
<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">Nosotros</h1>
        </div>
    </div>
</div>

<section class="row g-0">
    <div
        class="col-md-6 bg-position-center bg-size-cover bg-secondary"
        style="min-height: 15rem; background-image: url(images/about-us/solar-center-industria-fotovoltaica_580x.webp); background-size: cover;"
    ></div>
    <div class="col-md-6 px-3 px-md-5 py-5">
        <div class="mx-auto py-lg-5" style="max-width: 35rem;">
            <h2 class="h3 pb-3">Industria Fotovoltaica</h2>
            <p class="fs-sm pb-3 text-muted">
                Somos el Centro de Distribución Solar mas completo del país,
                buscamos junto con nuestros socios comerciales transformar a México a través de la energía solar.
                Trabajamos para alcanzar día con día nuestros objetivos:
                entregando diferenciadores que apoyen a mejorar el desempeño de los integradores en el mercado.
            </p>
            {{-- <a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Ver Productos</a> --}}
        </div>
    </div>
</section>
<section class="row g-0">
    <div
        class="col-md-6 bg-position-center bg-size-cover bg-secondary order-md-2"
        style="min-height: 15rem; background-image: url(images/about-us/solar-center-transformar_580x.webp); background-size: cover;"
    ></div>
    <div class="col-md-6 px-3 px-md-5 py-5 order-md-1">
        <div class="mx-auto py-lg-5" style="max-width: 35rem;">
            <h2 class="h3 pb-3">Transformando a México a Través de la Engería Solar</h2>
            <p class="fs-sm pb-3 text-muted">
                El sueño de Solar Center,
                es ver crecer a nuestro país aprovechando cada espacio del gran recurso solar con el que contamos,
                cada techo de cada ciudad, de cada pueblo, de cada ranchería,
                lleno de sistemas solares siendo así parte de un cambio energético y sustentable en nuestra generación.
                <br><br>
                Debemos nuestros años de éxito a esta visión,
                que incluye ayudar a nuestros clientes a alcanzar y superar sus objetivos,
                así como aportar nuestro granito de arena para frenar el calentamiento global en nuestro planeta.
            </p>
            {{-- <a class="btn btn-accent btn-shadow" href="#">Shipping details</a> --}}
        </div>
    </div>
</section>

<section class="row g-0">
    <div class="col-md-12 px-3 px-md-5 pt-5">
        <div class="mx-auto pt-lg-5" style="max-width: 35rem;">
            <h2 class="h3 pb-3 text-center sc-gray">Nuestra Cultura</h2>
            <p class="fs-sm pb-3 text-muted text-center">
                Es la base de nuestro éxito de cara al cliente y con nuestro equipo interno.
            </p>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4 p-lg-4">
        <div class="mx-auto text-center" style="max-width: 35rem;">
            <i class="bi bi-headset h2 sc-yellow"></i>
            <h3 class="h4 pb-3 sc-gray">
                Servicio
            </h3>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4 p-lg-4">
        <div class="mx-auto text-center" style="max-width: 35rem;">
            <i class="bi bi-house-check h2 sc-yellow"></i>
            <h3 class="h4 pb-3 sc-gray">
                Sustentabilidad
            </h3>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4 p-lg-4">
        <div class="mx-auto text-center" style="max-width: 35rem;">
            <i class="bi bi-award h2 sc-yellow"></i>
            <h3 class="h4 pb-3 sc-gray">
                Confiabilidad
            </h3>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4 p-lg-4">
        <div class="mx-auto text-center" style="max-width: 35rem;">
            <i class="bi bi-heart h2 sc-yellow"></i>
            <h3 class="h4 pb-3 sc-gray">
                Pasión
            </h3>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4 p-lg-4">
        <div class="mx-auto text-center" style="max-width: 35rem;">
            <i class="bi bi-trophy h2 sc-yellow"></i>
            <h3 class="h4 pb-3 sc-gray">
                Perseverancia
            </h3>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4 p-lg-4">
        <div class="mx-auto text-center" style="max-width: 35rem;">
            <i class="bi bi-lightbulb h2 sc-yellow"></i>
            <h3 class="h4 pb-3 sc-gray">
                Creatividad
            </h3>
        </div>
    </div>
</section>
@endsection