<?php

session_start();

use core\Application;
use core\DotEnv;

include_once(__DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "Application.php");
include_once(__DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "DotEnv.php");

$env_reader = new DotEnv(__DIR__ . DIRECTORY_SEPARATOR . "db.env");
$env_reader->load();

$app = new Application(__DIR__, $_ENV);
$app->database->applyMigrations();
