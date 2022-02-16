<?php
namespace migrations;

use core\Application;
use Exception;

class m0002_add_users{
    public function up(): bool{
        $connector = Application::APP()->database->connector();
        try{
            $connector->beginTransaction();

            $query = "INSERT INTO users(username, password) VALUES(:username, :password)";

            $stmt = $connector->prepare($query);
            $username = "admin";
            $password = password_hash("admin", PASSWORD_DEFAULT);

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            $connector->commit();
            return True;
        }catch(Exception $e){
            if ($connector->inTransaction())
                $connector->rollBack();
            Application::APP()->error_logger->log(0, $e, __FILE__, __LINE__);
            return False;
        }
    }

    public function down(){
        $connector = Application::APP()->database->connector();
        $connector->exec("DELETE FROM users WHERE username = admin");
    }
}