<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{

    public $Graduated;

     public function __construct(StudentGraduatedRepositoryInterface $Graduated)
     {
         $this->Graduated=$Graduated;
     }

    public function index()
    {
        return $this->Graduated->index();
    }

    public function create()
    {
        return $this->Graduated->create();
    }


    public function store(Request $request)
    {//نقوم بحذف الطالب لسلة المحذوفات ويبقى بالقاعدة
        return $this->Graduated->SoftDelete($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function update(Request $request)
    {
       return $this->Graduated->ReturnData($request);
    }


    public function destroy(Request $request)
    {
        return $this->Graduated->destroy($request);
    }

    public function OneSoftDelete(Request $request)
    {
        return $this->Graduated->OneSoftDelete($request);
    }


}
