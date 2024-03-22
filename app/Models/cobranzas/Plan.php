<?php

namespace App\Models\cobranzas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Plan extends Model
{
    use HasFactory;

    protected $filiable=[
        'id_plan',
        'id_obra_social',
        'nombre_plan',
        'siglas',
        'percapita',
        'total'
    ];

    public static function array_pmo($id){
        
        $ids = [470,476,276,275,384,279,
                415,521,535,556,545,
                519];
        $percapita=8;
        $precio = 1500;
        $pmo = [];
        for($i=0;$i<count($ids);$i++){
            if($ids[$i] == $id){
                $pmo[0] = $percapita;
                $pmo[1] = $precio;
            }
        }

        return $pmo;
    
    }

    public static function array_pc($id){
        
        $ids = [494,495,492,493,27,
                520,539,560,549,516];
        $percapita=9;
        $precio = 2500;
        $pc= [];
        for($i=0;$i<count($ids);$i++){
            if($ids[$i] == $id){
                $pc[0] = $percapita;
                $pc[1] = $precio;
            }
        }

        return $pc;
    
    }

    public static function array_pe($id){
        
        $ids = [459,164,13,368,28,
                517,536,557,562,546,
                512];
        $percapita=10;
        $precio = 3500;
        $pe = [];
        for($i=0;$i<count($ids);$i++){
            if($ids[$i] == $id){
                $pe[0] = $percapita;
                $pe[1] = $precio;
            }
        }

        return $pe;
    
    }

    public static function array_pp($id){
        
        $ids = [461,463,465,466,452,
                519,451,374,375,383,
                195,155,199,200,450,
                169,171,173,174,175,
                469,461,465,466,463,
                471,460,166,379,547,
                514,537];
        $percapita=11;
        $precio = 6500;
        $pp = [];
        for($i=0;$i<count($ids);$i++){
            if($ids[$i] == $id){
                $pp[0] = $percapita;
                $pp[1] = $precio;
            }
        }
 
        return $pp;
    
    }

    public static function array_po($id){
        
        $ids = [191,177,188,180,182,
                197,156,196,198,377,
                376,382,518,464,468,
                467,462,538,559,12,
                548,513,181];
        $percapita=12;
        $precio = 13000;
        $po = [];
        for($i=0;$i<count($ids);$i++){
            if($ids[$i] == $id){
                $po[0] = $percapita;
                $po[1] = $precio;
            }
        }
 
        return $po;
    
    }

    public static function get_all_planes(){
        $result = DB::table('plans as pl')
            ->get();
        return $result;
    }

    public static function get_plan($idplan){
        $result = DB::table('plans as pl')
            ->where('pl.id_plan',$idplan)
            ->get();
        return $result[0]->percapita;
    }
}
