-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2025 at 01:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `checkin` date DEFAULT NULL,
  `checkout` date DEFAULT NULL,
  `numof_guests` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `listing_id`, `user_id`, `checkin`, `checkout`, `numof_guests`, `total_price`, `created_at`) VALUES
(1, 1, 1, '2025-08-15', '2025-08-17', 4, NULL, '2025-08-12 14:53:16'),
(2, 3, 2, '2025-08-20', '2025-08-23', 2, NULL, '2025-08-12 14:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cover_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `property_id`, `name`, `price`, `capacity`, `description`, `cover_img`) VALUES
(1, 1, '5 Bedroom Empire Bay Luxury Beach Villa.', 4931.40, 8, 'Experience ultimate luxury at the 5 Bedroom Empire Bay Luxury Beach Villa, where modern comfort meets breathtaking coastal views.\nThis expansive beachfront retreat offers five beautifully designed bedrooms, a sparkling private pool, and direct access to the sandy shore — perfect for family vacations, group getaways, or special celebrations.\n\nInside, you’ll find bright, airy living spaces, a fully equipped kitchen, and stylish décor that blends elegance with relaxation. Step outside to lounge by the pool, enjoy sunset views from the terrace, or take a few steps to the beach for a morning swim. With premium amenities and a serene location, Empire Bay Villa promises an unforgettable escape.', 'images/empire bay/main.png'),
(2, 2, '3 bedroom Beachfront villa', 800.00, 2, 'Fully furnished executive apartment.', 'images/empire bay/main.png'),
(3, 3, '3 Bedroom Villa', 500.00, 2, 'Minimalist studio in Osu.', 'images/empire bay/main.png'),
(4, 4, '1-bedroom villa @ Airport Tribute House', 750.00, 4, 'Modern condo near shopping areas.', 'images/empire bay/main.png'),
(5, 5, 'Luxury Villa with a private pool', 1500.00, 2, 'Modern studio apartment in the heart of East Legon Hills', 'images/empire bay/main.png'),
(6, 6, 'One Bedroom Executive Apartment', 1500.00, 2, 'Modern studio apartment in the heart of Osu', 'images/empire bay/main.png'),
(7, 7, 'One Bedroom Luxurious studio Apartment', 2200.00, 3, 'Luxurious apartment near the airport', 'images/empire bay/main.png'),
(8, 8, 'One bedroom luxury apartment at The Loxwood', 1800.00, 4, 'Spacious apartment with scenic views in Accra', 'images/empire bay/main.png'),
(9, 9, 'One bedroom condo with a rooftop pool', 1700.00, 3, 'Comfortable and cozy apartment in Roman Ridge', 'images/empire bay/main.png');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `type`, `location`) VALUES
(1, 'Empire Bay Villa', 'Villa', 'PramPram'),
(2, 'Streicher Beachfront Villa', 'Villa', 'PramPram'),
(3, 'Crescent Crove', 'Villa', 'Airport Residential'),
(4, 'Airport Tribute House', 'Villa', 'Roman Ridge'),
(5, 'Poa Homes', 'Villa', 'East Legon Hills'),
(6, 'Solaris', 'Apartment', 'Osu'),
(7, 'The Lennox', 'Apartment', 'Airport Residential'),
(8, 'Loxwood', 'Apartment', 'Accra'),
(9, 'Nova', 'Apartment', 'Roman Ridge');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `listing_id`, `image_url`) VALUES
(1, 1, 'images/empire bay/EB2.png'),
(2, 1, 'images/empire bay/EB3.png'),
(3, 1, 'images/empire bay/EB4.png'),
(4, 1, 'images/empire bay/EB5.png'),
(5, 1, 'images/empire bay/EB6.png'),
(6, 1, 'images/empire bay/EB7.png'),
(7, 1, 'images/empire bay/EB8.png'),
(8, 1, 'images/empire bay/EB9.png'),
(9, 1, 'images/empire bay/EB10.png'),
(10, 1, 'images/empire bay/EB11.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`) VALUES
(1, 'Awo', 'Afranie-Adjei', 'awo@example.com', '0501234567'),
(2, 'Nana', 'Mensah', 'nana@example.com', '0245678910');

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`);

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_ibfk_1` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
