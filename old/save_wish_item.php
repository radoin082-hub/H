<?php
$data = json_decode(file_get_contents('php://input'), true);
$wishList = $data['wishsheet'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "list";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($wishList as $index => $item) {
        $stmt = $conn->prepare("INSERT INTO wishsheet (theme, professor, description, priority) VALUES (:theme, :professor, :description, :priority)");
        $stmt->bindParam(':theme', $item['theme']);
        $stmt->bindParam(':professor', $item['professor']);
        $stmt->bindParam(':description', $item['description']);
        $stmt->bindParam(':priority', $index + 1);
        $stmt->execute();
    }

    http_response_code(200);
    echo json_encode(array("message" => "Wish list saved successfully."));
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
?>
