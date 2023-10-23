<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;

class CustomerRegistrationController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //TODO: crear Request Forms

        // Crear el usuario y el cliente
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        $user->assignRole('customer');

        $customer = Customer::create([
            'user_id' => $user->id,
            'company_name' => $request->get('company_name'),
            'rfc' => $request->get('rfc'),
            'delivery_address' => $request->get('delivery_address'),
            'status' => 'pending',
        ]);

        return "PRE REGISTRO EXITOSO!";
        return redirect()->route('registration.success');
    }
}
