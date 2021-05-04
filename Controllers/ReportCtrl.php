<?php

namespace app\Controllers;

use Exception;
use PDO;

class ReportCtrl {


    public function index($router) {
        $active_store = null;
        $products = [];
        $purchase_report = [];
        $sales_report = [];
        if(isset($_COOKIE["active_store"])) {
            $active_store = $_COOKIE["active_store"];
            
            // Purchasee Report
            $statement = $router->database->pdo->prepare(
                "SELECT 
                    stores.name as store_name,
                    products.id,
                    products.store_id,
                    products.name,
                    products.price,
                    products.stock,
                    products.created_at,
                    suppliers.name as supplier,
                    purchase_products.qnty,
                    purchase_products.rate
                FROM purchase_products
                LEFT JOIN suppliers ON
                    purchase_products.supplier_id = suppliers.id
                LEFT JOIN products ON
                    purchase_products.product_id = products.id
                LEFT JOIN stores ON
                    products.store_id = stores.id
                WHERE stores.id = $active_store"
            );
            $statement->execute();
            $purchase_report = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            // Sales Report
            $statement2 = $router->database->pdo->prepare(
                "SELECT 
                    products.id,
                    products.name,
                    products.price,
                    sales.qnty,
                    sales.created_at
                FROM sales
                LEFT JOIN products ON
                    sales.product_id = products.id
                WHERE products.store_id = $active_store"
            );
            $statement2->execute();
            $sales_report = $statement2->fetchAll(PDO::FETCH_ASSOC);

            // print_r($sales_report);
        }
        
        $router->renderView('report/index', "Report", [
            'active_store' => $active_store,
            'purchase_report' => $purchase_report,
            'sales_report' => $sales_report,
        ]);
    }
}