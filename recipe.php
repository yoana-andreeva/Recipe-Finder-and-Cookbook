<?php

$conn = new mysqli("localhost", "root", "", "recipe_website");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$ingredient_ids = isset($_GET['ingredients']) ? $_GET['ingredients'] : '';
$recipe = null;

if ($recipe_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE recipe_id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $recipe = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $recipe ? htmlspecialchars($recipe['title']) : "Recipe Not Found"; ?></title>
    <link rel="stylesheet" href="style_recipe.css">
</head>
<body>
<form action="index.php" method="POST">
    <?php
    if (!empty($_GET['ingredients'])) {
        $ingredient_ids = $_GET['ingredients'];
        $ids_array = explode(',', $ingredient_ids);
        foreach ($ids_array as $id) {
            echo '<input type="hidden" name="ingredients[]" value="' . htmlspecialchars($id) . '">';
        }
    }
    ?>
    <button type="submit" class="back-link">&larr; Back to Home</button>
</form>
    </div> 
    <div class="recipe-wrapper">
    <div class="recipe-image">
        <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" alt="Recipe Image">
    </div>
    <div class="recipe-content">
        <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($recipe['description'])); ?></p>
        <h3>Instructions:</h3>
        <p><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
    </div>
</div>

</body>
</html>
