<x-layouts.main>
  @slot('headerSeo')
    @if (!empty($meta_tags))
    <title>{!! $meta_tags->title !!}</title>
    <meta name="keyword" content="{!! $meta_tags->meta_keywords !!}">
    <meta name="description" content="{!! $meta_tags->meta_description !!}">
    <link rel="canonical" href="{!! $meta_tags->canonical_tag ?? '' !!}">
    @else
    @endif

    @if (empty($openGraph))
    @else
    @foreach ($openGraph as $graph)
    <meta name="og:title" content="{!! $graph->title !!}">
    <meta name="og:description" content="{!! $graph->description !!}">
    <meta name="og:image" content="{!! $graph->image !!}">
    <meta name="og:url" content="{!! $graph->url !!}">
    <meta name="og:site_name" content="{!! $graph->site_name !!}">
    <meta name="og:type" content="{!! $graph->type !!}">
    @endforeach
    @endif

    @if (empty($twitterCard))
    @else
    @foreach ($twitterCard as $twitter)
    <meta name="twitter:card" content="{!! $twitter->summary !!}">
    <meta name="twitter:site" content="{!! $twitter->site !!}">
    <meta name="twitter:title" content="{!! $twitter->title !!}">
    <meta name="twitter:description" content="{!! $twitter->description !!}">
    <meta name="twitter:image" content="{!! $twitter->image !!}">
    @endforeach
    @endif

    @if (empty($scriptHeader))
    @else
    @foreach ($scriptHeader as $header)
    {!! $header->code !!}
    @endforeach
    @endif
    @endslot
    <div class="cs_content">
      <livewire:home.navbar />
      <livewire:home.blog-details :slug="$slug"/>
      <livewire:home.contact />
    </div>
    <livewire:home.footer />
    @slot('footerSeo')
    @if (empty($scriptFooter))
    @else
        @foreach ($scriptFooter as $footer)
            {!! $footer->code !!}
        @endforeach
    @endif
  @endslot
</x-layouts.main>