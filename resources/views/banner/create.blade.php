@extends('layouts.main')
@section('title', 'Add Banners')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
@endpush


<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Add Banners')}}</h5>
                        <span>{{ __('Add new banners')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Add Banners')}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- start message area-->
        @include('include.message')
        <!-- end message area-->
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h3>{{ __('Add banner')}}</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="{{ route('create-banner') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label for="name">{{ __('Banner Name')}}<span class="text-red">*</span></label>
                                    <input type="text" class="form-control @error('banner_name') is-invalid @enderror" name="banner_name" value="{{old('banner_name')}}" placeholder="Enter banner name">
                                    <div class="help-block with-errors"></div>

                                    @error('banner_name')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('Banner Description')}}<span class="text-red">*</span></label>
                                    <textarea name="banner_description" class="form-control @error('banner_description') is-invalid @enderror" cols=" 30" rows="10">{{old('banner_description')}}</textarea>
                                    <div class="help-block with-errors"></div>

                                    @error('banner_description')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                            </div>
                            <div class="col-md-6">
                                <!-- Assign role & view role permisions -->

                                <div class="form-group">
                                    <label>{{ __('File upload')}}<span class="text-red">*</span></label>
                                    <input type="file" name="banner_image" class="file-upload-default @error('banner_image') is-invalid @enderror" value="{{old('banner_image')}}">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info @error('banner_image') is-invalid @enderror" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">{{ __('Upload')}}</button>
                                        </span>
                                    </div>

                                    @error('banner_image')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('Status')}}<span class="text-red">*</span></label>
                                    <select name="active_status" class="form-control" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <!-- 
                                <div class="form-group">
                                    <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                </div> -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- push external js -->
@push('script')
<script src="{{ asset('js/form-components.js') }}"></script>
@endpush
@endsection