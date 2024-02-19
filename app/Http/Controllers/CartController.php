<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CartController extends Controller
{
    public function cartList()
    {
        // \Cart::clear();
        $cart_items = \Cart::getContent();
        $customer = auth()->user()->customer;

        if (is_null($customer)) {
            session()->flash('message', 'No tienes permiso para realizar esta acción.');
            session()->flash('icon', 'warning');
            return redirect()->back();
        }

        return view('cart', compact('cart_items'));
    }

    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'attributes' => array(
                'featured' => $request->featured,
                'brand' => $request->brand,
            )
        ]);

        session()->flash('success', 'Product is Added to Cart Successfully !');

        // return redirect()->route('cart.list');
        return redirect()->route('index');
    }

    public function updateCart(Request $request)
    {
        //TODO: consultar el stock antes de permitirle actualizar el carrito para comprobar que la cantidad de existe.

        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        $new_subtotal = \Cart::getTotal();

        $new_subtotal_formatted = view('components.amount-formatter', ['amount' => $new_subtotal])->render();
        return response()->json(['newSubtotalFormatted' => $new_subtotal_formatted]);
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->item_id);
        session()->flash('message', 'Elemento eliminado del carrito exitosamente!');
        session()->flash('icon', 'success');

        return redirect()->back();
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    // private function generatePaymentConcept($last_order_id, $company_name)
    // {
    //     $folio = sprintf('%04d', $last_order_id);

    //     // Divide el nombre de la empresa en palabras y toma la primera palabra
    //     $company_words = explode(' ', $company_name);
    //     $first_word_of_company_name = $company_words[0];

    //     return 'Orden ' . $folio .' '. $first_word_of_company_name .' '. date('Y');
    // }
}
