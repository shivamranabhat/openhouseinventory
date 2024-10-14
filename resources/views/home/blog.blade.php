<x-layouts.main>
    <div class="cs_content">
      <livewire:home.navbar />
      <livewire:home.blog-details :slug="$slug"/>
      <livewire:home.contact />
    </div>
    <livewire:home.footer />
</x-layouts.main>