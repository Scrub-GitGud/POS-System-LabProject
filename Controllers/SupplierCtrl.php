<?php

namespace app\Controllers;

use Exception;
use PDO;

class SupplierCtrl {

    public function create($router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            try{
                $statement = $router->database->pdo->prepare("INSERT INTO suppliers (name) VALUES (:name)");
                $statement->bindValue(':name', $_POST['name']);
                $statement->execute();
            } catch(Exception $e) {
                return $statement . "<br><br>" . $e->getMessage();
            }

            session_start();
            $_SESSION["msg"] = "Supplier created successfully";
            header('Location: /product');
            exit;
        }
    }
}