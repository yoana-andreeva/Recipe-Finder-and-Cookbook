<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Book</title>
    <link rel="stylesheet" href="style_book.css">
</head>
<body>
    <header>
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
        <div class="book-container">
            <div class="book" id="bookPages">
              <div class="page cover"></div>
            </div>

    
        <!-- Arrows -->
        <button id="prevPage" class="nav-arrow left-arrow">&#8592;</button>
        <button id="nextPage" class="nav-arrow right-arrow">&#8594;</button>
    </div>
    <?php
// Connection to database
$conn = new mysqli("localhost", "root", "", "recipe_website");
?>
    
    </main>
    <script>
    const savedIds = JSON.parse(localStorage.getItem("cookbook")) || [];

// Navigation
let currentPage = 0;
const nextBtn = document.getElementById("nextPage");
const prevBtn = document.getElementById("prevPage");

function updateBook() {
  const pages = document.querySelectorAll(".page");
  pages.forEach((page, index) => {
    if (index < currentPage) {
      page.style.transform = "rotateY(-180deg)";
      page.style.zIndex = index + 1;
    } else {
     page.style.transform = "rotateY(0deg)";
     page.style.zIndex = pages.length - index;
    }
  });
}

nextBtn.addEventListener("click", () => {
  const pages = document.querySelectorAll(".page");
  if (currentPage < pages.length) {
    currentPage++;
    updateBook();
  }
});

prevBtn.addEventListener("click", () => {
  if (currentPage > 0) {
    currentPage--;
    updateBook();
  }
});

</script>

    <script>
        function changeImage(button) {
            const img = button.querySelector('.button-img');
            // Changing the image 
            if (img.src.includes('book.png')) {
                img.src = 'book2.png'; 
            } else {
                img.src = 'book.png'; 
            }
        }

    document.addEventListener('DOMContentLoaded', () => {
    const saved = JSON.parse(localStorage.getItem('cookbook')) || [];
    const book = document.querySelector('.book');

    if (saved.length === 0) {
        book.innerHTML += '<div class="page"><h2>No saved recipes yet!</h2></div>';
        return;
    }
    let loadedCount = 0;

    saved.forEach(id => {
        fetch(`get_saved_recipes.php?id=${id}`)
            .then(res => res.json())
            .then(recipe => {
                if (recipe.error) return;

                const page = document.createElement('div');
                page.className = 'page';
                page.innerHTML = `
                <button class="remove-button" onclick="removeRecipe(${recipe.recipe_id}, this)">Ⓧ</button>
                <div class="recipe-image-wrapper">
                     <img src="${recipe.image_url}" alt="Recipe Image" class="recipe-image">
                </div>
                    <h2>${recipe.title}</h2>
                    <p class="description"><strong>Description:</strong> ${recipe.description}</p>
                    <p class="instructions"><strong>Instructions:</strong> ${recipe.instructions}</p>`;
                    book.appendChild(page);

                    loadedCount++;
                    if (loadedCount === saved.length) {
                    const endPage = document.createElement('div');
                    endPage.className = 'page';
                    endPage.innerHTML = `
                        <div class="end-message">
                            <h2>You've reached the end!</h2>
                            <p>Add more favorites to keep your cookbook growing!</p>
                             <a href="index.php" class="back-button">Find More</a>
                        </div>`;
                    book.appendChild(endPage);
                }
            });
    });
});


    function removeRecipe(id, btn) {
    if (!confirm("Are you sure you want to remove this recipe from your cookbook?")) return;

    let saved = JSON.parse(localStorage.getItem('cookbook')) || [];
    saved = saved.filter(recipeId => recipeId !== id);
    localStorage.setItem('cookbook', JSON.stringify(saved));

    // Removing the page 
    const page = btn.closest('.page');
    page.remove();

    // No pages left
    if (document.querySelectorAll('.book .page').length === 1) {
        document.querySelector('.book').innerHTML += `
            <div class="page">
                <h2>No saved recipes yet!</h2>
                <a href="index.php" class="back-button"> Find Recipes</a>
            </div>`;
    }
}


</script>

</body>
</html>