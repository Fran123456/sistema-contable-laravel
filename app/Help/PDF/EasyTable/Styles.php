<?php
namespace App\Help\PDF\EasyTable;
 class Styles
{

    public static  function alignPaddingY($paddingY, $align){
        return  "align:${align};paddingY: ${paddingY} ;";//alinear al centro, con padding en y //
    }
 

    public static function paddingY($paddingY){
        return 'paddingY:${paddingY};';
    }

    public static function alignPaddingYBorder($paddingY, $align){
        
        return  "align:${align};paddingY: ${paddingY} ;border:1;";//alinear al centro, con padding en y //
    }
    
}
