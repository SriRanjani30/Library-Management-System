<?php
$servername = "localhost";
$username = "root";
$password = "root@123";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $conn->real_escape_string($_POST['query']);
    $sql = "SELECT title, availability FROM books WHERE title LIKE '%$query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Title: " . $row["title"] . " - Availability: " . ($row["availability"] ? "Available" : "Not Available") . "<br>";
        }
    } else {
        echo "No books found.";
    }
}

$conn->close();
?>
