<x-layouts.app-ii>
    <div class="middle-content p-0 col-lg-8">
        <div class="d-flex justify-content-between align-items-center">
            <x-breadcrumb />
            <a href="{{route('faqs')}}" class="mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-arrow-left-circle">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 8 8 12 12 16" />
                <line x1="16" y1="12" x2="8" y2="12" />
            </svg>
            </a>
        </div>
        <div class="mb-4 layout-spacing layout-top-spacing">
            <livewire:admin.faq.edit :slug="$slug"/>
        </div>
    </div>
</x-layouts.app-ii>