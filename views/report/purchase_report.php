<div class="card card-custom gutter-b card-stretch">
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-primary">
                <i class="fas fa-shopping-cart text-primary"></i>
                Purchase Report
            </span>
        </h3>
        <div class="card-toolbar">

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
                        <th class="text-info" style="min-width: 50px">Supplier</th>
                        <th class="text-info" style="min-width: 50px">Price</th>
                        <th class="text-info" style="min-width: 50px">Quantity</th>
                        <th class="text-info" style="min-width: 50px">Rate</th>
                        <th class="text-info" style="min-width: 50px">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($purchase_report as $key=>$item): ?>
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
                                <?= $item['supplier']; ?>
                            </td>
                            <td class="pl-0">
                                $ <?= $item['price']; ?>
                            </td>
                            <td class="pl-0">
                                <?= $item['qnty']; ?>
                            </td>
                            <td class="pl-0">
                                $ <?= $item['rate']; ?>
                            </td>
                            <td class="pl-0">
                                $ <?= $item['qnty']*$item['rate']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>