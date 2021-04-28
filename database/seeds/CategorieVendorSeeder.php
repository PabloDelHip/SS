<?php

use Illuminate\Database\Seeder;
use App\Categorie_Vendor;
class CategorieVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Categorie_Vendor::class, 10)->create();
        
        /*DB::table('categories_vendors')->insert([
            'name' => 'Familiar',
        ]); */
    }
}
