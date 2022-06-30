<?php

namespace App\Repository;

use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function index()
    {
        if(auth('teacher')){
        $quizzes = Quizze::where('teacher_id',auth()->user()->id)->pluck('id');
        $questions=Question::whereIn('quizze_id',$quizzes)->get();
        }else{
            $questions=Question::get();
        }
        return view('pages.Questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizze::get();
        return view('pages.Questions.create', compact('quizzes'));
    }

    public function store($request)
    {
        // DB::beginTransaction();
        // $List_Questions = $request->List_Questions;

        // try {

        //     $quizzes = new Quizze();
        //     $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        //     $quizzes->subject_id = $request->subject_id;
        //     $quizzes->grade_id = $request->Grade_id;
        //     $quizzes->classroom_id = $request->Classroom_id;
        //     $quizzes->section_id = $request->section_id;
        //     $quizzes->teacher_id = $request->teacher_id;
        //     $quizzes->save();

        //     $quizz = Quizze::latest('created_at')->first();
        //     foreach ($List_Questions as $List) {

        //         $question = new Question();
        //         $question->title =['en' => $List['title_en'], 'ar' =>$List['title_ar']];
        //         $question->answers =$List['answers'];
        //         $question->right_answer =$List['right_answer'];
        //         $question->score =$List['score'];
        //         $question->quizze_id =$quizz->id;
        //         $question->save();
        //     }
        //     DB::commit();
        //     toastr()->success(trans('messages.success'));
        //     return redirect()->route('Quizzes.create');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->back()->with(['error' => $e->getMessage()]);
        // }
    }

    public function edit($id)
    {
        $question = Question::findorfail($id);
        $quizzes = Quizze::get();
        return view('pages.Questions.edit', compact('question', 'quizzes'));
    }

    public function update($request)
    {
        try {
            $question = Question::findorfail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizze_id;
            $question->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Question::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
    try {
        Question::findOrFail($id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

}
