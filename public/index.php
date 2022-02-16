<?php
date_default_timezone_set('Africa/Cairo');

session_start();

use controllers\AdminDashboardController;
use controllers\AuthController;
use core\Application;
use core\DotEnv;

include_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "Application.php");
include_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "DotEnv.php");

$env_reader = new DotEnv(__DIR__ . DIRECTORY_SEPARATOR . "db.env");
$env_reader->load();

$app = new Application(dirname(__DIR__), $_ENV);

$app->router->get("/", [AuthController::class, 'login']);
$app->router->post("/", [AuthController::class, 'login']);
$app->router->post("/admin/dashboard/save", [AdminDashboardController::class, 'saveSetting']);
$app->router->get("/admin/dashboard", [AdminDashboardController::class, 'index']);
$app->router->get("/logout", [AuthController::class, 'logout']);
$app->router->get("/fetchCountries", [AdminDashboardController::class, 'fetchCountries']);
$app->router->get("/fetchObstructions", [AdminDashboardController::class, 'fetchObstructions']);
$app->router->get("/fetchSettings", [AdminDashboardController::class, 'fetchSettings']);
$app->router->post("/deleteSetting", [AdminDashboardController::class, 'deleteSetting']);

$app->run();