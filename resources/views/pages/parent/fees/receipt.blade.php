@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    معلومات الفواتير
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    معلومات الفواتير
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

                        <!-- الفواتير -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                    style="text-align: center">
                                    <h3>الرسوم </h3>
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>المبلغ</th>
                                            <th>البيان</th>
                                            <th>نوع الرسوم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fee_invoices as $fee_invoice)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $fee_invoice->student->name }}</td>
                                                <td>{{ number_format($fee_invoice->amount, 2) }}</td>
                                                <td>{{ $fee_invoice->description }}</td>
                                                <td>{{ $fee_invoice->fees->title }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" style="background-color: rgb(97, 192, 97); color: black">
                                                {{ number_format($fee_invoices->sum('amount'), 2) }}</td>
                                        </tr>
                                </table>
                            </div>
                        </div>

                        {{-- //المدفوعات --}}
                        @if ($receipt_students->IsNotEmpty())
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                        style="text-align: center">
                                        <h3> المدفوعات</h3>
                                        <thead>
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>المبلغ</th>
                                                <th>الوصف</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($receipt_students as $receipt_student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $receipt_student->student->name }}</td>
                                                    <td>{{ number_format($receipt_student->Debit, 2) }}</td>
                                                    <td>{{ $receipt_student->description }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4"
                                                    style="background-color: rgb(97, 192, 97); color: black">
                                                    {{ number_format($receipt_student->sum('Debit'), 2) }}
                                                </td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        @endif

                        {{-- //المبلغ المسترد --}}
                        @if ($Payment_students->IsNotEmpty())
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                        style="text-align: center">
                                        <h3> المبلغ المسترد </h3>
                                        <thead>
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>المبلغ</th>
                                                <th>الوصف</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Payment_students as $Payment_student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $Payment_student->student->name }}</td>
                                                    <td>{{ number_format($Payment_student->amount, 2) }}</td>
                                                    <td>{{ $Payment_student->description }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4"
                                                    style="background-color: rgb(219, 43, 52); color: black">
                                                    {{ number_format($Payment_student->sum('amount'), 2) }}
                                                </td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        @endif

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
