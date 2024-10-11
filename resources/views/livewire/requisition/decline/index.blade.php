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
                <a href="{{route('requisition.create')}}"
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
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Requested At</th>
                </tr>
            </thead>
            <tbody wire:poll.keep-alive>
                @forelse($requests as $request)

                <tr role="row">
                    <td>{{$loop->iteration}}</td>
                    <td class="d-flex gap-3">
                        <div class="avatar avatar-sm">
                            <span class="avatar-title rounded-circle">
                                @if($request->employee->user->image)
                                <img src="{{asset('storage/'.$request->employee->user->image)}}" width="100" height="100" class="rounded-circle"
                                    alt="profile">
                                @else
                                {{
                                collect(explode(' ', $request->employee->name))
                                ->map(fn($name) => strtoupper(substr($name, 0, 1)))
                                ->take(2)
                                ->implode('')
                                }}
                                @endif
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <span>{{$request->employee->name}}</span>
                            <span>{{$request->employee->department->name}}</span>
                        </div>
                    </td>
                    <td>{{$request->itemIn->product->name ?? ''}}</td>
                    <td>{{$request->quantity}}</td>
                    <td>{{\Carbon\Carbon::parse($request->created_at)->format('M d Y')}},  {{\Carbon\Carbon::parse($request->created_at)->format('g:i A')}}</td>
                   
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No records found</td>
                </tr>

                @endforelse
            </tbody>

        </table>
    </div>
    {{$requests->links('vendor.pagination.pagination')}}
</div>