<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind(Database::class, function () {
    $config = config();

    return new Database($config['database'], $config['database']['user'], ''); 
});

App::setContainer($container);