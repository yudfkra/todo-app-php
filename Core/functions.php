<?php

function dd($values)
{
    echo "<pre>";
    var_dump($values);
    echo "</pre>";

    exit();
}

function authorize($condition, $responseCode = 403, $message = 'You are not Authorized.')
{
    if (!$condition) {
        abort($responseCode, $message);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function config()
{
    $config = require base_path("config.php");

    return $config;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path("views/{$path}");
}