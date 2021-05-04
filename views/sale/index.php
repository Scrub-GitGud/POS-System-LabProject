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
            <?php include_once 'left_div.php' ?>
        </div>
        
        <div class="col-lg-7">
            <?php include_once 'right_div.php' ?>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-danger alert-shadow mb-5 p-5" role="alert">
        <h4 class="alert-heading">Store not found</h4>
        <div class="border-bottom border-white opacity-20 mb-5"></div>
        <p class="mb-0">You need to select a store first!!</p>
    </div>
<?php endif; ?>


<script>
    let already_selected = [];

    search = (text) => {
        $.ajax({
            url: 'product/search',
            type: 'get',
            dataType: 'json',
            data: {text},
            success: function (result) {
                console.log(result);
                showSearchResult(result)
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
    showSearchResult = (products) => {
        document.getElementById('search_results').innerHTML = ''
        products.forEach(product_i => {
            let new_el = document.createElement('div')
            new_el.id = `SR_${product_i.id}`
            $(new_el).addClass("d-flex justify-content-between align-items-center bg-hover-gray-200 p-3 rounded")
            new_el.innerHTML = `<div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-light-warning mr-5">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-lg svg-icon-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column font-weight-bold">
                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">${product_i.name}</a>
                                    </div>
                                </div>

                                <div class="d-flex flex-column">
                                    s<span>
                                        <span class="text-muted">Stock:</span>
                                        <span class="font-weight-bold">${product_i.stock} </span>
                                    </span> 
                                </div>

                                <div class="d-flex flex-column">
                                    <span>
                                        <span class="text-muted">Price:</span>
                                        <span class="font-weight-bold">$ ${product_i.price} </span>
                                    </span> 
                                </div>`
            document.getElementById('search_results').appendChild(new_el);
            new_el.addEventListener('click', (id) => {
                getOneProduct(product_i.id)
            })
        });
    }

    getOneProduct = (id) => {
        console.log(id);

        curr_qnty = 0;
        if(document.querySelector(`#SP_${id} .qnty`)) {
            curr_qnty = parseInt(document.querySelector(`#SP_${id} .qnty`).value) || 0
        }

        $.ajax({
            url: 'product/add_to_list',
            type: 'get',
            dataType: 'json',
            data: {id, curr_qnty},
            success: function (result) {
                console.log(result);
                if(result.status == 'success') {
                    product = result.product[0]
                    if(!already_selected.includes(product.id)) {
                        already_selected.push(product.id)
                        addProductToList(product)
                    } else {
                        curr_qnty = parseInt(document.querySelector(`#SP_${product.id} .qnty`).value) || 0
                        document.querySelector(`#SP_${product.id} .qnty`).value = curr_qnty + 1
                        document.querySelector(`#SP_${product.id} .qnty_text`).innerText = curr_qnty + 1
                    }
                }  else {
                    console.log(result.msg);
                    toastr.error(result.msg);
                }
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
    addProductToList = (product) => {
        selected_product = document.querySelectorAll('.selected_product')

        let new_el = document.createElement('div')
        new_el.id = `SP_${product.id}`
        $(new_el).addClass("d-flex justify-content-between align-items-center bg-hover-light-primary p-3 rounded selected_product")
        new_el.innerHTML = `<div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-light-primary mr-5">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                    <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                                </g>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                                <div class="d-flex flex-column font-weight-bold">
                                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">${product.name}</a>
                                    <span>
                                        <span class="text-muted">Price:</span>
                                        <span class="font-weight-bold">$ ${product.price} </span>
                                        <span>
                                            <a onclick="decrement(${product.id})" class="btn btn-icon btn-xs btn-light-success ml-2">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                            <span class="bg-gray mx-3 qnty_text">1</span>   
                                            <a onclick="getOneProduct(${product.id})" class="btn btn-icon btn-xs btn-light-success ml-2">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </span>
                                    </span> 
                                </div>
                            </div>
                            <div>
                                <a onclick="removeItem(${product.id})" class="btn btn-sm pr-1 btn-light-danger"><i class="fas fa-times"></i></a>
                                <input type="hidden" class="form-control id" name="product[${selected_product.length}][product_id]" value="${product.id}" type="number" min="0" step="any"/>
                                <input type="hidden" class="form-control qnty" name="product[${selected_product.length}][qnty]" value="1" type="number" min="0" step="any"/>
                            </div>`
        document.getElementById('selected_products').appendChild(new_el);
    }

    decrement = (id) => {
        curr_qnty = parseInt(document.querySelector(`#SP_${id} .qnty`).value) || 0
        if(curr_qnty > 1) {
            document.querySelector(`#SP_${id} .qnty`).value = curr_qnty - 1
            document.querySelector(`#SP_${id} .qnty_text`).innerText = curr_qnty - 1
        }
    }
    removeItem = (id) => {
        document.querySelector(`#SP_${id}`).remove();
        already_selected = already_selected.filter(i => i != id)
    }
</script>