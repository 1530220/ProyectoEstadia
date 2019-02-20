<?php
function getMySQLDate($date_string)
{
    $date_split = explode(" ", $date_string);

    switch($date_split[1]){
        case 'Enero':
            $date_split[1] = "01";
            break;
        case 'Febrero':
            $date_split[1] = "02";
            break;
        case 'Marzo':
            $date_split[1] = "03";
            break;
        case 'Abril':
            $date_split[1] = "04";
            break;
        case 'Mayo':
            $date_split[1] = "05";
            break;
        case 'Junio':
            $date_split[1] = "06";
            break;
        case 'Julio':
            $date_split[1] = "07";
            break;
        case 'Agosto':
            $date_split[1] = "08";
            break;
        case 'Septiembre':
            $date_split[1] = "09";
            break;
        case 'Octubre':
            $date_split[1] = "10";
            break;
        case 'Noviembre':
            $date_split[1] = "11";
            break;
        case 'Diciembre':
            $date_split[1] = "12";
            break;
    }

    return $date_split[2]."-".$date_split[1]."-".$date_split[0]." 00:00:00";
}
