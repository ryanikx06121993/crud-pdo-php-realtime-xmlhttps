<?php

// $conn = new PDO("mysql:host=localhost;dbname=php_tester", "root", "", array(
//     PDO::ATTR_PERSISTENT => true
// ));
// if($conn == FALSE) {
//     echo "Error connection";
// }

// $servername = "localhost";
// $username = "username";
// $password = "password";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully";
//     }
// catch(PDOException $e)
//     {
//     echo "Connection failed: " . $e->getMessage();
//     }
define('DB_DSN', 'mysql:host=localhost;dbname=php_tester;charset=utf8');
define('DB_HOST', 'localhost');
define('DB_NAME', 'php_tester');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
function connect() {
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION
        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    try {
    return new PDO(DB_DSN,DB_USER,DB_PASSWORD, $opt);
    }
    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
}
$conn = connect();




    // try {
    //  $conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME , DB_USER,DB_PASSWORD);
    // }
    // catch(PDOException $e)
    // {
    // echo "Connection failed: " . $e->getMessage();
    // }

?>