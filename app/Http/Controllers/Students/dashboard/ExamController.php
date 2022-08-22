<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quizze::where('grade_id', auth()->user()->Grade_id)
            ->where('classroom_id', auth()->user()->Classroom_id)
            ->where('section_id', auth()->user()->section_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('pages.students.dashboard.exams.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $score= 0 ;
        if($request->answers ){
            $quistions = Question::where('quizze_id', $request->quiz_id)->get();
            foreach ($request->answers as $key => $answer) {
                foreach ($quistions as $quistion) {
                    if ($answer == $quistion->right_answer &&  $key == $quistion->id) {

                        $score += $quistion->score;
                    } elseif ($key != $quistion->id) {
                        continue;
                    } else {
                        $score += 0;
                    }
                }
            }
            Degree::Create(
                [
                    'quizze_id' => $request->quiz_id,
                    'student_id' => auth()->user()->id,
                    'question_id' => "0",
                    'score' => $score,
                    'abuse' => "0",
                ]
            );
            return redirect()->route('ExamStudent.index');
        // echo redirect()->back()->withErrors(['errors'=>'you have answers all quistions']);
        }else{
            Degree::Create(
                [
                    'quizze_id' => $request->quiz_id,
                    'student_id' => auth()->user()->id,
                    'question_id' => "0",
                    'score' => "0",
                    'abuse' => "0",
                ]
            );
            echo redirect()->route('ExamStudent.index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quistions=Question::where('quizze_id',$id)->get();

        return view("pages.students.dashboard.exams.onlinequiz",compact("quistions","id")) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    //if student refresh the Exam page
    public function refreshStore($id)
    {
        Degree::Create(
            [
                'quizze_id' => $id,
                'student_id' => auth()->user()->id,
                'question_id' => "0",
                'score' => "0",
                'abuse' => "0",
            ]
        );
        return redirect()->route('ExamStudent.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
