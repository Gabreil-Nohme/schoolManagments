@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        الملف الشخصي
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        الملف الشخصي
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->



    <div class="card-body">

        <section style="background-color: #eee;">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{URL::asset('assets/images/teacher.png')}}"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 205px;">
                            <h5 style="font-family: Cairo" class="my-3">{{$parent->email}}</h5>
                            <p class="text-muted mb-4">ولي الامر</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{route('parents.profile.store')}}" method="post">
                                @csrf
                               <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"> الايميل</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text"class="form-control" value="{{$parent->email}}" readonly>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                   <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">كلمة المرور الجديدة</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="password" id="password" class="form-control" name="password">
                                        </p>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">  تأكيد كلمة المرور</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="password" id="password1" class="form-control" name="conferm_password">
                                        </p><br><br>
                                        <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                               id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اظهار كلمة المرور</label>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">تعديل البيانات</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("password1");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
@endsection
