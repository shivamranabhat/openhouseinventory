<x-layouts.app>
    @slot('css')
    <link href="{{asset('src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/assets/css/dark/components/tabs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/assets/css/light/users/account-setting.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('src/assets/css/dark/users/account-setting.css')}}" rel="stylesheet" type="text/css">
    @endslot
    <x-breadcrumb />
    <livewire:auth.profile />
</x-layouts.app>