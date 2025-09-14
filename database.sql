-- Create database
CREATE DATABASE IF NOT EXISTS todo_app;
USE todo_app;

-- Table structure for table `organizations`
CREATE TABLE `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','user','org') NOT NULL DEFAULT 'user',
  `org_id` int(11) DEFAULT NULL,
  `bio` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `org_id` (`org_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL
);

-- Table structure for table `tasks`
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `due_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `org_id` (`org_id`),
  KEY `assigned_by` (`assigned_by`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
);

-- Insert sample data
INSERT INTO `organizations` (`id`, `name`, `description`) VALUES
(1, 'Sample Organization', 'This is a sample organization for demonstration purposes.');

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `org_id`, `bio`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$r3B7VjUJ5eG5Q2V8W6zZ.uY6K9cL7M2N1B3V5C7X9Y2Z3V6B4D5F7H9J', 'admin', NULL, 'I am the administrator of this system.'),
(2, 'Organization User', 'org@example.com', '$2y$10$r3B7VjUJ5eG5Q2V8W6zZ.uY6K9cL7M2N1B3V5C7X9Y2Z3V6B4D5F7H9J', 'org', 1, 'I represent the organization.'),
(3, 'Regular User', 'user@example.com', '$2y$10$r3B7VjUJ5eG5Q2V8W6zZ.uY6K9cL7M2N1B3V5C7X9Y2Z3V6B4D5F7H9J', 'user', 1, 'I am a regular user of this system.');

INSERT INTO `tasks` (`id`, `user_id`, `org_id`, `assigned_by`, `title`, `description`, `status`, `priority`, `due_date`) VALUES
(1, 3, 1, 1, 'Complete project proposal', 'Draft and submit the project proposal for client review', 'pending', 'high', '2023-12-15'),
(2, 3, 1, 2, 'Review design mockups', 'Provide feedback on the new UI design mockups', 'completed', 'medium', '2023-12-10'),
(3, 2, 1, 1, 'Organize team meeting', 'Schedule and prepare agenda for quarterly team meeting', 'pending', 'low', '2023-12-20');
