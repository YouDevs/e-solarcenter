<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\DeliveryStatusEnum;
use App\Services\TrackingService;
use App\Http\Requests\CustomerContactRequest;
use App\Mail\OrderDelivered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerContact;
use Illuminate\Support\Facades\Log;

class CustomerAccountController extends Controller
{
    protected $trackingService;

    public function __construct(TrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function orders(Request $request)
    {
        Log::info( $request->all() );
        $customer = Auth::user()->customer;
        $query = $customer->orders()->orderBy('id', 'desc');

        // Aplica filtros
        if ($request->filled('status')) {
            Log::info( "status" );
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('delivery_status')) {
            Log::info( "delivery_status" );
            $query->where('delivery_status', $request->input('delivery_status'));
        }

        // Pagina el resultado
        $orders = $query->paginate(3);

        foreach ($orders as $order) {
            $latest_status = null;

            // Obtiene el estado de entrega actualizado
            if($order->tracking_number && $order->courier_code) {
                $latest_status = $this->trackingService->getLatestDeliveryStatus($order->tracking_number, $order->courier_code);
            }

            // Actualiza el estado en la base de datos si es diferente
            if (isset($latest_status) && ($order->delivery_status && $order->delivery_status !== $latest_status)) {
                $order->update(['delivery_status' => $latest_status]);

                //TODO: enviar correo desde un cron-job.
                if( $latest_status == 'delivered' ) {
                    Mail::to( $customer->user->email )->send(new OrderDelivered($order) );
                }
            }

            // Traduce el estado para mostrarlo en la vista
            $order->translated_delivery_status = DeliveryStatusEnum::getTranslatedStatus($order->delivery_status);
        }

        return view('customer.account-orders', [
            'customer' => $customer,
            'orders' => $orders,
            'status' => $request->has('status')? $request->status: null,
            'delivery_status' => $request->has('delivery_status')? $request->delivery_status: null
        ]);
    }

    public function contact()
    {
        return view('customer.contact');
    }

    public function sendCustomerContact(CustomerContactRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $message_body = $request->message;

        try {
            Mail::to( $email )->send( new CustomerContact( $name, $email, $phone, $subject, $message_body ) );
            session()->flash('message', 'Tu mensaje ha sido enviado con éxito!');
            session()->flash('icon', 'success');
        } catch (\Exception $e) {
            session()->flash('message', 'Hubo un error al enviar tu mensaje. Por favor, intenta de nuevo más tarde.');
            session()->flash('icon', 'error');
            Log::error('Error al encolar correo: ' . $e->getMessage());
        }

        return redirect()->back();
    }

}
