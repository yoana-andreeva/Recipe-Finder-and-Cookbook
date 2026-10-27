<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recipe_website";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Missing ID"]);
    exit;
}

$recipeId = intval($_GET['id']);
$stmt = $conn->prepare("SELECT recipe_id, title, description, instructions, image_url FROM recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipeId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(["error" => "Recipe not found"]);
}

$stmt->close();
$conn->close();
?>
