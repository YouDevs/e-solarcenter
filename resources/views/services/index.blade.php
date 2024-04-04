@extends('layouts.base')

@section('content')
<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">Servicios Fundamentales</h1>
        </div>
    </div>
</div>

<section class="container pt-grid-gutter">
    <section class="row g-0">
        <div
            class="col-md-6 bg-position-center bg-size-cover bg-secondary"
            style="min-height: 15rem; background-image: url(images/about-us/solar-center-capacitacion-comercial_580x.webp); background-size: cover;"
        ></div>
        <div class="col-md-6 px-3 px-md-5 py-5">
            <div class="mx-auto py-lg-5" style="max-width: 35rem;">
                <i class="bi bi-graph-up-arrow h2"></i>
                <h2 class="h3 pb-3"> Capacitación Comercial</h2>
                <p class="fs-sm pb-3 text-muted">
                    Apoyamos a nuestros integradores a mejorar las técnicas y formas de prospección que ayuden a concretar sus proyectos.
                    Creemos que el apoyo dentro de la cadena de suministro desde fabricantes, distribuidores,
                    integrados y clientes finales es la forma en la que podemos seguir creciendo la industria solar de forma sostenible.
                    Tu crecimiento es nuestro crecimiento.
                </p>
                {{-- <a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Ver Productos</a> --}}
            </div>
        </div>
    </section>

    <section class="row g-0">
        <div
            class="col-md-6 bg-position-center bg-size-cover bg-secondary order-md-2"
            style="min-height: 15rem; background-image: url(images/about-us/solar-center-garantia-servicios_580x.webp); background-size: cover;"
        ></div>
        <div class="col-md-6 px-3 px-md-5 py-5 order-md-1">
            <div class="mx-auto py-lg-5" style="max-width: 35rem;">
                <i class="bi bi-award h2"></i>
                <h2 class="h3 pb-3">Garantía de Productos</h2>
                <p class="fs-sm pb-3 text-muted">
                    Es de suma importancia que los integradores cuenten con productos de calidad;
                    aunque siempre debemos de contemplar un pequeño margen de error donde desde la producción de producto pudiera haber un error al momento de la instalación.
                    Por lo que de parte del equipo Solar Center,
                    recibirás la atención y guía necesaria en caso de que algo así sucediera.
                    Siempre estaremos para apoyarte.
                </p>
            </div>
        </div>
    </section>

    <section class="row g-0">
        <div
            class="col-md-6 bg-position-center bg-size-cover bg-secondary"
            style="min-height: 15rem; background-image: url(images/about-us/solar-center-stock-disponible_580x.webp); background-size: cover;"
        ></div>
        <div class="col-md-6 px-3 px-md-5 py-5">
            <div class="mx-auto py-lg-5" style="max-width: 35rem;">
                <i class="bi bi-boxes h2"></i>
                <h2 class="h3 pb-3">Stock Siempre Disponible</h2>
                <p class="fs-sm pb-3 text-muted">
                    Sabemos la rapidez con la que avanzan los proyectos hoy en día,
                    es de vital importancia contar con los productos al alcance del integrador,
                    así como la mayor cantidad de opciones disponibles para así poder acelerar la transición energética.
                </p>
            </div>
        </div>
    </section>

    <section class="row g-0">
        <div
            class="col-md-6 bg-position-center bg-size-cover bg-secondary order-md-2"
            style="min-height: 15rem; background-image: url(images/about-us/solar-center-soporte_580x.webp); background-size: cover;"
        ></div>
        <div class="col-md-6 px-3 px-md-5 py-5 order-md-1">
            <div class="mx-auto py-lg-5" style="max-width: 35rem;">
                <i class="bi bi-tools h2"></i>
                <h2 class="h3 pb-3">Asesoría y Soporte Técnico</h2>
                <p class="fs-sm pb-3 text-muted">
                    Ofrecemos consultoría y asesoramiento para la elección de soluciones que se ajusten de la mejor forma a tus proyectos PV.
                    Tenemos claro el día a día de nuestros integradores,
                    es por eso que contamos con línea directa con nuestros ingenieros
                    quienes te podrán orientar mientras tu equipo de instaladores está en campo.
                </p>
            </div>
        </div>
    </section>

    <section class="row g-0">
        <div
            class="col-md-6 bg-position-center bg-size-cover bg-secondary"
            style="min-height: 15rem; background-image: url(images/about-us/solar-center-calidad_580x.webp); background-size: cover;"
        ></div>
        <div class="col-md-6 px-3 px-md-5 py-5">
            <div class="mx-auto py-lg-5" style="max-width: 35rem;">
                <i class="bi bi-patch-check h2"></i>
                <h2 class="h3 pb-3">Equipos de Primera Calidad</h2>
                <p class="fs-sm pb-3 text-muted">
                    Trabajamos con fabricantes que más allá de aportar un producto que satisfaga las necesidades de los integradores,
                    busque aportarles un valor agregado a nuestros clientes.
                    Si podemos garantizar la calidad y seguridad de los productos que ofertamos,
                    se vinculará directamente con el éxito de venta de nuestros integradores.
                </p>
            </div>
        </div>
    </section>

    <section class="row g-0 mb-5">
        <div
            class="col-md-6 bg-position-center bg-size-cover bg-secondary order-md-2"
            style="min-height: 15rem; background-image: url(images/about-us/solar-center-stock-entrega-inmediata_580x.webp); background-size: cover;"
        ></div>
        <div class="col-md-6 px-3 px-md-5 py-5 order-md-1">
            <div class="mx-auto py-lg-5" style="max-width: 35rem;">
                <i class="bi bi-truck h2"></i>
                <h2 class="h3 pb-3">Entrega Inmediata</h2>
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
</section>

@endsection