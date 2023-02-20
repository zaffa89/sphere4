<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Struttura;
use App\Models\Numeratore;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function asd()
    {
        return DB::connection('vecchio')
            ->table('tab_localita')
            ->join('tab_provincia' , 'tab_localita.id_provincia' , '=' , 'tab_provincia.id_provincia')
            ->join('tab_regione' , 'tab_provincia.id_regione' , '=' , 'tab_regione.id_regione')
            ->join('tab_nazione' , 'tab_localita.id_nazione' , '=' , 'tab_nazione.id_nazione')
            ->select(
                'tab_localita.id_localita', 
                'tab_localita.descrizione as descrizione' , 
                'tab_provincia.descrizione as provincia' ,
                'tab_provincia.codice as sigla_provincia' ,
                'tab_regione.descrizione as regione',
                'tab_nazione.descrizione as nazione',
                'tab_localita.cap',
                'tab_localita.cod_istat as codice_istat',
                'tab_localita.cod_fisc as codice_catastale',
                'tab_localita.id_asl')
            ->where(function($query) {
                $query->where('tab_localita.cap' , null)
                ->orWhere('tab_localita.cod_istat', null)
                ->orWhere('tab_localita.cod_fisc' , null)
                ->orWhere('tab_localita.id_asl' , null);
            })    
            ->get();
    }

    public function numeratoriGolosi() {
        $struttura = Struttura::find(1);
        //$struttura->incrementaNumeratoreFattura(2023);
    
        return [
            'mesi' => Sport::where('id' , 1366)->value('mesi_scadenza'),
            'ultimo_certificato' => $struttura->numeratore('certificato'),
            'prossimo_certificato' => $struttura->prossimoNumeratore('certificato'),
            'fatture_2023' => $struttura->numeratoreFattura(2023),
            'prossima_fattura_2023' => $struttura->prossimoNumeratoreFattura(),
            'numeratore_certificato' => $struttura->numeratoreCertificato()            
            //'certificati_ago' => Struttura::numeratoreCertificati(),            
        ];
        
    }
}
