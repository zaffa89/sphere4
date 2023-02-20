<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Paziente;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Events\PazienteVisualizzato;
use App\Http\Requests\ValidatePazienteRequest;
use Illuminate\Support\Facades\Auth;

class PazienteController extends Controller
{
    //proprietà per codice fiscale
    private $mesi = ['A', 'B', 'C', 'D', 'E', 'H', 'L', 'M', 'P', 'R', 'S', 'T'];
    private $vocali = ['A', 'E', 'I', 'O', 'U'];
    private $consonanti = ['B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'];
    private $numeri = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    private $alfabeto = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    private $matriceCodiceControllo = ["01" => 1, "00" => 0, "11" => 0, "10" => 1, "21" => 5, "20" => 2, "31" => 7, "30" => 3, "41" => 9, "40" => 4, "51" => 13, "50" => 5, "61" => 15, "60" => 6, "71" => 17, "70" => 7, "81" => 19, "80" => 8, "91" => 21, "90" => 9, "101" => 1, "100" => 0, "111" => 0, "110" => 1, "121" => 5, "120" => 2, "131" => 7, "130" => 3, "141" => 9, "140" => 4, "151" => 13, "150" => 5, "161" => 15, "160" => 6, "171" => 17, "170" => 7, "181" => 19, "180" => 8, "191" => 21, "190" => 9, "201" => 2, "200" => 10, "211" => 4, "210" => 11, "221" => 18, "220" => 12, "231" => 20, "230" => 13, "241" => 11, "240" => 14, "251" => 3, "250" => 15, "261" => 6, "260" => 16, "271" => 8, "270" => 17, "281" => 12, "280" => 18, "291" => 14, "290" => 19, "301" => 16, "300" => 20, "311" => 10, "310" => 21, "321" => 22, "320" => 22, "331" => 25, "330" => 23, "341" => 24, "340" => 24, "351" => 23, "350" => 25];        

    /* POST
    public function ricercaPaziente(Request $request)
    {
        $request->validate([
            'ricerca' => 'nullable|string'
        ]);
        
        return Paziente::where('ragione_sociale' , 'like' , '%'.strtolower(trim($request->ricerca)).'%')->orderBy('ragione_sociale')->limit(200)->get();
    }
    */
    public function ricercaPaziente($queryRicerca)
    {
        return $queryRicerca ? Paziente::with('localitaNascita' , 'localitaResidenza' , 'localitaRilascioDocumento')->withCount(['visiteMedsport' => function($query) { $query->where('accettata' , true); }])->where('ragione_sociale' , 'like' , '%'.strtolower(trim($queryRicerca)).'%')->orderBy('ragione_sociale')->limit(10)->get() : [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Paziente::with('localitaNascita' , 'localitaResidenza')->orderBy('id')->limit(50)->get(); //per le prove
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return new Paziente();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatePazienteRequest $request)
    {
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            //'codice_fiscale' => 'unique:pazienti,codice_fiscale',
            'sesso' => 'required',
            'data_nascita' => 'required|date',
            'localita_nascita_id' => 'nullable|integer|exists:tabella_localita,id',
            'email' => 'nullable|email',

            
        ]);
        
        $paziente = Paziente::create([
            'user_id' => Auth::user()->id,           

            'nome' => $request->nome,
            'cognome' => $request->cognome,                
            'ragione_sociale' => $request->cognome.' '.$request->nome,
            'data_nascita' => $request->data_nascita,
            'sesso' => $request->sesso,
            'localita_nascita_id' => $request->localita_nascita_id,
            'codice_fiscale' => $request->codice_fiscale,

            'struttura_id' => 1, //da fixare
            'codice' => null, //fare metodo appropriato                
            
            
            'localita_residenza_id' => $request->localita_residenza_id,
            'indirizzo' => $request->indirizzo,
            'civico' => $request->civico,

            'telefono' => $request->telefono,
            'telefono_fisso' => $request->telefono_fisso,
            'email' => $request->email,

            'note' => $request->note,

            'documento' => $request->documento,
            'documento_numero' => $request->documento_numero,
            'documento_data_rilascio' => $request->documento_data_rilascio,
            'documento_localita_rilascio_id' => $request->documento_localita_rilascio_id,

            'gruppo_sanguigno' => $request->gruppo_sanguigno,

            'consenso_privacy' => $request->consenso_privacy,
            'consenso_730' => $request->consenso_730,
            'consenso_sms' => $request->consenso_sms,
            'consenso_email' => $request->consenso_email,
        ]);
        
        return $paziente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paziente  $paziente
     * @return \Illuminate\Http\Response
     */
    public function show(Paziente $paziente)
    {
        return $paziente->load('localitaNascita' , 'localitaResidenza' , 'localitaRilascioDocumento');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paziente  $paziente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paziente $paziente)
    {
        return $paziente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paziente  $paziente
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatePazienteRequest $request, Paziente $paziente)
    {
        //aggiungere validazione
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'data_nascita' => 'required|date_format:Y-m-d',
            'sesso' => 'required|in:M,F',
            'codice_fiscale' => 'nullable|size:16|alpha_num'
        ]);

        DB::transaction(function () use ($request , $paziente) {            
            $paziente->update([                
                'user_id' => Auth::user()->id,

                'nome' => $request->nome,
                'cognome' => $request->cognome,                
                'ragione_sociale' => $request->cognome.' '.$request->nome,
                'data_nascita' => $request->data_nascita,
                'sesso' => $request->sesso,
                'localita_nascita_id' => $request->localita_nascita_id,
                'codice_fiscale' => $request->codice_fiscale,

                'struttura_id' => 1, //da fixare
                'codice' => null, //fare metodo appropriato                
                
                
                'localita_residenza_id' => $request->localita_residenza_id,
                'indirizzo' => $request->indirizzo,
                'civico' => $request->civico,

                'telefono' => $request->telefono,
                'telefono_fisso' => $request->telefono_fisso,
                'email' => $request->email,

                'note' => $request->note,

                'documento' => $request->documento,
                'documento_numero' => $request->documento_numero,
                'documento_data_rilascio' => $request->documento_data_rilascio,
                'documento_localita_rilascio_id' => $request->documento_localita_rilascio_id,

                'disabile' => $request->disabile,
                'gruppo_sanguigno' => $request->gruppo_sanguigno,

                'consenso_privacy' => $request->consenso_privacy,
                'consenso_730' => $request->consenso_730,
                'consenso_sms' => $request->consenso_sms,
                'consenso_email' => $request->consenso_email,
            ]);
        });
                
        return $paziente->load('localitaNascita' , 'localitaResidenza');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paziente  $paziente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paziente $paziente)
    {        
        $paziente->delete();
        
    }
    
    /* CODICE FISCALE ******************************************/
    public function cercaTramiteCodiceFiscale($codiceFiscale)
    {
        $paziente = Paziente::with('localitaNascita')->where('codice_fiscale' , '=' , trim($codiceFiscale))->first();
        return $paziente ? response()->json($paziente , 200) : response(null , 404);
    }

    public function calcolaCodiceFiscale(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'cognome' => 'required|string',
            'sesso' => 'required|size:1',
            'data_nascita' => 'required|date',
            'codice_catastale' => 'required'
        ]);                             
                
        $codiceFiscale = '';
        $nome = $this->sanitizeString($request->nome);
        $cognome = $this->sanitizeString($request->cognome);
        $sesso = $this->sanitizeString($request->sesso);

        $dataNascita = Carbon::parse($request->data_nascita);
        
        $giorno = $dataNascita->format('d');
        $mese = $dataNascita->format('n');
        $anno = $dataNascita->format('y');


        // inizia con il calcolo dei primi sei caratteri corrispondenti al nome e cognome
        $codiceFiscale = $this->calcolaCognome($cognome) . $this->calcolaNome($nome);

        // calcola i dati corrispondenti alla data di nascita
        if ($sesso == 'F') {
            $giorno += 40;
        }
        
        $codiceFiscale .= $anno . $this->mesi[$mese - 1] . $giorno;

        // aggiunge il codice del comune
        $codiceFiscale .= $request->codice_catastale;

        // e finalmente calcola il codice controllo
        $codiceControllo = 0;
        $alfanumerico = array_merge($this->numeri, $this->alfabeto);
        for ($i = 0; $i < 15; $i++) {
            $codiceControllo += $this->matriceCodiceControllo[strval(array_search($codiceFiscale[$i], $alfanumerico)) . strval((($i + 1) % 2))];
        }
        $codiceFiscale .= $this->alfabeto[$codiceControllo % 26];
        
        return $codiceFiscale;
    }

    private function calcolaNome($string)
    {
        $i = 0;
        $res = '';
        $cons = '';
        while (strlen($cons) < 4 && ($i + 1 <= strlen($string))) {
            if (array_search($string[$i], $this->consonanti) !== false) {
                $cons .= $string[$i];
            }
            $i++;
        }

        if (strlen($cons) > 3) {
            $res = $cons[0] . $cons[2] . $cons[3];
            return $res;
        } else {
            $res = $cons;
        }

        // Se non bastano prendo le vocali
        $i = 0;
        while (strlen($res) < 3 && ($i + 1 <= strlen($string))) {
            if (array_search($string[$i], $this->vocali) !== false) {
                $res .= $string[$i];
            }
            $i++;
        }
        $res .= "XXX";
        return substr($res, 0, 3);
    }

    /**
     * @param string $string
     */
    private function calcolaCognome($string)
    {
        $res = '';
        $i = 0;
        while(strlen($res) < 3 && ($i + 1 <= strlen($string))) {
            if (array_search($string[$i], $this->consonanti) !== false) {
                $res .= $string[$i];
            }
            $i++;
        }

        // Se non bastano le consonanti, prendo le vocali
        $i = 0;
        while(strlen($res) < 3 && ($i + 1 <= strlen($string))) {
            if (array_search($string[$i], $this->vocali) !== false) {
                $res .= $string[$i];
            }
            $i++;
        }

        $res .= "XXX";
        return substr($res, 0, 3);
    }

    private function sanitizeString($string)
    {
        $string = trim($string);
        $string = strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', $string));
        $string = str_replace(' ', '', $string);
        return $string;
    }
}
