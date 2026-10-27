<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Find Your Perfect Recipe</h1>
        <h3>Just fill out the ingredients that you want to use and click the button, so easy to find the <span class="highlight">PERFECT</span> recipe for you.</h3>
        <h3>Or just check out our inspiration section and get inspired to cook something new and tasty.</h3>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Recipe Finder</a>
                <button class="navbar-toggler" class="regular-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="cookbook.php">Cookbook</a></li>
                        <li class="nav-item"><a class="nav-link" href="inspiration.html">Inspiration</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <main>
        <!--Ingredients Section -->
        <section class="filter-section">
             <form id="recipeForm" action="index.php" method="POST">
            <h2>Select Ingredients</h2>
            <hr>
            <h3>Vegetables</h3>
            <div class="ingredient-categories">
                <label><input type="checkbox" name="ingredients[]" value="1"> Tomato</label>
                <label><input type="checkbox" name="ingredients[]" value="2"> Onion</label>
                <label><input type="checkbox" name="ingredients[]" value="3"> Bell Pepper</label>
                <label><input type="checkbox" name="ingredients[]" value="4"> Spinach</label>
                <label><input type="checkbox" name="ingredients[]" value="5"> Carrot</label>
                <label><input type="checkbox" name="ingredients[]" value="6"> Cucumber</label>
                <label><input type="checkbox" name="ingredients[]" value="7"> Broccoli</label>
                <label><input type="checkbox" name="ingredients[]" value="8"> Mushroom</label>
                <label><input type="checkbox" name="ingredients[]" value="9"> Potato</label>
            </div>
            <hr>
            <h3>Proteins</h3>
            <div class="ingredient-categories">
                <label><input type="checkbox" name="ingredients[]" value="10"> Chicken</label>
                <label><input type="checkbox" name="ingredients[]" value="11"> Beef</label>
                <label><input type="checkbox" name="ingredients[]" value="12"> Salmon</label>
                <label><input type="checkbox" name="ingredients[]" value="13"> Eggs</label>
            </div>
            <hr>
            <h3>Dairy</h3>
            <div class="ingredient-categories">
                <label><input type="checkbox" name="ingredients[]" value="14"> Cheese</label>
                <label><input type="checkbox" name="ingredients[]" value="15"> Milk</label>
                <label><input type="checkbox" name="ingredients[]" value="16"> Yogurt</label>
                <label><input type="checkbox" name="ingredients[]" value="17"> Cream</label>
            </div>
            <hr>
            <h3>Grains</h3>
            <div class="ingredient-categories">
                <label><input type="checkbox" name="ingredients[]" value="18"> Rice</label>
                <label><input type="checkbox" name="ingredients[]" value="19"> Pasta</label>
                <label><input type="checkbox" name="ingredients[]" value="20"> Bread</label>
                <label><input type="checkbox" name="ingredients[]" value="21"> Quinoa</label>
            </div>
            <hr>
            <button type="submit" class="regular-button">Find Recipes</button>
                </form>
            </section>

        
             <!-- Results Section -->
            <section class="results-section">
            <div class="row">
                <?php
                $servername = "localhost";
                $username = "root"; 
                $password = ""; 
                $dbname = "recipe_website"; 
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                if (!isset($_POST['ingredients']) || empty($_POST['ingredients'])) {
                    echo  '<h2 class="no-results">Don\'t know what to cook? Select a few ingredients and let\'s find your perfect dish!</h2>';
                    exit;
                }
                
                // Get selected ingredients from the query string
                $selected_ingredients = $_POST['ingredients'];
                
                if (!is_array($selected_ingredients)) {
                    echo "<h2>Invalid ingredients format.</h2>";
                    exit;
                }
                
                $placeholders = implode(',', array_fill(0, count($selected_ingredients), '?'));
                
                // select recipes
                $sql = "
                    SELECT recipes.recipe_id, recipes.title, recipes.description, recipes.image_url, 
                           COUNT(recipe_ingredients.ingredient_id) AS ingredient_count
                    FROM recipes
                    JOIN recipe_ingredients ON recipes.recipe_id = recipe_ingredients.recipe_id
                    WHERE recipe_ingredients.ingredient_id IN ($placeholders)
                    GROUP BY recipes.recipe_id
                    ORDER BY ingredient_count DESC
                ";
                
                $stmt = $conn->prepare($sql);

                 if ($stmt === false) {
                    die("Error preparing statement: " . $conn->error);
                }
                

                $stmt->bind_param(str_repeat('i', count($selected_ingredients)), ...$selected_ingredients);
                $stmt->execute();
                $result = $stmt->get_result();
                
                // Check if any recipes were found
                if ($result->num_rows > 0) {
                    echo '<h2 class="highlight-background">Recipes Found:</h2>';
                    while ($row = $result->fetch_assoc()) {
                        echo '
                                    <div class="recipe-card">
                                        <img class="dish-image" src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['title']) . '">
                                        <h3>' . htmlspecialchars($row['title']) . '</h3>
                                        <div class="button-container">
                                           <a href="recipe.php?id=' . htmlspecialchars($row['recipe_id']) . '&ingredients=' . implode(',', $selected_ingredients) . '" class="regular-button">Read More</a>
                                            <button class="image-button" onclick="changeImage(this); saveToCookbook(' . htmlspecialchars($row['recipe_id']) . ')" >
                                                <img src="book.png" alt="Button" class="button-img">
                                            </button>
                                        </div>
                                    </div>
                                ';
                    }
                } else {
                    echo '<h2 style="margin-top:160px; margin-left:100px;">No matching recipes found :(</h2>';
                    echo '<img  class="fridge" src="fridge.png" alt="fridge ">';
                }
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                } </script>';
                
                $stmt->close();
                $conn->close();
                ?> 
             </div>
        </section>
    </main>
        
   
    
    <footer>
        <p>&copy; 2025 Recipe Finder</p>
    </footer>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function changeImage(button) {
        const img = button.querySelector('.button-img');
        // Changing image 
        if (img.src.includes('book.png')) {
            img.src = 'book2.png'; 
        } else {
            img.src = 'book.png';
        }
    }

    //    button for cookbook 
    function saveToCookbook(recipeId) {
    let saved = JSON.parse(localStorage.getItem('cookbook')) || [];
    if (!saved.includes(recipeId)) {
        saved.push(recipeId);
        localStorage.setItem('cookbook', JSON.stringify(saved));
        alert("Recipe saved to your cookbook!");
    } else {
        alert("Recipe is already in your cookbook.");
    }
}


    </script>

</body>
</html>

