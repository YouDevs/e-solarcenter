<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductStockService
{
    public function getProductStockForProduct(Product $product, $locationId)
    {
        $localStock = null;
        $nationalStockQuantity = 0;

        foreach ($product->stocks as $stock) {
            if ($stock->quantity_available != 0) {
                if ($stock->location->id == $locationId) {
                    $localStock = [
                        'id' => $stock->location->id,
                        'name' => $stock->location->name,
                        'quantity' => $stock->quantity_available,
                    ];
                } else {
                    $nationalStockQuantity += $stock->quantity_available;
                }
            }
        }

        $nationalStock = null;
        if ($nationalStockQuantity > 0) {
            $nationalStock = [
                'id' => 0, // Este ID es un identificador genérico para el stock nacional.
                'name' => 'Nacional',
                'quantity' => $nationalStockQuantity,
            ];
        }

        return [
            'localStock' => $localStock,
            'nationalStock' => $nationalStock,
        ];
    }



    // public function getProductStock($productId)
    // {
    //     $locationId = auth()->user()->customer->location_id;
    //     $product = Product::with(['stocks.location'])->findOrFail($productId);

    //     $localStock = null;
    //     $nationalStockQuantity = 0;

    //     foreach ($product->stocks as $stock) {
    //         if ($stock->location->id == $locationId) {
    //             $localStock = [
    //                 'id' => $stock->location->id,
    //                 'name' => $stock->location->name,
    //                 'quantity' => $stock->quantity_available,
    //             ];
    //         } else {
    //             $nationalStockQuantity += $stock->quantity_available;
    //         }
    //     }

    //     Log::info($localStock);

    //     return [
    //         'localStock' => $localStock,
    //         'nationalStock' => [
    //             'name' => 'Nacional',
    //             'quantity' => $nationalStockQuantity,
    //         ],
    //     ];
    // }
}