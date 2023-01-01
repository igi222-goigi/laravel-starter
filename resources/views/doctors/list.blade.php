@extends('layouts.main')
@section('title', 'Banner List')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endpush


<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-Banners bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Banner')}}</h5>
                        <span>{{ __('List of banners')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Banners')}}</a>
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
            <div class="card p-3">
                <div class="card-header">
                    <h3>{{ __('Banners')}}</h3>
                </div>
                <div class="card-body">
                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Image')}}</th>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('Description')}}</th>
                                <th>{{ __('Status')}}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- push external js -->
@push('script')
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<!--server side Banners table script-->
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    //Banners data table
    $(document).ready(function() {
        var searchable = [];
        var selectable = [];

        var dTable = $("#data_table").DataTable({
            order: [],
            processing: true,
            responsive: false,
            serverSide: true,
            processing: true,
            language: {
                processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: "banners/get-list",
                type: "get"
            },
            columns: [
                /*{data:'serial_no', name: 'serial_no'},*/
                {
                    data: "banner_image",
                    name: "banner_image",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "banner_name",
                    name: "banner_name"
                },
                {
                    data: "banner_description",
                    name: "banner_description"
                },
                {
                    data: "active_status",
                    name: "active_status"
                },
                //only those have manage_user permission will get access
                {
                    data: "action",
                    name: "action"
                }
            ],
            buttons: [{
                    extend: "copy",
                    className: "btn-sm btn-info",
                    title: "Banners",
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: "csv",
                    className: "btn-sm btn-success",
                    title: "Banners",
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: "excel",
                    className: "btn-sm btn-warning",
                    title: "Banners",
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: "pdf",
                    className: "btn-sm btn-primary",
                    title: "Banners",
                    pageSize: "A2",
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: "print",
                    className: "btn-sm btn-default",
                    title: "Banners",
                    // orientation:'landscape',
                    pageSize: "A2",
                    header: true,
                    footer: false,
                    orientation: "landscape",
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ]
        });
    });
</script>
@endpush
@endsection