<?php

use Core\App;
use Core\Authenticator;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind(Database::class, function () {
    $config = config();

    return new Database($config['database'], $config['database']['user'], ''); 
});

$container->bind(Authenticator::class, function () {
    return new Authenticator;
});

App::setContainer($container);