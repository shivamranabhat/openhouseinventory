<div id="zero-config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
    <div class="dt--top-section">
        <div class="row">
            <div class="col-12 col-sm-6 d-flex justify-content-start">
                <div class="dataTables_length" id="zero-config_length"><label>Results : <select
                            name="zero-config_length" aria-controls="zero-config"
                            wire:change="updatePage($event.target.value)" class="form-control">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select></label>
                </div>
            </div>
            <div
                class="col-12 col-sm-6 d-flex justify-content-between justify-content-md-end align-items-center gap-0 gap-md-5 mt-sm-0 mt-3">
                <div id="zero-config_filter" class="dataTables_filter"><label><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-search">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg><input type="search" wire:model.live="search" class="form-control" placeholder="Search..."
                            aria-controls="zero-config"></label></div>
                <a href="{{route('category.create')}}"
                    class="form-create flex justify-content-between align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-plus-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                    Create
                </a>

            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="zero-config" class="table table-striped dt-table-hover dataTable" style="width:100%" role="grid"
            aria-describedby="zero-config_info">
            <thead>
                <tr role="row">
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr role="row">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{\Carbon\Carbon::parse($product->created)->format('M d Y')}}</td>
                    <td class="d-flex gap-3">
                        <a href="{{route('category.edit',$category->slug)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                        <a data-bs-toggle="modal" data-bs-target="#modal-{{$category->id}}" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </a>
                        <div id="modal-{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{$category->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-text">Are you sure want to delete this?</p>
                                    </div>
                                    <div class="modal-footer md-button">
                                        <button class="btn btn-light-dark" data-bs-dismiss="modal">Discard</button>
                                        <button wire:click='remove({{$category->slug}})' class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No records found</td>
                </tr>

                @endforelse
            </tbody>
            
        </table>
    </div>
    
    {{$categories->links('vendor.pagination.pagination')}}
</div>