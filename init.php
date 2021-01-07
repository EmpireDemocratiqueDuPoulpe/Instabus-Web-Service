<?php

############################
# Const
############################

define("ROOT", str_replace('\\', '/', __DIR__));

############################
# Load classes
############################

function loadClasses($classname) { require_once ROOT . "/classes/$classname.php"; }
spl_autoload_register("loadClasses");

############################
# Import config file
############################

$config = parse_ini_file(ROOT . "/config/config.ini", true);

############################
# Connect to database
############################

$db = PDOFactory::getInstance(
    PDOFactory::DATABASE_TYPE_MYSQL,
    $config["DB"]["host"],
    $config["DB"]["dbname"],
    $config["DB"]["port"],
    $config["DB"]["user"],
    $config["DB"]["password"]
);