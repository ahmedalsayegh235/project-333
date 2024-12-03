<?php
$dsn = "mysql:host=localhost;dbname=Roomyweb";
$dbusername= "root";
$dbpassword = "";
try{
$pdo = new PDO($dsn, $dbusername, $dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException)
{
echo "Connection failed: " . $e->getMessage();
}
