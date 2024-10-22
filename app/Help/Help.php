<?php

namespace App\Help;

use Illuminate\Support\Facades\Storage;
use App\Help\HttpClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Models\TeamInvitation;
use App\Models\Config;
use App\Models\Contabilidad\ContaPeriodoContable;
use App\Models\Contabilidad\ContaPartidaContable;
use \Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Facturacion\ConfPartidasAutomaticas;


class Help
{

    public static function partidaAutomaticaConf($key){
       return  ConfPartidasAutomaticas::where('keygen', $key)->where('empresa_id', Help::empresa())->first();
    }

    public static function groupPermissions($group)
    {
        return Permission::where('opcion', $group)->get();
    }

    public static function groupPermissionsOwner($group, Role $role)
    {

        return DB::table('role_has_permissions')
            ->select(
                'roles.name as role_name',
                'roles.id as id_role',
                'permissions.name as permission',
                'permissions.opcion',
                'permissions.id as id_permissions'
            )
            ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $role->id)->where('permissions.opcion', $group)->get();
    }

    public static function codigoPartida($partida)
    {
        if (!isset($partida->correlativo)) {
            $partida = ContaPartidaContable::find($partida['id']);
        }
        $numero = Help::complementCode($partida->correlativo, Help::getConfigByKey('contabilidad', 'correlativo')->value, '0');
        $complemento = $partida->tipoPartida->tipo . $partida->periodo->year . $partida->periodo->mes;
        return $complemento . $numero;
    }

    public static function usuario()
    {
        return  Auth::user();
    }

    public static function empresa()
    {
        return  Auth::user()->empresa_id;
    }

    public static function periodoContable()
    {
        return ContaPeriodoContable::where('empresa_id', Help::empresa())->where('activo', true)->first();
    }


    public static function complementCode($string, $MaxNumber, $complement)
    {
        $response = str_pad($string, ($MaxNumber - Str::length($MaxNumber)) + 1, $complement, STR_PAD_LEFT);
        return $response;
    }

    public static function monthToString($month)
    {
        $array = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        for ($i = 0; $i < count($array); $i++) {
            if ($month == ($i + 1)) return $array[$i];
        }
    }


    public static function countTeamInvitations()
    {
        $user = auth()->user();
        return count(TeamInvitation::where('email', $user->email)->get());
    }

    public static function getConfigByKey($category, $key)
    {
        $empresa_id = Help::empresa(); 
        return Config::where('field', $key)
                    ->where('category', $category)
                    ->where('empresa_id', $empresa_id) // Filtra por empresa_id del usuario y así obtiene el valor del logo
                    ->first();
        // return Config::where('field', $key)->where('category', $category)->first();
    }

    public static function pathAssets($path)
    {
        //$url = env('PATH_ASSETS').'/'.$path.'/'.$name;
        $url = HttpClient::get('api/validar/asset', env('PATH_ASSETS'), ['path' => $path], 'body');
        return $url;
    }

    public static function uploadFile($request, $folder, $anexo, $input, $ramdonName = true)
    {
        //url es el path corto luego de el path publico a donde se encontrara el archivo.
        //anexo debe ser algo extra en el proyecto se usa por ejemplo MAT115/archivo.png donde anexo = "MAT115/"
        $file  = $request->file($input);
        $original = Help::changeCharacters($file->getClientOriginalName());
        $name = $ramdonName ? Help::code(8) . '-' . time() . '-' . $original : $original;
        $file->move(public_path() . '/' . $folder . '/', $name);
        return $name;
    }

    public static function deleteFile($path, $file = null)
    {
        $fullPath = $path;
        if ($file != null) {
            $fullPath = $path . '/' . $file;
        }
        Storage::disk('public')->delete($fullPath);
    }

    public static function code($lenght)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $lenght);
    }

    public static function date($fecha)
    {
        $c =  substr($fecha, 0, 10);
        $date = new \DateTime($c);
        return $date->format('d/m/Y ');
    }

    public static function dateByYear($fecha, $separator = '/')
    {
        $c =  substr($fecha, 0, 10);
        $date = new \DateTime($c);
        return $date->format("Y${separator}m${separator}d");
    }


    public static function hour($fecha)
    {
        $date = date_create($fecha);
        return  date_format($date, "d/m/Y h:i:s A");
    }

    public static function year()
    {
        $hoy = getdate();
        return $hoy['year'];
    }

    public static function changeCharacters($string)
    {
        $data = array('á', 'é', 'í', 'ó', 'ú', 'ñ', ' ');
        $sup = array('a', 'e', 'i', 'o', 'u', 'n', '-');
        $a = $string;
        for ($i = 0; $i < count($data); $i++) {
            $a = str_replace($data[$i], $sup[$i], $a);
        }
        return strtolower($a);
    }



    public static function isNumber($str)
    {
        $str = str_replace(',', '.', $str);
        if (!is_numeric($str)) return false;

        $str = (int)$str;
        if (!is_integer($str) and !is_float($str)) return false;

        return true;
    }

    public static function getNameMothByNumber($mothNumber)
    {
        $month = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
        return $month[$mothNumber];
    }

    public static function groupArray($array, $groupkey)
    {
        if (count($array) > 0) {
            $keys = array_keys($array[0]);
            $removekey = array_search($groupkey, $keys);
            if ($removekey === false)
                return array("Clave \"$groupkey\" no existe");
            else
                unset($keys[$removekey]);
            $groupcriteria = array();
            $return = array();
            foreach ($array as $value) {
                $item = null;
                foreach ($keys as $key) {
                    $item[$key] = $value[$key];
                }
                $busca = array_search($value[$groupkey], $groupcriteria);
                if ($busca === false) {
                    $groupcriteria[] = $value[$groupkey];
                    $return[] = array($groupkey => $value[$groupkey], 'groupeddata' => array());
                    $busca = count($return) - 1;
                }
                $return[$busca]['groupeddata'][] = $item;
            }
            return $return;
        } else
            return array();
    }
}
