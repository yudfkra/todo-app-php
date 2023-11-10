<?php

function dd($values)
{
    echo "<pre>";
    print_r($values);
    echo "</pre>";

    exit();
}

function authorize($condition, $responseCode = 403, $message = 'You are not Authorized.')
{
    if (!$condition) {
        \Core\Router::abort($responseCode, $message);
    }
}

function authorizeUser($userID)
{
    return (\Core\Session::get('user')['id'] ?? null) === $userID;    
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function public_path($path)
{
    return base_path("public/{$path}");    
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

function redirect($path = '/')
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return \Core\Session::get('old')[$key] ?? $default;
}

function csrf_field() {
    return '<input type="hidden" name="_token" value="' . \Core\Session::get('_token') . '">';
}

function mapStatusDisplay($status)
{
    return match ($status) {
        1, "1" => 'Selesai',
        2, "2" => 'Inprogress',
        -1, "-1" => 'Batal',
        default => '-'
    };
}