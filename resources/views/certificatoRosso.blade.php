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
                <div class="absolute mt-[5cm] ml-[3cm]">
                    {{ $data->paziente->cognome }}
                </div>
                <div class="absolute mt-[6cm] ml-[2cm]">
                    {{ $data->paziente->nome }}
                </div>
                <div class="absolute mt-[7cm] ml-[2cm]">
                    {{ $data->paziente->localitaNascita->nome }}
                </div>
                <div class="absolute mt-[8cm] ml-[1cm]">
                    {{ date('d/m/Y' , strtotime($data->paziente->data_nascita)) }}
                </div>
                <div class="absolute mt-[9cm] ml-[4cm]">
                    {{ $data->paziente->indirizzo }} {{ $data->paziente->civico }}
                </div>
                <div class="absolute mt-[10cm] ml-[4.5cm]">
                    {{ $data->paziente->documento_numero }}
                </div>
                <div class="absolute mt-[11cm] ml-[6cm]">
                    {{ $data->sport->nome }}
                </div>
                <div class="absolute mt-[12cm] ml-[7cm]">
                    {{ $data->societaSportiva->ragione_sociale }} - {{ $data->societaSportiva->indirizzo }} {{ $data->societaSportiva->civico }}
                </div>
                <div class="absolute mt-[14cm]">
                    è un pigrone scoreggione<br>
                    non ha tempo per fare sport, deve raidare su wow
                </div>
                <div class="absolute mt-[20cm] ml-[2cm]">
                    [DATA_VISITA]
                </div>
                <div class="absolute mt-[23cm] w-[19cm] text-center">
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