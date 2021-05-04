<?php if(!$active_store) : ?>
    <div class="alert alert-danger alert-shadow mb-5 p-5" role="alert">
        <h4 class="alert-heading">Store not found</h4>
        <div class="border-bottom border-white opacity-20 mb-5"></div>
        <p class="mb-0">You need to select a store first!!</p>
    </div>
<?php endif; ?>


<div class="row">
    <div class="col-lg-12">
        <?php include_once 'purchase_report.php' ?>
    </div>
    
    <div class="col-lg-12">
        <?php include_once 'sale_report.php' ?>
    </div>
</div>