<?php

namespace migrations;

use core\Application;
use Exception;

class m0001_initial
{
    public function up(): bool
    {
        $connector = Application::APP()->database->connector();
        try {
            $query = "CREATE TABLE IF NOT EXISTS `users` ( `user_id` BIGINT NOT NULL AUTO_INCREMENT , `creation_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `username` VARCHAR(20) NOT NULL , `password` VARCHAR(127) NOT NULL, PRIMARY KEY (`user_id`), UNIQUE `username` (`username`)) ENGINE = InnoDB;
            ";

            $stmt = $connector->prepare($query);
            $status = $stmt->execute();

            if (!$status)
                return False;

            $query = "CREATE TABLE IF NOT EXISTS `countries` ( `country_id` INT NOT NULL , `country_name` VARCHAR(256) NOT NULL , PRIMARY KEY (`country_id`), UNIQUE (`country_name`)) ENGINE = InnoDB;";
            $stmt = $connector->prepare($query);
            $status = $stmt->execute();

            if (!$status)
                return False;

            $query = "CREATE TABLE IF NOT EXISTS `obstructions` ( `obstruction_id` INT NOT NULL , `obstruction_name` VARCHAR(256) NOT NULL , PRIMARY KEY (`obstruction_id`), UNIQUE (`obstruction_name`)) ENGINE = InnoDB;";
            $stmt = $connector->prepare($query);
            $status = $stmt->execute();

            if (!$status)
                return False;

            $query = "CREATE TABLE IF NOT EXISTS bot_settings(
                        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                        setting_name VARCHAR(256) NOT NULL UNIQUE,
                        telegram_bot VARCHAR(256) NOT NULL UNIQUE,
                        telegram_channel VARCHAR(256) NOT NULL UNIQUE,
                        country_id INT NOT NULL,
                        obstruction_id VARCHAR(1024) NOT NULL,
                        CONSTRAINT country_name_FK FOREIGN KEY (country_id)
                            REFERENCES countries(country_id)
                            ON UPDATE CASCADE
                            ON DELETE CASCADE
                    )ENGINE=InnoDB;";

            $stmt = $connector->prepare($query);
            $status = $stmt->execute();

            if (!$status)
                return False;

            $query = "CREATE TABLE IF NOT EXISTS dates(
                        id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        country_id INT(11) NOT NULL,
                        obstruction_id INT(11) NOT NULL,
                        council_id INT(11) NOT NULL,
                        date_id INT(11) NOT NULL,
                        country_name VARCHAR(256) NOT NULL, 
                        obstruction_name VARCHAR(256) NOT NULL,
                        council_name VARCHAR(256) NOT NULL,
                        date_value VARCHAR(256) NOT NULL,
                        checked BOOLEAN DEFAULT 0,
                        telegram_bot VARCHAR(256) NOT NULL,
                        telegram_channel VARCHAR(256) NOT NULL,
                        create_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        CONSTRAINT country_id_FK FOREIGN KEY (country_id)
                            REFERENCES countries(country_id)
                            ON UPDATE CASCADE
                            ON DELETE CASCADE,
                        CONSTRAINT country_name_dates_FK FOREIGN KEY (country_name)
                            REFERENCES countries(country_name)
                            ON UPDATE CASCADE
                            ON DELETE CASCADE,
                        CONSTRAINT obstruction_id_FK FOREIGN KEY (obstruction_id)
                            REFERENCES obstructions(obstruction_id)
                            ON UPDATE CASCADE
                            ON DELETE CASCADE,
                        CONSTRAINT obstruction_name_dates_FK FOREIGN KEY (obstruction_name)
                            REFERENCES obstructions(obstruction_name)
                            ON UPDATE CASCADE
                            ON DELETE CASCADE,
                        CONSTRAINT telegram_channel_FK FOREIGN KEY (telegram_channel)
                            REFERENCES bot_settings(telegram_channel)
                            ON UPDATE CASCADE
                            ON DELETE CASCADE,
                        CONSTRAINT telegram_bot_FK FOREIGN KEY (telegram_bot)
                            REFERENCES bot_settings(telegram_bot)
                            ON UPDATE CASCADE
                            ON DELETE CASCADE
                    )ENGINE=InnoDB;";

            $stmt = $connector->prepare($query);
            $status = $stmt->execute();
        } catch (Exception $e) {
            Application::APP()->error_logger->log(0, $e, __FILE__, __LINE__);
            $status = False;
        }
        return $status;
    }

    public function down()
    {
        $connector = Application::APP()->database->connector();
        $connector->exec("DROP TABLE IF EXISTS users");
        $connector->exec("DROP TABLE IF EXISTS dates");
        $connector->exec("DROP TABLE IF EXISTS notification");
        $connector->exec("DROP TABLE IF EXISTS countries");
        $connector->exec("DROP TABLE IF EXISTS bot_settings");
    }
}
