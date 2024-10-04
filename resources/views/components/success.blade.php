@if(session()->has('success') || session()->has('message'))
<div class="snackbar-container  snackbar-pos bottom-right"
    style="width: auto; background: rgb(59, 63, 92); opacity: 1;" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
    <p style="margin: 0px; padding: 0px; color: rgb(255, 255, 255); font-size: 16px; font-weight: 300; line-height: 1em;"
        class="d-flex gap-3 align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-check-circle">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        {{ session('success') ? session('success') : session('message') }}
    </p>
</div>
@endif