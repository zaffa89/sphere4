<?php

namespace Database\Seeders;

use App\Models\Struttura;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NumeratoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $struttura = Struttura::find(1);
        
        $numeratoreFatture = $struttura->numeratori()->create([
            'codice' => 'fattura',
            'descrizione' => 'Fatture struttura 1',
            'tipo' => 'annuale',
            'automatico' => true                    
        ]);

        $numeratoreFatture->numeratoreDet()->createMany([
            [
                'anno' => 2022,
                'valore' => 512
            ],
            [
                'anno' => 2023,
                'valore' => 128
            ]
        ]);

        $numeratoreCertificatiAgo = $struttura->numeratori()->create([     
            'codice' => 'certificato',
            'descrizione' => 'Certificati agonistici Struttura 1',
            'tipo' => 'progressivo',
            'automatico' => false
        ]);

        $numeratoreCertificatiAgo->numeratoreDet()->createMany([
            [
                'anno' => null,
                'valore' => 1024
            ]
        ]);

        $numeratoreCodicePaziente = $struttura->numeratori()->create([
            'codice' => 'codice-paziente',
            'descrizione' => 'Numeratore codice paziente (se non automatico)',
            'tipo' => 'progressivo',
            'automatico' => true
        ]);

        $numeratoreCodicePaziente->numeratoreDet()->create([
            'anno' => null,
            'valore' => 0
        ]);

        $struttura = Struttura::find(2);

        $numeratoreFatture = $struttura->numeratori()->create([
            'codice' => 'fattura',
            'descrizione' => 'Fatture struttura 2',
            'tipo' => 'annuale',
            'automatico' => true                    
        ]);

        $numeratoreFatture->numeratoreDet()->createMany([
            [
                'anno' => 2022,
                'valore' => 512
            ],
            [
                'anno' => 2023,
                'valore' => 128
            ]
        ]);

        $numeratoreCertificatiAgo = $struttura->numeratori()->create([     
            'codice' => 'certificato',
            'descrizione' => 'Certificati agonistici Struttura 2',
            'tipo' => 'progressivo',
            'automatico' => false
        ]);

        $numeratoreCertificatiAgo->numeratoreDet()->createMany([
            [
                'anno' => null,
                'valore' => 1024
            ]
        ]);

        $numeratoreCodicePaziente = $struttura->numeratori()->create([
            'codice' => 'codice-paziente',
            'descrizione' => 'Numeratore codice paziente (se non automatico)',
            'tipo' => 'progressivo',
            'automatico' => true
        ]);

        $numeratoreCodicePaziente->numeratoreDet()->create([
            'anno' => null,
            'valore' => 0
        ]);
        
    }
}
