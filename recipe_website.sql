-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране: 27 окт 2026 в 21:56
-- Версия на сървъра: 9.1.0
-- Версия на PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `recipe_website`
--

-- --------------------------------------------------------

--
-- Структура на таблица `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `ingredient_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `name`) VALUES
(1, 'Tomato'),
(2, 'Onion'),
(3, 'Bell Pepper'),
(4, 'Spinach'),
(5, 'Carrot'),
(6, 'Cucumber'),
(7, 'Broccoli'),
(8, 'Mushroom'),
(9, 'Potato'),
(10, 'Chicken'),
(11, 'Beef'),
(12, 'Salmon'),
(13, 'Eggs'),
(14, 'Cheese'),
(15, 'Milk'),
(16, 'Yogurt'),
(17, 'Cream'),
(18, 'Rice'),
(19, 'Pasta'),
(20, 'Bread'),
(21, 'Quinoa');

-- --------------------------------------------------------

--
-- Структура на таблица `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `recipe_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `instructions` text COLLATE utf8mb4_general_ci,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`recipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `description`, `instructions`, `image_url`) VALUES
(2, 'Grilled Chicken', 'Juicy grilled chicken with spices.', 'Marinate chicken with olive oil, garlic, salt, pepper, and herbs for 30 minutes. Grill over medium-high heat for 5–6 minutes per side until fully cooked. Let rest for 5 minutes, then serve with vegetables or salad.', 'grilled_chicken.jpg'),
(1, 'Vegetable Stir Fry', 'A quick and easy vegetable stir fry.', 'Chop all vegetables. Heat oil in a wok, sauté onion and carrot for 2–3 minutes. Add broccoli, bell pepper, and mushrooms. Stir-fry for 5 minutes. Add soy sauce mixed with a little cornstarch and water. Toss well and cook until sauce thickens. Serve hot with rice.\r\n\r\n', 'stir_fry.jpg'),
(3, 'Pasta Primavera', 'Pasta with fresh vegetables.', 'Cook pasta until al dente. Heat olive oil and add chopped onions, cook for 2 minutes. Then add sliced bell peppers, carrots, and broccoli. Stir in chopped tomatoes and spinach. Cook for another 2 minutes and then stir in cream. Toss with pasta, season with salt, pepper, and herbs. Serve warm.', 'pasta_primavera.jpg'),
(4, 'Chicken Quinoa Bowl', 'A nutritious bowl with chicken and fluffy quinoa.', 'Cook quinoa in water or broth until light and fluffy. Grill chicken breasts and chop fresh spinach, tomato, and cucumber. Assemble the bowl by layering quinoa at the bottom, then the veggies and sliced chicken on top.', 'chicken_quinoa_bowl.jpg'),
(5, 'Creamy Mushroom Pasta', 'Creamy pasta with mushrooms.', 'Boil the pasta, drain and set aside. In a large skillet, sauté chopped onion in olive oil, add sliced mushrooms and cook until they release their moisture and brown. Pour in the cream and simmer for 5 minutes. Stir in shredded cheese and the cooked pasta. Season with salt and pepper to taste.', 'mushroom_pasta.jpg'),
(6, 'Broccoli Cheddar Soup', 'Creamy soup with fresh broccoli and cheddar.', 'In a pot, melt butter and sauté chopped onion and broccoli, cook for a few minutes. Pour in milk and cook until broccoli is tender. Use a blender to blend the soup. Stir in grated cheese and mix until melted and creamy. Season to taste and serve hot with bread.', 'broccoli_soup.jpg'),
(7, 'Salmon with Creamy Spinach', 'Salmon fillets in a creamy spinach sauce.', 'Season salmon with salt and pepper, sear salmon fillets skin-side down until golden. In the same skillet, sauté chopped onion, add spinach and cook until wilted. Stir in cream and simmer for 2–3 minutes. Return salmon to the skillet, coat with sauce, and serve hot.', 'salmon_spinach.jpg'),
(8, 'Egg and Veggie Sandwich', 'Breakfast sandwich with egg, cheese, and fresh veggies.', 'Toast two slices of bread. In a skillet, cook a scrambled egg, sauté chopped bell pepper and spinach lightly. Layer egg, sautéed veggies, and a slice of cheese between the toasted bread. Serve warm.', 'egg_sandwich.jpg'),
(9, 'Creamy Potato Soup', 'Creamy soup with potatoes and cream.', 'Peel and chop potatoes. In a large pot, sauté chopped onion, then add potatoes and enough water to cover. Simmer until potatoes are soft. Use a blender to blend the soup. Stir in cream and season with salt and pepper. Simmer briefly and serve hot.', 'creamy_potato_soup.jpg'),
(10, 'Creamy Chicken Rice Skillet', 'Tender chicken, rice, and a creamy sauce.', 'Cook chopped onion in a skillet until soft. Add cubed chicken and brown on all sides. Stir in uncooked rice and enough water to cover. Simmer until rice is cooked. Stir in cream and cook for another 2–3 minutes until everything is creamy and heated through.', 'creamy_chicken_rice.jpg'),
(11, 'Beef and Potato Skillet', 'Meal with Tender beef, potatoes, and vegetables.', 'In a large skillet, sauté diced onion until translucent, add cubed beef and cook until browned. Add diced potatoes and sliced carrots. Season with salt and pepper. Cover and cook on medium-low heat for about 20–25 minutes until potatoes are soft.', 'beef_potato_skillet.jpg'),
(12, 'Teriyaki Salmon with Rice', 'Salmon fillets glazed in teriyaki sauce served with fluffy rice and fresh vegetables.', 'Cook rice as per package instructions. In a pan, cook salmon fillets for 3–4 minutes on each side, brushing with teriyaki sauce. Slice cucumber and grate carrot. Serve salmon over rice and top with fresh vegetables.', 'salmon_rice.jpg'),
(13, 'Rice Salad with Veggies and Beef', 'Nutritious bowl with beef and veggies.', 'Cook rice and set aside. Roast sliced carrots and onions for 20 minutes. Sear thin strips of beef in a pan until cooked. Combine warm rice, beef, and roasted veggies in a bowl. Top with sliced cucumber and a light dressing.', 'rice_beef_salad.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
CREATE TABLE IF NOT EXISTS `recipe_ingredients` (
  `recipe_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  PRIMARY KEY (`recipe_id`,`ingredient_id`),
  KEY `ingredient_id` (`ingredient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`recipe_id`, `ingredient_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 7),
(1, 8),
(1, 18),
(2, 10),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 7),
(3, 17),
(3, 19),
(4, 1),
(4, 4),
(4, 6),
(4, 10),
(4, 21),
(5, 8),
(5, 14),
(5, 17),
(5, 19),
(6, 2),
(6, 7),
(6, 14),
(6, 15),
(6, 20),
(7, 2),
(7, 4),
(7, 12),
(7, 17),
(8, 3),
(8, 4),
(8, 13),
(8, 14),
(8, 20),
(9, 2),
(9, 9),
(9, 17),
(10, 2),
(10, 10),
(10, 17),
(10, 18),
(11, 2),
(11, 5),
(11, 9),
(11, 11),
(12, 5),
(12, 6),
(12, 12),
(12, 18),
(13, 2),
(13, 5),
(13, 6),
(13, 11),
(13, 18);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
