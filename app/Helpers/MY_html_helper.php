<?php
defined('SYSTEMPATH') or exit('No direct script access allowed');

function msgbox($tipo = 'danger', $conteudo = '')
{
    // $html = "<div style='max-width: 250px 'class='alert alert-{$tipo}' role='alert'>{$conteudo}</div>";
    if ($conteudo == "login")
        $html = "<p class='msgbox error'> Usuário e/ou senha incorretos.</p>";
    else
        $html = "demo.showNotification('top','center', '$conteudo', '$tipo')";
    return $html;
}

function get_periods($year = 2019, $range = false, $rangeYear = 2)
{
    $currentYear = intval(date('Y'));
    $currentMonth = intval(date('m'));
    if ($range) {
        $startYear = $currentYear - $rangeYear;
    } else {
        $startYear = $year;
    }
    $semesters = array();

    for ($startYear; $startYear <= $currentYear; $startYear++) {
        $period1 = $startYear . '.1';
        $period2 = $startYear . '.2';
        if ($startYear == $currentYear) {
            if ($currentMonth <= 6) {
                $semesters['Atual'][$period1] = $period1;
            } else {
                $semesters['Anterior'][$period1] = $period1;
                $semesters['Anterior'][$period2] = $period2;
            }
        } else {
            $semesters['Anterior'][$period1] = $period1;
            $semesters['Anterior'][$period2] = $period2;
        }
    }

    return $semesters;
}
