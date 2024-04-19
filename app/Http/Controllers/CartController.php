<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Support\Facades\Log;

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
        $quantities = json_decode($request->quantities, true);

        foreach ($quantities as $location => $quantity) {
            if ( (int) $quantity !== 0 && (int) $quantity > 0) {
                $uniqueId = $request->id . '-' . $location;

                \Cart::add([
                    'id' => $uniqueId,
                    'name' => $request->name,
                    'price' => $request->price,
                    'quantity' => $quantity,
                    'attributes' => array(
                        'location' => $location,
                        'brand' => $request->brand,
                        'featured' => $request->featured
                    )
                ]);
            }
        }

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

    public function getProductStock(Request $request, $productId)
    {
        $locationId = auth()->user()->customer->location_id;
        $product = Product::with(['stocks.location'])->findOrFail($productId);

        $localStock = null;
        $nationalStockQuantity = 0;

        foreach ($product->stocks as $stock) {
            if ($stock->location->id == $locationId) {
                // Este es el stock de la ubicación del usuario
                $localStock = [
                    'id' => $stock->location->id,
                    'name' => $stock->location->name,
                    'quantity' => $stock->quantity_available,
                ];
            } else {
                // Sumar el stock de otras ubicaciones como stock nacional
                $nationalStockQuantity += $stock->quantity_available;
            }
        }

        return response()->json([
            'localStock' => $localStock,
            'nationalStock' => [
                'name' => 'Nacional',
                'quantity' => $nationalStockQuantity,
            ],
        ]);
    }

}
