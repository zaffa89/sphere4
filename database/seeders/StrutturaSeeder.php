<?php

namespace Database\Seeders;

use App\Models\Paziente;
use App\Models\Struttura;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StrutturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* STRUTTURA DI DEFAULT 1 */
        $struttura = Struttura::create([
            'nome' => 'Centro Medsport',
            'colore' => 'FFFFFF'
        ]);

        $struttura->ambulatori()->createMany([
            [
                'nome' => 'Ambulatorio 1',
                'ordine' => 1
            ],
            [
                'nome' => 'Ambulatorio 2',
                'ordine' => 2
            ],
            [
                'nome' => 'Ambulatorio 3',
                'ordine' => 3
            ]
        ]);

        $struttura->medici()->createMany([
            [
                'nome' => 'Medico 1',
            ],
            [
                'nome' => 'Medico 2'
            ]
        ]);

        $struttura->has(Paziente::factory()->count(10) , 'pazienti')->create();

        /* STRUTTURA DI DEFAULT 2 */
        $struttura = Struttura::create([
            'nome' => 'Centro Ambulatoriale',
            'colore' => 'DDDDDD'
        ]);

        $struttura->ambulatori()->createMany([
            [
                'nome' => 'Ambulatorio 1',
                'ordine' => 1
            ],
            [
                'nome' => 'Ambulatorio 2',
                'ordine' => 2
            ],
            [
                'nome' => 'Ambulatorio 3',
                'ordine' => 3
            ]
        ]);

        $struttura->medici()->createMany([
            [
                'nome' => 'Medico 3',
            ],
            [
                'nome' => 'Medico 4'
            ]
        ]);

    }
}
