<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockAssitanceRequest;

class StockAssistanceRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'message' => 'required|string',
        ]);

        $customerEmail = auth()->user()->email;
        $customerName = auth()->user()->name;

        StockAssitanceRequest::create([
            'customer_id' => auth()->user()->customer->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Solicitud enviada correctamente.']);
    }
}
