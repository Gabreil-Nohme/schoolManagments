<?php

namespace App\Repository;

use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class QuizzRepository implements QuizzRepositoryInterface
{

    public function index()
    {
        if(auth('teacher')->check())
        $quizzes = Quizze::where('teacher_id',auth()->user()->id)->get();
        else
        $quizzes = Quizze::get();

        return view('pages.Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.create', $data);
    }

    public function store($request)
    {
        DB::beginTransaction();
        $List_Questions = $request->List_Questions;

        try {

            $quizzes = new Quizze();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();

            $quizz = Quizze::latest('created_at')->first();
            foreach ($List_Questions as $List) {

                $question = new Question();
                $question->title =['en' => $List['title_en'], 'ar' =>$List['title_ar']];
                $question->answers =$List['answers'];
                $question->right_answer =$List['right_answer'];
                $question->score =$List['score'];
                $question->quizze_id =$quizz->id;
                $question->save();
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Quizzes.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $quizz = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['sections'] = Section::all();
        $data['questions'] = Question::where('quizze_id',$id)->get();
        $data['classRoom'] = ClassRooms::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }

    public function update($request)
    {
        $Questions=  Question::where('quizze_id',$request->id)->get();

        DB::beginTransaction();
        $List_Questions = $request->List_Questions;

        try {

            $quizzes = Quizze::findorFail($request->id);
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();

            foreach ($List_Questions as $List) {

                // foreach( $Questions as $Question){
                //     if($Question->id !=$List['Question_id'])
                //     Question::destroy($Question->id);
                //     }

                Question::UpdateOrCreate(
                    [
                        //update  اذا تحقق الشرط بيعمل
                        //بيضل يمشي بالحلقة كل ما تنفذ الشرط بيحدث
                        //insert بيعمل  id وبس ما لقى
                        'id' => $List['Question_id'],
                    ],
                     [
                        'title' =>['en' => $List['title_en'], 'ar' =>$List['title_ar']],
                        'answers' =>$List['answers'],
                        'right_answer' =>$List['right_answer'],
                        'score' =>$List['score'],
                        'quizze_id' =>$quizzes->id,
                ]);
                //    ======== old methods ===========   //
                // $question =Question::findorFail($List['Question_id']);
                // $question->title =['en' => $List['title_en'], 'ar' =>$List['title_ar']];
                // $question->answers =$List['answers'];
                // $question->right_answer =$List['right_answer'];
                // $question->score =$List['score'];
                // $question->quizze_id =$quizzes->id;
                // $question->save();

            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Question::findOrFail($request->id)->destroy();
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
