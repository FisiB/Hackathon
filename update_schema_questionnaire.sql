CREATE TABLE `user_preferences` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `interest_historical` BOOLEAN DEFAULT FALSE,
  `interest_nature` BOOLEAN DEFAULT FALSE,
  `interest_adventure` BOOLEAN DEFAULT FALSE,
  `interest_beaches` BOOLEAN DEFAULT FALSE,
  `interest_city_life` BOOLEAN DEFAULT FALSE,
  `interest_museums` BOOLEAN DEFAULT FALSE,
  `interest_foodie_spots` BOOLEAN DEFAULT FALSE,
  `budget_range` VARCHAR(50) DEFAULT NULL, -- e.g., 'budget', 'moderate', 'upscale'
  `travel_companions` VARCHAR(50) DEFAULT NULL, -- e.g., 'solo', 'partner', 'family', 'friends'
  `travel_pace` VARCHAR(50) DEFAULT NULL, -- e.g., 'relaxed', 'balanced', 'action-packed'
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `unique_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;