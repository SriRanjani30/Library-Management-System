<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['query'];

    $sql = $conn->prepare("SELECT book_name, availability FROM books WHERE book_id = ?");
    $sql->bind_param("s", $bookId);
    $sql->execute();
    $sql->bind_result($bookName, $availability);
    $sql->fetch();

    if ($bookName) {
        $availabilityText = $availability ? "Available" : "Not Available";
        echo "<p>Book Name: " . htmlspecialchars($bookName) . "</p>";
        echo "<p>Availability: " . htmlspecialchars($availabilityText) . "</p>";
    } else {
        echo "<p>No book found with ID " . htmlspecialchars($bookId) . "</p>";
    }

    $sql->close();
}

$conn->close();
?>
