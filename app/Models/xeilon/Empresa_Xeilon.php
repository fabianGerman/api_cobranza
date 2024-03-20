<?php

namespace App\Models\xeilon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa_Xeilon extends Model
{
    use HasFactory;

    protected $connection = 'xeilon';
    protected $table = 'empresassj';

    public static function get_count_afiliados_inconsistencia_by_empresa($cuit,$idempresasj,$periodo){
        
        $auxiliar = DB::connection('xeilon')
        ->table('empresassj as emp')
        ->where('emp.CUIT',$cuit)
        ->select('emp.IdEmpresaSJ')
        ->get();

        $result = DB::connection('xeilon')
            ->table('empresassj as emp')
            ->leftJoin('afiliadossjempresas as ae',function($join){
                $join->on('ae.IdEmpresaSJ','=','emp.IdEmpresaSJ')
                ->where(function($query){
                    $query->whereRaw('CAST(NOW() AS Date) >= ae.FechaDesde')
                    ->whereRaw('CAST(NOW() AS Date) <= ae.FechaHasta OR ae.FechaHasta IS NULL');
                });
            })
            ->join('afiliadossj as afsj','afsj.IdAfiliadoSJ','=','ae.IdAfiliadoSJ')
            ->join('afiliados as af','af.IdAfiliadoSJ','=','afsj.IdAfiliadoSJ')
            ->join('ctacteaportesafiliadossj as ctacte','ctacte.IdAfiliadoSJ','=','afsj.IdAfiliadoSJ')
            ->where('ctacte.PeriodoAporte',$periodo)
            ->where('ctacte.IdEmpresaSJ','<>',$idempresasj)
            ->where('af.IdCaracter',1)
            ->where('emp.CUIT',$cuit)
            ->select("af.Nombres")
            ->groupBy('af.Nombres')
            ->get();

        return $result;

    }

    public static function get_count_afiliados_titular_by_empresa($cuit){
        $result = DB::connection('xeilon')
            ->table('empresassj as emp')
            ->leftJoin('afiliadossjempresas as ae',function($join){
                $join->on('ae.IdEmpresaSJ','=','emp.IdEmpresaSJ')
                ->where(function($query){
                    $query->whereRaw('CAST(NOW() AS Date) >= ae.FechaDesde')
                    ->whereRaw('CAST(NOW() AS Date) <= ae.FechaHasta OR ae.FechaHasta IS NULL');
                });
            })
            ->join('afiliadossj as afsj','afsj.IdAfiliadoSJ','=','ae.IdAfiliadoSJ')
            ->join('afiliados as af','af.IdAfiliadoSJ','=','afsj.IdAfiliadoSJ')
            ->where('af.IdCaracter',1)
            ->where('emp.CUIT',$cuit)
            ->count();

        return $result;

    }

    public static function get_count_afiliados_by_empresa($cuit){
        $result = DB::connection('xeilon')
            ->table('empresassj as emp')
            ->leftJoin('afiliadossjempresas as ae',function($join){
                $join->on('ae.IdEmpresaSJ','=','emp.IdEmpresaSJ')
                ->where(function($query){
                    $query->whereRaw('CAST(NOW() AS Date) >= ae.FechaDesde')
                    ->whereRaw('CAST(NOW() AS Date) <= ae.FechaHasta OR ae.FechaHasta IS NULL');
                });
            })
            ->join('afiliadossj as afsj','afsj.IdAfiliadoSJ','=','ae.IdAfiliadoSJ')
            ->join('afiliados as af','af.IdAfiliadoSJ','=','afsj.IdAfiliadoSJ')
            ->where('emp.CUIT',$cuit)
            ->count();

        return $result;

    }


    public static function get_afiliados_by_empresa($cuit){
        
        $result = DB::connection('xeilon')
            ->table('empresassj as emp')
            ->leftJoin('afiliadossjempresas as ae',function($join){
                $join->on('ae.IdEmpresaSJ','=','emp.IdEmpresaSJ')
                ->where(function($query){
                    $query->whereRaw('CAST(NOW() as Date) >= ae.FechaDesde')
                    ->whereRaw('CAST(NOW() as Date) <= ae.FechaHasta OR ae.FechaHasta IS NULL');
                });
            })
            ->join('afiliadossj as afsj','afsj.IdAfiliadoSJ','=','ae.IdAfiliadoSJ')
            ->join('afiliados as af','af.IdAfiliadoSJ','=','afsj.IdAfiliadoSJ')
            ->select('afsj.IdAfiliadoSJ as id_afiliado_sj','af.NroAfiliado as nro_afiliado','af.PlanVigente as plan_vigente','afsj.CUIL_CUIT as cuil','af.Nombres as nombres','afsj.Baja as baja','ae.FechaDesde as fechaalta','ae.FechaHasta as fechabaja')
            ->where('af.IdCaracter',1)
            ->where('emp.CUIT',$cuit)
            ->groupBy('af.Nombres')
            ->paginate(5);
        if(count($result)== 0){
            $result = DB::connection('xeilon')
                ->table('empresassj as emp')
                ->leftJoin('afiliadossjempresas as ae',function($join){
                    $join->on('ae.IdEmpresaSJ','=','emp.IdEmpresaSJ')
                    ->where(function($query){
                        $query->whereRaw('CAST(NOW() as Date) >= ae.FechaDesde')
                        ->whereRaw('CAST(NOW() as Date) >= ae.FechaHasta OR ae.FechaHasta IS NULL');
                    });
                })
                ->join('afiliadossj as afsj','afsj.IdAfiliadoSJ','=','ae.IdAfiliadoSJ')
                ->join('afiliados as af','af.IdAfiliadoSJ','=','afsj.IdAfiliadoSJ')
                ->select('afsj.IdAfiliadoSJ as id_afiliado_sj','af.NroAfiliado as nro_afiliado','af.PlanVigente as plan_vigente','afsj.CUIL_CUIT as cuil','af.Nombres as nombres','ae.FechaDesde as fechaalta','ae.FechaHasta as fechabaja')
                ->where('af.IdCaracter',1)
                ->where('emp.CUIT',$cuit)
                ->groupBy('af.Nombres')
                ->paginate(5);
        }
        return $result;
    }

    public static function get_empresa_by_afiliado($idafiliadosj){
        
        $result = DB::connection('xeilon')
            ->table('afiliadossj as afsj')
            ->where('afsj.IdAfiliadoSJ',$idafiliadosj)
            ->leftJoin('afiliadossjempresas as ae',function($join){
                $join->on('ae.IdAfiliadoSJ','=','afsj.IdAfiliadoSJ')
                ->where(function($query){
                    $query->whereRaw('CAST(NOW() as Date) >= ae.FechaDesde')
                    ->whereRaw('CAST(NOW() as Date) <= ae.FechaHasta OR ae.FechaHasta IS NULL');
                });
            })
            ->join('empresassj as emp','emp.IdEmpresaSJ','=','ae.IdEmpresaSJ')
            ->select('afsj.IdAfiliadoSJ as ideafiliadosj','emp.IdEmpresaSJ as idempresasj','emp.RazonSocial as razonsocial','emp.CUIT as cuit','ae.FechaDesde as fechadesde','ae.FechaHasta as fechahasta')
            ->get();
        if(count($result)==0){
            $result = DB::connection('xeilon')
            ->table('afiliadossj as afsj')
            ->where('afsj.IdAfiliadoSJ',$idafiliadosj)
            ->leftJoin('afiliadossjempresas as ae',function($join){
                $join->on('ae.IdAfiliadoSJ','=','afsj.IdAfiliadoSJ')
                ->where(function($query){
                    $query->whereRaw('CAST(NOW() as Date) >= ae.FechaDesde')
                    ->whereRaw('CAST(NOW() as Date) >= ae.FechaHasta');
                });
            })
            ->join('empresassj as emp','emp.IdEmpresaSJ','=','ae.IdEmpresaSJ')
            ->select('afsj.IdAfiliadoSJ as ideafiliadosj','emp.IdEmpresaSJ as idempresasj','emp.RazonSocial as razonsocial','emp.CUIT as cuit','ae.FechaDesde as fechadesde','ae.FechaHasta as fechahasta')
            ->get();
        }
        return $result;
    }

    public static function search_empresa_by_cuit($cuit=null){

        $result = DB::connection('xeilon')
        ->table('empresassj as emp')
        ->where('emp.CUIT',$cuit)
        ->select('emp.RazonSocial as razonsocial','emp.CUIT as cuit','emp.IdEmpresaSJ as idempresasj')
        ->get();
        
        return $result[0];

    }
}
