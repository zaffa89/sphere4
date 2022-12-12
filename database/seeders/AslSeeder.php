<?php

namespace Database\Seeders;

use App\Models\Asl;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AslSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asl_vecchie = DB::connection('vecchio')->table('tab_asl')->select('id_asl as id' , 'codice' , 'descrizione as nome')->get();

        foreach($asl_vecchie as $asl_vecchia)
        {
            Asl::create([
                'id' =>$asl_vecchia->id,
                'nome' => $asl_vecchia->nome,
                'codice' => $asl_vecchia->codice
            ]);
        }
    }
}
