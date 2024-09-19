<x-layouts.app>
    @slot('css')
    @endslot
    <div class="middle-content container-xxl p-0">
        <x-breadcrumb />
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <livewire:stock.index />
                </div>
            </div>

        </div>

    </div>
</x-layouts.app>