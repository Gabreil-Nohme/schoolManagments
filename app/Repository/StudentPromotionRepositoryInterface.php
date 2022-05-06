<?php

namespace App\Repository;

use App\Models\Grade;

interface StudentPromotionRepositoryInterface
{


    public function index();

    //create in table[promotion] and update students
    public function store($request);

    //route to page managment
    public function create();

    //rollpack in promotions of students
    public function destroy($request);
}
