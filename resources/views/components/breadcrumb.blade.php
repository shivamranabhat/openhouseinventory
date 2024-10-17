<div>
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-capitalize">{{ str_replace('-', ' ', request()->segment(2)) }}</a></li>
                @if(request()->segment(3) !== null)
                <li class="breadcrumb-item text-capitalize active" aria-current="page" class="text-capitalize">{{ str_replace('-', ' ', request()->segment(3)) }}</li>
                @endif
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <!--  BEGIN BREADCRUMBS  -->
    <div class="secondary-nav">
        <div class="breadcrumbs-container" data-page-heading="Analytics">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </a>
                <div class="d-flex breadcrumb-content">
                    <div class="page-header">

                        <div class="page-title">
                        </div>
        
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="text-capitalize">{{ str_replace('-', ' ', request()->segment(2)) }}</a></li>
                                @if(request()->segment(3) !== null)
                                <li class="breadcrumb-item  text-capitalize active" aria-current="page">{{ str_replace('-', ' ', request()->segment(3)) }}</li>
                                @endif
                            </ol>
                        </nav>
        
                    </div>
                </div>
               
            </header>
        </div>
    </div>
    <!--  END BREADCRUMBS  -->
</div>

