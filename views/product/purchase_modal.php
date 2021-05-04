
<!-- Modal-->
<div class="modal fade dragable_modal" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Purchase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form action="/product/purchase" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="product_id">

                    <div class="form-group">
                        <label for="exampleSelect1">Example select <span class="text-danger">*</span></label>
                        <select class="form-control" id="exampleSelect1" name="supplier_id">
                            <?php foreach($suppliers as $key=>$supplier_i): ?>
                                <option value="<?= $supplier_i['id']; ?>"><?= $supplier_i['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Quantity <span class="text-danger">*</span></label>
                        <input type="number" step="any" class="form-control" name="qnty"  placeholder="Quantity" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label>Rate <span class="text-danger">*</span></label>
                        <input type="number" step="any" class="form-control" name="rate"  placeholder="Rate" autocomplete="off"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Purchase</button>
                </div>
            </form>
        </div>
    </div>
</div>