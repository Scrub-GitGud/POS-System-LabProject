
<?php session_start();?>
<?php if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"])) : ?>
    <div class="toastr_alert alert alert-success">
        <div><i class="fas fa-exclamation-triangle text-white mr-3"></i></div>
        <div><?= $_SESSION["msg"]; ?></div>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION["err"]) && !empty($_SESSION["err"])) : ?>
    <div class="toastr_alert alert alert-danger">
        <div><i class="fas fa-exclamation-triangle text-white mr-3"></i></div>
        <div><?= $_SESSION["err"]; ?></div>
    </div>
<?php endif; ?>
<?php session_destroy(); ?>



<?php if($active_store) : ?>

    <div class="row">
        <div class="col-lg-5">
            <?php include_once 'product_form.php' ?>
        </div>
        
        <div class="col-lg-7">
            <?php include_once 'product_table.php' ?>
        </div>
    </div>

<?php else : ?>
    <div class="alert alert-danger alert-shadow mb-5 p-5" role="alert">
        <h4 class="alert-heading">Store not found</h4>
        <div class="border-bottom border-white opacity-20 mb-5"></div>
        <p class="mb-0">You need to select a store first!!</p>
    </div>
<?php endif; ?>

<?php include_once 'purchase_modal.php'; ?>
<?php include_once 'supplier_modal.php'; ?>




<script>

    getProductInfo = (id) => {
        console.log(id);

        $.ajax({
            url: `/product/get-info?id=${id}`,
            type: 'get',
            dataType: 'json',
            success: function (result) {
                console.log(result);
                
                toggleCreateUpdate('update')
                document.querySelector("#update_form_div input[name='id']").value = result[0].id
                document.querySelector("#update_form_div input[name='name']").value = result[0].name
                document.querySelector("#update_form_div input[name='price']").value = result[0].price
            },
            error: function (result) {
                console.log(result);
            }
        });
    }

    toggleCreateUpdate = (type = '') => {
        if(type == 'update') {
            document.getElementById('create_form_div').classList.add('dsp_none')
            document.getElementById('update_form_div').classList.remove('dsp_none')
        }
        if(type == 'create') {
            document.getElementById('create_form_div').classList.remove('dsp_none')
            document.getElementById('update_form_div').classList.add('dsp_none')
        }
    }

</script>