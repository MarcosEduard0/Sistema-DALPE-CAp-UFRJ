<?php
defined('SYSTEMPATH') or exit('No direct script access allowed');

function msgbox($tipo = 'error', $conteudo = '')
{
    // $html = "<div style='max-width: 250px 'class='alert alert-{$tipo}' role='alert'>{$conteudo}</div>";
    if ($conteudo == "login")
        $html = "<p class='msgbox error'> Usuário e/ou senha incorretos.</p>";
    else
        $html = "demo.showNotification('top','center', '$conteudo', '$tipo')";
    return $html;
}
