-- -------------------------------------------------------------
-- -------------------------------------------------------------
-- TablePlus 1.2.0
--
-- https://tableplus.com/
--
-- Database: mariadb
-- Generation Time: 2024-09-04 23:45:15.380968
-- -------------------------------------------------------------

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `comentarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comentarios_user_id_foreign` (`user_id`),
  KEY `comentarios_post_id_foreign` (`post_id`),
  CONSTRAINT `comentarios_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comentarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `followers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `follower_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `followers_user_id_foreign` (`user_id`),
  KEY `followers_follower_id_foreign` (`follower_id`),
  CONSTRAINT `followers_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_user_id_foreign` (`user_id`),
  KEY `likes_post_id_foreign` (`post_id`),
  CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `devstagram`.`comentarios` (`id`, `user_id`, `post_id`, `comentario`, `created_at`, `updated_at`) VALUES 
(2, 2, 5, 'Chales
creo que no', '2024-09-03 20:01:11', '2024-09-03 20:01:11'),
(3, 2, 17, 'Yo igual', '2024-09-04 18:06:40', '2024-09-04 18:06:40');

INSERT INTO `devstagram`.`followers` (`id`, `user_id`, `follower_id`, `created_at`, `updated_at`) VALUES 
(3, 2, 3, NULL, NULL),
(6, 3, 2, NULL, NULL);

INSERT INTO `devstagram`.`likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES 
(12, 2, 5, '2024-09-03 19:59:06', '2024-09-03 19:59:06'),
(13, 3, 17, '2024-09-03 22:17:01', '2024-09-03 22:17:01'),
(14, 2, 7, '2024-09-04 04:33:37', '2024-09-04 04:33:37'),
(15, 2, 9, '2024-09-05 04:09:59', '2024-09-05 04:09:59'),
(16, 2, 14, '2024-09-05 04:10:07', '2024-09-05 04:10:07');

INSERT INTO `devstagram`.`migrations` (`id`, `migration`, `batch`) VALUES 
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_29_030234_add_username_to_users_table', 2),
(7, '2024_08_29_031922_add_username_to_users_table', 3),
(9, '2024_08_30_222936_create_posts_table', 4),
(11, '2024_09_02_211240_create_comentarios_table', 5),
(12, '2024_09_03_052458_create_likes_table', 6),
(13, '2024_09_03_214926_add_imagen_field_to_users_table', 7),
(14, '2024_09_04_034943_create_followers_table', 8);

INSERT INTO `devstagram`.`posts` (`id`, `titulo`, `descripcion`, `imagen`, `user_id`, `created_at`, `updated_at`) VALUES 
(1, 'Creando un nuevo proyecto Plebes', 'Aquí de nuevo creando un nuevo proyecto, pero ahora con el framework laravel 11, me canse de tener que reinventar la rueda, ahora vamos a agilizar mas el trabajo usando laravel 11, esto si que atrae a las chicas!! :D', 'f295620f-9cff-43aa-a09c-0fedec154433.png', 2, '2024-09-01 23:13:16', '2024-09-01 23:13:16'),
(3, 'Creando el juego Angry birs para web', 'Aquí con toda la actitud desarrollando un juego esta semana', '0128f457-32bf-4485-8703-c10e527ac5dd.jpg', 2, '2024-09-02 00:12:19', '2024-09-02 00:12:19'),
(5, 'Windows vista', 'Alguien recuerda windows vista? eran bonitos esos art cover', '139a3edd-85fb-461f-8aba-9cba9925b95b.jpg', 2, '2024-09-02 00:24:18', '2024-09-02 00:24:18'),
(6, 'Linux', 'EL mejor S.O. libre', '5d6bdd9e-9aae-49c4-afef-6780d7dc88b0.jpg', 2, '2024-09-02 00:24:37', '2024-09-02 00:24:37'),
(7, 'El señor Namek', 'Se cumplen 35 años desde que ese heroe Namek nos salvo', 'b89dc469-4783-435a-82cf-e22472085a99.jpg', 2, '2024-09-02 00:25:07', '2024-09-02 00:25:07'),
(8, 'Que música ocupan para programar?', 'Ami me encanta Blink-182', '0a80b696-7f2e-4c60-8c61-283008146e97.jpg', 2, '2024-09-02 00:25:46', '2024-09-02 00:25:46'),
(9, 'Box Car Racer', 'La mejor banda Post-Hardcore que he escuchado', '7187f625-3967-46eb-8c3a-620e42e3f711.jpg', 2, '2024-09-02 00:26:27', '2024-09-02 00:26:27'),
(10, 'Tux', 'El pinguino Linux', '2962d6cb-6d1a-4920-837e-ace12004d20b.png', 2, '2024-09-02 00:26:54', '2024-09-02 00:26:54'),
(11, 'Desarrollo callejero', 'Arte callejero en el desarrollo web', '980ff234-3d21-44ea-bf72-a86ed4ed46f4.jpg', 2, '2024-09-02 00:27:25', '2024-09-02 00:27:25'),
(12, 'M.C.R para programadores frustrados', 'Esos compis son re raros su musica', '6287c3c3-0b0c-474a-9fc8-66220d4a9ce6.jpg', 2, '2024-09-02 00:28:13', '2024-09-02 00:28:13'),
(13, 'Linux O Mac para programar?', 'No se ustedes, yo prefiero mac', '50785999-8fb8-4340-951f-aa3badb32db4.jpg', 2, '2024-09-02 00:28:51', '2024-09-02 00:28:51'),
(14, 'Los sex Pistols la mejor banda para programar', 'Amo el Punk para programar', 'ede820ee-cc59-40c8-9318-4ccb45842482.jpg', 2, '2024-09-02 00:29:29', '2024-09-02 00:29:29'),
(17, 'Me gusta el Rock', 'Me gusta el metal core lml', 'e36bdc42-ed7a-4d38-b54c-1e1aac4261ef.jpg', 3, '2024-09-03 22:16:56', '2024-09-03 22:16:56'),
(18, 'memes', 'Me dio mucha risa xd xd xDddddddddd', '3034f94b-33d8-44d9-9878-aa85c437861e.jpg', 3, '2024-09-04 20:08:33', '2024-09-04 20:08:33');

INSERT INTO `devstagram`.`sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES 
('FaeHOrwfmNrrvBOkDLVqbvNpcs06TMe5mLxdGnjz', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQlRYd2ZPeTJTZDVDeVM3WGhkMXVRNG12RHd6aVFPZE0xdVRRSDU5USI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Rpby1sdWlzbXkvcG9zdC8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1725510322),
('nr12zd7FC9WyVtaD5IPPeujLMWHFzFYgNIfvwz72', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2ZMNkpZSU9venlhUjNyTHhuQ3AyR3VGTmgxRG5FRUVGVnhlMFNtYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Rpby1sdWlzbXkvcG9zdC84Ijt9fQ==', 1725513106);

INSERT INTO `devstagram`.`users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `imagen`) VALUES 
(2, 'Miguel Angel', 'miguel.buny@gmail.com', NULL, '$2y$12$AymeHEZznLI29JtWBjZWwOWfffEY2jgz.ddMCN/4QwtRd85UrBYUi', 'iz9Qp7zu88CPn38dQd8ZuqIMZFYuaHsWCKf15nwu3k4A3mcke5D8Fec0Mwhx', '2024-08-29 17:36:19', '2024-09-03 21:59:18', 'tio-luismy', '6b3c3e62-bb56-4697-bd5d-c3d9eca6023e.jpg'),
(3, 'Noemi', 'mimi@mimi.com', NULL, '$2y$12$tfYdODzP3QbNlCHNL7OHWOs/vtsntPk/SThUt0w1fcxAjkuKBNqdG', 'ZTLI2qE0z426KsQrH0Fk8uNGJHNFy1JGk8aLPoP3CGG0ARjVOvZkEsrBnz2y', '2024-08-29 18:06:06', '2024-09-03 22:16:15', 'noemi123', '423da585-abae-43e6-8e75-67d6d65ff776.jpg'),
(4, 'Ana Maria', 'ana@ana.com', NULL, '$2y$12$5DFgxUS3crBzy0cLXfa8/.mW7dL8nJrhhvgTk2GA4w6GRuhT2k.p6', NULL, '2024-08-29 18:10:35', '2024-08-29 18:10:35', 'maria123', NULL);

