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
    <div class="dropdown-menu position-absolute" x-bind:class="{ 'show': open }" x-show="open"
        @click.outside="open = false" style="display: none">
        <div class="drodpown-title message">
            <h6 class="d-flex justify-content-between"><span class="align-self-center">New Request</span>
                <span class="badge badge-primary" wire:poll.keep-alive>{{$requests? $requests->count() : '0'}}
                    Pending</span>
            </h6>
        </div>
        <div class="notification-scroll h-100">
            @forelse($requests as $request)
            <div class="dropdown-item">
                <div class="media server-log">
                    @if($request->employee->user->image)
                    <img src="{{asset('storage/'.$request->employee->user->image)}}" class="img-fluid me-2"
                        style="object-fit: cover" alt="avatar">
                    @else
                    {{
                    collect(explode(' ', $request->employee->name))
                    ->map(fn($name) => strtoupper(substr($name, 0, 1)))
                    ->take(2)
                    ->implode('')
                    }}
                    @endif
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">{{$request->employee->name}} request for {{$request->itemIn->product->name}}
                            </h6>
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
    <div class="dropdown-menu position-absolute" x-bind:class="{ 'show': open }" x-show="open"
        @click.outside="open = false" style="display: none">
        @if($approved->count()>0)
        <div class="drodpown-title message">
            <h6>Notification</h6>
        </div>
        @endif
        <div class="notification-scroll h-100" wire:poll.keep-alive>
            @forelse($approved as $approved)
            <div class="dropdown-item">
                <div class="media server-log">
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">Your request for {{$approved->itemIn->product->name}} has been approved.</h6>
                            <p class="">{{ $approved->updated_at->timezone('Asia/Kathmandu')->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
            @forelse($declined as $decline)
            <div class="dropdown-item">
                <div class="media server-log">
                    <div class="media-body">
                        <div class="data-info">
                            <h6 class="">Your request for {{$decline->itemIn->product->name}} has been declined.</h6>
                            <p class="">{{ $decline->updated_at->timezone('Asia/Kathmandu')->diffForHumans() }}
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