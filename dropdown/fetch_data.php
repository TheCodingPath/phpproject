<?php
include 'db_connection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_GET['type'];
if ($type == 'cities') {
    $country_id = $_GET['country_id'];
    $sql = "SELECT * FROM cities WHERE country_id = $country_id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
} elseif ($type == 'areas') {
    $city_id = $_GET['city_id'];
    $sql = "SELECT * FROM areas WHERE city_id = $city_id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
}
$conn->close();
