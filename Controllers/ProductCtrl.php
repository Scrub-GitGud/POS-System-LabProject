<?php

namespace app\Controllers;

use Exception;
use PDO;

class ProductCtrl {


    public function index($router) {
        $active_store = null;
        $products = [];
        $suppliers = [];
        if(isset($_COOKIE["active_store"])) {
            $active_store = $_COOKIE["active_store"];
            

            $statement = $router->database->pdo->prepare(
                "SELECT stores.name as store_name, products.id, products.store_id, products.name, products.price, products.stock, products.created_at
                FROM products
                LEFT JOIN stores
                ON (products.store_id=stores.id)
                WHERE stores.id = $active_store"
            );
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);

            $statement2 = $router->database->pdo->prepare("SELECT id, name FROM suppliers");
            $statement2->execute();
            $suppliers = $statement2->fetchAll(PDO::FETCH_ASSOC);

            // print_r($products);
        }
        
        $router->renderView('product/index', "Product", [
            'products' => $products,
            'active_store' => $active_store,
            'suppliers' => $suppliers,
        ]);
    }
    public function create($router) {
        session_start();
        
        $active_store = null;
        if(isset($_COOKIE["active_store"])) {
            $active_store = $_COOKIE["active_store"];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if($_POST['name'] == '' || $_POST['price'] == '') {
                $_SESSION["err"] = "Please fill the required field";
                header('Location: /product');
                exit;
            }
            
            try{
                $statement = $router->database->pdo->prepare("INSERT INTO products (store_id, name, price)
                VALUES (:store_id, :name, :price)");
                $statement->bindValue(':store_id', $active_store);
                $statement->bindValue(':name', $_POST['name']);
                $statement->bindValue(':price', $_POST['price']);
                $statement->execute();
            } catch(Exception $e) {
                return $statement . "<br><br>" . $e->getMessage();
            }
            
            $_SESSION["msg"] = "Product Created";
            header('Location: /product');
            exit;
        }
    }
    public function getInfo($router) {
        $id = $_GET['id'];
        $statement = $router->database->pdo->prepare("SELECT * FROM products WHERE id=$id");
        $statement->execute();
        $product = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($product);
    }
    public function update($router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            try{
                $statement = $router->database->pdo->prepare(
                    "UPDATE products
                    SET name=:name, price=:price
                    WHERE id=$id");
                $statement->bindValue(':name', $_POST['name']);
                $statement->bindValue(':price', $_POST['price']);
                $statement->execute();
            } catch(Exception $e) {
                return $statement . "<br><br>" . $e->getMessage();
            }
            
            header('Location: /product');
            exit;
        }
    }
    public function delete($router) {
        $id = $_GET['id'];
        $statement = $router->database->pdo->prepare("DELETE FROM products WHERE id=$id");
        $statement->execute();
        
        session_start();
        $_SESSION["msg"] = "Product Deleted";
        header('Location: /product');
        exit;
    }


    public function purchase($router) {
        // print_r($_POST);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            try{
                $statement = $router->database->pdo->prepare("INSERT INTO purchase_products (product_id, supplier_id, qnty, rate)
                VALUES (:product_id, :supplier_id, :qnty, :rate)");
                $statement->bindValue(':product_id', $_POST['product_id']);
                $statement->bindValue(':supplier_id', $_POST['supplier_id']);
                $statement->bindValue(':qnty', $_POST['qnty']);
                $statement->bindValue(':rate', $_POST['rate']);
                $statement->execute();

                $id = $_POST['product_id'];
                $qnty = $_POST['qnty'];
                $statement2 = $router->database->pdo->prepare("UPDATE products SET stock=stock+$qnty     WHERE id=$id");
                $statement2->execute();
            } catch(Exception $e) {
                return $statement . "<br><br>" . $e->getMessage();
            }

            session_start();
            $_SESSION["msg"] = "Purchase Complete";
            header('Location: /product');
            exit;
        }
    }

    public function search($router) {
        $active_store = null;
        if(isset($_COOKIE["active_store"])) {
            $active_store = $_COOKIE["active_store"];
        }
        
        $text = $_GET['text'];
        $products = [];
        if($text != '') {
            $statement = $router->database->pdo->prepare("SELECT id, name, price, stock 
                            FROM products WHERE name LIKE '%$text%' 
                            AND store_id=$active_store");
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
        echo json_encode($products);
    }
    public function addToList($router) {
        $id = $_GET['id'];
        $curr_qnty = $_GET['curr_qnty'];
        $statement = $router->database->pdo->prepare("SELECT id, name, price, stock FROM products WHERE id=$id");
        $statement->execute();
        $product = $statement->fetchAll(PDO::FETCH_ASSOC);

        $data = [];

        if($product[0]['stock'] <= $curr_qnty) {
            $data = [
                'status' => 'failed',
                'product' => $product,
                'msg' => 'Product is out of stock!!'
            ];
        } else {
            $data = [
                'status' => 'success',
                'product' => $product,
                'X' => $_GET
            ];
        }
        
        echo json_encode($data);
    }
}