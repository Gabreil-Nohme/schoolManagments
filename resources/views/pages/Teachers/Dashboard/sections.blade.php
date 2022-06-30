@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Sections_trans.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Sections_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <h1>الاقسام</h1>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">


                            <div class="tab-pane fade active show"  role="tabpanel" aria-labelledby="students-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                        <tr  class="table-info text-danger">
                                            <th>#</th>
                                            <th>القسم</th>
                                            <th>الصف</th>
                                            <th>الحالة</th>
                                            <th>عرض الطلاب</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sections as $section)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$section->name_section}}</td>
                                                <td>{{$section->grades->name}}</td>
                                                <td>
                                                    @if ($section->status === 1)
                                                    <label
                                                        class="badge badge-success md-2">{{ trans('Sections_trans.Status_Section_AC') }}</label>
                                                @else
                                                    <label
                                                        class="badge badge-danger">{{ trans('Sections_trans.Status_Section_No') }}</label>
                                                @endif

                                                <td><a href="{{route('teacher.stuents')}}">عرض الطلاب</a></td>


                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>
        <!-- row closed -->
        @endsection

