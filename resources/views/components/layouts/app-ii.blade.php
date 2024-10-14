<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{auth()->user()->name}} | Inventory</title>
    <link rel="icon" type="image/x-icon" href="https://designreset.com/cork/html/src/assets/img/favicon.ico" />
    <link href="{{asset('layouts/vertical-dark-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('layouts/vertical-dark-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('layouts/vertical-dark-menu/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('layouts/vertical-dark-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('layouts/vertical-dark-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('src/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/assets/css/light/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('src/assets/css/dark/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="{{asset('src/plugins/src/filepond/filepond.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/src/tagify/tagify.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('src/assets/css/light/forms/switches.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/css/light/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/css/light/tagify/custom-tagify.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('src/assets/css/dark/forms/switches.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/css/dark/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/css/dark/tagify/custom-tagify.css')}}">
    <link href="{{asset('src/plugins/src/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/plugins/css/light/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet"
        type="text/css">
    <link href="{{asset('src/plugins/css/dark/notification/snackbar/custom-snackbar.css')}}" rel="stylesheet"
        type="text/css">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" href="{{asset('src/assets/css/light/apps/ecommerce-create.css')}}">
    <link rel="stylesheet" href="{{asset('assets/custom.css')}}">
    <link rel="stylesheet" href="{{asset('src/assets/css/dark/apps/ecommerce-create.css')}}">
    <link href="{{asset('src/assets/css/dark/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <!--  END CUSTOM STYLE FILE  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- CK editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    
    @livewireStyles
</head>

<body class="layout-boxed">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

            <ul class="navbar-item theme-brand flex-row  text-center">

                <li class="nav-item theme-text">
                    <a href="index.html" class="nav-link"> {{auth()->user()->name}} </a>
                </li>
            </ul>

            <div class="search-animated toggle-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-x search-close">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </form>
                <span class="badge badge-secondary">Search</span>
            </div>

            <ul class="navbar-item flex-row ms-lg-auto ms-0 action-area">


                <li class="nav-item theme-toggle-item">
                    <a href="javascript:void(0);" class="nav-link theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-moon dark-mode">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-sun light-mode">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </a>
                </li>

                <livewire:requisition.notification />
                <livewire:auth.auth-card />

            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-text">
                            <a href="#" class="nav-link"> {{auth()->user()->name}} </a>
                        </div>
                    </div>
                    <div class="nav-item sidebar-toggle">
                        <div class="btn-toggle sidebarCollapse">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevrons-left">
                                <polyline points="11 17 6 12 11 7"></polyline>
                                <polyline points="18 17 13 12 18 7"></polyline>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu {{request()->segment(2) == 'vendor'  ? 'active' : '' }}">
                        <a href="{{route('vendors')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>Vendor</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{request()->segment(2) == 'department'  ? 'active' : '' }}">
                        <a href="{{route('departments')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg fill="none" stroke="currentColor" width="800px" class="feather" height="800px"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.04146 3C5.22009 2.6906 5.55022 2.5 5.90748 2.5L9.75278 2.5C10.11 2.5 10.4402 2.6906 10.6188 3L12.5415 6.33013C12.7201 6.63953 12.7201 7.02073 12.5415 7.33013L10.6188 10.6603C10.4402 10.9697 10.11 11.1603 9.75278 11.1603H5.90748C5.55022 11.1603 5.22009 10.9697 5.04146 10.6603L3.11881 7.33013C2.94017 7.02073 2.94017 6.63953 3.11881 6.33013L5.04146 3Z" />
                                    <path
                                        d="M5.1216 13.2272C5.30023 12.9178 5.63036 12.7272 5.98762 12.7272H9.83292C10.1902 12.7272 10.5203 12.9178 10.6989 13.2272L12.6216 16.5574C12.8002 16.8668 12.8002 17.248 12.6216 17.5574L10.6989 20.8875C10.5203 21.1969 10.1902 21.3875 9.83292 21.3875H5.98762C5.63036 21.3875 5.30023 21.1969 5.1216 20.8875L3.19895 17.5574C3.02031 17.248 3.02031 16.8668 3.19895 16.5574L5.1216 13.2272Z" />
                                    <path
                                        d="M14.1216 8.22723C14.3002 7.91783 14.6304 7.72723 14.9876 7.72723L18.8329 7.72723C19.1902 7.72723 19.5203 7.91783 19.6989 8.22723L21.6216 11.5574C21.8002 11.8668 21.8002 12.248 21.6216 12.5574L19.6989 15.8875C19.5203 16.1969 19.1902 16.3875 18.8329 16.3875H14.9876C14.6304 16.3875 14.3002 16.1969 14.1216 15.8875L12.1989 12.5574C12.0203 12.248 12.0203 11.8668 12.1989 11.5574L14.1216 8.22723Z" />
                                </svg>
                                <span>Department</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{request()->segment(2) == 'employee'  ? 'active' : '' }}">
                        <a href="{{route('employees')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Employee</span>
                            </div>
                        </a>
                    </li>
                    <li
                        class="menu {{request()->segment(2) == 'inventory' ||  request()->segment(2)=='prefix' ||request()->segment(2) == 'category'  ? 'active' : '' }}">
                        <a href="#inventory" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-layers">
                                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                    <polyline points="2 17 12 22 22 17"></polyline>
                                    <polyline points="2 12 12 17 22 12"></polyline>
                                </svg>
                                <span>Inventory</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="inventory" data-bs-parent="#accordionExample"
                            style="">
                            <li class="{{request()->segment(2) == 'inventory'  ? 'active' : '' }}">
                                <a href="{{route('inventories')}}"> Lists </a>
                            </li>

                            <li class="{{request()->segment(2) == 'category'  ? 'active' : '' }}">
                                <a href="{{route('categories')}}"> Category </a>
                            </li>
                            <li class="{{request()->segment(2) == 'prefix'  ? 'active' : '' }}">
                                <a href="{{route('prefixes')}}"> Prefix </a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="menu {{request()->segment(2) == 'stock-in' || request()->segment(2) == 'stock-out'  ? 'active' : '' }}">
                        <a href="#stock" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed">
                            <div class="">
                                <svg width="800px" height="800px" fill="none" stroke="currentColor" class="feather"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" id="package"
                                    class="icon glyph">
                                    <path
                                        d="M22,8.5V20a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V8.5H8V15a1,1,0,0,0,.42.81,1,1,0,0,0,.9.14l2.68-.9,2.68.9A1.19,1.19,0,0,0,15,16a.94.94,0,0,0,.58-.19A1,1,0,0,0,16,15V8.5Zm-.14-1h0a.83.83,0,0,0-.16-.21L17,2.58A2,2,0,0,0,15.59,2H8.41A2,2,0,0,0,7,2.58L2.29,7.29a.83.83,0,0,0-.16.21H21.86Z">
                                    </path>
                                </svg>
                                <span>Stock</span>

                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="stock" data-bs-parent="#accordionExample"
                            style="">
                            <li class="{{request()->segment(2) == 'stock-in'  ? 'active' : '' }}">
                                <a href="{{route('stocks')}}"> Stock In </a>
                            </li>
                            <li class="{{request()->segment(2) == 'stock-out'  ? 'active' : '' }}">
                                <a href="{{route('stockOuts')}}"> Stock Out </a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="menu {{ request()->segment(2)=='bill' ||request()->segment(2) == 'payment-out'  ? 'active' : '' }}">
                        <a href="#requisition" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-shopping-cart">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <span>Purchase</span>

                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="requisition" data-bs-parent="#accordionExample"
                            style="">

                            <li class="{{request()->segment(2) == 'bill'  ? 'active' : '' }}">
                                <a href="{{route('bills')}}"> Purchase Bill</a>
                            </li>
                            <li class="{{request()->segment(2) == 'payment-out'  ? 'active' : '' }}">
                                <a href="{{route('payments')}}"> Payment Out </a>
                            </li>

                        </ul>
                    </li>
                    <li class="menu {{request()->segment(2) == 'requisition'  ? 'active' : '' }}">
                        <a href="{{route('requisitions')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-plus-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                </svg>
                                <span>Requisition</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{request()->segment(2) == 'cheque'  ? 'active' : '' }}">
                        <a href="{{route('cheques')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg fill="none" class="feather" stroke="currentColor" width="800px" height="800px"
                                    viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">

                                    <g data-name="36. Bank Check" id="_36._Bank_Check">

                                        <path
                                            d="M31,8H28V3a3,3,0,0,0-6,0V8H3a3,3,0,0,0-3,3V29a3,3,0,0,0,3,3H23a1,1,0,0,0,1-1V28h7a1,1,0,0,0,1-1V9A1,1,0,0,0,31,8ZM24,6h2v8.59l-1,1-1-1Zm1-4a1,1,0,0,1,1,1V4H24V3A1,1,0,0,1,25,2ZM22,30H3a1,1,0,0,1,0-2H22Zm8-4H3a3,3,0,0,0-1,.18V11a1,1,0,0,1,1-1H22v5a1,1,0,0,0,.29.71l2,2a1,1,0,0,0,1.42,0l2-2A1,1,0,0,0,28,15V10h2Z" />

                                        <path d="M5,14h8a1,1,0,0,0,0-2H5a1,1,0,0,0,0,2Z" />

                                        <path d="M18,17a1,1,0,0,0-1-1H5a1,1,0,0,0,0,2H17A1,1,0,0,0,18,17Z" />

                                        <path
                                            d="M27,22H25.54l-1.71-2.55a1,1,0,0,0-1.66,0L20.46,22H18a1,1,0,0,0,0,2h3a1,1,0,0,0,.83-.45L23,21.8l1.17,1.75A1,1,0,0,0,25,24h2a1,1,0,0,0,0-2Z" />

                                    </g>

                                </svg>
                                <span>Cheque</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{request()->segment(2) == 'credit'  ? 'active' : '' }}">
                        <a href="{{route('credits')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="feather" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>Credits</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{request()->segment(2) == 'account'  ? 'active' : '' }}">
                        <a href="{{route('accounts')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user-plus">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                                <span>Accounts</span>
                            </div>
                        </a>
                    </li>
                    <li
                        class="menu {{request()->segment(2) == 'charge' || request()->segment(2) == 'profile'  ? 'active' : '' }}">
                        <a href="#charges" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle collapsed">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-settings">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path
                                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                    </path>
                                </svg>
                                <span>Settings</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="charges" data-bs-parent="#accordionExample"
                            style="">
                            <li class="{{request()->segment(2) == 'charge'  ? 'active' : '' }}">
                                <a href="{{route('charges')}}"> Charges </a>
                            </li>
                            <li class="{{request()->segment(2) == 'profile'  ? 'active' : '' }}">
                                <a href="{{route('profile')}}"> Profile </a>
                            </li>

                        </ul>
                    </li>
                    @if (auth()->user()->role == 'Super Admin')

                    <li class="menu {{request()->segment(2) == 'content'  ? 'active' : '' }}">
                        <a href="{{route('blogs')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span>Contents</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{request()->segment(2) == 'content'  ? 'active' : '' }}">
                        <a href="{{route('blogs')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-slack">
                                    <path
                                        d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z">
                                    </path>
                                    <path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z">
                                    </path>
                                    <path
                                        d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z">
                                    </path>
                                    <path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path>
                                    <path
                                        d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z">
                                    </path>
                                    <path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z">
                                    </path>
                                    <path
                                        d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z">
                                    </path>
                                    <path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path>
                                </svg>
                                <span>Services</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{request()->segment(2) == 'service'  ? 'active' : '' }}">
                        <a href="{{route('blogs')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-edit-3">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>
                                <span>Blog</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{request()->segment(2) == 'faq'  ? 'active' : '' }}">
                        <a href="{{route('faqs')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-help-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                                <span>FAQs</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{request()->segment(2) == 'testimonial'  ? 'active' : '' }}">
                        <a href="{{route('testimonials')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg fill="{{request()->segment(2) == 'testimonial'  ? '#030305': 'currentColor'}}"
                                    width="800px" height="800px" viewBox="0 0 14 14" role="img" focusable="false"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m 1.4358383,12.895149 c -0.38924,-0.1993 -0.43281,-0.3751 -0.41279,-1.665 0.0158,-1.0195 0.0314,-1.1697 0.14735,-1.4205004 0.26312,-0.5694 0.88589,-1.0631 1.46037,-1.1579 l 0.21,-0.035 0.62728,1.0597 c 0.345,0.5829004 0.63415,1.0358004 0.64256,1.0065004 0.008,-0.029 0.0415,-0.3472 0.0736,-0.7065004 0.0525,-0.5882 0.0468,-0.6826 -0.0575,-0.9472 -0.0637,-0.1617 -0.11586,-0.32 -0.11586,-0.3517 0,-0.033 0.26499,-0.058 0.62678,-0.058 l 0.62678,0 -0.12063,0.345 c -0.10456,0.2991 -0.11523,0.4309 -0.0802,0.9905 0.0222,0.3551004 0.0611,0.6584004 0.0864,0.6740004 0.0253,0.016 0.32158,-0.4318 0.65846,-0.9942004 l 0.61252,-1.0226 0.18995,0.04 c 0.58752,0.1229 1.19054,0.5979 1.42811,1.1248 0.12949,0.2872004 0.1425,0.4062004 0.1588,1.4528004 0.0156,0.9994 0.005,1.1659 -0.0896,1.35 -0.21721,0.425 -0.1746,0.4199 -3.4974,0.4199 -2.70948,0 -2.98802,-0.01 -3.17496,-0.1049 z m 2.71495,-4.9624004 c -0.76247,-0.3317 -1.3488,-1.7133 -1.07583,-2.5352 0.48535,-1.4612 2.58633,-1.4612 3.07167,0 0.27559,0.8297 -0.31945,2.2162 -1.08916,2.5378 -0.25463,0.1064 -0.65878,0.1053 -0.90668,0 z m 3.58006,-2.0213 0,-0.6365 -0.34018,-0.028 c -0.27583,-0.023 -0.36661,-0.059 -0.48,-0.1908 -0.13962,-0.1623 -0.13984,-0.1653 -0.13984,-1.9339 l 0,-1.7713 0.17539,-0.1754 0.17539,-0.1753 2.76131,0 2.7613097,0 0.16835,0.1448 0.16835,0.1448 0,1.8101 0,1.8102 -0.19595,0.175 -0.19595,0.1751 -1.7831,0 -1.7830997,0 -0.64599,0.644 -0.64599,0.644 0,-0.6366 z" />
                                </svg>
                                <span>Testimonial</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    <livewire:logout />
                </ul>
            </nav>
        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                {{$slot}}

            </div>
            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2022</span> <a target="_blank"
                            href="https://designreset.com/cork-admin/">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg></p>
                </div>
            </div>
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @livewireScripts
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
    <script src="{{asset('src/plugins/src/waves/waves.min.js')}}"></script>
    <script src="{{asset('layouts/vertical-dark-menu/app.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    @stack('scripts')
    <script>
        flatpickr("#date", {
            enableTime: false,
            dateFormat: "M d Y",
        });
        flatpickr("#withdraw", {
            enableTime: false,
            dateFormat: "M d Y",
        });
    </script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>