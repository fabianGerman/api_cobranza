<?php

namespace App\Models\xeilon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Plan_Xeilon extends Model
{
    use HasFactory;

    protected $connection = 'xeilon';
    protected $table = 'planes';

    public static function get_all_planes(){
        $result = DB::connection('xeilon')
            ->table('planes as pl')
            ->join('obrassociales as os','os.IdObrasSociales','=','pl.IdObrasSociales')
            ->select('pl.IdPlanes as idplan','pl.IdObrasSociales as idobrasocial','pl.NombrePlan as nombreplan')
            ->whereIn('os.NroObraSocial',[101,121,122,131,135,107,108,109,111,302])
            ->whereNotIn('pl.IdPlanes',[184,20,185,22,24,25,26,455,475,515,453,454,446])
            ->get();
        return $result;
    }

    public static function get_plan($nro){
        $result = DB::connection('xeilon')
            ->table('planes as pl')
            ->join('obrassociales as os','os.IdObrasSociales','=','pl.IdObrasSociales')
            ->select('pl.IdPlanes as idplan','pl.IdObrasSociales as idobrasocial','pl.NombrePlan as nombreplan')
            ->where('os.NroObraSocial',$nro)
            ->get();
        return $result;
    }
}
