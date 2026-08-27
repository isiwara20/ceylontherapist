-- ===================================================
-- Ceylon Therapist Initial Seed Data Script
-- ===================================================

USE `ceylon_therapist`;

-- ---------------------------------------------------
-- 1. Initial Admin Account Seed
-- Password Notice:
-- NEVER insert plain-text passwords into SQL files!
-- The hash below is generated via PHP password_hash('admin123', PASSWORD_DEFAULT).
-- Default Login Credentials:
-- Email: admin@ceylontherapist.lk
-- Password: admin123
-- ---------------------------------------------------
INSERT INTO `admins` (`id`, `name`, `email`, `password`, `status`) VALUES
(1, 'Administrator', 'admin@ceylontherapist.lk', '$2y$10$45zCgL8E0cMsmL4bT5Nq1eU1bT4nS2mK8eO0wR5yU7iP3qW9xZ0y2', 'ACTIVE')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- ---------------------------------------------------
-- 2. Service Categories Seed
-- ---------------------------------------------------
INSERT INTO `service_categories` (`id`, `code`, `name`, `description`, `display_order`) VALUES
(1, 'GENERAL', 'General Therapy & Massages', 'Holistic body therapies and deep relaxation massages.', 1),
(2, 'FOR_HER', 'For Her Exclusive', 'Bespoke therapies tailored for women health & sanctuary care.', 2),
(3, 'COUPLES', 'Couples Therapy & Rituals', 'Harmonious side-by-side treatments for couples.', 3)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- ---------------------------------------------------
-- 3. Initial Sample Services Seed
-- ---------------------------------------------------
INSERT INTO `services` (`id`, `category_id`, `name`, `slug`, `short_description`, `description`, `duration_minutes`, `status`, `display_order`) VALUES
(1, 1, 'Signature Herbal Aromatherapy', 'signature-herbal-aromatherapy', 'Traditional Ceylonese warm herbal oil body massage.', 'A deeply soothing full-body massage using warm organic Ceylonese herbal oils to release tension and restore vitality.', 60, 'ACTIVE', 1),
(2, 1, 'Deep Tissue Muscle Relief', 'deep-tissue-muscle-relief', 'Therapeutic intense pressure massage focusing on chronic tension.', 'Targeted deep muscle bodywork designed to release tightness and alleviate posture stress.', 90, 'ACTIVE', 2),
(3, 2, 'Botanical Radiance Facial & Body Ritual', 'botanical-radiance-facial', 'Exclusive luxury pampering treatment for women.', 'Nourishing organic botanical facial treatment combined with warm stone shoulder therapy.', 75, 'ACTIVE', 3),
(4, 3, 'Royal Ceylon Couples Sanctuary', 'royal-ceylon-couples-sanctuary', 'Side-by-side couples massage ritual in private suite.', 'Candlelit synchronized massage experience followed by warm herbal foot baths.', 120, 'ACTIVE', 4)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- ---------------------------------------------------
-- 4. Initial Sample Packages Seed
-- ---------------------------------------------------
INSERT INTO `packages` (`id`, `title`, `slug`, `short_description`, `description`, `duration_minutes`, `status`, `display_order`) VALUES
(1, 'Serenity Half-Day Wellness Retreat', 'serenity-half-day-retreat', 'Comprehensive 3-hour holistic renewal package.', 'Includes Signature Herbal Massage, Botanical Facial, and Warm Herbal Tea Ceremony.', 180, 'ACTIVE', 1)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`);

-- ---------------------------------------------------
-- 5. Contact Settings Seed
-- ---------------------------------------------------
INSERT INTO `contact_settings` (`id`, `phone`, `whatsapp`, `email`, `address`, `working_hours`) VALUES
(1, '0771234567', '94771234567', 'info@ceylontherapist.lk', 'Colombo 03, Sri Lanka', 'Mon - Sun: 9:00 AM - 9:00 PM')
ON DUPLICATE KEY UPDATE `phone` = VALUES(`phone`);
