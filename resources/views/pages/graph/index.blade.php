<x-layouts.app>
    @slot('css')
    <link href="{{asset('src/assets/css/dark/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css">
    @endslot
    <div class="middle-content container-xxl p-0">
        <x-breadcrumb />
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <div class="simple-tab">
                        <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="index-tab" data-bs-toggle="tab" data-bs-target="#index-tab-pane" type="button" role="tab" aria-controls="index-tab-pane" aria-selected="true">Index</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="bin-tab" data-bs-toggle="tab" data-bs-target="#bin-tab-pane" type="button" role="tab" aria-controls="bin-tab-pane" aria-selected="false" tabindex="-1">Bin</button>
                            </li>
                        </ul>
        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="index-tab-pane" role="tabpanel" aria-labelledby="index-tab" tabindex="0">
                                <livewire:admin.graph.index />
                            </div>
                            <div class="tab-pane fade" id="bin-tab-pane" role="tabpanel" aria-labelledby="bin-tab" tabindex="0">
                                <livewire:admin.graph.bin />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>