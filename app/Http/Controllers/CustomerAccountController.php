<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\DeliveryStatusEnum;
use App\Services\TrackingService;
use App\Http\Requests\CustomerContactRequest;
use App\Http\Requests\UpdateCustomerProfileRequest;
use App\Mail\OrderDelivered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\CustomerContact;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class CustomerAccountController extends Controller
{
    protected $trackingService;

    public function __construct(TrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function profile()
    {
        $customer = auth()->user()->customer;

        $delivery_addresses = collect([$customer->delivery_address_1, $customer->delivery_address_2, $customer->delivery_address_3])
                                ->filter()
                                ->values()
                                ->all();

        $orders = Order::all();
        return view('customer.account-profile', [
            'customer' => $customer,
            'orders' => $orders,
            'delivery_addresses' => $delivery_addresses
        ]);
    }

    public function profileUpdate(UpdateCustomerProfileRequest $request, Customer $customer)
    {

        // Actualizar nombre y correo electrónico
        $customer->user->name = $request->name;
        $customer->user->email = $request->email;
        $customer->default_address = $request->default_address + 1;
        $customer->user->save();
        $customer->save();

        // Actualizar contraseña si se proporcionó una nueva
        if (!empty($request->password)) {
            $customer->user->password = Hash::make($request->password);
            $customer->save();
            $customer->user->save();
        }

        session()->flash('message', 'Perfil actualizado con éxito');
        session()->flash('icon', 'success');

        return redirect()->back();
    }

    public function locationUpdate(Request $request)
    {
        $customer = Auth::user()->customer;
        $customer->location_id = $request->location_id;
        $customer->save();
        return redirect()->back();
    }

    public function orders(Request $request)
    {
        $customer = Auth::user()->customer;

        if( $customer->orders()->exists() ) {
            $query = $customer->orders()->orderBy('id', 'desc');

            // Aplica filtros
            if ($request->filled('status')) {
                $query->where('status', $request->input('status'));
            }
            if ($request->filled('delivery_status')) {
                $query->where('delivery_status', $request->input('delivery_status'));
            }
            if ($request->filled('created_at')) {
                $date = $request->input('created_at');
                $query->whereDate('created_at', $date);
            }

            // Pagina el resultado
            $orders = $query->paginate(5);

            // Para generar el concepto de pago:
            $customer = auth()->user()->customer;
            $last_order = Order::where('customer_id', $customer->id)->orderBy('created_at','DESC')->first();
            $last_order_id = !is_null($last_order) ? $last_order->id: 1;

            foreach ($orders as $order) {
                $latest_status = null;

                // Obtiene el estado de entrega actualizado
                // if($order->tracking_number && $order->courier_code) {
                //     $latest_status = $this->trackingService->getLatestDeliveryStatus($order->tracking_number, $order->courier_code);
                // }

                // Actualiza el estado en la base de datos si es diferente
                // if (isset($latest_status['status']) && ($order->delivery_status && $order->delivery_status !== $latest_status)) {
                //     $order->update(['delivery_status' => $latest_status['status']]);

                //     //TODO: enviar correo desde un cron-job.
                //     if( $latest_status == 'Delivered' ) {
                //         Mail::to( $order->customer->user->email )->send(new OrderDelivered($order) );

                //         //TODO: enviar correo también al operador:
                //         // Mail::to( 'carlos.hernandez@solar-center.mx' )->send( new OrderDeliveredAdmin($order) );
                //     }
                // }

                $order->payment_concept = $this->generatePaymentConcept($last_order_id, $customer->company_name);

                // Traduce el estado para mostrarlo en la vista
                $order->translated_delivery_status = DeliveryStatusEnum::getTranslatedStatus($order->delivery_status);

        }
        }

        return view('customer.account-orders', [
            'customer' => $customer,
            'orders' => $orders,
            'status' => $request->has('status')? $request->status: null,
            'delivery_status' => $request->has('delivery_status')? $request->delivery_status: null,
            'created_at' => $request->has('created_at')? $request->created_at: null
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

    public function orderDelete(Request $request, Order $order)
    {
        $order->items()->delete();
        $order->delete();

        session()->flash('message', 'La orden ha sido eliminada con éxito.');
        session()->flash('icon', 'success');
        return redirect()->back();
    }


    private function generatePaymentConcept($last_order_id, $company_name)
    {
        $folio = sprintf('%04d', $last_order_id);

        // Divide el nombre de la empresa en palabras y toma la primera palabra
        $company_words = explode(' ', $company_name);
        // $first_word_of_company_name = $company_words[0];

        // return  Auth::user()->customer->netsuite_key .' '. $folio .' '. $first_word_of_company_name .' '. date('y-m-d');
        return  Auth::user()->customer->netsuite_key .' '. $folio .' '. date('y-m-d');
    }

}
