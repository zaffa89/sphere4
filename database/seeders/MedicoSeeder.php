<?php

namespace Database\Seeders;

use App\Models\Medico;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medico::create([
            'nome' => 'Medico 1'
        ]);

        Medico::create([
            'nome' => 'Medico 2'
        ]);

        Medico::create([
            'nome' => 'Medico 3'
        ]);
    }
}
