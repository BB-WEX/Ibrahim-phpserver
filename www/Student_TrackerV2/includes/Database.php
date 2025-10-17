<?php
try {
    $db = new PDO('mysql:host=mysql;dbname=Student_TrackerV2', 'root', 'root');
    // echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Tell PDO how to fetch data (associative array)
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>