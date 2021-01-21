<?php

############################
# Const
############################

define("ROOT", str_replace('\\', '/', __DIR__));

$externalContent = file_get_contents('http://checkip.dyndns.com/');
preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
$externalIp = $m[1];

define("SERVER_IP", $externalIp);

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