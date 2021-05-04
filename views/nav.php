<!--begin::Header Menu Wrapper-->
<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
    <div class="container">
        <!--begin::Header Menu-->
        <div id="" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default header-menu-root-arrow">
            <!--begin::Header Nav-->
            <ul class="menu-nav">

                <li class="menu-item <?php if($title == 'Store'){echo 'menu-item-open menu-item-here';} ?> menu-item-submenu menu-item-rel">
                    <a href="store" class="menu-link menu-toggle">
                        <span class="menu-text">Store</span>
                    </a>
                </li>
                
                <li class="menu-item <?php if($title == 'Product'){echo 'menu-item-open menu-item-here';} ?> menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="product" class="menu-link menu-toggle">
                        <span class="menu-text">Product</span>
                        <span class="menu-desc"></span>
                    </a>
                </li>
                
                <li class="menu-item <?php if($title == 'Sale'){echo 'menu-item-open menu-item-here';} ?> menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="sale" class="menu-link menu-toggle">
                        <span class="menu-text">Sale</span>
                        <span class="menu-desc"></span>
                    </a>
                </li>
                
                <li class="menu-item <?php if($title == 'Report'){echo 'menu-item-open menu-item-here';} ?> menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="report" class="menu-link menu-toggle">
                        <span class="menu-text">Report</span>
                        <span class="menu-desc"></span>
                    </a>
                </li>

            </ul>
            <!--end::Header Nav-->
        </div>
        <!--end::Header Menu-->
    </div>
</div>
<!--end::Header Menu Wrapper-->