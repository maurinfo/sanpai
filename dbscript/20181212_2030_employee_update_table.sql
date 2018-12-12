ALTER TABLE `employee`
MODIFY COLUMN `created_at`  timestamp NULL DEFAULT NOW() AFTER `accesslevel`,
MODIFY COLUMN `updated_at`  timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

