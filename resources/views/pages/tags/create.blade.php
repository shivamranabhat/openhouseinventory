<x-layouts.app-ii>
    <div class="middle-content p-0 col-12 col-lg-9">
        <div class="d-flex justify-content-between align-items-center">
            <x-breadcrumb />
            <a href="{{route('tags')}}" class="mt-3">
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
                action="{{ route('tag.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-12 col-md-6 form-group">
                        <label for="page_id">Page</label>
                        <select class="form-select" name="page_id" id="page_id">
                            <option value="">Select a page</option>
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
                        <input type="text" class="form-control" name="tag_name" id="tag_name" placeholder="Tag Name">
                        @error('tag_name')
                        <div class="feedback text-danger">Please provide a tag name.</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 form-group mb-4">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        @error('title')
                        <div class="feedback text-danger">Please provide a title.</div>
                        @enderror
                    </div>
                   
    
                    <div class="col-12 col-md-6 form-group mb-4">
                        <label for="canonical_tag">Canonical Tag</label>
                        <input type="text" class="form-control" id="canonical_tag" name="canonical_tag" placeholder="Canonical tag">
                        @error('canonical_tag')
                        <div class="feedback text-danger">Please provide a canonical tag.</div>
                        @enderror
                    </div>
    
                </div>
                <div class="form-group mb-4">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
                    @error('meta_description')
                    <div class="feedback text-danger">Please provide a meta description.</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="meta_keywords">Meta keywords</label>
                    <textarea class="form-control" id="meta_keywords" name="meta_keywords"></textarea>
                    @error('meta_keywords')
                    <div class="feedback text-danger">Please provide a meta keyword.</div>
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