<?php

namespace app\Controllers;

use Exception;
use PDO;

class StoreCtrl {


    public function index($router) {
        $statement = $router->database->pdo->prepare("SELECT id, name, address, created_at FROM stores");
        $statement->execute();
        $stores = $statement->fetchAll(PDO::FETCH_ASSOC);

        // print_r($stores);

        $router->renderView('store/index', "Store", [
            'stores' => $stores
        ]);
    }
    public function create($router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            if($_POST['name'] == '' || $_POST['address'] == '') {
                $_SESSION["err"] = "Please fill the required field";
                header('Location: /store');
                exit;
            }


            try{
                // $name = $_POST['name'];
                // $address = $_POST['address'];
                // $sql = "INSERT INTO stores (name, address) VALUES ($name, $address)";
                // $router->database->pdo->exec($sql);

                $statement = $router->database->pdo->prepare("INSERT INTO stores (name, address)
                VALUES (:name, :address)");
                $statement->bindValue(':name', $_POST['name']);
                $statement->bindValue(':address', $_POST['address']);
                $statement->execute();
            } catch(Exception $e) {
                return $statement . "<br><br>" . $e->getMessage();
            }
            
            $_SESSION["msg"] = "Store created succesfully";
            
            // $msg = urlencode("Store created succesfully");
            // header('Location: /store?msg='.$msg);
            header('Location: /store');
            exit;
        }
    }
    public function setActive($router) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $cookie_value = $_GET["id"];
            setcookie('active_store', $cookie_value, time() + (86400), "/");

            session_start();
            $_SESSION["msg"] = "Store is active";

            header('Location: /store');
            exit;
        }
    }
    public function setInactive($router) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            setcookie('active_store', '', time() + (86400), "/");

            session_start();
            $_SESSION["msg"] = "Store is inactive";
            header('Location: /store');
            exit;
        }
    }
    public function delete($router) {
        $id = $_GET['id'];
        $statement = $router->database->pdo->prepare("DELETE FROM stores WHERE id=$id");
        $statement->execute();

        session_start();
        $_SESSION["msg"] = "Store deleted succesfully";
        
        header('Location: /store');
        exit;
    }
    public function getInfo($router) {
        $id = $_GET['id'];
        $statement = $router->database->pdo->prepare("SELECT * FROM stores WHERE id=$id");
        $statement->execute();
        $store = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($store);
    }
    public function update($router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            try{
                $statement = $router->database->pdo->prepare(
                    "UPDATE stores
                    SET name=:name, address=:address
                    WHERE id=$id");
                $statement->bindValue(':name', $_POST['name']);
                $statement->bindValue(':address', $_POST['address']);
                $statement->execute();
            } catch(Exception $e) {
                return $statement . "<br><br>" . $e->getMessage();
            }

            session_start();
            $_SESSION["msg"] = "Store updated succesfully";
            
            header('Location: /store');
            exit;
        }
    }
}