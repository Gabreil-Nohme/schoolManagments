<?php
namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    public function DashboardTeacher(){
        $ids=Teacher::findOrFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['sections']=$ids;
        $data['students']=Student::whereIn('section_id',$ids)->pluck('id');

        // You can to use two methods -------------->

        // $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        // $data['count_sections']=$ids->count();
        // $data['count_students']=DB::table('students')->whereIn('section_id',$ids)->count();

    return view('pages.Teachers.Dashboard.dashboard',$data);

    }


    public function getAllTeachers()
    {
        return Teacher::all();
    }
    public function getSpecialization()
    {
        return Specialization::all();
    }
    public function getGender()
    {
        return Gender::all();
    }
    public function StoreTeachers($request){

        try {
            $Teachers = new Teacher();
                $Teachers->Email = $request->Email;
                $Teachers->Password =  Hash::make($request->Password);
                $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
                $Teachers->Specialization_id = $request->Specialization_id;
                $Teachers->Gender_id = $request->Gender_id;
                $Teachers->Joining_Date = $request->Joining_Date;
                $Teachers->Address = $request->Address;
                $Teachers->save();
                toastr()->success(trans('messages.success'));
                return redirect()->route('teachers.create');
            }
            catch (Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }

        }
        public function UpdateTeacher($request){

            try{
                $Teachers=Teacher::findOrFail($request->id);
                $Teachers->email = $request->Email;
                $Teachers->password =  Hash::make($request->Password);
                $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
                $Teachers->Specialization_id = $request->Specialization_id;
                $Teachers->Gender_id = $request->Gender_id;
                $Teachers->Joining_Date = $request->Joining_Date;
                $Teachers->Address = $request->Address;
                $Teachers->save();
                toastr()->success(trans('messages.success'));
                return redirect()->route('teachers.index');
            }catch (Exception $e) {

                    return redirect()->back()->with(['error' => $e->getMessage()]);
                }
        }
        public function EditTeacher($id)
        {
          return Teacher::findOrFail($id);
        }
        public function DeleteTeacher($request)
        {

           Teacher::findOrFail($request->id)->delete();
          toastr()->success(trans('messages.success'));
                return redirect()->route('teachers.index');

        }

}



