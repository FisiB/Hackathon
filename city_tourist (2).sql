-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 04:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `city_tourist`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `description2` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country`, `description`, `description2`, `image`) VALUES
(6, 'New York', '', 'A vibrant metropolis with iconic landmarks like Times Square and Central Park.', 'New York is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, New York captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of New York. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, New York delivers an unforgettable journey of discovery and wonder.', 'newyork.jpg'),
(7, 'Tokyo', '', 'Tokyo blends cutting-edge technology with traditional culture, and is known for its food.', 'Tokyo is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Tokyo captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Tokyo. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Tokyo delivers an unforgettable journey of discovery and wonder.', 'tokyo.jpg'),
(8, 'Cairo', '', 'Cairo is the gateway to ancient Egypt, featuring the pyramids and rich history.', 'Cairo is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Cairo captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Cairo. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Cairo delivers an unforgettable journey of discovery and wonder.', 'cairo.jpg'),
(9, 'Paris', '', 'The romantic capital of France, famous for the Eiffel Tower and world-class museums.', 'Paris, the City of Light, radiates beauty, art, and romance. Famed for its iconic Eiffel Tower and historic landmarks like Notre-Dame Cathedral and the Arc de Triomphe, Paris seamlessly blends past and present. The city is a haven for art lovers with world-class museums such as the Louvre, home to the Mona Lisa, and the Musée d\'Orsay. Walks along the Seine River reveal picturesque views, bookstalls, and the charm of Parisian life. The city\'s neighborhoods—from the bohemian Montmartre to the chic Le Marais—each offer a unique slice of Parisian culture, cuisine, and style. Paris is not just a destination, it\'s an experience that stays with you long after your visit.', 'images/paris.jpg'),
(10, 'Rome', '', 'An ancient city rich in history, home to the Colosseum, Roman Forum, and Vatican City.', 'Rome, the Eternal City, is a living museum that spans thousands of years of history. From the ancient ruins of the Roman Forum and the Colosseum to the Renaissance splendor of St. Peter’s Basilica and the Sistine Chapel, every street corner tells a story. Rome\'s cobblestone streets and majestic piazzas host vibrant markets, lively cafes, and awe-inspiring art at every turn. The city’s culinary scene is a celebration of Italian tradition, from hand-tossed pizzas to creamy gelato. Visitors can spend days uncovering the layers of this historic capital while enjoying its relaxed pace of life and sun-kissed charm.', 'images/rome.jpg'),
(11, 'Athens', '', 'The cradle of Western civilization, featuring the Acropolis and Parthenon.', '', 'images/athens.jpg'),
(12, 'Amsterdam', '', 'A charming city with canals, museums, and vibrant bike culture.', 'Amsterdam is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Amsterdam captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Amsterdam. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Amsterdam delivers an unforgettable journey of discovery and wonder.', 'images/amsterdam.jpg'),
(13, 'Vienna', '', 'Austria’s capital known for classical music, baroque architecture, and coffee houses.', 'Vienna is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Vienna captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Vienna. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Vienna delivers an unforgettable journey of discovery and wonder.', 'images/vienna.jpg'),
(14, 'Berlin', '', 'A city of contrast, combining history, art, and a lively tech and nightlife scene.', '', 'images/berlin.jpg'),
(15, 'Prague', '', 'The fairytale city of castles, bridges, and medieval charm.', 'Prague is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Prague captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Prague. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Prague delivers an unforgettable journey of discovery and wonder.', 'images/prague.jpg'),
(16, 'Lisbon', '', 'Portugal’s colorful capital, famous for its hills, trams, and historic neighborhoods.', 'Lisbon is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Lisbon captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Lisbon. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Lisbon delivers an unforgettable journey of discovery and wonder.', 'images/lisbon.jpg'),
(17, 'Venice', '', 'A city built on water, known for gondolas, canals, and Renaissance art.', '', 'images/venice.jpg'),
(18, 'Seoul', '', 'South Korea’s capital blends ancient palaces with high-tech skyscrapers.', '', 'images/seoul.jpg'),
(19, 'Beijing', '', 'China’s capital city with centuries-old history, from the Forbidden City to the Great Wall.', '', 'images/beijing.jpg'),
(20, 'Mumbai', '', 'India’s bustling financial hub with vibrant culture, Bollywood, and historic architecture.', '', 'images/mumbai.jpg'),
(21, 'Singapore', '', 'A modern city-state known for cleanliness, gardens, and cultural diversity.', '', 'images/singapore.jpg'),
(22, 'Los Angeles', '', 'Home to Hollywood, beaches, and a creative urban vibe.', '', 'images/losangeles.jpg'),
(23, 'San Francisco', '', 'Famous for the Golden Gate Bridge, hills, and tech innovation.', '', 'images/sanfrancisco.jpg'),
(24, 'Chicago', '', 'Known for its architecture, skyline, deep-dish pizza, and jazz heritage.', '', 'images/chicago.jpg'),
(25, 'Toronto', '', 'Canada’s largest city offering a mix of cultures, food, and urban experiences.', 'Toronto is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Toronto captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Toronto. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Toronto delivers an unforgettable journey of discovery and wonder.', 'images/toronto.jpg'),
(26, 'Buenos Aires', '', 'Argentina’s capital with tango, European charm, and rich culture.', 'Buenos Aires is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Buenos Aires captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Buenos Aires. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Buenos Aires delivers an unforgettable journey of discovery and wonder.', 'images/buenosaires.jpg'),
(27, 'Lima', '', 'A coastal capital with a fusion of history, food, and Peruvian heritage.', '', 'images/lima.jpg'),
(28, 'Cairo', '', 'Home of the ancient pyramids, the Nile River, and Islamic architecture.', 'Cairo is a dynamic and culturally rich city known for its unique blend of history, modernity, and vibrant lifestyle. With its iconic landmarks, world-class cuisine, and diverse neighborhoods, Cairo captivates travelers from around the globe. Visitors can immerse themselves in the local traditions, explore bustling markets, or enjoy scenic vistas that define the character of Cairo. Whether you\'re seeking architectural marvels, artistic treasures, or unforgettable street experiences, Cairo delivers an unforgettable journey of discovery and wonder.', 'images/cairo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Fisib', 'fisi@gmail.com', '$2y$10$DN2OrhyP9jf3oRwxkGpm8Ot6f6JTH44p5W.C7CGMaNZopYxifnD2.'),
(2, 'Fisib2', 'fisi2@gmail.com', '$2y$10$ROhcBuSi7CjaX79.0.yKGeasbkA/giK9voKny6FrlPUS9o8scAPKe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
