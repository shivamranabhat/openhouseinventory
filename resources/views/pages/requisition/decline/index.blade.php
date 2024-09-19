<x-layouts.app>
    @slot('css')
    @endslot
    <div class="middle-content container-xxl p-0">
        <x-breadcrumb />
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
               
                <livewire:requisition.decline.index />
            </div>

        </div>
    </div>
</x-layouts.app>