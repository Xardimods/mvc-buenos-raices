<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require "funciones.php";
require "config/database.php";

// Conexión a la BBDD
$db = conectarDatabase();
$db->set_charset("utf8");
ActiveRecord::setDB($db);