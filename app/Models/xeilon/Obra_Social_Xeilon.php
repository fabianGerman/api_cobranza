<?php

namespace App\Models\xeilon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Obra_Social_Xeilon extends Model
{
    use HasFactory;

    protected $connection = "xeilon";
    protected $table = "obrassociales";

    public static function get_all_obras_sociales(){
        $result = DB::connection('xeilon')
        ->table('obrassociales as os')
        ->select('os.IdObrasSociales as idobrasocial','os.NroObraSocial as nroobrasocial','os.RazonSocial as razonsocial','os.Siglas as siglas','os.CUIT as cuit')
        ->whereIn('os.NroObraSocial',[101,121,122,131,135,107,108,109,111,302])
        ->get();
        return $result;
    }

    public static function get_obra_social($nro){
        $result = DB::connection('xeilon')
        ->table('obrassociales as os')
        ->select('os.IdObrasSociales as idobrasocial','os.NroObraSocial as nroobrasocial','os.RazonSocial as razonsocial','os.Siglas as siglas','os.CUIT as cuit')
        ->where('os.NroObraSocial',$nro)
        ->get();
    }
}
