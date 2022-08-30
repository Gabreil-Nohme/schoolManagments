
@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
الفواتير الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
الفواتير الدراسية
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr class="alert-success">
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>اجمالي الحساب</th>
                                        <th>باقي الحساب</th>
                                        <th>الصف الدراسي</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$student->fee_invoices->sum('amount')}}</td>
                                        <td>{{$student->fee_invoices->sum('amount') - $student->receipts_student->sum('Debit') }}</td>
                                        <td>{{$student->classroom->name_class}}</td>
                                        <td>
                                            <a href="{{route('sons.receipt',$student->id)}}"  class="btn btn-info btn-sm" role="button" aria-pressed="true">عرض التفاصيل</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                            <h3>باااااااقيي معالجة واستبعاد الرسوومم لا تنساهننننن</h3>
J
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
