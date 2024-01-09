<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaidOrder;
use Illuminate\Support\Facades\DB;
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
        return view('checkout-shipping', compact('cart_items'));
    }

    public function payment()
    {
        $cart_items = \Cart::getContent();

        $customer = auth()->user()->customer;
        $last_order = Order::where('customer_id', $customer->id)->orderBy('created_at','DESC')->first();

        $last_order_id = !is_null($last_order) ? $last_order->id: 1;
        $payment_concept = $this->generatePaymentConcept($last_order_id, $customer->company_name);

        return view('checkout-payment', compact('cart_items', 'payment_concept'));
    }

    public function store(Request $request)
    {
        // Obtener el ID del cliente autenticado
        $customer_id = auth()->user()->customer->id; // Asegúrate de que este sea el campo correcto para el ID del cliente

        // Comenzar una transacción
        DB::beginTransaction();

        try {
            // Crear la orden
            $order = Order::create([
                'customer_id' => $customer_id,
                'total' => \Cart::getTotal(),
                'status' => $request->has('pay_now') ? 'pending' : 'pending_payment',
            ]);

            // Iterar sobre los artículos del carrito y crear order_items
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

            if($request->has('pay_now') ) {
                Log::info("Enviando correo.... orden realizada!");
                Mail::to( $order->customer->user->email )->send( new PaidOrder($order) );
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

    public function complete()
    {
        session()->flash('message', 'Orden guardada exitosamente!');
        session()->flash('icon', 'success');

        return view('checkout-complete');
    }

    private function generatePaymentConcept($last_order_id, $company_name)
    {
        $folio = sprintf('%04d', $last_order_id);

        // Divide el nombre de la empresa en palabras y toma la primera palabra
        $company_words = explode(' ', $company_name);
        $first_word_of_company_name = $company_words[0];

        return 'Orden ' . $folio .' '. $first_word_of_company_name .' '. date('Y');
    }
}
