@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{__('main_trans.Grades')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{__('main_trans.Grades')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <!-- ERRORS -->
 @if ($errors->any())
<div class="alert alert-danger">
     <ul>
        @foreach ($errors->all() as $error)
            <small class="form-text text-danger">{{$error}}</small>
         @endforeach
     </ul>
 </div>
        @endif


    <div class="col-xl-12 mb-30">
      <div class="card card-statistics h-100">
        <div class="card-body">
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{__('grade_trans.add_Grade') }}
            </button>
            <button type="button" class="button x-small" id="btn_delete_all">
                {{ trans('classes_trans.delete_checkbox') }}
            </button>
            <br><br>
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                    <th>#</th>
                    <th>{{__('grade_trans.Name')}}</th>
                    <th>{{__('grade_trans.Notes')}}</th>
                    <th>{{__('grade_trans.Processes')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade )
                    <tr>
                        <td><input type="checkbox"  value="{{ $grade->id }}" class="box1" ></td>
                        <td>{{$grade->id}}</td>
                        <td>{{$grade->name}}</td>
                        <td>{{$grade->notes}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#edit{{ $grade->id }}"
                                title="{{ trans('grade_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $grade->id }}"
                                title="{{ trans('grade_trans.Delete') }}"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>


                     <!-- edit_modal_Grade -->
                     <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                       id="exampleModalLabel">
                                       {{ trans('grade_trans.edit_Grade') }}
                                   </h5>
                                   <button type="button" class="close" data-dismiss="modal"
                                           aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <div class="modal-body">
                                   <!-- add_form -->
                                   <form action="{{route('grades.update','test')}}" method="post">
                                       {{method_field('patch')}}
                                       @csrf
                                       <div class="row">
                                           <div class="col">
                                               <label for="Name"
                                                      class="mr-sm-2">{{ trans('grade_trans.stage_name_ar') }}
                                                   :</label>
                                               <input id="name_ar" type="text" name="name_ar"
                                                      class="form-control"
                                                      value="{{$grade->getTranslation('name', 'ar')}}"
                                                      required>
                                               <input id="id" type="hidden" name="id" class="form-control"
                                                      value="{{ $grade->id }}">
                                           </div>
                                           <div class="col">
                                               <label for="name_en"
                                                      class="mr-sm-2">{{ trans('grade_trans.stage_name_en') }}
                                                   :</label>
                                               <input type="text" class="form-control"
                                                      value="{{$grade->getTranslation('name', 'en')}}"
                                                      name="name_en" required>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label
                                               for="exampleFormControlTextarea1">{{ trans('grade_trans.Notes') }}
                                               :</label>
                                           <textarea class="form-control" name="notes"
                                                     id="exampleFormControlTextarea1"
                                                     rows="3">{{ $grade->notes }}</textarea>
                                       </div>
                                       <br><br>

                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary"
                                                   data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                                           <button type="submit"
                                                   class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
                                       </div>
                                   </form>

                               </div>
                           </div>
                       </div>
                   </div>

                   <!-- delete_modal_Grade -->
                   <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                       id="exampleModalLabel">
                                       {{ trans('grade_trans.Delete') }}
                                   </h5>
                                   <button type="button" class="close" data-dismiss="modal"
                                           aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <div class="modal-body">
                                   <form action="{{route('grades.destroy','test')}}" method="post">
                                       {{method_field('Delete')}}
                                       @csrf
                                       {{ trans('grade_trans.Warning_Grade') }}
                                      <b> {{$grade->name}}</b>

                                       <input id="id" type="hidden" name="id" class="form-control"
                                              value="{{ $grade->id }}">
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary"
                                                   data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                                           <button type="submit"
                                                   class="btn btn-danger">{{ trans('grade_trans.submit') }}</button>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>

                @endforeach

            </tbody>


         </table>
        </div>
        </div>
      </div>
    </div>
    <!-- add_modal_grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('grade_trans.add_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('Grade_trans.stage_name_ar') }}
                                :</label>
                            <input id="name_ar" type="text" name="name_ar" class="form-control">

                        </div>

                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('grade_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('grade_trans.Notes') }}
                            :</label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
            </div>
            </form>

        </div>
    </div>
    </div>
    <!-- حذف مجموعة صفوف -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
               {{ trans('classes_trans.delete_class') }}
           </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>

       <form action="{{ route('delete_all_grade') }}" method="POST">
           {{ csrf_field() }}
           <div class="modal-body">
               {{ trans('classes_trans.Warning') }}
               <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
           </div>

           <div class="modal-footer">
               <button type="button" class="btn btn-secondary"
                       data-dismiss="modal">{{ trans('classes_trans.Close') }}</button>
               <button type="submit" class="btn btn-danger">{{ trans('classes_trans.submit') }}</button>
           </div>
       </form>
   </div>
</div>
</div>

<!-- end_modal_Grade -->
</div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
    @toastr_render
@endsection
