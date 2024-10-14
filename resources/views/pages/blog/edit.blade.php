<x-layouts.app-ii>
    <div class="middle-content p-0 col-lg-8">
        <div class="d-flex justify-content-between align-items-center">
            <x-breadcrumb />
            <a href="{{route('blogs')}}" class="mt-3">
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
                action="{{route('blog.update',$blog->slug)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-4">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$blog->title}}">
                    @error('title')
                    <div class="feedback text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" name="author" id="author" value="{{$blog->author}}">
                    @error('author')
                    <div class="feedback text-danger">
                        Please provide a valid author.
                    </div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="image">Image</label>
                    <div x-data="fileUpload()">
                        <label for="image">
                            <svg xmlns="http://www.w3.org/2000/svg" role="button" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera">
                                <path
                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                </path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </label>
                        <input type="file" class="d-none" id="image" name='image' @change="showPreview">

                        <!-- Image preview -->
                        <template x-if="imageUrl">
                            <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                                style="max-width: 200px;margin-left:1rem">
                        </template>
                        @error('image')
                        <div class="feedback text-danger">
                            Please provide a valid image
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="image_alt">Image Alt</label>
                    <input type="text" class="form-control" name="image_alt" id="image_alt"
                        value="{{$blog->image_alt}}">
                    @error('image_alt')
                    <div class="feedback text-danger">
                        Please provide an image alt.
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description">{{$blog->description}}</textarea>
                    @error('description')
                    <div class="feedback text-danger">
                        Please provide a description.
                    </div>
                    @enderror
                </div>

                <div class="col-12">
                    <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit">Submit
                    </button>
                </div>
                <script>
                    function fileUpload() {
                        return {
                            imageUrl: '{{$blog->image ? asset("storage/".$blog->image) : ""}}',
                            showPreview(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    this.imageUrl = URL.createObjectURL(file); 
                                }
                            },
                        };
                    }
                    CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
                         ckfinder:{
                                 uploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
                             },
                         toolbar: {
                             items: [
                                 'heading', '|',
                                 'bold', 'italic', 'strikethrough', 'underline', '|',
                                 'bulletedList', 'numberedList', 'todoList', '|',
                                 'outdent', 'indent', '|',
                                 'undo', 'redo',
                                 '-',
                                 'fontSize', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                 'alignment', '|',
                                 'link', 'uploadImage', 'blockQuote','htmlEmbed', 'insertTable', '|', 'horizontalLine'
                             ],
                             shouldNotGroupWhenFull: true
                         },
                         list: {
                             properties: {
                                 styles: true,
                                 startIndex: true,
                                 reversed: true
                             }
                         },
                         heading: {
                             options: [
                                 { model: 'paragraph', title: 'Paragraph' },
                                 { model: 'heading1', view: 'h1', title: 'Heading 1' },
                                 { model: 'heading2', view: 'h2', title: 'Heading 2'},
                                 { model: 'heading3', view: 'h3', title: 'Heading 3' },
                                 { model: 'heading4', view: 'h4', title: 'Heading 4' },
                                 { model: 'heading5', view: 'h5', title: 'Heading 5' },
                                 { model: 'heading6', view: 'h6', title: 'Heading 6' }
                             ]
                         },
                         fontSize: {
                             options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                             supportAllValues: true
                         },
                         htmlSupport: {
                             allow: [
                                 {
                                     name: /.*/,
                                     attributes: true,
                                     classes: true,
                                     styles: true
                                 }
                             ]
                         },
                         htmlEmbed: {
                             showPreviews: true
                         },
                         link: {
                             decorators: {
                                 addTargetToExternalLinks: true,
                                 defaultProtocol: 'https://',
                                 toggleDownloadable: {
                                     mode: 'manual',
                                     label: 'Downloadable',
                                     attributes: {
                                         download: 'file'
                                     }
                                 }
                             }
                         },
                         removePlugins: [
                             'AIAssistant',
                             'CKBox',
                             'CKFinder',
                             'EasyImage',
                             'MultiLevelList',
                             'RealTimeCollaborativeComments',
                             'RealTimeCollaborativeTrackChanges',
                             'RealTimeCollaborativeRevisionHistory',
                             'PresenceList',
                             'Comments',
                             'TrackChanges',
                             'TrackChangesData',
                             'RevisionHistory',
                             'Pagination',
                             'WProofreader',
                             'MathType',
                             'SlashCommand',
                             'Template',
                             'DocumentOutline',
                             'FormatPainter',
                             'TableOfContents',
                             'PasteFromOfficeEnhanced',
                             'CaseChange'
                         ]
                     });
                </script>
            </form>
        </div>
    </div>
</x-layouts.app-ii>