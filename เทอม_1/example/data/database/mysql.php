<?php
ob_start();

// MySQL database connection details
$db_host = $mysql['host'];
$db_name = $mysql['database'];
$db_user = $mysql['username'];
$db_pass = $mysql['password'];

// Establish MySQL PDO connection
try {
    $connec = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    // Set PDO to throw exceptions on error
    $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

?>
