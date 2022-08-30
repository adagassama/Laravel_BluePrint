<?php

namespace Database\Seeders;

use App\Models\Facture;
use Illuminate\Database\Seeder;

class FactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facture::factory()->count(5)->create();
    }
}
