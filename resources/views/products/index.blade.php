@extends('layouts.base')

@section('content')

<div class="bg-dark pt-4 pb-5">
    <div class="container pt-2 pb-3 pt-lg-3 pb-lg-4">
        <div class="d-lg-flex justify-content-between pb-3">
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">Productos</h1>
            </div>
        </div>
    </div>
</div>


<div class="container pb-5 mb-2 mb-md-4">
    <!-- Toolbar -->
    <div class="bg-light shadow-lg rounded-3 p-4 mt-n5 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="dropdown me-2">
                <a class="btn btn-outline-secondary dropdown-toggle collapsed" href="#shop-filters" data-bs-toggle="collapse" aria-expanded="false">
                <i class="ci-filter me-2"></i>Filtros</a>
            </div>
            {{-- <div class="d-flex"><a class="nav-link-style me-3" href="#"><i class="ci-arrow-left"></i></a><span class="fs-md">1 / 5</span><a class="nav-link-style ms-3" href="#"><i class="ci-arrow-right"></i></a></div> --}}
        </div>
        <!-- Toolbar with expandable filters-->
        <div class="collapse" id="shop-filters" style="">
            <div class="row pt-4">
                <div class="col-lg-4 col-sm-6">
                    <!-- Categories-->
                    <div class="card mb-grid-gutter">
                        <div class="card-body px-4">
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Categoría</h3>
                            <div class="accordion mt-n1" id="shop-categories">
                                <!-- Clothing-->
                                <div class="accordion-item">
                                    <div class="accordion-collapse collapse show" id="clothing" data-bs-parent="#shop-categories">
                                    <div class="accordion-body">
                                        <div class="widget widget-links widget-filter">
                                        <div class="input-group input-group-sm mb-2">
                                            {{-- <input class="widget-filter-search form-control rounded-end" type="text" placeholder="Search"><i class="ci-search position-absolute top-50 end-0 translate-middle-y fs-sm me-3"></i> --}}
                                            <select class="form-select flex-shrink-0" id="category-id" name="category_id" style="width: 10.5rem;">
                                                <option value="">Categoría</option>
                                                <option value="">Categoría</option>
                                                <option value="">Categoría</option>
                                                <option value="">Categoría</option>
                                                <option value="">Categoría</option>
                                                <option value="">Categoría</option>
                                                {{-- @foreach ($categories as $category)
                                                    <option
                                                        value="{{$category->id}}"
                                                        @selected(request('category_id') == $category->id)
                                                    >
                                                        {{$category->name}}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- Price range-->
                    {{-- <div class="card mb-grid-gutter">
                        <div class="card-body px-4">
                        <div class="widget">
                            <h3 class="widget-title">Price range</h3>
                            <div class="range-slider" data-start-min="250" data-start-max="680" data-min="0" data-max="1000" data-step="1">
                            <div class="range-slider-ui noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr"><div class="noUi-base"><div class="noUi-connects"><div class="noUi-connect" style="transform: translate(25%, 0px) scale(0.43, 1);"></div></div><div class="noUi-origin" style="transform: translate(-75%, 0px); z-index: 5;"><div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="680.0" aria-valuenow="250.0" aria-valuetext="$250"><div class="noUi-touch-area"></div><div class="noUi-tooltip">$250</div></div></div><div class="noUi-origin" style="transform: translate(-32%, 0px); z-index: 4;"><div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="250.0" aria-valuemax="1000.0" aria-valuenow="680.0" aria-valuetext="$680"><div class="noUi-touch-area"></div><div class="noUi-tooltip">$680</div></div></div></div><div class="noUi-pips noUi-pips-horizontal"><div class="noUi-marker noUi-marker-horizontal noUi-marker-large" style="left: 0%;"></div><div class="noUi-value noUi-value-horizontal noUi-value-large" data-value="0" style="left: 0%;">0</div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 1%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 2%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 3%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 4%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 5%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 6%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 7%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 8%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 9%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 10%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 11%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 12%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 13%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 14%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 15%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 16%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 17%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 18%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 19%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 20%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 21%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 22%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 23%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 24%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-large" style="left: 25%;"></div><div class="noUi-value noUi-value-horizontal noUi-value-large" data-value="250" style="left: 25%;">250</div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 26%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 27%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 28%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 29%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 30%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 31%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 32%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 33%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 34%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 35%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 36%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 37%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 38%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 39%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 40%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 41%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 42%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 43%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 44%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 45%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 46%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 47%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 48%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 49%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-large" style="left: 50%;"></div><div class="noUi-value noUi-value-horizontal noUi-value-large" data-value="500" style="left: 50%;">500</div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 51%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 52%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 53%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 54%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 55%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 56%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 57%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 58%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 59%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 60%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 61%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 62%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 63%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 64%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 65%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 66%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 67%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 68%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 69%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 70%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 71%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 72%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 73%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 74%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-large" style="left: 75%;"></div><div class="noUi-value noUi-value-horizontal noUi-value-large" data-value="750" style="left: 75%;">750</div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 76%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 77%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 78%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 79%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 80%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 81%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 82%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 83%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 84%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 85%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 86%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 87%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 88%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 89%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 90%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 91%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 92%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 93%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 94%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 95%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 96%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 97%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 98%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-normal" style="left: 99%;"></div><div class="noUi-marker noUi-marker-horizontal noUi-marker-large" style="left: 100%;"></div><div class="noUi-value noUi-value-horizontal noUi-value-large" data-value="1000" style="left: 100%;">1000</div></div></div>
                            <div class="d-flex pb-1">
                                <div class="w-50 pe-2 me-2">
                                <div class="input-group input-group-sm"><span class="input-group-text">$</span>
                                    <input class="form-control range-slider-value-min" type="text">
                                </div>
                                </div>
                                <div class="w-50 ps-2">
                                <div class="input-group input-group-sm"><span class="input-group-text">$</span>
                                    <input class="form-control range-slider-value-max" type="text">
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div> --}}
                    <!-- Filter by Brand-->
                    <div class="card mb-grid-gutter">
                        <div class="card-body px-4">
                            <div class="widget widget-filter">
                                <h3 class="widget-title">Marca</h3>
                                <div class="input-group input-group-sm mb-2">
                                <input class="widget-filter-search form-control rounded-end pe-5" type="text" placeholder="Search"><i class="ci-search position-absolute top-50 end-0 translate-middle-y fs-sm me-3"></i>
                                </div>
                                <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar="init" data-simplebar-auto-hide="false"><div class="simplebar-wrapper" style="margin: -4px -16px 0px 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 4px 16px 0px 0px;">
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="adidas">
                                    <label class="form-check-label widget-filter-item-text" for="adidas">Adidas</label>
                                    </div><span class="fs-xs text-muted">425</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ataylor">
                                    <label class="form-check-label widget-filter-item-text" for="ataylor">Ann Taylor</label>
                                    </div><span class="fs-xs text-muted">15</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="armani">
                                    <label class="form-check-label widget-filter-item-text" for="armani">Armani</label>
                                    </div><span class="fs-xs text-muted">18</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="banana">
                                    <label class="form-check-label widget-filter-item-text" for="banana">Banana Republic</label>
                                    </div><span class="fs-xs text-muted">103</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="bilabong">
                                    <label class="form-check-label widget-filter-item-text" for="bilabong">Bilabong</label>
                                    </div><span class="fs-xs text-muted">27</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="birkenstock">
                                    <label class="form-check-label widget-filter-item-text" for="birkenstock">Birkenstock</label>
                                    </div><span class="fs-xs text-muted">10</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="klein">
                                    <label class="form-check-label widget-filter-item-text" for="klein">Calvin Klein</label>
                                    </div><span class="fs-xs text-muted">365</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="columbia">
                                    <label class="form-check-label widget-filter-item-text" for="columbia">Columbia</label>
                                    </div><span class="fs-xs text-muted">508</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="converse">
                                    <label class="form-check-label widget-filter-item-text" for="converse">Converse</label>
                                    </div><span class="fs-xs text-muted">176</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="dockers">
                                    <label class="form-check-label widget-filter-item-text" for="dockers">Dockers</label>
                                    </div><span class="fs-xs text-muted">54</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="fruit">
                                    <label class="form-check-label widget-filter-item-text" for="fruit">Fruit of the Loom</label>
                                    </div><span class="fs-xs text-muted">739</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hanes">
                                    <label class="form-check-label widget-filter-item-text" for="hanes">Hanes</label>
                                    </div><span class="fs-xs text-muted">92</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="choo">
                                    <label class="form-check-label widget-filter-item-text" for="choo">Jimmy Choo</label>
                                    </div><span class="fs-xs text-muted">17</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="levis">
                                    <label class="form-check-label widget-filter-item-text" for="levis">Levi's</label>
                                    </div><span class="fs-xs text-muted">361</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="lee">
                                    <label class="form-check-label widget-filter-item-text" for="lee">Lee</label>
                                    </div><span class="fs-xs text-muted">264</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wearhouse">
                                    <label class="form-check-label widget-filter-item-text" for="wearhouse">Men's Wearhouse</label>
                                    </div><span class="fs-xs text-muted">75</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="newbalance">
                                    <label class="form-check-label widget-filter-item-text" for="newbalance">New Balance</label>
                                    </div><span class="fs-xs text-muted">218</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="nike">
                                    <label class="form-check-label widget-filter-item-text" for="nike">Nike</label>
                                    </div><span class="fs-xs text-muted">810</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="navy">
                                    <label class="form-check-label widget-filter-item-text" for="navy">Old Navy</label>
                                    </div><span class="fs-xs text-muted">147</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="polo">
                                    <label class="form-check-label widget-filter-item-text" for="polo">Polo Ralph Lauren</label>
                                    </div><span class="fs-xs text-muted">64</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="puma">
                                    <label class="form-check-label widget-filter-item-text" for="puma">Puma</label>
                                    </div><span class="fs-xs text-muted">370</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="reebok">
                                    <label class="form-check-label widget-filter-item-text" for="reebok">Reebok</label>
                                    </div><span class="fs-xs text-muted">506</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="skechers">
                                    <label class="form-check-label widget-filter-item-text" for="skechers">Skechers</label>
                                    </div><span class="fs-xs text-muted">209</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hilfiger">
                                    <label class="form-check-label widget-filter-item-text" for="hilfiger">Tommy Hilfiger</label>
                                    </div><span class="fs-xs text-muted">487</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="armour">
                                    <label class="form-check-label widget-filter-item-text" for="armour">Under Armour</label>
                                    </div><span class="fs-xs text-muted">90</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="urban">
                                    <label class="form-check-label widget-filter-item-text" for="urban">Urban Outfitters</label>
                                    </div><span class="fs-xs text-muted">152</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="vsecret">
                                    <label class="form-check-label widget-filter-item-text" for="vsecret">Victoria's Secret</label>
                                    </div><span class="fs-xs text-muted">238</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wolverine">
                                    <label class="form-check-label widget-filter-item-text" for="wolverine">Wolverine</label>
                                    </div><span class="fs-xs text-muted">29</span>
                                </li>
                                <li class="widget-filter-item d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wrangler">
                                    <label class="form-check-label widget-filter-item-text" for="wrangler">Wrangler</label>
                                    </div><span class="fs-xs text-muted">115</span>
                                </li>
                                </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar simplebar-visible" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar simplebar-visible" style="height: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div></div></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-md-center mx-n2" id="grid-products">
        <!-- 2do PRODUCT ORIGINAL DEL TEMPLATE (para referencia) -->
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4 pt-3">
            <div class="card product-card">
                <a class="card-img-top d-block overflow-hidden" href="#" previewlistener="true">
                    <img src="{{Storage::url($product->featured)}}" alt="Product">
                </a>
                <div class="card-body py-2">
                    @auth
                        <a class="product-meta d-block fs-xs pb-1" href="#">stock: {{ $product->totalAvailableQuantity }}</a>
                    @endauth
                    <h3 class="product-title fs-sm">
                        <a href="#" previewlistener="true">
                            {{$product->name}}
                        </a>
                    </h3>
                    @auth
                        <div class="d-flex justify-content-between">
                            <div class="product-price">
                                <x-amount-formatter :amount="$product->defaultPrice" />
                            </div>
                        </div>
                    @endauth
                </div>
                <div class="card-body {{Auth::check()? 'card-body-hidden': ''}}">
                    @auth
                        <form action="{{ route('cart.store') }}" class="d-flex mb-2" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="number" class="form-control me-2" placeholder="cantidad" name="quantity" min="1" value="1">
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->name }}" name="name">
                            <input type="hidden" value="{{ $product->brand }}" name="brand">
                            <input type="hidden" value="{{ $product->defaultPrice }}" name="price">
                            <input type="hidden" value="{{ $product->location }}"  name="location">
                            {{-- <button class="px-4 py-1.5 text-white text-sm bg-blue-800 rounded">Add To Cart</button> --}}
                            <button class="btn btn-primary btn-sm add-to-cart-btn" data-product-id="{{ $product->id }}" type="submit">
                                <i class="ci-cart fs-sm me-1"></i>Agregar al Carrito
                            </button>
                        </form>
                    @endauth
                    <div class="text-center">
                        <a class="nav-link-style fs-ms" data-bs-toggle="modal" data-bs-target="#quick-view-{{$product->id}}">
                            <i class="bi bi-eye"></i> Vista rápida
                        </a>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>

        <div class="modal fade modal-quick-view" id="quick-view-{{$product->id}}" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title product-title" id="quickViewLabel">
                            <a href="shop-single-v1.html" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Go to product page">
                                {{$product->name}}
                            </a>
                        </h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Product gallery-->
                            <div class="col-lg-7 pe-lg-0">
                                <div class="product-gallery">
                                    <div class="product-gallery-preview order-sm-2">
                                        <div class="product-gallery-preview-item active">
                                            <img src="{{$product->featured_url}}" alt="Product">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product details-->
                            <div class="col-lg-5 pt-4 pt-lg-0 image-zoom-pane">
                                <div class="product-details ms-auto pb-3">
                                    @auth
                                        <div class="mb-3">
                                            <x-amount-formatter :amount="$product->price" />
                                        </div>
                                        <div class="fs-sm mb-4">
                                            <span class="text-heading fw-medium me-1">Stock:</span>
                                            <span class="text-muted" id="colorOptionText">1</span>
                                        </div>
                                        <form action="{{ route('cart.store') }}" class="mb-grid-gutter" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3 d-flex align-items-center">
                                                @csrf
                                                <input type="number" class="form-control me-3" placeholder="cantidad" name="quantity" min="1" value="1">
                                                <input type="hidden" value="{{ $product->id }}" name="id">
                                                <input type="hidden" value="{{ $product->name }}" name="name">
                                                <input type="hidden" value="{{ $product->brand }}" name="brand">
                                                <input type="hidden" value="{{ $product->price }}" name="price">
                                                <input type="hidden" value="{{ $product->featured }}"  name="featured">
                                                <button class="btn btn-solar btn-shadow d-block w-100" type="submit">
                                                    <i class="ci-cart fs-sm me-1"></i>Agregar al Carrito
                                                </button>
                                            </div>
                                        </form>
                                    @endauth
                                    @if (!is_null($product->data_sheet_url))
                                        <a
                                            href="{{$product->data_sheet_url}}"
                                            class="btn btn-outline-accent float-end"
                                            target="_blank">
                                            Ficha Técnica
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row justify-content-center mb-3">
        <div class="tns-carousel pt-3">
            <div class="tns-carousel-brands">
                <!-- Carousel slides here -->
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/longi.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/solis.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/risen.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/s5.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="#" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/huawei.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/victron.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/trina.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/growatt.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/znshine.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/unirac.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/tw-solar.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/fronius.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/soluna.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/gosolar.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/pylontech.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/srne.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/yassion.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/zbeny.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/parts-master.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/xpower.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/ultrastart.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/yassion.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
                <div>
                    <a href="" class="d-block bg-white border py-4 py-sm-5 px-2">
                        <img src="{{asset('brands/zbeny.webp')}}" class="d-block mx-auto" style="width: 165px;" alt="Alt text">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Selección de Sucursal -->
<div class="modal fade" tabindex="-1" role="dialog" id="selectQuantityModal" aria-labelledby="selectQuantityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectQuantityModalLabel">Selecciona una Sucursal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="quantitySelectionForm">
                <div class="modal-body">
                    <!-- El formulario se generará dinámicamente aquí -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-md">Agregar al Carrito</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', (e) => {
    // Tiny Slider:
    let sliderHero = tns({
        container: '.tns-carousel-hero',
        nav: true, // Desactiva los puntos de navegación inferiores
        controls: false, // Desactiva los botones de anterior/siguiente
        mouseDrag: true,
        autoplay: false,
        autoplayButtonOutput: false,
        autoplayTimeout: 3000, // Establece el intervalo de autoplay a 4000ms (4 segundos)
        loop: true, // Permite que el slider se repita infinitamente
        // responsive: {
        //     "0": {"items": 1},
        //     "360": {"items": 2},
        //     "600": {"items": 3},
        //     "991": {"items": 4},
        //     "1200": {"items": 4} // A partir de 1200px, muestra 4 elementos
        // }
    });

    let sliderBrands = tns({
        container: '.tns-carousel-brands',
        nav: false, // Desactiva los puntos de navegación inferiores
        controls: false, // Desactiva los botones de anterior/siguiente
        mouseDrag: true,
        autoplay: true, // Activa el autoplay
        autoplayButtonOutput: false,
        autoplayTimeout: 3000, // Establece el intervalo de autoplay a 4000ms (4 segundos)
        loop: true, // Permite que el slider se repita infinitamente
        responsive: {
            "0": {"items": 1},
            "360": {"items": 2},
            "600": {"items": 3},
            "991": {"items": 4},
            "1200": {"items": 4} // A partir de 1200px, muestra 4 elementos
        }
    });

    window.ResizeObserver = ResizeObserver;

    //
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');

            fetch(`/cart/product/${productId}/stock`)
                .then( response => response.json() )
                .then( data => {
                    // Llenar el modal:
                    const modalBody = document.querySelector('#selectQuantityModal .modal-body');
                    modalBody.innerHTML = '';

                    // Generar campos del formulario para cada sucursal
                    data.stocks.forEach(location => {
                        const label = document.createElement('label');
                        label.textContent = `${location.name} (cantidad ${location.quantity} )`;
                        label.className = `mt-2`;
                        label.htmlFor = `quantity-${location.id}`;

                        const input = document.createElement('input');
                        input.type = 'number';
                        input.id = `quantity-${location.id}`;
                        input.name = `quantity[${location.name}]`;
                        input.min = 0;
                        input.max = location.quantity;
                        input.value = 1;
                        input.className = 'form-control';

                        modalBody.appendChild(label);
                        modalBody.appendChild(input);
                    });
                })

            let modalElement = document.getElementById('selectQuantityModal');
            let modalInstance = new bootstrap.Modal(modalElement);
            modalInstance.show();
        });
    });

    document.getElementById('quantitySelectionForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const selectedQuantities = {};
        document.querySelectorAll('#selectQuantityModal input[type="number"]').forEach(input => {
            const locationName = input.name.replace('quantity[', '').replace(']', '');
            selectedQuantities[locationName] = input.value;
        });

        // Agrega el objeto de cantidades seleccionadas al formulario como antes
        const quantitiesInput = document.querySelector('input[name="quantities"]') || document.createElement('input');
        quantitiesInput.type = 'hidden';
        quantitiesInput.name = 'quantities';
        quantitiesInput.value = JSON.stringify(selectedQuantities);
        const form = document.querySelector('form[action="{{ route('cart.store') }}"]');
        form.appendChild(quantitiesInput);

        new bootstrap.Modal(document.getElementById('selectQuantityModal')).hide();

        form.submit();
    });


})
</script>


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
