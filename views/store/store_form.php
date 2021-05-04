<div class="card card-custom card-stretch gutter-b" id="create_form_div">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title font-weight-bolder">Create Store</h3>
        <div class="card-toolbar">

        </div>
    </div>

    <div class="card-body d-flex flex-column">

        <form action="/store/create" method="POST">
            <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name"  placeholder="Name"/>
            </div>
            <div class="form-group mb-1">
                <label for="address">Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" id="address" rows="3"></textarea>
            </div>

            <div class="mt-5">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>

</div>

<div class="card card-custom card-stretch gutter-b dsp_none" id="update_form_div">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title font-weight-bolder">Update Store</h3>
        <div class="card-toolbar">

        </div>
    </div>

    <div class="card-body d-flex flex-column">

        <form action="/store/update" method="POST">
            <input type="hidden" name="id">
            <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name"  placeholder="Name"/>
            </div>
            <div class="form-group mb-1">
                <label for="address">Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" id="address" rows="3"></textarea>
            </div>

            <div class="mt-5">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <button onclick="toggleCreateUpdate('create')" type="button" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>

</div>