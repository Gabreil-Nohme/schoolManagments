<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;
use Livewire\Component ;

class Counter extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search='';

    public function render()
    {
        if(!empty($this->search)){
            return view('livewire.counter',[
                'users' =>  User::where('name', 'like', '%'.$this->search.'%')->paginate(1),
            ]);
            }else{
                return view('livewire.counter');
            }


    }


}
