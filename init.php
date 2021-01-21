<?php

############################
# Const
############################

define("ROOT", str_replace('\\', '/', __DIR__));
define("SERVER_IP", gethostbyname(gethostname() . ".local"));

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
    $config["db"]["host"],
    $config["db"]["dbname"],
    $config["db"]["port"],
    $config["db"]["user"],
    $config["db"]["password"]
);