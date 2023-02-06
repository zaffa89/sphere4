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
                <div class="flex flex-col font-medium absolute ml-[14cm] w-[5cm]">
                    <span>Solution Med Srl</span>
                    <span>26100 Cremona (CR)</span>
                    <span>Via Giulio Ratti , 2</span>
                    <span>0372 027 380</span>
                    <span>info@solutionmed.it</span>
                </div>
                <div class="absolute mt-[5cm] ml-[3.5cm] w-[10cm] h-[0.6cm] overflow-hidden">
                    {{ $data->paziente->cognome }}
                </div>
                <div class="absolute mt-[6cm] ml-[3.5cm] w-[10cm]  h-[0.6cm] overflow-hidden">
                    {{ $data->paziente->nome }}
                </div>
                <div class="absolute mt-[7cm] ml-[3.5cm] w-[10cm]  h-[0.6cm] overflow-hidden">
                    {{ $data->paziente->localitaNascita->nome }}
                </div>
                <div class="absolute mt-[8cm] ml-[3.5cm] w-[10cm]  h-[0.6cm] overflow-hidden">
                    {{ date('d/m/Y' , strtotime($data->paziente->data_nascita)) }}
                </div>
                <div class="absolute mt-[9cm] ml-[5cm] w-[14cm] h-[0.6cm] overflow-hidden">
                    {{ $data->paziente->indirizzo }} {{ $data->paziente->civico }} - {{ $data->paziente->localitaResidenza->nome }} ({{ $data->paziente->localitaResidenza->sigla_provincia}})
                </div>
                <div class="absolute mt-[10cm] ml-[6cm] w-[10cm]  h-[0.6cm] overflow-hidden">
                    C.I. {{ $data->paziente->documento_numero }} ( C.Fisc. {{$data->paziente->codice_fiscale}} )
                </div>
                <div class="absolute mt-[11cm] ml-[6.5cm] w-[10cm]  h-[0.6cm] overflow-hidden">
                    {{ $data->sport->nome }} {{ $data->sport->codice_sport }}
                </div>
                <div class="absolute mt-[14cm] ml-[6.5cm] w-[10cm]  h-[0.6cm] overflow-hidden">
                    {{ $data->sport->nome }} {{ $data->sport->codice_sport }}
                </div>
                <div class="absolute mt-[16cm] ml-[6.5cm] w-[6cm]  h-[0.6cm] overflow-hidden">
                    [VALIDITA']
                </div>                
                <div class="absolute mt-[17cm] ml-[2cm] w-[5cm]  h-[0.6cm] overflow-hidden">
                    [DATA_VISITA]
                </div>
                <div class="absolute mt-[19cm] ml-[2cm] w-[5cm]  h-[0.6cm] overflow-hidden">
                    [DATA_SCADENZA]
                </div>
                <div class="absolute mt-[23cm] w-[19cm] h-[3cm] text-center">
                    [TIMBRO_FIRMA_MEDICO]
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