<?php

namespace App\Http\Controllers\CustomerSupport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Mail\AccountActivated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('id', 'DESC')->get();
        return view('customer_support.customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customer_support.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        DB::beginTransaction();

        try {

            $customer->netsuite_key = $request->netsuite_key;
            $customer->user->password = Hash::make($request->password);
            $customer->status = 'active';
            $customer->save();
            $customer->user->save();

            Mail::to( $customer->user->email )->send( new AccountActivated($customer->user->email, $request->password) );

            DB::commit();

            session()->flash('message', 'Nuevo cliente activo: a venderle como desquiciado 🥴!');
            session()->flash('icon', 'error');

        } catch (\Exception $e) {
            session()->flash('message', 'Ups! Algo salió mal, pero no sabría decirte qué!');
            session()->flash('icon', 'error');
        }

        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
