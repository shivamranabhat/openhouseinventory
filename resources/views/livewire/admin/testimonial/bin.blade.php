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
                            <option value="100">100</option>
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
                <a href="{{route('testimonial.create')}}"
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
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody wire:poll.keep-alive>
                @forelse($testimonials as $testimonial)
                <tr role="row">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$testimonial->name}}</td>
                    <td>{{$testimonial->role}}</td>
                    <td> <span class="inv-date"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg> {{\Carbon\Carbon::parse($testimonial->created_at)->format('M d Y')}} </span></td>
                    <td class="d-flex">
                        <a class="badge badge-light-danger text-start action-delete"
                            wire:click="restore({{$testimonial->id}})" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-rotate-ccw">
                                <polyline points="1 4 1 10 7 10"></polyline>
                                <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No records found</td>
                </tr>

                @endforelse
            </tbody>

        </table>
    </div>

    {{$testimonials->links('vendor.pagination.pagination')}}
    <x-success />
    <x-error />
</div>