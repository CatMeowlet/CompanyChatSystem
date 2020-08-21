@extends('layouts.user__app')

@section('content')

<div class="col-md-7">
    @if( Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }}" role="alert" style="top:0;right:0; position:static;">{{ Session::get('message') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">{{ __('Profile') }}</div>
        <div class="card-body">
            <div class="container-md">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex justify-content-start rounded" id="image-holder">
                            <img class="img-thumbnail" id="image-current"
                                src="{{ url('assets/images/avatar/'.$auth_profile->avatar)  }}">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="text-center text-sm-left">
                            <h1 class="my-0 text-nowrap">{{ $auth_details->name }}</h1>
                            <p class="my-0">{{ $auth_details->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-start px-3 mt-4 ">

                    <form enctype="multipart/form-data" method="POST" action="{{ route('user.profile_update') }}">
                        <div class="mt-2" id="file-upload">
                            <input type="file" id="BtnBrowseHidden" name="files"
                                style="display: none; position: absolute;" class="form-control" />
                            <label for="BtnBrowseHidden" id="LblBrowse">
                                <span class="badge-primary p-2">
                                    <i class="fa fa-fw fa-camera"></i> Change
                                </span>
                                <div class="text-muted mt-2">
                                    <p>Picture: <small class="file-name">Please select a
                                            file.</small></p>
                                </div>
                            </label>
                        </div>
                </div>
            </div>
            <div class="text-center text-sm-right">
                <span class="badge badge-secondary">{{$auth_profile->job_title }}</span>
                <div class="text-muted"><small>Joined
                        {{\Carbon\Carbon::parse($auth_details->created_at)->format('m/d/Y') }}</small>
                </div>
            </div>
            <div class="container-md mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input class="form-control" type="text" name="full_name" placeholder="Full Name"
                                value=" {{$auth_details->name}} " />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" placeholder="user@example.com"
                                value="{{$auth_details->email}}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>About</label>
                            <textarea class="form-control" name="bio" rows="5"
                                placeholder="My Bio">{{$auth_profile->bio}}</textarea>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>

                </div>
            </div>
            </form>
        </div>
    </div>

</div>
@endsection
