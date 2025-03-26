<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_settings')->insert([
                [
                    'name'  => "google_client_secret",
                    'val'   => "",
                    'group' => "advance",
                ],
                [
                    'name'  => "google_client_id",
                    'val'   => "",
                    'group' => "advance",
                ],
                [
                    'name'  => "google_enable",
                    'val'   => "1",
                    'group' => "advance",
                ],
                [
                    'name'  => "facebook_client_secret",
                    'val'   => "",
                    'group' => "advance",
                ],
                [
                    'name'  => "facebook_client_id",
                    'val'   => "",
                    'group' => "advance",
                ],
                [
                    'name'  => "facebook_enable",
                    'val'   => "1",
                    'group' => "advance",
                ],
                [
                    'name'  => "twitter_client_id",
                    'val'   => "",
                    'group' => "advance",
                ],
                [
                    'name'  => "twitter_client_secret",
                    'val'   => "",
                    'group' => "advance",
                ],
                [
                    'name'  => "twitter_enable",
                    'val'   => "1",
                    'group' => "advance",
                ],
                [
                    'name'  => "",
                    'val'   => "",
                    'group' => "advance",
                ],
            ]);
        // Gateways setting
        DB::table('core_settings')->insert([
                [
                    'name'  => "g_paypal_enable",
                    'val'   => "1",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_paypal_name",
                    'val'   => "Paypal",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_paypal_test",
                    'val'   => "1",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_paypal_convert_to",
                    'val'   => "usd",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_paypal_exchange_rate",
                    'val'   => "1",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_paypal_test_account",
                    'val'   => "",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_paypal_test_client_id",
                    'val'   => "",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_paypal_test_client_secret",
                    'val'   => "",
                    'group' => "payment",
                ]
            ]);
        DB::table('core_settings')->insert([
                [
                    'name'  => "g_stripe_enable",
                    'val'   => "1",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_stripe_name",
                    'val'   => "Stripe",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_stripe_stripe_enable_sandbox",
                    'val'   => "1",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_stripe_stripe_test_secret_key",
                    'val'   => "",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_stripe_stripe_test_publishable_key",
                    'val'   => "",
                    'group' => "payment",
                ]
            ]);
        DB::table('core_settings')->insert([
                [
                    'name'  => "g_two_checkout_gateway_enable",
                    'val'   => "1",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_two_checkout_gateway_name",
                    'val'   => "Two Checkout",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_two_checkout_gateway_twocheckout_enable_sandbox",
                    'val'   => "1",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_two_checkout_gateway_twocheckout_account_number",
                    'val'   => "",
                    'group' => "payment",
                ],
                [
                    'name'  => "g_two_checkout_gateway_twocheckout_secret_word",
                    'val'   => "",
                    'group' => "payment",
                ]
            ]);
    }
}
