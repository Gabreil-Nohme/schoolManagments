@extends('layouts.master')
@section('css')

@section('title')
    Quiz
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Quiz</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Quiz</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<?php
$i = 1;
$j = 0;
echo $id;
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
?>
<h3> غير محلول :لازم بس يعمل اعادة تحميل للصفحة تروح البيانات الحالية للقاعدة ويطلع من صفحة الامتحان</h3>
<form action="{{ route('ExamStudent.store') }}" method="POST">
    @csrf

    <input type="hidden" name="quiz_id" value="{{ $id }}">

    @if ($pageWasRefreshed)
        <script>
            window.location = "{{ route('student_exams.refresh.store', $id) }}"
        </script>
    @endif

    @foreach ($quistions as $quistion)
        <button class="btn btn-primary col-12" type="button" data-toggle="collapse"
            data-target="#collapseExample{{ $i }}" aria-expanded="false" aria-controls="collapseExample">
            {{ $i . ' :  ' . $quistion->title . ' score:  ' . $quistion->score }}
        </button>
        <br>
        <div class="collapse" id="collapseExample{{ $i }}">
            <div class="card-header">
                @foreach (explode('-', $quistion->answers) as $item)
                    <input type="radio" name="answers[{{ $quistion->id }}]" value="{{ $item }}"
                        id="id{{ $j }}">
                    <label for="id{{ $j }}">{{ $item }}</label><br>
                    <?php $j++; ?>
                @endforeach
            </div>
        </div>


        {{-- <div id="accordion">

        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-primary col-12" data-toggle="collapse"
                        data-target="#collapse{{ $i }}" aria-expanded="false"
                        aria-controls="collapse{{ $i }}">
                        {{ $i . ' :  ' . $quistion->title }}
                    </button>
                </h5>
            </div>
            <div id="collapse{{ $i }}" class="collapse" aria-labelledby="heading{{ $i }}"
                data-parent="#accordion">
                <div class="card-body">
                    @foreach (explode('-', $quistion->answers) as $item)
                    <input type="radio" name="id{{$i}}" id="id{{$j}}">
                    <label for="id{{$j}}">{{ $item }}</label><br>

                    @endforeach
                </div>
            </div>
        </div>

    </div> --}}
        <?php $i++; ?>
    @endforeach
    <input type="submit" value="finish">
</form>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
{{--تظهر في حال حدث الصفحة message  ناقص بس --}}
@endsection
