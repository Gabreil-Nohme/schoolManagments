<div class="col-xs-12">
    <div class="col-md-12">
        <br>
        <div class="content">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title">
                الاسئلة
            </h5>

        </div>
        <div class="modal-body">
            <div class="card-body">
                <div class="repeater">
                    <div data-repeater-list="List_Questions">
                        <div data-repeater-item>

                            <div class="row">

                                <div class="col">
                                    <label for="title"> اسم السؤال بالعربي</label>
                                    <input type="text" name="title_ar" id="input-name"
                                        class="form-control form-control-alternative" autofocus>
                                </div>
                                <div class="col">
                                    <label for="title"> اسم السؤال بالانكليزي</label>
                                    <input type="text" name="title_en" id="input-name"
                                        class="form-control form-control-alternative" autofocus>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <label for="title">الاجابات</label>
                                    <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                </div>
                                <div class="col">
                                    <label for="title">الاجابة الصحيحة</label>
                                    <input type="text" name="right_answer" id="input-name"
                                        class="form-control form-control-alternative" autofocus>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">الدرجة : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="score">
                                            <option selected disabled> حدد الدرجة...
                                            </option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="name_en" class="mr-sm-2">{{ trans('classes_trans.Processes') }}
                                        :</label>
                                    <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                        value="{{ trans('classes_trans.delete_row') }}" />
                                </div>
                            </div>

                        </div>
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
                        <button type="submit" class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
