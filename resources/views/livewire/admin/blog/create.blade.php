<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="row">
        <div class="col-12 col-md-6 form-group mb-4">
            <label for="title">Title</label>
            <input type="text" class="form-control" wire:model="title" placeholder="Title">
            @error('title')
            <div class="feedback text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-12 col-md-6 form-group mb-4">
            <label for="author">Author</label>
            <input type="text" class="form-control" wire:model="author" placeholder="Author">
            @error('author')
            <div class="feedback text-danger">
                Please provide a valid author.
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="image">Image</label>
        <div x-data="fileUpload()">
            <label for="fileInput">
                <svg xmlns="http://www.w3.org/2000/svg" role="button" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-camera">
                    <path
                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                    </path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
            </label>
            <input type="file" class="d-none" id="fileInput" wire:model='image'
                @change="showPreview">

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
        <label for="description">Description</label>
        <textarea class="form-control" wire:model="description" id="description" style="display: block"></textarea>
        @error('description')
        <div class="feedback text-danger">
            Please provide a description.
        </div>
        @enderror
    </div>
 
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
    <script>
        function fileUpload() {
            return {
                imageUrl: '',
                showPreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.imageUrl = URL.createObjectURL(file);
                    }
                },
            };
        }
    </script>
    <script>
        
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