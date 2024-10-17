<x-layouts.app-ii>
    <div class="middle-content p-0 col-12 col-lg-9">
        <div class="d-flex justify-content-between align-items-center">
            <x-breadcrumb />
            <a href="{{route('cards')}}" class="mt-3">
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
                action="{{ route('card.update',$card->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-4">
                    <div class="col-12 col-md-6 form-group">
                        <label for="page_id">Page</label>
                        <select class="form-select" name="page_id" id="page_id">
                            <option value="{{$card->page_id}}">{{$card->page->name}}</option>
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
                        <input type="text" class="form-control" name="tag_name" id="tag_name" value="{{$card->tag_name}}">
                        @error('tag_name')
                        <div class="feedback text-danger">Please provide a tag name.</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-md-6 form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$card->title}}">
                        @error('title')
                        <div class="feedback text-danger">Please provide a title.</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 form-group">
                        <label for="image">Image</label>
                        <input type="text" class="form-control" id="image" name="image" value="{{$card->image}}">
                        @error('image')
                        <div class="feedback text-danger">Please provide an image URL.</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="site">Site</label>
                    <input type="text" class="form-control" id="site" name="site" value="{{$card->site}}">
                    @error('site')
                    <div class="feedback text-danger">Please provide a twitter site.</div>
                    @enderror
                </div>


                <div class="form-group mb-4">
                    <label for="summary">Summary</label>
                    <textarea class="form-control" id="summary" name="summary">{{$card->summary}}</textarea>
                    @error('summary')
                    <div class="feedback text-danger">Please provide a summary.</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{$card->description}}</textarea>
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