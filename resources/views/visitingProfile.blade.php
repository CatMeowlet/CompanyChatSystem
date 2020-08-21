@extends('layouts.user__app')

@section('content')
<div class="col-md-7">
    <div class="card">
        <div class="card-header">{{ __('Profile') }}</div>

        <div class="card-body">
            <div class="container-md">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex justify-content-start rounded" id="image-holder">
                            <img class="img-thumbnail" id="image-current"
                                src="{{ url('assets/images/avatar/'.$visit_profile->profile->avatar)  }}">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="text-center text-sm-left">
                            <h1 class="my-0 text-nowrap">{{ $visit_profile->name }}</h1>
                            <p class="my-0">{{ $visit_profile->email }}</p>
                        </div>
                        <div class="mt-2 text-center text-sm-left menu"
                            data-profile="{{ $visit_profile->profile->user_id }}">

                            {{--  check if auth user already added this profile or not  --}}
                            @if(Auth::check())
                            {{--  check if auth has added someone  --}}
                                @if(Auth::user()->friends()->count() != 0 )
                                    {{--  get all data in friends where auth user is user1 ( requester )  --}}
                                    @foreach(Auth::user()->friends as $user_1)
                                        {{--  check user2 ( the requested ) if matched the visited profile  --}}
                                        @if($user_1->user2->id == $visit_profile->profile->user_id)
                                        <a href="#" class="btn btn-primary btn-sm pending disabled" id="btn-pending">Pending</a>
                                        <a href="#" class="btn btn-secondary btn-sm cancel " id="btn-cancel">Cancel</a>
                                        @endif
                                    @endforeach
                                @endif

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center text-sm-right">
                <span class="badge badge-secondary">{{$visit_profile->profile->job_title }}</span>
                <div class="text-muted"><small>Joined
                        {{\Carbon\Carbon::parse($visit_profile->created_at)->format('m/d/Y') }}</small>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
