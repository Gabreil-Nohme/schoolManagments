<div class="col-xs-12">
    <div class="col-md-12">
        <br>
                <div class="content" >
                    <h5  style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        >
                        الاسئلة
                    </h5>

                </div>
                <div class="modal-body">
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Questions">



                                    @foreach ($questions as $question)

                                    <div data-repeater-item>
                                        <div class="form-row">
                                            <input type="hidden" name="Question_id"
                                                value="{{$question->id}}"
                                                >

                                            <div class="col " >
                                                <label for="title"> اسم السؤال بالعربي</label>
                                                <input type="text" name="title_ar" id="input-name"
                                                    class="form-control form-control-alternative"
                                                    value="{{$question->getTranslation('title','ar')}}">
                                                </div>
                                                    <div class="col " >
                                                    <label for="title"> اسم السؤال بالانكليزي</label>
                                                <input type="text" name="title_en" id="input-name"
                                                    class="form-control form-control-alternative"
                                                    value="{{$question->getTranslation('title','en')}}">

                                            </div>
                                        </div>
                                            <div class="form-row">
                                            <div class="col">
                                                <label for="title">الاجابات</label>
                                                <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4">
                                                    {{$question->answers}}
                                                </textarea>
                                            </div>
                                            <div class="col">
                                                <label for="title">الاجابة الصحيحة</label>
                                                <input type="text" name="right_answer" id="input-name"
                                                    class="form-control form-control-alternative"
                                                    value="{{$question->right_answer}}">

                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="Grade_id">الدرجة : <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select mr-sm-2" name="score">
                                                        <option  selected disabled > حدد الدرجة...
                                                        </option>
                                                        @for ($i = 5; $i <= 20; $i+=5)
                                                        <option {{$question->score == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="name_en"
                                                    class="mr-sm-2">{{ trans('classes_trans.Processes') }}
                                                    :</label>
                                                    <a href="{{ route('question.delete',$question->id) }}">
                                                <input class="btn btn-danger btn-block"
                                                    data-repeater-delete type="button"
                                                    value="{{ trans('classes_trans.delete_row') }}" />

                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr width="75%">
                                    @endforeach


                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="{{ trans('classes_trans.add_row') }}" />
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                                    <button type="submit"
                                        class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
                                </div>
                            </div>
                        </div>
                </div>

    </div>
</div>


