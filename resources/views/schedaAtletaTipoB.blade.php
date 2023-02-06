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
    <body class="bg-gray-300 print:bg-none">
        <page size="A3" layout="landscape">
            <div class="flex flex-row gap-14 h-full">
                <!-- retro -->
                <div class="w-1/2 flex flex-col justify-between">
                    <p class="font-medium text-center">Giudizio conclusivo di idoneità</p>
                    
                    <span>L'atleta all'atto della visita, non presenta controindicazioni cliniche pregresse o in atto alla pratica</span>
                    <div class="h-[0.7cm] w-full flex gap-4 overflow-hidden">
                        <span class="w-[7cm]">sportiva non-agonistica</span>
                        <span class="w-full shrink border-b border-black text-medium"> [QUALCOSA] </span>
                    </div>

                    <div class="h-[0.7cm] w-full flex gap-4 overflow-hidden">
                        <span class="w-[3.2cm]">Per il periodo di</span>
                        <span class="w-full shrink border-b border-black text-medium"> [DURATA_IDONEITA'] </span>
                    </div>

                    <div class="flex gap-4">
                        <span>Data</span>
                        <span class="w-40 border-b border-black text-medium">[DATA_RILASCIO ?]</span>
                    </div>

                    <div class="w-full text-center flex flex-col">                        
                        <span>[TIMBRO_MEDICO_RIGA_1]</span>
                        <span>[TIMBRO_MEDICO_RIGA_2]</span>
                        <span>[TIMBRO_MEDICO_RIGA_3]</span>
                    </div>
                    <div class="flex justify-around">
                        <div class="h-14">
                            [TIMBRO_DEL_CENTRO]
                        </div>
                        <div class="h-14 flex flex-col">
                            <div>Rilasciato</div>
                            <div>
                                In data <span class="font-medium">[DATA_RILASCIO]</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="text-sm">
                        INFORMATIVA ALL'UTENTE SUL TRATTAMENTO DEI DATI PERSONALI AI SENSI DELL'ART . 13 DEL REGOLAMENTO N . 2016/679/UE
                    </p>
                    <div class="text-xs">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sodales purus in lectus malesuada, a rutrum risus porta. Maecenas tempus ullamcorper arcu ut consectetur. Donec ac pretium libero. Suspendisse suscipit in eros non euismod. Aliquam sed gravida metus. Suspendisse hendrerit tristique tellus sit amet pretium. Pellentesque gravida rhoncus tortor lacinia fermentum. Morbi ornare, ipsum at accumsan condimentum, justo purus auctor diam, eu sollicitudin justo velit quis orci.
                        Nam id sem fermentum, pulvinar neque in, fringilla mi. Morbi tincidunt rutrum diam, at maximus sapien lacinia et. Suspendisse euismod aliquet ex a aliquet. Cras at risus sed dolor egestas malesuada vitae a sem. Duis tempor ex justo, non fermentum libero iaculis eu. Pellentesque at nunc non justo pellentesque tempus sed id urna. Aliquam commodo pretium pellentesque. Mauris mollis scelerisque fringilla. Nam cursus vitae odio blandit rhoncus. Proin pretium, nulla non tincidunt fermentum, orci dui porttitor eros, eget faucibus massa risus id urna. Nunc a interdum augue. Fusce metus magna, sodales eu facilisis ut, porta at dui. Nam elementum tincidunt volutpat.
                        Donec a placerat lorem. Duis vitae magna aliquam, rhoncus felis vel, condimentum enim. In bibendum justo sit amet varius hendrerit. Cras dui dui, finibus ut facilisis sit amet, ultrices nec urna. Praesent dolor turpis, consequat molestie quam ut, aliquam congue diam. Sed non magna augue. Aliquam sit amet ex leo. Donec ac nibh pretium, aliquet odio in, tincidunt turpis. Sed nec cursus tellus, id luctus ligula. Vestibulum iaculis aliquet est vitae maximus.
                        Nunc id turpis vel tellus molestie ornare. Nunc varius ipsum tortor. Quisque quis semper elit. Maecenas nec posuere quam. Integer maximus ultricies neque, non mattis velit varius vitae. In euismod, justo porta interdum fringilla, tellus lectus dignissim magna, eu vulputate ligula metus quis nisi. Etiam tempor arcu augue, id iaculis odio venenatis id. Curabitur quis nulla quis erat fringilla ultricies quis eu turpis. Sed fringilla sapien mi, quis tempor tortor sollicitudin nec. Phasellus semper viverra ullamcorper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce vitae ullamcorper nisi, eu volutpat mi. Proin eu finibus sem. Etiam quis volutpat tortor.
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="h-[0.7cm] w-full flex overflow-hidden">
                            <span class="w-[2.5cm]">Cognome</span>
                            <span class="min-w-[6cm] ml-5 border-b border-black text-medium"> [COGNOME_DICHIARANTE] </span>
                        </div>
                        <div class="h-[0.7cm] w-full flex overflow-hidden">
                            <span class="w-[2.5cm]">Nome</span>
                            <span class="min-w-[6cm] ml-5 border-b border-black text-medium"> [NOME_DICHIARANTE] </span>
                        </div>
                        <div class="h-[0.7cm] w-full flex overflow-hidden">
                            <span class="w-[2.5cm]">Data di oggi</span>
                            <span class="min-w-[6cm] ml-5 border-b border-black text-medium"> [DATA_DI_OGGI] </span>
                        </div>                        
                    </div>
                    <div class="flex justify-end">
                        <div class="flex flex-col text-center">
                            <span>Firma del dichiarante (o del tutore se minore)</span>
                            <span class="h-14 min-w-[200px] border-b border-black text-medium">[FIRMA_DICHIARANTE]</span>
                        </div>
                    </div>
                </div>
                <!-- fronte -->
                <div class="w-1/2 flex flex-col justify-between">
                    <div class="flex justify-between font-medium">
                        <div class="flex flex-col">
                            <span>ATS ZIOPERA</span>
                            <span>123</span>
                        </div>
                        <div class="flex flex-col">
                            <img src="/storage/regione_lombardia_logo.png" class="w-60 mx-auto" />
                            <span class="uppercase">TUTELA SANITARIA DELLE ATTIVITà SPORTIVE</span>

                        </div>
                        
                        <div class="flex flex-col">
                            <span>Num. Visita</span>
                            <span>1234</span>
                            <span>Data visita</span>
                            <span>[DATA_VISITA]</span>
                        </div>
                    </div>
                    <div class="flex flex-1">
                        <div class="grid grid-cols-2">
                            <div class="h-[0.7cm] w-full flex gap-4 overflow-hidden">
                                <span class="w-[7cm]">Cognome</span>
                                <span class="w-full shrink border-b border-black text-medium"> [COGNOME] </span>
                            </div>
                            <div class="h-[0.7cm] w-full flex gap-4 overflow-hidden">
                                <span class="w-[7cm]">Nome</span>
                                <span class="w-full shrink border-b border-black text-medium"> [NOME] </span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        asd
                    </div>
                </div>                
            </div>
        </page>
        <div style="page-break-after: always"></div>
        <page size="A3" layout="landscape">
            <div class="flex flex-row gap-14 h-full">
                <!-- pagina interna 1 -->
                <div class="w-1/2 border border-black">
                    pagina 3-4
                </div>
                <!-- pagina interna 2 -->
                <div class="w-1/2 border border-black">
                    pagina 3-4
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
        padding: 0.5cm;
        //border:1px solid black;
        //box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }

    page[size="A3"][layout="landscape"] {
        width: 42cm;
        height: 29cm;  //NON 29.7 ALTRIMENTI FA DUE PAGINE
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