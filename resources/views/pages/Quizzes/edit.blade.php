@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    اضافة اختبار جديد
@stop
@endsection
@section('page-header')
 تعديل اختبار : {{$quizz->name}}
@section('PageTitle')
    اضافة اختبار جديد
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('Quizzes.update','test')}}" method="post" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <input type="hidden" name="id" value="{{$quizz->id}}">
                                    <div class="col">
                                        <label for="title">اسم الاختبار باللغة العربية</label>
                                        <input type="text" name="Name_ar" value="{{$quizz->getTranslation('name','ar')}}" class="form-control">
                                    </div>

                                    <div class="col">
                                        <label for="title">اسم الاختبار باللغة الانجليزية</label>
                                        <input type="text" name="Name_en" value="{{$quizz->getTranslation('name','en')}}" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">المادة الدراسية : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="subject_id">
                                                <option  disabled>حدد المادة الدراسية...</option>

                                                @foreach($subjects as $subject)
                                                    <option {{$quizz->subject_id == $subject->id ? 'selected': ''}}  value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if (!auth('teacher')->check())

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">اسم المعلم : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>حدد اسم المعلم...</option>
                                                @foreach($teachers as $teacher)
                                                    <option {{$quizz->teacher_id == $teacher->id ? 'selected': ''}}  value="{{ $teacher->id }}">{{ $teacher->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @else
                                    <input type="hidden" name="teacher_id" value="{{auth()->user()->id}}">
                                    @endif
                                </div>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Grade_id">
                                                <option  disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option {{$quizz->grade_id == $grade->id ? 'selected': ''}} value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Classroom_id">
                                                <option  disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($classRoom as $class)
                                                    <option {{$quizz->classroom_id == $class->id ? 'selected': ''}} value="{{$class->id}}">{{$class->name_class}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                <option  disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($sections as $section)
                                                    <option {{$quizz->section_id == $section->id ? 'selected': ''}} value="{{$section->id}}">{{$section->name_section}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                @include('pages.Questions.edit')
                               
                            </form>
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
