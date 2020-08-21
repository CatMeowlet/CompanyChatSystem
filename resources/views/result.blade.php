@extends('layouts.user__app')

@section('content')
<div class="col-md-7">
    <div class="card">
        <div class="card-header">{{ __('Search Result') }}</div>
        <div class="card-body">
            @if(count($data) > 0)
            @foreach ($data as $data)
            <div class="card my-5" style="flex-direction:row;">
                <img class="card-img-top" style="width: 170px; height: inherit;"
                    src="{{ url('assets/images/avatar/'.$data->profile->avatar)  }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $data->name}}</h5>
                    <p class="card-text">{{ $data->profile->bio }}</p>
                    <a href="{{ url('profile/'.$data->profile->user_id) }}" class="btn btn-primary">Button</a>
                </div>
            </div>
            @endforeach

            @else
            <div class="row justify-content-center p-5">
                <p>No Posts Found</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
