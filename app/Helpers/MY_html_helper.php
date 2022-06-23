<?php
defined('SYSTEMPATH') or exit('No direct script access allowed');

function msgbox($tipo = 'error', $conteudo = '')
{
    // $html = "<div style='max-width: 250px 'class='alert alert-{$tipo}' role='alert'>{$conteudo}</div>";
    $html = "<p class='msgbox {$tipo}'>{$conteudo}</p>";
    return $html;
}
