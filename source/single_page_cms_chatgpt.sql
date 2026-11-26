-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2026 at 04:18 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `single_page_cms_chatgpt`
--

-- --------------------------------------------------------

--
-- Table structure for table `section_type`
--

DROP TABLE IF EXISTS `section_type`;
CREATE TABLE IF NOT EXISTS `section_type` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_key` (`type_key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_type`
--

INSERT INTO `section_type` (`id`, `type_key`, `type_name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'hero', 'Hero', 'Main banner and introduction section', 1, '2026-11-24 15:45:34', NULL),
(2, 'about', 'About', 'Company or personal introduction section', 1, '2026-11-24 15:45:34', NULL),
(3, 'services', 'Services', 'Products and services section', 1, '2026-11-24 15:45:34', NULL),
(4, 'gallery', 'Gallery', 'Images and portfolio section', 1, '2026-11-24 15:45:34', NULL),
(5, 'contact', 'Contact', 'Contact details and enquiry section', 1, '2026-11-24 15:45:34', NULL),
(6, 'testimonial', 'Testimonials', 'Customer reviews and feedback section', 1, '2026-11-24 15:45:34', NULL),
(7, 'team', 'Team', 'Team members section', 1, '2026-11-24 15:45:34', NULL),
(8, 'faq', 'FAQ', 'Frequently asked questions section', 1, '2026-11-24 15:45:34', NULL),
(9, 'footer', 'Footer', 'Website footer section', 1, '2026-11-24 15:45:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `section_variation`
--

DROP TABLE IF EXISTS `section_variation`;
CREATE TABLE IF NOT EXISTS `section_variation` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_type_id` bigint UNSIGNED NOT NULL,
  `variation_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `view_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_content_json` json DEFAULT NULL,
  `default_layout_json` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_variation_type_key` (`section_type_id`,`variation_key`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_variation`
--

INSERT INTO `section_variation` (`id`, `section_type_id`, `variation_key`, `variation_name`, `description`, `view_file`, `default_content_json`, `default_layout_json`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'centered', 'Centered Hero', 'Centered heading and introduction', 'hero/centered.php', '{\"title\": \"Welcome\", \"subtitle\": \"Your success starts here\"}', '{\"alignment\": \"center\"}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(2, 1, 'split', 'Split Hero', 'Text and image side by side', 'hero/split.php', '{\"title\": \"Welcome\", \"subtitle\": \"Discover our services\"}', '{\"image_position\": \"right\"}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(3, 1, 'banner', 'Banner Hero', 'Full width background banner', 'hero/banner.php', '{\"title\": \"Build Your Future\"}', '{\"overlay\": true}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(4, 2, 'image-left', 'Image Left', 'Image on left and text on right', 'about/image-left.php', '{\"title\": \"About Us\", \"description\": \"Our company introduction\"}', '{\"image_position\": \"left\"}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(5, 2, 'image-right', 'Image Right', 'Text on left and image on right', 'about/image-right.php', '{\"title\": \"Who We Are\", \"description\": \"Learn about our company\"}', '{\"image_position\": \"right\"}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(6, 2, 'statistics', 'Statistics About', 'Introduction with statistics', 'about/statistics.php', '{\"title\": \"Our Achievements\", \"statistics\": []}', '{\"columns\": 3}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(7, 3, 'grid-3', 'Three Column Grid', 'Services displayed in three columns', 'services/grid-3.php', '{\"items\": [], \"title\": \"Our Services\"}', '{\"columns\": 3}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(8, 3, 'grid-4', 'Four Column Grid', 'Services displayed in four columns', 'services/grid-4.php', '{\"items\": [], \"title\": \"Our Services\"}', '{\"columns\": 4}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(9, 3, 'list', 'Services List', 'Services displayed as a list', 'services/list.php', '{\"items\": [], \"title\": \"What We Offer\"}', '{\"style\": \"list\"}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(10, 4, 'grid', 'Gallery Grid', 'Image gallery in grid layout', 'gallery/grid.php', '{\"title\": \"Our Gallery\", \"images\": []}', '{\"columns\": 3}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(11, 4, 'masonry', 'Masonry Gallery', 'Variable height image gallery', 'gallery/masonry.php', '{\"title\": \"Our Work\", \"images\": []}', '{\"columns\": 3}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(12, 5, 'simple', 'Simple Contact', 'Contact details and information', 'contact/simple.php', '{\"email\": \"\", \"phone\": \"\", \"title\": \"Contact Us\"}', '{\"alignment\": \"left\"}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(13, 5, 'map-form', 'Map and Contact Form', 'Map with enquiry form', 'contact/map-form.php', '{\"email\": \"\", \"title\": \"Get In Touch\", \"address\": \"\"}', '{\"map_position\": \"left\"}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(14, 6, 'cards', 'Testimonial Cards', 'Customer testimonials in cards', 'testimonial/cards.php', '{\"items\": [], \"title\": \"What Clients Say\"}', '{\"columns\": 3}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(15, 6, 'slider', 'Testimonial Slider', 'Customer testimonials in slider', 'testimonial/slider.php', '{\"items\": [], \"title\": \"Testimonials\"}', '{\"autoplay\": true}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(16, 7, 'grid', 'Team Grid', 'Team members in grid layout', 'team/grid.php', '{\"title\": \"Our Team\", \"members\": []}', '{\"columns\": 3}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(17, 8, 'accordion', 'FAQ Accordion', 'Expandable frequently asked questions', 'faq/accordion.php', '{\"items\": [], \"title\": \"Frequently Asked Questions\"}', '{\"multiple_open\": false}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59'),
(18, 9, 'standard', 'Standard Footer', 'Standard website footer', 'footer/standard.php', '{\"links\": [], \"copyright\": \"All rights reserved\"}', '{\"columns\": 4}', 1, '2026-11-24 15:48:59', '2026-11-24 15:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `template_id` bigint UNSIGNED NOT NULL,
  `template_version` int UNSIGNED NOT NULL DEFAULT '1',
  `template_snapshot_json` json DEFAULT NULL,
  `settings_json` json DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_site_template` (`template_id`),
  KEY `idx_site_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `slug`, `description`, `template_id`, `template_version`, `template_snapshot_json`, `settings_json`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'TappIndia Solutions', 'tappindia', 'Technology and software solutions website', 1, 1, '{\"template_id\": 1, \"css_framework\": \"bootstrap\", \"template_version\": 1, \"framework_version\": \"5.3\"}', '{\"language\": \"en\", \"timezone\": \"Asia/Kolkata\", \"site_title\": \"TappIndia Solutions\"}', 'active', NULL, '2026-11-24 15:57:36', '2026-11-24 15:57:36'),
(2, 'Demo Creative Website', 'demo-creative', 'Sample website using the Creative template', 2, 1, '{\"template_id\": 2, \"css_framework\": \"tailwind\", \"template_version\": 1, \"framework_version\": \"3\"}', '{\"language\": \"en\", \"timezone\": \"Asia/Kolkata\", \"site_title\": \"Demo Creative\"}', 'draft', NULL, '2026-11-24 15:57:36', '2026-11-24 15:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `site_design_setting`
--

DROP TABLE IF EXISTS `site_design_setting`;
CREATE TABLE IF NOT EXISTS `site_design_setting` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` bigint UNSIGNED NOT NULL,
  `setting_key` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_group` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_value` json DEFAULT NULL,
  `custom_value` json DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_site_design_setting` (`site_id`,`setting_key`),
  KEY `idx_site_design_group` (`site_id`,`setting_group`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_design_setting`
--

INSERT INTO `site_design_setting` (`id`, `site_id`, `setting_key`, `setting_group`, `setting_type`, `default_value`, `custom_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'color.primary', 'colors', 'color', '\"#0d6efd\"', '\"#f58220\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(2, 1, 'color.secondary', 'colors', 'color', '\"#6c757d\"', '\"#222222\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(3, 1, 'color.background', 'colors', 'color', '\"#ffffff\"', '\"#ffffff\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(4, 1, 'font.body.family', 'typography', 'font', '\"Arial\"', '\"Roboto\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(5, 1, 'font.heading.family', 'typography', 'font', '\"Arial\"', '\"Poppins\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(6, 1, 'button.radius', 'buttons', 'size', '\"6px\"', '\"10px\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(7, 1, 'section.hero-main.background', 'section', 'color', '\"#ffffff\"', '\"#f5f5f5\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(8, 1, 'section.about-company.title.color', 'section', 'color', '\"#222222\"', '\"#f58220\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(9, 2, 'color.primary', 'colors', 'color', '\"#7c3aed\"', '\"#7c3aed\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(10, 2, 'color.secondary', 'colors', 'color', '\"#111827\"', '\"#111827\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(11, 2, 'font.body.family', 'typography', 'font', '\"Inter\"', '\"Inter\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17'),
(12, 2, 'section.hero-main.background', 'section', 'color', '\"#ffffff\"', '\"#ede9fe\"', '2026-11-24 16:03:17', '2026-11-24 16:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `site_domain`
--

DROP TABLE IF EXISTS `site_domain`;
CREATE TABLE IF NOT EXISTS `site_domain` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` bigint UNSIGNED NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verified_at` datetime DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_site_domain` (`domain`),
  KEY `idx_site_domain_site` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_domain`
--

INSERT INTO `site_domain` (`id`, `site_id`, `domain`, `is_primary`, `is_verified`, `verified_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'tappindia.com', 1, 1, '2026-11-24 16:00:18', 'active', '2026-11-24 16:00:18', '2026-11-24 16:00:18'),
(2, 1, 'www.tappindia.com', 0, 1, '2026-11-24 16:00:18', 'active', '2026-11-24 16:00:18', '2026-11-24 16:00:18'),
(3, 2, 'demo-creative.example.com', 0, 0, NULL, 'active', '2026-11-24 16:00:18', '2026-11-24 21:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `site_media`
--

DROP TABLE IF EXISTS `site_media`;
CREATE TABLE IF NOT EXISTS `site_media` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_extension` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED NOT NULL DEFAULT '0',
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata_json` json DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_site_media_site` (`site_id`),
  KEY `idx_site_media_type` (`site_id`,`file_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_media`
--

INSERT INTO `site_media` (`id`, `site_id`, `file_name`, `original_name`, `file_path`, `file_type`, `mime_type`, `file_extension`, `file_size`, `alt_text`, `metadata_json`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'hero.webp', 'hero-banner.jpg', 'uploads/sites/1/hero.webp', 'image', 'image/webp', 'webp', 125000, 'TappIndia main banner', '{\"width\": 1920, \"height\": 800}', 'active', '2026-11-24 16:04:33', '2026-11-24 16:04:33'),
(2, 1, 'about.webp', 'about-company.png', 'uploads/sites/1/about.webp', 'image', 'image/webp', 'webp', 98000, 'About TappIndia', '{\"width\": 800, \"height\": 600}', 'active', '2026-11-24 16:04:33', '2026-11-24 16:04:33'),
(3, 1, 'company-profile.pdf', 'company-profile.pdf', 'uploads/sites/1/company-profile.pdf', 'document', 'application/pdf', 'pdf', 450000, 'TappIndia company profile', '{\"category\": \"company-document\"}', 'active', '2026-11-24 16:04:33', '2026-11-24 16:04:33'),
(4, 2, 'creative-banner.webp', 'creative-banner.png', 'uploads/sites/2/creative-banner.webp', 'image', 'image/webp', 'webp', 175000, 'Creative website banner', '{\"width\": 1920, \"height\": 900}', 'active', '2026-11-24 16:04:33', '2026-11-24 16:04:33'),
(5, 1, '1795533432_90a5b3467656d1ec3d7d.jpeg', 'WhatsApp Image 2026-10-29 at 12.44.45 PM (1).jpeg', 'uploads/1/1795533432_90a5b3467656d1ec3d7d.jpeg', 'image', 'image/jpeg', 'jpeg', 126441, NULL, NULL, 'active', '2026-11-24 15:17:12', '2026-11-24 15:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `site_page`
--

DROP TABLE IF EXISTS `site_page`;
CREATE TABLE IF NOT EXISTS `site_page` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `is_homepage` tinyint(1) NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_site_page_slug` (`site_id`,`slug`),
  KEY `idx_site_page_order` (`site_id`,`sort_order`),
  KEY `idx_site_page_status` (`site_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_page`
--

INSERT INTO `site_page` (`id`, `site_id`, `title`, `slug`, `page_type`, `meta_title`, `meta_description`, `meta_keywords`, `is_homepage`, `is_enabled`, `status`, `published_at`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Home', 'home', 'home', 'TappIndia Solutions - Home', NULL, NULL, 1, 1, 'published', NULL, 1, '2026-11-25 03:11:04', '2026-11-25 03:11:04'),
(2, 1, 'About Us', 'about-us', 'standard', 'About TappIndia Solutions', NULL, NULL, 0, 1, 'published', NULL, 2, '2026-11-25 03:11:04', '2026-11-25 03:11:04'),
(3, 1, 'Services', 'services', 'standard', 'Our Services - TappIndia', NULL, NULL, 0, 1, 'published', NULL, 3, '2026-11-25 03:11:04', '2026-11-25 03:11:04'),
(4, 1, 'Contact Us', 'contact-us', 'standard', 'Contact TappIndia Solutions', NULL, NULL, 0, 1, 'draft', NULL, 4, '2026-11-25 03:11:04', '2026-11-25 03:11:04'),
(5, 2, 'Home', 'home', 'home', 'Demo Creative - Home', NULL, NULL, 1, 1, 'published', NULL, 1, '2026-11-25 03:11:04', '2026-11-25 03:11:04'),
(6, 2, 'About', 'about', 'standard', 'About Demo Creative', NULL, NULL, 0, 1, 'draft', NULL, 2, '2026-11-25 03:11:04', '2026-11-25 03:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `site_page_section`
--

DROP TABLE IF EXISTS `site_page_section`;
CREATE TABLE IF NOT EXISTS `site_page_section` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id` bigint UNSIGNED NOT NULL,
  `site_section_id` bigint UNSIGNED NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_page_section` (`page_id`,`site_section_id`),
  KEY `idx_page_section_order` (`page_id`,`sort_order`),
  KEY `idx_page_section_source` (`site_section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_page_section`
--

INSERT INTO `site_page_section` (`id`, `page_id`, `site_section_id`, `sort_order`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3, 1, '2026-11-25 03:12:24', '2026-11-25 03:12:24'),
(2, 1, 4, 4, 1, '2026-11-25 03:12:24', '2026-11-25 03:12:24'),
(3, 1, 1, 1, 1, '2026-11-25 03:12:24', '2026-11-25 03:12:24'),
(4, 1, 2, 2, 1, '2026-11-25 03:12:24', '2026-11-25 03:12:24'),
(5, 1, 5, 5, 1, '2026-11-25 03:12:24', '2026-11-25 03:12:24'),
(8, 5, 8, 2, 1, '2026-11-25 03:12:24', '2026-11-25 03:08:35'),
(16, 5, 7, 4, 0, '2026-11-25 03:01:38', '2026-11-25 03:08:35'),
(17, 5, 6, 1, 0, '2026-11-25 03:06:03', '2026-11-25 03:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `site_section`
--

DROP TABLE IF EXISTS `site_section`;
CREATE TABLE IF NOT EXISTS `site_section` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_id` bigint UNSIGNED NOT NULL,
  `section_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_json` json DEFAULT NULL,
  `layout_json` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `source_template_version` int UNSIGNED DEFAULT NULL,
  `source_template_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sync_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'synced',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_site_section_key` (`site_id`,`section_key`),
  KEY `idx_site_section_order` (`site_id`,`sort_order`),
  KEY `idx_site_section_type` (`site_id`,`section_type`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_section`
--

INSERT INTO `site_section` (`id`, `site_id`, `section_key`, `section_type`, `view_key`, `section_name`, `content_json`, `layout_json`, `sort_order`, `is_enabled`, `source_template_version`, `source_template_key`, `sync_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'hero-main', 'hero', 'split', 'Main Hero', '{\"image\": \"hero.webp\", \"title\": \"Welcome to TappIndia\", \"subtitle\": \"Technology solutions for growing businesses\", \"button_text\": \"Explore Services\"}', '{\"alignment\": \"center\", \"image_position\": \"right\"}', 1, 1, 1, 'hero', 'synced', '2026-11-24 16:01:52', '2026-11-24 16:01:52'),
(2, 1, 'hero-secondary', 'hero', 'centered', 'Secondary Hero', '{\"title\": \"Digital Transformation\", \"subtitle\": \"Software, websites and business solutions\"}', '{\"height\": \"large\", \"alignment\": \"center\"}', 2, 1, 1, 'hero', 'synced', '2026-11-24 16:01:52', '2026-11-24 16:01:52'),
(3, 1, 'about-company', 'about', 'image-left', 'About Company', '{\"image\": \"about.webp\", \"title\": \"About TappIndia\", \"description\": \"We develop software and digital solutions for businesses.\"}', '{\"image_position\": \"left\"}', 3, 1, 1, 'about', 'synced', '2026-11-24 16:01:52', '2026-11-24 16:01:52'),
(4, 1, 'about-history', 'about', 'statistics', 'Our Achievements', '{\"title\": \"Our Journey\", \"statistics\": [{\"label\": \"Projects\", \"value\": \"100+\"}, {\"label\": \"Clients\", \"value\": \"75+\"}, {\"label\": \"Years\", \"value\": \"10+\"}]}', '{\"columns\": 3}', 4, 1, 1, 'about', 'synced', '2026-11-24 16:01:52', '2026-11-24 16:01:52'),
(5, 1, 'services-main', 'services', 'grid-3', 'Our Services', '{\"items\": [{\"title\": \"CRM Software\", \"description\": \"Manage customer relationships\"}, {\"title\": \"Hospital Management\", \"description\": \"Manage clinic operations\"}, {\"title\": \"Website Development\", \"description\": \"Build your online presence\"}], \"title\": \"Our Services\"}', '{\"columns\": 3}', 5, 1, 1, 'services', 'synced', '2026-11-24 16:01:52', '2026-11-24 16:01:52'),
(6, 2, 'hero-main', 'hero', 'banner', 'Main Banner', '{\"title\": \"Create Something Amazing\", \"subtitle\": \"Creative digital experiences\"}', '{\"overlay\": true}', 1, 1, 1, 'hero', 'synced', '2026-11-24 16:01:52', '2026-11-24 16:01:52'),
(7, 2, 'about-main', 'about', 'image-right', 'About Us', '{\"title\": \"Our Creative Studio\", \"description\": \"We design digital experiences.\"}', '{\"image_position\": \"right\"}', 2, 1, 1, 'about', 'synced', '2026-11-24 16:01:52', '2026-11-24 16:01:52'),
(8, 2, 'services-main', 'services', 'list', 'Our Services', '{\"items\": [], \"title\": \"What We Do\"}', '{\"style\": \"list\"}', 3, 1, 1, 'services', 'synced', '2026-11-24 16:01:52', '2026-11-24 16:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `css_framework` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bootstrap',
  `framework_version` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '5.3',
  `framework_config_json` json DEFAULT NULL,
  `sections_json` json DEFAULT NULL,
  `design_json` json DEFAULT NULL,
  `version` int UNSIGNED NOT NULL DEFAULT '1',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `slug`, `description`, `css_framework`, `framework_version`, `framework_config_json`, `sections_json`, `design_json`, `version`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Corporate', 'corporate', 'Professional corporate website template', 'bootstrap', '5.3', '{\"js_file\": \"assets/js/bootstrap.bundle.min.js\", \"css_file\": \"assets/css/bootstrap.min.css\"}', '[{\"section_type\": \"hero\", \"default_variation\": \"split\", \"allowed_variations\": [\"centered\", \"split\"]}, {\"section_type\": \"about\", \"default_variation\": \"image-left\", \"allowed_variations\": [\"image-left\", \"statistics\"]}, {\"section_type\": \"services\", \"default_variation\": \"grid-3\", \"allowed_variations\": [\"grid-3\"]}, {\"section_type\": \"contact\", \"default_variation\": \"simple\", \"allowed_variations\": [\"simple\", \"map-form\"]}, {\"section_type\": \"footer\", \"default_variation\": \"standard\", \"allowed_variations\": [\"standard\"]}]', '{\"colors\": {\"primary\": \"#0d6efd\", \"secondary\": \"#6c757d\", \"background\": \"#ffffff\"}, \"typography\": {\"body\": \"Arial\", \"heading\": \"Arial\"}}', 1, 'active', '2026-11-24 15:50:43', '2026-11-24 15:50:43'),
(2, 'Creative', 'creative', 'Modern creative agency website template', 'tailwind', '3', '{\"css_file\": \"assets/css/tailwind.css\"}', '[{\"section_type\": \"hero\", \"default_variation\": \"banner\", \"allowed_variations\": [\"banner\"]}, {\"section_type\": \"about\", \"default_variation\": \"image-right\", \"allowed_variations\": [\"image-right\"]}, {\"section_type\": \"services\", \"default_variation\": \"grid-3\", \"allowed_variations\": [\"grid-3\", \"list\"]}, {\"section_type\": \"gallery\", \"default_variation\": \"grid\", \"allowed_variations\": [\"grid\", \"masonry\"]}, {\"section_type\": \"footer\", \"default_variation\": \"standard\", \"allowed_variations\": [\"standard\"]}]', '{\"colors\": {\"primary\": \"#7c3aed\", \"secondary\": \"#111827\", \"background\": \"#ffffff\"}, \"typography\": {\"body\": \"Inter\", \"heading\": \"Inter\"}}', 1, 'active', '2026-11-24 15:50:43', '2026-11-24 15:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `template_section_variation`
--

DROP TABLE IF EXISTS `template_section_variation`;
CREATE TABLE IF NOT EXISTS `template_section_variation` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `template_id` bigint UNSIGNED NOT NULL,
  `section_variation_id` bigint UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `config_json` json DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_template_variation` (`template_id`,`section_variation_id`),
  KEY `fk_tsv_variation` (`section_variation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_section_variation`
--

INSERT INTO `template_section_variation` (`id`, `template_id`, `section_variation_id`, `is_default`, `is_enabled`, `sort_order`, `config_json`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 1, 1, NULL, '2026-11-24 15:53:05', NULL),
(2, 1, 2, 1, 1, 2, NULL, '2026-11-24 15:53:05', NULL),
(3, 1, 4, 1, 1, 3, NULL, '2026-11-24 15:53:05', NULL),
(4, 1, 6, 0, 1, 4, NULL, '2026-11-24 15:53:05', NULL),
(5, 1, 7, 1, 1, 5, NULL, '2026-11-24 15:53:05', NULL),
(6, 1, 12, 1, 1, 6, NULL, '2026-11-24 15:53:05', NULL),
(7, 1, 13, 0, 1, 7, NULL, '2026-11-24 15:53:05', NULL),
(8, 1, 18, 1, 1, 8, NULL, '2026-11-24 15:53:05', NULL),
(9, 2, 3, 1, 1, 1, NULL, '2026-11-24 15:53:05', NULL),
(10, 2, 5, 1, 1, 2, NULL, '2026-11-24 15:53:05', NULL),
(11, 2, 7, 1, 1, 3, NULL, '2026-11-24 15:53:05', NULL),
(12, 2, 9, 0, 1, 4, NULL, '2026-11-24 15:53:05', NULL),
(13, 2, 10, 1, 1, 5, NULL, '2026-11-24 15:53:05', NULL),
(14, 2, 11, 0, 1, 6, NULL, '2026-11-24 15:53:05', NULL),
(15, 2, 18, 1, 1, 7, NULL, '2026-11-24 15:53:05', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `section_variation`
--
ALTER TABLE `section_variation`
  ADD CONSTRAINT `fk_variation_section_type` FOREIGN KEY (`section_type_id`) REFERENCES `section_type` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `fk_site_template` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `site_design_setting`
--
ALTER TABLE `site_design_setting`
  ADD CONSTRAINT `fk_site_design_setting_site` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `site_domain`
--
ALTER TABLE `site_domain`
  ADD CONSTRAINT `fk_site_domain_site` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `site_media`
--
ALTER TABLE `site_media`
  ADD CONSTRAINT `fk_site_media_site` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `site_page`
--
ALTER TABLE `site_page`
  ADD CONSTRAINT `fk_site_page_site` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `site_page_section`
--
ALTER TABLE `site_page_section`
  ADD CONSTRAINT `fk_page_section_page` FOREIGN KEY (`page_id`) REFERENCES `site_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_page_section_site_section` FOREIGN KEY (`site_section_id`) REFERENCES `site_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `site_section`
--
ALTER TABLE `site_section`
  ADD CONSTRAINT `fk_site_section_site` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `template_section_variation`
--
ALTER TABLE `template_section_variation`
  ADD CONSTRAINT `fk_tsv_template` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tsv_variation` FOREIGN KEY (`section_variation_id`) REFERENCES `section_variation` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
