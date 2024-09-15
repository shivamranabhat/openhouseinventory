<x-layouts.app>
    <div class="middle-content container-xxl p-0">
        <x-breadcrumb />
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <div class="simple-tab">
                        <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="true">Product</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="service-tab" data-bs-toggle="tab" data-bs-target="#service-tab-pane" type="button" role="tab" aria-controls="service-tab-pane" aria-selected="false" tabindex="-1">Service</button>
                            </li>
                        </ul>
        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
                                <livewire:product.index />
                            </div>
                            <div class="tab-pane fade" id="service-tab-pane" role="tabpanel" aria-labelledby="service-tab" tabindex="0">
                                <livewire:service.index />
                            </div>
                            
                        </div>
        
                    </div>

                   
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>