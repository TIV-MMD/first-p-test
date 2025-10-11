<?php

function getcurrenturl()
{
    return 1;
}
function diepage($msg)
{
    echo $msg;
    die();
}
function isAjaxRequest()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;   //request is ajax
    }
    return false;
}
function dd($var)
{
    echo "<pre style='color: #9c4100; background: #fff; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #c56705;'>";
    var_dump($var);
    echo "</pre>";
}
function site_url($uri = '')
{
    return BASE_URL . $uri;
}
function message($msg, $cssClass = 'info')
{
    echo "<div class='$cssClass' style='padding: 20px; width: 80%; margin: 10px auto; background: #f9dede; border: 1px solid #cca4a4; color: #521717; border-radius: 5px; font-family: sans-serif;'>$msg</div>";
}
function messagetrue($msg, $cssClass = 'info')
{
    echo "<div class='$cssClass' style='padding: 20px; width: 80%; margin: 10px auto; background: #e4c6e7ff; border: 1px solid #cd5fe9ff; color: #44a82aff; border-radius: 5px; font-family: sans-serif;'>$msg</div>";
}
