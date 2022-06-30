<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $Attendance;
    public function __construct(AttendanceRepositoryInterface $Attendance)
    {
        $this->Attendance=$Attendance;
    }

    public function index()
    {
        return $this->Attendance->index();
    }

    public function show($id)
    {
        return $this->Attendance->show($id);
    }

    public function store(Request $request)
    {
        return $this->Attendance->store($request);
    }

    public function ReportAttendance()
    {
        return $this->Attendance->ReportAttendance();
    }

    public function SeachAttendance(Request $request)
    {
        return $this->Attendance->SeachAttendance($request);
    }



}
