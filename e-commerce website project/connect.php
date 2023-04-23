<?php

try {
    $conn = new pdo("mysql:host=localhost;dbname=ecomweb", "root", "");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
