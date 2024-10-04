@if(session()->has('error'))
<div class="snackbar-container  snackbar-pos bottom-right"
    style="width: auto; background: rgb(231, 81, 90); opacity: 1;" x-data="{ show: true }" x-show="show"
    x-init="setTimeout(() => show = false, 3000)">

    <p style="margin: 0px; padding: 0px; color: rgb(255, 255, 255); font-size: 16px; font-weight: 300; line-height: 1em;"
        class="d-flex gap-3 align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-info">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>{{session('error')}}
    </p>
</div>
@endif