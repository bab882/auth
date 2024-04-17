<?php
define("dbhost", "localhost");
define("dbuser", "root");
define("dbpass", "");
define("dbname", "database");

$dsn = "mysql:dbname=" . dbname . ";host=" . dbhost;

try {
    $db = new PDO($dsn, dbuser, dbpass);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erreur:".$e->getMessage());
}