<div class="card card-custom card-stretch gutter-b" id="create_form_div">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title font-weight-bolder">Create Product</h3>
        <div class="card-toolbar">
            
        </div>
    </div>

    <div class="card-body d-flex flex-column">

        <form action="/product/create" method="POST">
            <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name"  placeholder="Name"/>
            </div>
            <div class="form-group">
                <label>Price <span class="text-danger">*</span></label>
                <input type="number" step="any" class="form-control" name="price"  placeholder="Price" autocomplete="off"/>
            </div>
            <!-- <div class="form-group">
                <label>Image</label>
                <div></div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="customFile"/>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div> -->

            <div class="mt-5">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>

    </div>

</div>


<div class="card card-custom card-stretch gutter-b dsp_none" id="update_form_div">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title font-weight-bolder">Update Product</h3>
        <div class="card-toolbar">

        </div>
    </div>

    <div class="card-body d-flex flex-column">

        <form action="/product/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id">
            <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name"  placeholder="Name"/>
            </div>
            <div class="form-group">
                <label>Price <span class="text-danger">*</span></label>
                <input type="number" step="any" class="form-control" name="price"  placeholder="Price" autocomplete="off"/>
            </div>

            <div class="mt-5">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <button onclick="toggleCreateUpdate('create')" type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>

</div>