<?php
/**
 * Created by PhpStorm.
 * User: ryann_000
 * Date: 18/08/2017
 * Time: 05:44 PM
 */


$user = 'root';
$pass = '';
$db = 'games';

$conn = new mysqli('localhost', $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to database: $db <br>";


$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully <br>";

} else {

    echo "Error creating table:  " . $conn->error;

}


$conn->close();






