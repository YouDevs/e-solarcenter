<div class="modal fade" id="order-details-{{$order->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">No. de Orden - {{$order->folio()}}</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-0">
                @foreach ($order->items as $item)
                    <!-- Item-->
                    <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
                        <div class="d-sm-flex text-center text-sm-start">
                            <a class="d-inline-block flex-shrink-0 mx-auto" style="width: 10rem;">
                                <img src="{{Storage::url($item->product->featured)}}" alt="{{$item->product->name}}" width="120">
                            </a>
                            <div class="ps-sm-4 pt-2">
                                <h3 class="product-title fs-base mb-2">
                                    <a>{{$item->product->name}}</a>
                                </h3>
                                <div class="fs-sm"><span class="text-muted me-2">Marca:</span>8.5</div>
                                <div class="fs-sm"><span class="text-muted me-2">SKU:</span>{{$item->product->sku}}</div>
                                <div class="fs-lg text-accent pt-2">
                                    <x-amount-formatter :amount="$item->price" />
                                </div>
                            </div>
                        </div>
                        <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                            <div class="text-muted mb-2">Cantidad:</div>{{$item->quantity}}
                        </div>
                        <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                            <div class="text-muted mb-2">Subtotal</div>
                            <x-amount-formatter :amount="$item->price * $item->quantity" />
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Footer-->
            <div class="modal-footer flex-wrap justify-content-between bg-secondary fs-md">
                {{-- <div class="px-2 py-1"><span class="text-muted">Subtotal:&nbsp;</span><span>$265.<small>00</small></span></div> --}}
                {{-- <div class="px-2 py-1"><span class="text-muted">Shipping:&nbsp;</span><span>$22.<small>50</small></span></div> --}}
                <div class="px-2 py-1">
                    @if ($order->invoice)
                        <span>
                            <a
                                href="{{Storage::url($order->invoice)}}"
                                class="btn btn-outline-accent float-end"
                                target="_blank">
                                Ver factura
                            </a>
                        </span>
                    @endif
                </div>
                <div class="px-2 py-1">
                    <span class="text-muted">Total:&nbsp;</span>
                    <span class="fs-lg">
                        <x-amount-formatter :amount="$order->total" />
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>