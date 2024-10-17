<x-layouts.app-ii>
    <div class="middle-content p-0 col-12 col-lg-9">
        <div class="d-flex justify-content-between align-items-center">
            <x-breadcrumb />
            <a href="{{route('graphs')}}" class="mt-3">
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
            <form class="widget-content widget-content-area ecommerce-create-section"
                action="{{ route('graph.update', $graph->slug) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-12 col-md-6 form-group">
                        <label for="page_id">Page</label>
                        <select class="form-select" name="page_id" id="page_id">
                            <option value="{{ $graph->page_id }}">{{ $graph->page->name }}</option>
                            @forelse($pages as $page)
                            <option value="{{ $page->id }}">{{ $page->name }}</option>
                            @empty
                            <option value="">No page found</option>
                            @endforelse
                        </select>
                        @error('page_id')
                        <div class="feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 form-group">
                        <label for="tag_name">Tag Name</label>
                        <input type="text" class="form-control" name="tag_name" id="tag_name"
                            value="{{ $graph->tag_name }}">
                        @error('tag_name')
                        <div class="feedback text-danger">Please provide a tag name.</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-md-6 form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $graph->title }}">
                        @error('title')
                        <div class="feedback text-danger">Please provide a title.</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 form-group">
                        <label for="image">Image</label>
                        <input type="text" class="form-control" id="image" name="image" value="{{ $graph->image }}">
                        @error('image')
                        <div class="feedback text-danger">Please provide an image URL.</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-md-6 form-group">
                        <label for="url">Page Url</label>
                        <input type="text" class="form-control" id="url" name="url" value="{{ $graph->url }}">
                        @error('url')
                        <div class="feedback text-danger">Please provide a page URL.</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" class="form-control" id="site_name" name="site_name"
                            value="{{ $graph->site_name }}">
                        @error('site_name')
                        <div class="feedback text-danger">Please provide a site name.</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" id="type" name="type" value="{{ $graph->type }}">
                    @error('type')
                    <div class="feedback text-danger">Please provide a type.</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description"
                        name="description">{{ $graph->description }}</textarea>
                    @error('description')
                    <div class="feedback text-danger">Please provide a description.</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button class="btn btn-primary _effect--ripple waves-effect waves-light"
                        type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app-ii>