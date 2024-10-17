<x-layouts.app-ii>
    <div class="middle-content p-0 col-12 col-lg-9">
        <div class="d-flex justify-content-between align-items-center">
            <x-breadcrumb />
            
        </div>
        <div class="mb-4 layout-spacing layout-top-spacing">
            <form class="widget-content widget-content-area ecommerce-create-section" action="{{route('stockOut.uploadExcel')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <label for="file">Excel File</label>
                    <input type="file" class="form-control-file" id='file' name="file">
                    @error('file')
                    <div class="feedback text-danger">
                        Please select an excel file.
                    </div>
                    @enderror
                </div>
                <div class="col-12">
                    <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit">
                        Submit
                    </button>
                </div>
                <x-success />
                <x-error />
            </form>
        </div>
    </div>
</x-layouts.app-ii>