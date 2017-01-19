-- added in version 3.2.4
-- add new `login_attempts` table
CREATE TABLE `login_attempts` ( `ip` VARCHAR(20) NOT NULL , `attempt` DATETIME NOT NULL , INDEX `ip` (`ip`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
