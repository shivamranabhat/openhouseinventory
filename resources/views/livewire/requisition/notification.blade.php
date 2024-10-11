<li class="nav-item dropdown notification-dropdown" x-data="{ open: false }">
    @if(auth()->user()->can_approve=='Yes' && auth()->user()->can_decline =='Yes')
    <a href="javascript:void(0);" class="nav-link dropdown-toggle" @click="open = !open">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-bell">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        @if($requests && $requests->count() > 0)
        <span class="badge badge-success"></span>
        @endif
    </a>
    <div class="dropdown-menu position-absolute" x-bind:class="{ 'show': open }"  x-show="open" @click.outside="open = false" 
     style="display: none">
        <div class="drodpown-title message">
            <h6 class="d-flex justify-content-between"><span class="align-self-center">New Request</span>
                <span class="badge badge-primary" wire:poll.keep-alive>{{$requests? $requests->count() : '0'}} Pending</span>
            </h6>
        </div>
        <div class="notification-scroll h-100">
            @forelse($requests as $request)
            <div class="dropdown-item">
                <div class="media server-log">
                    <img src="{{asset('storage/'.$request->employee->user->image)}}" class="img-fluid me-2" style="object-fit: cover" alt="avatar">
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">{{$request->employee->name}} request for {{$request->itemIn->product->name}}</h6>
                            <p class="">{{ $request->created_at->timezone('Asia/Kathmandu')->diffForHumans() }}
                            </p>
                        </div>

                        <div class="icon-status" wire:click='decline({{$request->id}})'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="dropdown-item">
                <div class="media server-log">
                    
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">No request found</h6>
                        </div>

                    </div>
                </div>
            </div>
            @endforelse

            {{-- <div class="drodpown-title notification mt-2">
                <h6 class="d-flex justify-content-between"><span class="align-self-center">Notifications</span> <span
                        class="badge badge-secondary">16 New</span></h6>
            </div>

            <div class="dropdown-item">
                <div class="media server-log">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-server">
                        <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                        <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                        <line x1="6" y1="6" x2="6" y2="6"></line>
                        <line x1="6" y1="18" x2="6" y2="18"></line>
                    </svg>
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">Server Rebooted</h6>
                            <p class="">45 min ago</p>
                        </div>

                        <div class="icon-status">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown-item">
                <div class="media file-upload">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-file-text">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">Kelly Portfolio.pdf</h6>
                            <p class="">670 kb</p>
                        </div>

                        <div class="icon-status">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown-item">
                <div class="media ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-heart">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                        </path>
                    </svg>
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">Licence Expiring Soon</h6>
                            <p class="">8 hrs ago</p>
                        </div>

                        <div class="icon-status">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    @else
    <a href="javascript:void(0);" class="nav-link dropdown-toggle" @click="open = !open">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-bell">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        @if($approved && $approved->count() > 0 || $declined && $declined->count() > 0)
        <span class="badge badge-success"></span>
        @endif
    </a>
    <div class="dropdown-menu position-absolute" x-bind:class="{ 'show': open }"  x-show="open" @click.outside="open = false" 
     style="display: none">
        <div class="drodpown-title message">
           <h6>Approval</h6>
        </div>
        <div class="notification-scroll h-100" wire:poll.keep-alive>
            @forelse($approved as $approved)
            <div class="dropdown-item">
                <div class="media server-log">
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">Your request for {{$approved->itemIn->product->name}} has been approved.</h6>
                            <p class="">{{ $approved->created_at->timezone('Asia/Kathmandu')->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="dropdown-item">
                <div class="media server-log">
                    
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">No new notification</h6>
                        </div>

                    </div>
                </div>
            </div>
            @endforelse

            <div class="drodpown-title notification mt-2">
                <h6>Declined
                </h6>
            </div>

            @forelse($declined as $decline)
            <div class="dropdown-item">
                <div class="media server-log">
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">Your request for {{$decline->itemIn->product->name}} has been declined.</h6>
                            <p class="">{{ $decline->created_at->timezone('Asia/Kathmandu')->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="dropdown-item">
                <div class="media server-log">
                    
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">No new notification</h6>
                        </div>

                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    @endif
</li>