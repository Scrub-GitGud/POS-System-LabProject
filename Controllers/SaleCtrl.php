<?php

namespace app\Controllers;

use Exception;
use PDO;

class SaleCtrl {


    public function index($router) {
        $active_store = null;
        $products = [];
        if(isset($_COOKIE["active_store"])) {
            $active_store = $_COOKIE["active_store"];

            $statement = $router->database->pdo->prepare(
                "SELECT stores.name as store_name, products.id, products.store_id, products.name, products.price, products.stock, products.created_at
                FROM products
                RIGHT JOIN stores
                ON (products.store_id=stores.id)
                WHERE stores.id = $active_store"
            );
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);

            // print_r($products);
        }
        
        $router->renderView('sale/index', "Sale", [
            'products' => $products,
            'active_store' => $active_store,
        ]);
    }

    public function create($router) {
        $active_store = null;
        if(isset($_COOKIE["active_store"])) {
            $active_store = $_COOKIE["active_store"];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // print_r($_POST);

            $products = $_POST['product'];
            
            foreach($products as $product_i) {
                try{
                    $statement = $router->database->pdo->prepare("INSERT INTO sales (product_id, qnty)
                    VALUES (:product_id, :qnty)");
                    $statement->bindValue(':product_id', $product_i['product_id']);
                    $statement->bindValue(':qnty', $product_i['qnty']);
                    $statement->execute();

                    $id = $product_i['product_id'];
                    $qnty = $product_i['qnty'];
                    $statement2 = $router->database->pdo->prepare("UPDATE products SET stock=stock-$qnty WHERE id=$id");
                    $statement2->execute();
                } catch(Exception $e) {
                    echo $statement . "<br><br>" . $e->getMessage();
                }
            }
            
            session_start();
            $_SESSION["msg"] = "Sale Complete";
            header('Location: /sale');
            exit;
        }
    }
}