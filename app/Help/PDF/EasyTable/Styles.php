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
    
}
