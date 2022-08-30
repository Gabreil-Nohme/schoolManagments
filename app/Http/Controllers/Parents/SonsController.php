<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\PaymentStudent;
use App\Models\ReceiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SonsController extends Controller
{
    public function index()
    {
        $sons = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parent.sons.index', compact('sons'));
    }
    public function result($id)
    {
        $student = Student::find($id);
        if( empty($student)|| $student->parent_id !== auth()->user()->id){
            toastr()->error('في حال التلاعب في عرض السجلات سيتم حظر حسابك');
            return redirect()->route('sons.index');
        }
        $degrees = Degree::where('student_id', $id)->get();
            if($degrees->isNotEmpty()){
            return view('pages.parent.degree.index',compact('degrees'));
        }else{
            toastr()->success('لايوجد بيانات لعرضها');
            return redirect()->back();
        }
    }
    public function attendance(){
        $students  = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parent.attendance.index',compact('students'));

    }
    public function attendance_search(Request $request){

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        $ids  = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $students  = Student::where('parent_id', auth()->user()->id)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
            ->whereIn('student_id',$ids)->get();
            return view('pages.parent.attendance.index', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.parent.attendance.index', compact('Students', 'students'));
        }

    }
    public function fees(){

        $students = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parent.fees.index',compact('students'));
    }

    public function receipt($id){
        $student = Student::find($id);
        if (empty($student) || $student->parent_id !== auth()->user()->id) {
            toastr()->error('في حال التلاعب في عرض السجلات سيتم حظر حسابك');
            return redirect()->route('sons.fees');
        }
        $fee_invoices  = Fee_invoice::where('student_id',$id)->get(); //فواتير
        $receipt_students  = ReceiptStudent::where('student_id',$id)->get(); //مدفوعات
        $Payment_students = PaymentStudent::where('student_id',$id)->get();// سند صرف
        return view('pages.parent.fees.receipt',
        compact('student', 'fee_invoices', 'receipt_students', 'Payment_students'));
    }

}
