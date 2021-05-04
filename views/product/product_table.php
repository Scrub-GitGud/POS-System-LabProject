<div class="card card-custom gutter-b card-stretch">
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
                <i class="fab fa-product-hunt"></i>
                Products
            </span>
        </h3>
        <div class="card-toolbar">
            <button class="btn btn-sm btn-light-info" data-toggle="modal" data-target="#supplierModal">
                Create Supplier
            </button>
        </div>
    </div>

    <div class="card-body py-0">

        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_3">
                <thead>
                    <tr class="text-left text-uppercase">
                        <th class="pl-0" style="min-width: 30px">#</th>
                        <th class="px-0" style="min-width: 50px">Name</th>
                        <th class="text-info" style="min-width: 50px">Store</th>
                        <th class="text-info" style="min-width: 50px">Price</th>
                        <th class="text-info" style="min-width: 50px">Stock</th>
                        <th class="pr-0 text-right" style="min-width: 50px">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $key=>$item): ?>
                        <tr>
                            <td class="pl-0 py-7">
                                <?= $key+1; ?>
                            </td>
                            <td class="pl-0">
                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                    <?= $item['name']; ?>
                                </a>
                            </td>
                            <td class="pl-0">
                                <?= $item['store_name']; ?>
                            </td>
                            <td class="pl-0">
                                $ <?= $item['price']; ?>
                            </td>
                            <td class="pl-0">
                                <?= $item['stock']; ?>
                            </td>
                            
                            <td class="text-right pr-0">
                                <button onclick="showPurchaseModal(<?= $item['id']; ?>)" type="button" class="btn btn-icon btn-xs btn-outline-dark">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                                <a onclick="getProductInfo(<?= $item['id']; ?>)" href="#" class="btn btn-icon btn-xs btn-outline-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/product/delete?id=<?= $item['id']; ?>" class="btn btn-icon btn-xs btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>



<script>
    showPurchaseModal = (id) => {
        document.querySelector("#purchaseModal input[name='product_id']").value = id
        $('#purchaseModal').modal('show');
    }
</script>