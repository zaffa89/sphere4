<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
     
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <!-- Scripts -->
        
        @vite('resources/js/app.js')
      
    </head>
    <body class="bg-gray-300">
        <page size="A4">
            <div class="flex flex-col content-between h-full">
                <div class="flex justify-between">
                    <img src="/storage/logo_struttura.png" class="w-60" />
                    <div class="flex flex-col font-medium">
                        <span>Solution Med Srl</span>
                        <span>26100 Cremona (CR)</span>
                        <span>Via Giulio Ratti , 2</span>
                        <span>0372 027 380</span>
                        <span>info@solutionmed.it</span>
                    </div>
                </div>
                
                <div class="flex flex-1 flex-col gap-6 mt-10 mb-20 justify-between">
                    <div class="flex flex-col text-center font-bold">
                        <span>CERTIFICATO DI IDONEITA' ALLA PRATICA</span>
                        <span>SPORTIVA DI TIPO NON AGONISTICO</span>
                        <span>D.M. 24 Aprile 2013</span>
                    </div>                    
        
                    <div>
                        <p>COGNOME NOME {{ $data->paziente->ragione_sociale }}</p>
                        <p>NATO/A A <span class="uppercase">{{ $data->paziente->localitaNascita->nome }}</span></p>
                        <p>IL <span class="uppercase">{{ date('d/m/Y' , strtotime($data->paziente->data_nascita)) }}</span></p>
                        <p>RESIDENTE IN <span class="uppercase">{{ $data->paziente->indirizzo }}, {{ $data->paziente->civico }} - {{ $data->paziente->localitaNascita->cap }} ({{$data->paziente->localitaNascita->sigla_provincia}})</span></p>
                        <p>C.F. <span class="uppercase">{{ $data->paziente->codice_fiscale }}</span></p>
                    </div>
                    
                    <div class="uppercase">
                        il soggetto, sulla base della visita medica da me effettuata, dai valori di pressione arteriosa rilevati, nonchè dal referto del tracciato ECG eseguito in data [DATA_VISITA] non presenta controindicazioni in atto
                        alla pratica di attività sportiva non agonistica                        
                    </div>
                    <div class="uppercase">
                        il presente certificato ha validità annuale dalla data del rilascio
                    </div>
                </div>
                <div class="flex justify-between mb-10">
                    <span>Cremona, GG/MM/AAAA</span>
                    <div class="h-20 text-center">
                        <p>TIMBRO E FIRMA DEL MEDICO</p>
                        <div class="flex flex-col text-center">
                            <span>{{ $data->medico->ragione_sociale}}</span>
                            <span>SPEC. IN MED. DELLO SPORT</span>
                            <span>CF. ZFFNHL89C17D150M</span>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-full text-center text-sm text-gray-700">
                        © 2022 Solution Med Srl | P.IVA 01768410191 | Via Mons. Giulio Ratti 2 - 26100 CREMONA(CR)
                    </div>
                </div>
            </div>
        </page>
    </body>
</html>

<style>
    body {
        margin-top: 10px;
    }

    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-top: 0.5cm;
        margin-bottom: 0.5cm;
        padding: 1cm;
        //box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);        
    }

    page[size="A4"] {  
        width: 21cm;
        height: 29.7cm; 
    }

    @media print {
        body , page {
            margin: 0;            
        }
    }
</style>
<!-- 
    <body class="font-sans bg-gray-50 print:bg-white">        
        <div style="page-break-after: always" class="p-5">
         
        </div>
           
    </body>

<style>
    body {
        
    }
    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
    }
    page[size="A4"] {  
        width: 21cm;
        height: 29.7cm; 
    }
    page[size="A4"][layout="landscape"] {
        width: 29.7cm;
        height: 21cm;  
    }
    page[size="A3"] {
        width: 29.7cm;
        height: 42cm;
    }
    page[size="A3"][layout="landscape"] {
        width: 42cm;
        height: 29.7cm;  
    }
    page[size="A5"] {
        width: 14.8cm;
        height: 21cm;
    }
    page[size="A5"][layout="landscape"] {
        width: 21cm;
        height: 14.8cm;  
    }
    @media print {
        body, page {
            margin: 0;
            
        }
    }
</style>
-->