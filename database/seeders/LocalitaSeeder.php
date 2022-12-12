<?php

namespace Database\Seeders;

use App\Models\Localita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocalitaSeeder extends Seeder
{
    private function sanitizeString($string)
    {
        $string = trim($string);
        $string = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $string));
        //$string = str_replace(' ', '', $string);
        return $string;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localita_vecchie = DB::connection('vecchio')->table('tab_localita')->join('tab_provincia' , 'tab_localita.id_provincia' , '=' , 'tab_provincia.id_provincia')->join('tab_regione' , 'tab_provincia.id_regione' , '=' , 'tab_regione.id_regione')->join('tab_nazione' , 'tab_localita.id_nazione' , '=' , 'tab_nazione.id_nazione')
        ->select(
            'tab_localita.id_localita as id', 
            'tab_localita.descrizione as nome' , 
            'tab_provincia.descrizione as provincia' ,
            'tab_provincia.codice as sigla_provincia' , 
            'tab_regione.descrizione as regione',
            'tab_nazione.descrizione as nazione',
            'tab_localita.cap',
            'tab_localita.cod_istat as codice_istat',
            'tab_localita.cod_fisc as codice_catastale',
            'tab_localita.id_asl')->get();

        foreach($localita_vecchie as $localita_vecchia)
        {            
            Localita::create([
                'vecchio_id' => $localita_vecchia->id,
                'nome' => $this->sanitizeString($localita_vecchia->nome),
                'provincia' => strtolower($localita_vecchia->provincia),
                'sigla_provincia' => strtolower($localita_vecchia->sigla_provincia),
                'regione' => strtolower($localita_vecchia->regione),
                'nazione' => strtolower($localita_vecchia->nazione),
                'cap' => $localita_vecchia->cap,
                'codice_istat' => $localita_vecchia->codice_istat,
                'codice_catastale' => strtoupper($localita_vecchia->codice_catastale),
                'asl_id' => $localita_vecchia->id_asl,
            ]);
        }
    }
}
