<div class="card card-custom gutter-b card-stretch">
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">
                <i class="fas fa-store-alt"></i>
                Stores
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
                        <th class="px-0" style="min-width: 130px">Name</th>
                        <th class="text-info" style="min-width: 50px">Address</th>
                        <th class="pr-0 text-right" style="min-width: 30px">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($stores as $key=>$item): ?>
                        <tr>
                            <td class="pl-0 py-7">
                                <?= $key+1; ?>
                            </td>
                            <td class="pl-0">
                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                    <?php if(isset($_COOKIE["active_store"]) && $_COOKIE['active_store'] == $item['id']) : ?>
                                        <span class="text-primary"><?= $item['name']; ?></span>
                                    <?php else : ?>
                                        <span class="text-dark"><?= $item['name']; ?></span>
                                    <?php endif; ?>
                                    
                                </a>
                            </td>
                            <td class="pl-0">
                                <?= $item['address']; ?>
                            </td>
                            
                            <td class="text-right pr-0">

                                <?php if(isset($_COOKIE["active_store"]) && $_COOKIE['active_store'] == $item['id']) : ?>
                                    <a href="/store/inactive" class="btn btn-icon btn-xs btn-outline-success">
                                        <i class='fas fa-check'></i>
                                    </a>
                                <?php else : ?>
                                    <a href="/store/active?id=<?= $item['id']; ?>" class="btn btn-icon btn-xs btn-outline-danger">
                                        <i class='fas fa-times'></i>
                                    </a>
                                <?php endif; ?>

                                <a onclick="getStoreInfo(<?= $item['id']; ?>)" class="btn btn-icon btn-xs btn-outline-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/store/delete?id=<?= $item['id']; ?>" class="btn btn-icon btn-xs btn-outline-danger">
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