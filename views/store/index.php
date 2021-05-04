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

<!-- <div class="toastr_alert alert alert-success">
    <div><i class="fas fa-exclamation-triangle text-white mr-3"></i></div>
    <div>Something is wrong</div>
</div> -->

<div class="row">
    <div class="col-lg-5">
        <?php include_once 'store_form.php' ?>
    </div>
    
    <div class="col-lg-7">
        <?php include_once 'store_table.php' ?>
    </div>
</div>


<script>
    var session = '<%= Session["msg"] %>';
    console.log(session);
    
    getStoreInfo = (id) => {
        console.log(id);

        $.ajax({
            url: `/store/get-info?id=${id}`,
            type: 'get',
            dataType: 'json',
            success: function (result) {
                console.log(result);
                
                toggleCreateUpdate('update')
                document.querySelector("#update_form_div input[name='id']").value = result[0].id
                document.querySelector("#update_form_div input[name='name']").value = result[0].name
                document.querySelector("#update_form_div textarea[name='address']").value = result[0].address
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