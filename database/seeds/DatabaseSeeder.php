<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        factory(App\Customer::class, 200)->create();
        factory(App\Product::class, 100)->create();
        //factory(App\Order::class, 50)->create();
        factory(App\OrderItems::class, 50)->create();
    }
}
