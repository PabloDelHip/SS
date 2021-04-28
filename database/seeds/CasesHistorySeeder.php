<?php

use Illuminate\Database\Seeder;
use App\CasesHistory;
class CasesHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CasesHistory::class, 50)->create();
    }
}
