<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use App\Traits\OAuth1NetsuiteClientCreator;
use Illuminate\Support\Facades\Log;

class UpdateNewCustomers extends Command
{
    use OAuth1NetsuiteClientCreator;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-new-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It searches for new customers and updates their data such as addresses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = microtime(true);

        $this->updateNewCustomers();

        $end = microtime(true);
        $time = $end-$start;
        Log::info("----> update new customers duration: {$time}");
    }

    public function updateNewCustomers()
    {
        $endpoint = 'https://5874559-sb1.restlets.api.netsuite.com/app/';

        $client = $this->createOAuth1Client(
            $endpoint,
            config('app.consumer_key'),
            config('app.consumer_secret'),
            config('app.token_secret'),
            config('app.token'),
            config('app.realm')
        );

        $response = $client->get('site/hosting/restlet.nl', [
            'query' => ['script' => 2376, 'deploy' => 1, 'page' => 0],
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
        ]);

        $netsuiteCustomers = json_decode($response->getBody(), true);

        foreach ($netsuiteCustomers as $customer) {
            $dbCustomer = Customer::where('rfc', $customer['RFC'])->first();

            if ($dbCustomer && count($customer['DIRECCIONES']) > 0) {
                foreach ($customer['DIRECCIONES'] as $index => $address) {
                    $addressField = 'delivery_address_' . ($index + 1);
                    if ($dbCustomer->$addressField === null) {
                        $fullAddress = $address['CALLE'] . ', ' . $address['NUMERO'] . ', ' . $address['CODIGO_POSTAL'] . ', ' . $address['ESTADO'] . ', ' . $address['PAIS'];
                        $dbCustomer->$addressField = $fullAddress;
                    }
                }
                $dbCustomer->save();
            }
        }

        return 0;
    }
}
