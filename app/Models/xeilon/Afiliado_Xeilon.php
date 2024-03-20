<?php

namespace App\Models\xeilon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Afiliado_Xeilon extends Model
{
    use HasFactory;

    protected $connection = 'xeilon';
    protected $table = 'afiliadossj';

    public static function get_all_afiliados(){
        $result = DB::connection('xeilon')
            ->table('afiliados as af')
            ->select(
                'af.Nombres as nombres',
                'af.IdAfiliado as id_afiliado',
                'af.IdAfiliadoSJ as id_afiliado_sj',
                'af.NroAfiliado as nro_afiliado',
                'afsj.NroDocumento as nro_documento',
                'afsj.CUIL_CUIT as cuil',
                'afsj.Baja as baja',
                'afsj.Despedido as despedido',
                'af.PlanVigente as plan_vigente',
                'af.IdPlanes as id_plan'
            )
            ->join('afiliadossj as afsj','afsj.IdAfiliadoSJ','=','af.IdAfiliadoSJ')
            ->join('planes as pl','pl.IdPlanes','=','af.IdPlanes')
            ->join('obrassociales as os','os.IdObrasSociales','=','pl.IdObrasSociales')
            ->whereIn('os.NroObraSocial',[101,107,108,109,111,121,122,131,135,302])
            ->where('af.IdCaracter',1)
            ->orderBy('af.Nombres','ASC')
            ->groupBy('af.Nombres')
            ->paginate(5);
        return $result;
    }

    public static function get_estado_actual($idAfiliadosj,$activo=null){
        $result =DB::connection('xeilon')
            ->table('afiliadossj as afsj')
            ->join('Afiliados as af', 'af.IdAfiliadoSJ', '=', 'afsj.IdAfiliadoSJ')
            ->join('planes as pl', 'af.idPlanes', '=', 'pl.idPlanes')
            ->leftJoin('EstadoAfiliado as ea', function ($join) {
                $join->on('ea.IdAfiliado', '=', 'af.IdAfiliado')
                    ->where(function ($query) {
                        $query->whereRaw('CAST(NOW() as Date) >= ea.FechaDesde')
                            ->whereRaw('(CAST(NOW() as Date) <= ea.FechaHasta OR ea.FechaHasta IS NULL)');
                    });
            })
            ->selectRaw('SUM(IF(ea.IdAfiliado IS NOT NULL, 1, 0)) as activo')
            ->where('afsj.IdAfiliadoSJ', $idAfiliadosj)
            ->first();

        return $result;
    }

    public static function get_count_grupo_familiar($cuil) {
        $result = DB::connection('xeilon')
            ->table('afiliadossj as afsj')
            ->join('caracterafiliado as ca', 'afsj.idCaracter', '=', 'ca.idCaracter')
            ->join('afiliados as af', 'af.IdAfiliadosj', '=', 'afsj.idafiliadosj')
            ->leftJoin('estadoafiliado as ea', function ($join) {
                $join->on('ea.IdAfiliado', '=', 'af.IdAfiliado')
                    ->whereRaw('CURDATE() >= ea.FechaDesde')
                    ->whereRaw('(CURDATE() <= ea.FechaHasta OR ea.FechaHasta IS NULL)')
                    ->where('ea.idEstado', '=', 1);
            })
            ->where('afsj.CUIL_CUIT', $cuil)
            ->where('af.PlanVigente', 1)
            ->whereNotNull('ea.IdAfiliado')
            ->selectRaw('count(*) as GrupoFamiliar')
            ->first();
    
        return $result->GrupoFamiliar;
    }

    public static function get_plan($idafiliadosj){
        $result = DB::connection('xeilon')
            ->table('afiliados as af')
            ->join('afiliadossj as afsj', 'afsj.IdAfiliadoSJ', '=', 'af.IdAfiliadoSJ')
            ->join('planes as pl', 'pl.IdPlanes', '=', 'af.IdPlanes')
            ->join('obrassociales as os', 'os.IdObrasSociales', '=', 'pl.IdObrasSociales')
            ->where('afsj.IdAfiliadoSJ', $idafiliadosj)
            ->whereIn('af.PlanVigente', [1, 0]) // Look for both PlanVigente = 1 and PlanVigente = 0
            ->orderBy('af.PlanVigente', 'desc') // Order by PlanVigente in descending order
            ->select('pl.IdPlanes as idplan', 'pl.NombrePlan as nombreplan')
            ->first();

        return $result;
    }

    public static function get_obra_social($idafiliadosj){
        $result = DB::connection('xeilon')
            ->table('afiliados as af')
            ->join('afiliadossj as afsj', 'afsj.IdAfiliadoSJ', '=', 'af.IdAfiliadoSJ')
            ->join('planes as pl', 'pl.IdPlanes', '=', 'af.IdPlanes')
            ->join('obrassociales as os', 'os.IdObrasSociales', '=', 'pl.IdObrasSociales')
            ->where('afsj.IdAfiliadoSJ', $idafiliadosj)
            ->whereIn('af.PlanVigente', [1, 0])
            ->orderBy('af.PlanVigente', 'desc') // Order by PlanVigente in descending order
            ->select('os.NroObraSocial as nroobrasocial', 'os.RazonSocial as razonsocial', 'os.Siglas as siglas', 'os.IdObrasSociales as idobrasocial')
            ->first();

        return $result;
    }

    public static function get_fecha_ingreso($idafiliado){   
        $result = DB::connection('xeilon')
            ->table('estadoafiliadosj as ea')
            ->select('ea.FechaDesde as fechaIngreso')
            ->join('afiliados as af', 'ea.IdAfiliadosj', '=', 'af.IdAfiliado')
            ->join('estados as e', 'ea.IdEstado', '=', 'e.IdEstado')
            ->where('ea.IdAfiliadosj', $idafiliado)
            ->where('ea.IdEstado', 1)
            ->orderBy('ea.FechaDesde', 'ASC')
            ->limit(1)
            ->first();
        return $result;
    }
}
