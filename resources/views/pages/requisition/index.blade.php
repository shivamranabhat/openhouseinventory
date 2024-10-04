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
                            @can('action-approve')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="request-tab" data-bs-toggle="tab" data-bs-target="#request-tab-pane" type="button" role="tab" aria-controls="request-tab-pane" aria-selected="true">Requests</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="approve-tab" data-bs-toggle="tab" data-bs-target="#approve-tab-pane" type="button" role="tab" aria-controls="approve-tab-pane" aria-selected="false" tabindex="-1">Approved</button>
                            </li>
                            @endcan
                            @can('action-decline')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="decline-tab" data-bs-toggle="tab" data-bs-target="#decline-tab-pane" type="button" role="tab" aria-controls="decline-tab-pane" aria-selected="false" tabindex="-1">Declined</button>
                            </li>
                            @endcan
                        </ul>
        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="request-tab-pane" role="tabpanel" aria-labelledby="request-tab" tabindex="0">
                                <livewire:requisition.index />
                            </div>
                            @can('action-approve')
                            <div class="tab-pane fade" id="approve-tab-pane" role="tabpanel" aria-labelledby="approve-tab" tabindex="0">
                                <livewire:requisition.approve.index/>
                            </div>
                            @endcan
                            @can('action-decline')
                            <div class="tab-pane fade" id="decline-tab-pane" role="tabpanel" aria-labelledby="decline-tab" tabindex="0">
                                <livewire:requisition.decline.index />
                            </div>
                            @endcan
                            
                        </div>
        
                    </div>

                   
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>