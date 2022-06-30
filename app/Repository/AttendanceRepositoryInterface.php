<?php


namespace App\Repository;


interface AttendanceRepositoryInterface
{
    public function index();

    public function show($id);

    public function store($request);

    public function ReportAttendance();

    public function SeachAttendance($request);
}
