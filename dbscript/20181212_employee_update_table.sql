ALTER TABLE `employee`
MODIFY COLUMN `id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT FIRST ,
MODIFY COLUMN `birthdate`  date NULL DEFAULT NULL AFTER `furigana`,
MODIFY COLUMN `zip`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `gender`,
MODIFY COLUMN `address1`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `zip`,
MODIFY COLUMN `address2`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `address1`,
MODIFY COLUMN `telno`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `address2`,
MODIFY COLUMN `schedulein`  time NULL DEFAULT NULL AFTER `hiredate`,
MODIFY COLUMN `scheduleout`  time NULL DEFAULT NULL AFTER `schedulein`,
MODIFY COLUMN `resigndate`  date NULL DEFAULT NULL AFTER `scheduleout`,
ADD COLUMN `created_at`  timestamp NOT NULL AFTER `accesslevel`,
ADD COLUMN `updated_at`  timestamp NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`,
ADD PRIMARY KEY (`id`);
