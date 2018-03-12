<?php

declare(strict_types=1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

$app = new App\App;
while (true) {
    $app->cli();
}
