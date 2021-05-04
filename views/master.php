
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->

        <title>POS System</title>
        
		<link rel="shortcut icon" href="assets/media/logos/404-ERRORIST-FAVICON.png" />

        <style>
            .container {
                max-width: 1600px !important;
            }
            .dsp_none {
                display: none !important;
            }
            .crsr_grab {
                cursor: grab;
            }
            /* Toastr margin */
            .toast-top-center {
                top: 12px !important;
            }

            .toastr_alert {
                position: absolute;
                top: 5%;
                right: 5%;
                padding: 2rem;
                /* background-color: #F64E60; */
                /* color: white; */
                z-index: 100;
                border-radius: 5px;
                min-width: 20rem;
                height: 1.5rem;
                text-align: left;
                font-size: 1rem;

                display: flex;
                justify-content: flex-start;
                align-items: center;
                transition: all .3s ease-in-out;
                opacity: 0;
                animation: toastr_animation ease 2.5s forwards;
            }
            @keyframes toastr_animation {
                0% {
                    opacity: .5;
                    transform: translateY(-5%);
                }
                2% {
                    opacity: .2;
                }
                5% {
                    opacity: .7;
                }
                7% {
                    opacity: .2;
                }
                10% {
                    opacity: 1;
                }
                85% {
                    opacity: 1;
                }
                100% {
                    opacity: 0;
                    display: none;
                }
            }
            
        </style>
        
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed subheader-enabled page-loading">



            <!--begin::Main-->
            <div class="d-flex flex-column flex-root">
                <!--begin::Page-->
                <div class="d-flex flex-row flex-column-fluid page">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                        
                        <!--begin::Header Mobile-->
                        <div id="kt_header_mobile" class="header-mobile">
                            <!--begin::Logo-->
                            <a href="/store">
                                <img alt="Logo" src="assets/media/logos/404-ERRORIST.png" class="max-h-30px" />
                            </a>
                            <!--end::Logo-->
                        </div>
                        <!--end::Header Mobile-->



                        <!--begin::Header-->
                        <div id="kt_header" class="header header-fixed">
                            <!--begin::Container-->
                            <div class="container">
                                <!--begin::Left-->
                                <div class="d-none d-lg-flex align-items-center mr-3">
                                    <!--begin::Logo-->
                                    <a href="/store" class="mr-20">
                                        <img alt="Logo" src="assets/media/logos/404-ERRORIST.png" class="logo-default max-h-35px" />
                                    </a>
                                    <!--end::Logo-->
                                </div>
                                <!--end::Left-->
                                <!--begin::Topbar-->
                                <div class="topbar topbar-minimize">

                                </div>
                                <!--end::Topbar-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Header-->



                        <?php include('nav.php') ?>


                        
                        <!--begin::Container-->
                        <div class="d-flex flex-row flex-column-fluid container">
                            <!--begin::Content Wrapper-->
                            <div class="main d-flex flex-column flex-row-fluid">
                                <!--begin::Subheader-->
                                <div class="subheader py-2 py-lg-6" id="kt_subheader">
                                    <div class="w-100 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center flex-wrap mr-1">
                                            <!--begin::Page Heading-->
                                            <div class="d-flex align-items-baseline flex-wrap mr-5">
                                                <!--begin::Page Title-->
                                                <h5 class="text-dark font-weight-bold my-1 mr-5">
                                                    <?php echo $title ?>
                                                </h5>
                                                <!--end::Page Title-->
                                            </div>
                                            <!--end::Page Heading-->
                                        </div>
                                        <!--end::Info-->

                                        <!--begin::Toolbar-->
                                        <div class="d-flex align-items-center">
                                            <h3 class="label label-xl label-inline label-dark mr-2"><span>Mohammad Rifat Noor: </span><span class="ml-3 text-danger">191002144</span></h3>
                                            <h3 class="label label-xl label-inline label-dark"><span>Md. Saifur Rahman Syeed: </span><span class="ml-3 text-warning">191002145</span></h3>
                                        </div>
                                        <!--end::Toolbar-->

                                    </div>
                                </div>
                                <!--end::Subheader-->
                                <div class="content flex-column-fluid" id="kt_content">
                                    <!--begin::Dashboard-->

                                        <?php echo $content ?>

                                    <!--end::Dashboard-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--begin::Content Wrapper-->
                        </div>
                        <!--end::Container-->


<?php include('footer.php') ?>