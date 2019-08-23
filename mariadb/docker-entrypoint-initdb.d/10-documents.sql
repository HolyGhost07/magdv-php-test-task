USE `app`;

CREATE TABLE IF NOT EXISTS `documents` (
    `id` binary(16) NOT NULL,
    `status` varchar(255) NOT NULL,
    `payload` JSON,
    `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CHECK (JSON_VALID(`payload`)),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8;
