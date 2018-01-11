-- added in version 3.4.2

-- Create `ci_sessions` table
CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id` varchar(128) NOT NULL,
    `ip_address` varchar(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` blob NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`)
);

-- Add primary key
-- When sess_match_ip = FALSE
ALTER TABLE `ci_sessions` ADD PRIMARY KEY (`id`);
