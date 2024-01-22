<?php

namespace App\Help;

use DateTime;

class Fecha
{
    static $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
    static $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    /**Calcula los dias entre 2 fechas en formato Y-m-d
     */
    public static function CalculateDaysBetweenTwoDates($date1, $date2)
    {
        return ((new DateTime($date1))->diff((new DateTime($date2))))->days;
    }
    public static function SumDaysToDate($date, $days)
    {
        return date('Y-m-d', strtotime($date . " + {$days} days"));
    }
    public static function ReduceDaysToDate($date, $days)
    {
        return date('Y-m-d', strtotime($date . " - {$days} days"));
    }
    public static function SumMonthsToDate($date, $months)
    {
        return date('Y-m-d', strtotime($date . " + {$months} months"));
    }
    public static function IsOlder($firstDate, $secondDate)
    {
        return $firstDate < $secondDate;
    }
    public static function GetLastDayOfMonth(string $first_date_of_month)
    {
        return self::ReduceDaysToDate(self::SumMonthsToDate($first_date_of_month, 1), 1);
    }
    /**
     * returns [years,months,days]
     */
    public static function getYearsAndDayFromDateToToday($fecha)
    {
        $first_date_time = new DateTime($fecha);
        $second_date_time = new DateTime(date("Y-m-d"));
        $difference = $first_date_time->diff($second_date_time);
        return [$difference->y, $difference->m, $difference->d];
    }
    public static function getBasePagoPlanillas(array $fecha_desde, string $fecha_ingreso): int
    {
        $years = $fecha_desde[0];
        if ($years < 1) {
            $days = self::CalculateDaysBetweenTwoDates($fecha_ingreso, date("Y-m-d"));
            return ceil($days * 15 / 365);
        }
        if ($years > 1 && $years < 3) return 15;
        if ($years > 3 && $years < 10) return 19;

        return 21;
    }

    public static function obtenerYear($fecha){
        $fechaComoEntero = strtotime($fecha);
        $year = date("Y", $fechaComoEntero);
        return $year;
    }

    public static function obtenerDia($fecha){
        $fechaComoEntero = strtotime($fecha);
        $dia = date("d", $fechaComoEntero);
        return $dia;
    }





    public static function obtenerMesyDiaPorFecha($fecha){

        $fechaComoEntero = strtotime($fecha);
        $mes = date("m", $fechaComoEntero);
        $monthNameSpanish = null;
        switch( $mes)
        {
            case 1:
            $monthNameSpanish = "Enero";
            break;

            case 2:
            $monthNameSpanish = "Febrero";
            break;

            case 3:
            $monthNameSpanish = "Marzo";
            break;

            case 3:
            $monthNameSpanish = "Marzo";
            break;

            case 4:
                $monthNameSpanish = "Abril";
            break;

            case 5:
                $monthNameSpanish = "Mayo";
            break;

            case 6:
                $monthNameSpanish = "Junio";
            break;

            case 7:
                $monthNameSpanish = "Julio";
            break;

            case 8:
                $monthNameSpanish = "Agosto";
            break;

            case 9:
                $monthNameSpanish = "Septiembre";
            break;

            case 10:
                $monthNameSpanish = "Octubre";
            break;

            case 11:
                $monthNameSpanish = "Noviembre";
            break;

            case 12:
                $monthNameSpanish = "Diciembre";
            break;


        }

        return $monthNameSpanish;
    }
}
