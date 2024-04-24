<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaidOrder;
use App\Mail\PaidOrderAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function details()
    {
        $cart_items = \Cart::getContent();

        return view('checkout-details', compact('cart_items'));
    }

    public function shipping()
    {
        $cart_items = \Cart::getContent();
        $locations = [];

        foreach($cart_items as $item) {
            $location = $item->attributes->location;

            if(!array_key_exists($location, $locations)) {
                $locations[$location] = [
                    'items' => [],
                ];
            }
            $locations[$location]['items'][] = $item;
        }

        $customer = auth()->user()->customer;

        $delivery_addresses = collect([$customer->delivery_address_1, $customer->delivery_address_2, $customer->delivery_address_3])
                                ->filter()
                                ->values()
                                ->all();

        return view('checkout-shipping', compact(
            'cart_items',
            'locations',
            'customer',
            'delivery_addresses'
        ));
    }

    public function selectedAddress(Request $request)
    {
        $validated = $request->validate([
            'default_address' => 'required|numeric',
        ]);

        // Almacenar la selección en la sesión
        session(['default_address' => $request->default_address + 1]);

        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        $cart_items = \Cart::getContent();

        $customer = auth()->user()->customer;
        $customerId = $customer->id;

        // Generar Folio de Orden:
        $lastFolio = Order::where('customer_id', $customerId)->max('folio');
        $newFolio = $lastFolio ? $lastFolio + 1 : 1;
        $payment_concept = $this->generatePaymentConcept($newFolio, $customer->company_name);

        return view('checkout-payment', compact('cart_items', 'payment_concept'));
    }

    public function store(Request $request)
    {
        $customer = auth()->user()->customer;
        $customerId = $customer->id;

        // Código para obtener la dirección de envío del cliente basado en el índice seleccionado por el cliente o default.
        $index = session('default_address');
        $addressPropertyName = "delivery_address_$index";
        $deliveryAddress = $customer->{$addressPropertyName};

        // Generar Folio de Orden:
        $lastFolio = Order::where('customer_id', $customerId)->max('folio');
        $newFolio = $lastFolio ? $lastFolio + 1 : 1;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_id' => $customerId,
                'folio' => $newFolio,
                'total' => \Cart::getTotal(),
                'payment_concept' => $request->payment_concept,
                'status' => $request->has('payment_submitted') ? 'payment_submitted' : 'pending_payment',
                'delivery_address' => $deliveryAddress,
            ]);

            session()->forget('default_address');

            foreach (\Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                // Actualizar el stock del producto
                // $product = Product::find($item->id);
                // $product->decrement('stock', $item->quantity);
            }

            // Confirmar la transacción
            DB::commit();

            // Vaciar el carrito
            \Cart::clear();

            if($request->has('payment_submitted') ) {
                Log::info("Enviando correo.... orden realizada!");
                Mail::to( $order->customer->user->email )->send( new PaidOrder($order) );
                // TODO: enviar al correo que le corresponda.
                Mail::to( 'carlos.hernandez@solar-center.mx' )->send( new PaidOrderAdmin($order) );
            }

            // Redireccionar o responder con éxito
            return redirect()->route('checkout.complete');

        } catch (\Exception $e) {
            // Algo salió mal, hacer rollback
            session()->flash('message', 'La transacción no ha podido ser guardada; comunicate con el administrador de la plataforma');
            session()->flash('icon', 'error');
            Log::info($e);

            DB::rollback();
            return redirect()->back()->with('error', 'Error al guardar la orden.');
        }
    }

    public function update(Request $request, Order $order)
    {
        DB::beginTransaction();

        try {
            // Actualiza la orden
            $order->update([
                'payment_concept' => $request->payment_concept,
                'status' => $request->has('payment_submitted') ? 'payment_submitted' : 'pending_payment',
            ]);

            // Confirmar la transacción
            DB::commit();

            if($request->has('payment_submitted') ) {
                Log::info("Enviando correo.... orden realizada!");
                Mail::to( $order->customer->user->email )->send( new PaidOrder($order) );
                // TODO: enviar al correo que le corresponda.
                Mail::to( 'carlos.hernandez@solar-center.mx' )->send( new PaidOrderAdmin($order) );
            }

            return redirect()->route('checkout.complete');

        } catch (\Exception $e) {
            // Algo salió mal, hacer rollback
            session()->flash('message', 'La transacción no ha podido ser guardada; comunicate con el administrador de la plataforma');
            session()->flash('icon', 'error');
            Log::info($e);

            DB::rollback();
            return redirect()->back()->with('error', 'Error al guardar la orden.');
        }
    }

    public function complete()
    {
        session()->flash('message', 'Orden guardada exitosamente!');
        session()->flash('icon', 'success');

        return view('checkout-complete');
    }

    private function generatePaymentConcept($lastFolio, $company_name)
    {
        $folio = sprintf('%04d', $lastFolio);

        // Divide el nombre de la empresa en palabras y toma la primera palabra
        $company_words = explode(' ', $company_name);
        // $first_word_of_company_name = $company_words[0];

        // return  Auth::user()->customer->netsuite_key .' '. $folio .' '. $first_word_of_company_name .' '. date('y-m-d');
        return  Auth::user()->customer->netsuite_key .' '. $folio .' '. date('y-m-d');
    }
}
