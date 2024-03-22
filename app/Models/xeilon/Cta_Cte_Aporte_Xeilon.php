<?php

namespace App\Models\Xeilon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cta_Cte_Aporte_Xeilon extends Model
{
    use HasFactory;

    protected $connection = 'xeilon';
    protected $table = 'ctacteaportesafiliadossj';

    public static function get_aporte_afiliado_periodo($idafiliadosj,$periodo){
        $result = DB::connection('xeilon')
            ->table('catcteaportesafiliadossj as ctaccte')
            ->select(
                'ctacte.PeriodoAporte',
                DB::raw("STR_TO_DATE(concat('01/',ctacte.PeriodoAporte), '%d/%m/%Y') as DatePeriodoAporte"),
                'emp.IdEmpresaSJ',
                'emp.CUIT',
                'emp.RazonSocial',
                'afsj.IdAfiliadoSJ',
                'afsj.CUIL_CUIT',
                'afsj.Nombres',
                DB::raw('SUM(ctacte.Remuneracion) as remuneracion'),
                DB::raw('SUM(ctacte.Aporte) as aporte'),
                DB::raw('SUM(ctacte.Contribucion) as contribucion'),
                DB::raw('SUM(ctacte.Subsidio) as subsidio'),
                DB::raw('SUM(ctacte.Monotributo) as monotributo'),
                DB::row('SUM(ctacte.Aporte)+SUM(ctacte.Contribucion)+SUM(ctacte.Monotributo) as total')
            )
            ->join('empresassj as emp','emp.IdEmpresaSJ','=','ctacte.IdEmpresaSJ')
            ->join('afiliadossj as afsj','afsj.IdAfiliadoSJ','=','ctacte.IdAfiliadoSJ')
            ->where('ctacte.IdAfiliadoSJ',$idafiliadosj)
            ->where('ctacte.PeriodoAporte',$periodo)
            ->orderByDesc('DatePeriodoAporte')
            ->orderBy('emp.RazonSocial')
            ->orderBy('afsj.nombres')
            ->get();

        return $result;
    }

    public static function detalle_aporte($empresasj,$afiliadosj,$periodo){
        $result = DB::connection('xeilon')
            ->table('ctacteaportesafiliadossj as ctacte')
            ->select('ctacte.TipoMovimiento as movimiento','ctacte.PeriodoAporte as periodo','ctacte.Observacion as observacion','ctacte.Aporte as aporte','ctacte.Contribucion as contribucion','ctacte.Remuneracion as remuneracion','ctacte.Subsidio as subsidio','ctacte.Monotributo as monotributo')
            ->join('afiliadossj as afsj','afsj.IdAfiliadoSJ','=','ctacte.IdAfiliadoSJ')
            ->join('empresassj as emp','emp.IdEmpresaSJ','=','ctacte.IdEmpresaSJ')
            ->where('emp.CUIT',$empresasj)
            ->where('afsj.CUIL_CUIT',$afiliadosj)
            ->where('ctacte.PeriodoAporte',$periodo)
            ->get();

        return $result;
    }
}
