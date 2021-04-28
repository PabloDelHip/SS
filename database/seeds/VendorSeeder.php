<?php

use Illuminate\Database\Seeder;
use App\Vendor;
class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vendor::class, 25)->create();
    }
}
