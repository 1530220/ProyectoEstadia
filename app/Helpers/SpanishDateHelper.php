<?php
function getSpanishDate($date_string)
{

    $date_split = explode("-", $date_string);

    switch($date_split[1]){
        case '01':
            $date_split[1] = "Enero";
            break;
        case '02':
            $date_split[1] = "Febrero";
            break;
        case '03':
            $date_split[1] = "Marzo";
            break;
        case '04':
            $date_split[1] = "Abril";
            break;
        case '05':
            $date_split[1] = "Mayo";
            break;
        case '06':
            $date_split[1] = "Junio";
            break;
        case '07':
            $date_split[1] = "Julio";
            break;
        case '08':
            $date_split[1] = "Agosto";
            break;
        case '09':
            $date_split[1] = "Septiembre";
            break;
        case '10':
            $date_split[1] = "Octubre";
            break;
        case '11':
            $date_split[1] = "Noviembre";
            break;
        case '12':
            $date_split[1] = "Diciembre";
            break;
    }

    return explode(" ", $date_split[2])[0]." ".$date_split[1]." ".$date_split[0];
}
