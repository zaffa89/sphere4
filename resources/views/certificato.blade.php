<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
     
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <!-- Scripts -->
        
        @vite('resources/css/app.css')
      
    </head>
    <body class="h-full">
        <div class="container max-w-2xl h-screen mx-auto relative flex flex-col content-between">
            <div class="flex justify-between">
                <img src="/storage/logo_struttura.png" class="w-60" />
                <div>
                    <span>TIMBRO E CAGATINE</span>
                </div>
            </div>
            
            <div class="flex flex-1 flex-col gap-6 mt-10">
                <div>
                    ATLETA: {{ $data->paziente->ragione_sociale }}
                </div>
    
                <div class="mt-2">
                    SPORT PRATICATO: <span class="uppercase">{{ $data->sport->nome }}</span>
                </div>
                
                <div>
                    MEDICO: <span class="capitalize">{{ $data->medico->ragione_sociale}}</span>
                </div>            
            </div>
            <div class="flex justify-between">
                <span>Data e ora</span>
                <span>Firma del medico</span>
            </div>
            
        </div>
    </body>
</html>
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