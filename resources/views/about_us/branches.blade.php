@extends('layouts.base')

@section('head')
@endsection

@section('content')
<section class="row justify-content-center g-0">
    <div class="col-md-12 px-3 px-md-5 bg-primary">
        <div class="mx-auto py-lg-5 py-4" style="max-width: 35rem;">
            <h2 class="h2 mb-0 text-center text-blue-gray">Sucursales</h2>
        </div>
    </div>
    <div class="col-12 col-lg-3 my-4">
        <!-- Contacts card: Border -->
        <div class="card border-0 shadow mx-4">
            <img src="images/about-us/solar-center_sucursales-guadalajara_380x.webp" class="card-img-top" alt="Chicago">
            {{-- <div class="card-img-top overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3735.185091549234!2d-103.4432554144348!3d20.580497531863283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428aca7d3f35b59%3A0x60f05f836baafdb6!2sSolar%20Center%20Guadalajara!5e0!3m2!1ses!2smx!4v1712167662543!5m2!1ses!2smx" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> --}}
            <div class="card-body">
                <h6>Guadalajara</h6>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex pb-3 border-bottom">
                        <i class="bi bi-geo-alt fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Dirección</span>
                            <a href="#" class="d-block text-heading fs-sm text-blue-gray text-blue-gray">
                                C. Industria Eléctrica 43A
                                Parque Industrial Bugambilias, C.P. 45645
                                Tlajomulco de Zúñiga, Jal.
                            </a>
                        </div>
                    </li>
                    <li class="d-flex pt-2 pb-3 border-bottom">
                        <i class="bi bi-telephone fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Teléfono</span>
                            <a href="tel:+523338042122" class="d-block text-heading fs-sm text-blue-gray">+52 33 3804 2122</a>
                        </div>
                    </li>
                    <li class="d-flex pt-2m">
                        <i class="bi bi-envelope fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                        <span class="fs-ms text-muted">Email</span>
                        <a href="newyork:email@example.com" class="d-block text-heading fs-sm text-blue-gray">contacto@solar-center.mx</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 my-4">
        <div class="card border-0 shadow mx-4">
            <img src="images/about-us/solar-center_sucursales-monterrey_380x.webp" class="card-img-top" alt="Chicago">
            {{-- <div class="card-img-top overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3735.185091549234!2d-103.4432554144348!3d20.580497531863283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428aca7d3f35b59%3A0x60f05f836baafdb6!2sSolar%20Center%20Guadalajara!5e0!3m2!1ses!2smx!4v1712167662543!5m2!1ses!2smx" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> --}}
            <div class="card-body">
                <h6>Monterrey</h6>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex pb-3 border-bottom">
                        <i class="bi bi-geo-alt fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Dirección</span>
                            <a href="#" class="d-block text-heading fs-sm text-blue-gray">
                                Parque Industrial
                                Av. Cazadores, Sierra Madre 225, C.P. 66359
                                Santa Catarina, N.L.
                            </a>
                        </div>
                    </li>
                    <li class="d-flex pt-2 pb-3 border-bottom">
                        {{-- <i class="ci-phone fs-lg mt-2 mb-0 text-primary"></i> --}}
                        <i class="bi bi-telephone fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Teléfono</span>
                            <a href="tel:+523338042122" class="d-block text-heading fs-sm text-blue-gray">+52 33 3804 2122</a>
                        </div>
                    </li>
                    <li class="d-flex pt-2m">
                        <i class="bi bi-envelope fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                        <span class="fs-ms text-muted">Email</span>
                        <a href="newyork:email@example.com" class="d-block text-heading fs-sm text-blue-gray">contacto@solar-center.mx</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 my-4">
        <div class="card border-0 shadow mx-4">
            <img src="images/about-us/solar-center_sucursales-queretaro_380x.webp" class="card-img-top" alt="Chicago">
            {{-- <div class="card-img-top overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3735.185091549234!2d-103.4432554144348!3d20.580497531863283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428aca7d3f35b59%3A0x60f05f836baafdb6!2sSolar%20Center%20Guadalajara!5e0!3m2!1ses!2smx!4v1712167662543!5m2!1ses!2smx" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> --}}
            <div class="card-body">
                <h6>Querétaro</h6>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex pb-3 border-bottom">
                        <i class="bi bi-geo-alt fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Dirección</span>
                            <a href="#" class="d-block text-heading fs-sm text-blue-gray">
                                C. Industria Eléctrica 43A
                                Parque Industrial Bugambilias, C.P. 45645
                                Tlajomulco de Zúñiga, Jal.
                            </a>
                        </div>
                    </li>
                    <li class="d-flex pt-2 pb-3 border-bottom">
                        {{-- <i class="ci-phone fs-lg mt-2 mb-0 text-primary"></i> --}}
                        <i class="bi bi-telephone fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Teléfono</span>
                            <a href="tel:+523338042122" class="d-block text-heading fs-sm text-blue-gray">+52 33 3804 2122</a>
                        </div>
                    </li>
                    <li class="d-flex pt-2m">
                        <i class="bi bi-envelope fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                        <span class="fs-ms text-muted">Email</span>
                        <a href="newyork:email@example.com" class="d-block text-heading fs-sm text-blue-gray">contacto@solar-center.mx</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-12 px-3 px-md-5 bg-blue-gray">
        <div class="mx-auto py-lg-5 py-4" style="max-width: 35rem;">
            <h2 class="h2 mb-0 text-center text-primary">Centros de Distribución</h2>
        </div>
    </div>
    <div class="col-12 col-lg-3 my-4">
        <!-- Contacts card: Border -->
        <div class="card border-0 shadow mx-4">
            <img src="images/about-us/solar-center_centro-distribucion-cdmx_380x.webp" class="card-img-top" alt="Chicago">
            <div class="card-body">
                <h6>Ciudad de México</h6>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex pb-3">
                        <i class="bi bi-geo-alt fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Dirección</span>
                            <a href="#" class="d-block text-heading fs-sm text-blue-gray">
                                Av. Ceylán No. 489
                                Col. Industrial Vallejo. Delegación Azcapotzalco
                                C.P. 02300 Cuidad de México, CDMX
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 my-4">
        <div class="card border-0 shadow mx-4">
            <img src="images/about-us/solar-center_centro-distribucion-merida_237x.webp" class="card-img-top" alt="Chicago">
            <div class="card-body">
                <h6>Mérida</h6>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex pb-3">
                        <i class="bi bi-geo-alt fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Dirección</span>
                            <a href="#" class="d-block text-heading fs-sm text-blue-gray text-blue-gray">
                                Carretera Periférico Km 44 No. 11910, Periférico Poniente
                                C.P. 97300 Mérida Yucatán, México
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 my-4">
        <div class="card border-0 shadow mx-4">
            <img src="images/about-us/solar-center_centro-distribucion-chihuahua_237x.webp" class="card-img-top" alt="Chicago">
            <div class="card-body">
                <h6>Chihuahua</h6>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex pb-3">
                        <i class="bi bi-geo-alt fs-lg mt-2 mb-0 text-primary"></i>
                        <div class="ps-3">
                            <span class="fs-ms text-muted">Dirección</span>
                            <a href="#" class="d-block text-heading fs-sm text-blue-gray">
                                Complejo Industrial Oeste. Bodega 9 y 10
                                Km 9 Carretera Chihuahua - Cuauhtémoc.
                                Colonia Las Animas, C.P. 31450 Chihuahua, Chih.
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection