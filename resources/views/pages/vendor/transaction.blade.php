<x-layouts.app>
    @slot('css')
    <link href="{{asset('assets/dark/invoice-preview.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/light/invoice-preview.css')}}" rel="stylesheet" type="text/css">
    @endslot
    <div class="middle-content container-xxl p-0">
        <x-breadcrumb />
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <livewire:vendor.transaction :slug='$slug'/>
            </div>

        </div>

    </div>
</x-layouts.app>