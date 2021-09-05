<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

require_once 'vendor/autoload.php';

class Order extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('en_HK');
        DB::beginTransaction();

        try {
            for ($i = 0; $i < 1000; $i++) {
                $d = $faker->dateTime();

                $order = \App\Models\Order::create([
                    'name' => $faker->name,
                    'mobile' => $faker->mobileNumber,
                    'address' => $faker->town,
                    'custom_id' => $faker->ean8(),
                    'specification' => $faker->regexify('[A-Z]-([0-9]{3,5})'),
                    'barcode' => $faker->ean13(),
                    'price' => $faker->randomFloat(2, 90, 500),
                    'num' => 2,
                    'buyer_nick' => $faker->firstName(),
                    'created' => $d,
                    'modified' => $d,
                ]);

                for ($j = 0; $j < 2; $j++) {


                    OrderItem::create([

                        'order_id' => $order->id,
                        'sku' => $order->custom_id,
                        'spec' => $order->specification,
                        'num' => 1,
                        'platform' => $faker->randomElement(['taobao', 'pdd', 'douyin', 'kuaishou', 'jd']),
                        'bill_code' => $faker->isbn13,
                        'created' => $order->created,
                        'modified' => $order->modified,
                        'oid' => $faker->numberBetween($min = 10000000000, $max = 99999999999),
                    ]);
                }
                logger('insert order '. $order->id."\n");
            }
            DB::commit();
        } catch (\Exception $exception) {

            logger($exception->getMessage());
            return $exception->getMessage();
        }

    }
}
