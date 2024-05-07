<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "your_servername";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, level, student1, student2, student3, student4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $username, $email, $password, $level, $student1, $student2, $student3, $student4);

    // Set parameters and execute
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $level = $_POST["options"];
    $student1 = $_POST["student"];
    $student2 = $_POST["student2"];
    $student3 = $_POST["student3"];
    $student4 = $_POST["student4"];
    $stmt->execute();

    echo "New record inserted successfully";

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
