<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fonerepsite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo "<script>alert('Your message has been sent successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
