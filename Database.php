<?php

namespace app;

// use app\models\Product;

use Exception;
use PDO;

class Database
{
    public $pdo = null;
    public static ?Database $db = null;

    public function __construct()
    {
        $this->createDB();
        $this->createStoreTable();
        $this->createProductTable();
        $this->createSupplierTable();
        $this->createPurchaseProductTable();
        $this->createSaleTable();

        self::$db = $this;
    }
    private function createDB() {
        $dbname = "POS-System-LabProject";
        $this->pdo = new PDO("mysql:host=localhost", 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dbname = "`".str_replace("`","``",$dbname)."`";
        $this->pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
        $this->pdo->query("use $dbname");
        // set the PDO error mode to exception
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "DB Created/Connected successfully". "<br>";
    }
    private function createStoreTable() {
        try{
            $sql = "CREATE TABLE IF NOT EXISTS stores (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                address VARCHAR(200) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
            // use exec() because no results are returned
            $this->pdo->exec($sql);
            // echo "Table created/connected successfully" . "<br>";
        } catch(Exception $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    private function createProductTable() {
        try{
            $sql = "CREATE TABLE IF NOT EXISTS products (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                store_id INT(6) UNSIGNED NOT NULL,
                name VARCHAR(30) NOT NULL,
                price FLOAT(10, 2) NOT NULL,
                stock INT(6) DEFAULT 0 NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (store_id) REFERENCES stores(id) ON DELETE CASCADE
                )";
            $this->pdo->exec($sql);
        } catch(Exception $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    private function createSupplierTable() {
        try{
            $sql = "CREATE TABLE IF NOT EXISTS suppliers (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
            $this->pdo->exec($sql);
        } catch(Exception $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    private function createPurchaseProductTable() {
        try{
            $sql = "CREATE TABLE IF NOT EXISTS purchase_products (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                product_id INT(6) UNSIGNED NOT NULL,
                supplier_id INT(6) UNSIGNED NOT NULL,
                qnty INT(6) NOT NULL,
                rate FLOAT(10, 2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
                FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE CASCADE
                )";
            $this->pdo->exec($sql);
        } catch(Exception $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    private function createSaleTable() {
        try{
            $sql = "CREATE TABLE IF NOT EXISTS sales (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                product_id INT(6) UNSIGNED NOT NULL,
                qnty INT(6) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
                )";
            $this->pdo->exec($sql);
        } catch(Exception $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    // public function getProducts($keyword = '') {
    //     if ($keyword) {
    //         $statement = $this->pdo->prepare('SELECT * FROM stores WHERE name like :keyword ORDER BY created_at DESC');
    //         $statement->bindValue(":keyword", "%$keyword%");
    //     } else {
    //         $statement = $this->pdo->prepare('SELECT * FROM stores ORDER BY created_at DESC');
    //     }
    //     $statement->execute();

    //     return $statement->fetchAll(PDO::FETCH_ASSOC);
    // }

}