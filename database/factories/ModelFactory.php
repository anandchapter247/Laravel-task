<?php
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
    ];
 });

 $factory->define(App\Product::class, function (Faker\Generator $faker) {
    $array_rand = array('In stock','Out Of Stock');
    $stock = array_rand($array_rand,1);
    return [
        'name' => $faker->word,
        'price' => $faker->randomNumber(2),
        'in_stock' => $array_rand[$stock],
    ];
 });

 $factory->define(App\Order::class, function (Faker\Generator $faker) {
    $array_rand = array('Processed','New');
    $status = array_rand($array_rand,1);
    return [
        'invoice_number' => "INV_".str_random(4),
        'customer_id'    => factory('App\Customer')->create()->id,
        'total_amount'   => $faker->randomNumber(3),
        'status'         => $array_rand[$status],
    ];
});

 $factory->define(App\OrderItems::class, function (Faker\Generator $faker) {
    $order_id      = factory('App\Order')->create()->id;
    $product_id    = factory('App\Product')->create()->id;
    $product_arr   = DB::table('products')->where('id', $product_id)
                        ->select('price')->get()->toArray();
    $product_price = $product_arr[0]->price;
    //$quantity      = $faker->randomNumber(1);
    $total_amount  = $product_price;
    DB::table('orders')->where('id', $order_id)
          ->update(['total_amount' => $total_amount]);
    return [
        'order_id'   => $order_id,
        'product_id' => $product_id,
        'quantity'   => 1,
    ];
});
