<?php

require_once '../Core/autoload.php';

spl_autoload_register('autoload');

$config = require_once '../Core/config.php';

$app = new App($config);
$app->run();