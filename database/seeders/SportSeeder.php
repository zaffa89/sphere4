<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sport_vecchi = DB::connection('vecchio')->table('tab_sport')->select()->get();

        foreach($sport_vecchi as $sport_vecchio)
        {            
            Sport::create([
                'id' => $sport_vecchio->id_sport,
                'nome' => strtolower($sport_vecchio->descrizione),
                'tipo_visita' => $sport_vecchio->tipo_visita,
                'codice' => $sport_vecchio->codice,
                'codice_federazione' => $sport_vecchio->cod_fed,
                'sigla_federazione' => $sport_vecchio->sigla_fed,
                'mesi_scadenza' => $sport_vecchio->mm_scad,

                'eta_minima_maschi' => $sport_vecchio->maschi_dal,
                'eta_massima_maschi' => $sport_vecchio->maschi_al,
                'eta_minima_tem_maschi' => null,
                
                'eta_minima_femmine' => $sport_vecchio->femmine_dal,
                'eta_massima_femmine' => $sport_vecchio->femmine_al,
                'eta_minima_tem_femmine' => null,
                
                'anno_di_riferimento' => $sport_vecchio->flag_anno_rif,
                'inizio_anno_riferimento' => $sport_vecchio->inizio_rif,
                'fine_anno_riferimento' => $sport_vecchio->fine_rif,
                
                'disabili' => $sport_vecchio->flag_per_disabili === 'S' ? true : false,
                'richiesto_gruppo_sanguigno' => $sport_vecchio->flag_gruppo_sang === 'S' ? true : false,
                'richiesto_eeg' => $sport_vecchio->flag_eeg === 'S' ? true : false,
                'prenotabile_online' => $sport_vecchio->prenotabile_online ? true : false
            ]);
        }
    }
}
