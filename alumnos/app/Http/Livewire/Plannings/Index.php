<?php

namespace App\Http\Livewire\Plannings;

use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $subjects;

    public $searchTerm = "";

    public function render()
    {
        $this->onSearchSubject();
        return view('livewire.plannings.index', [
            'subjects' => $this->subjects
        ]);
    }

    public function onSearchSubject()
    {
        if(!$this->searchTerm){
            $this->subjects = Subject::paginate(0)->empty();
            return;
        }

        $this->subjects = Subject::search($this->searchTerm)->approved()->paginate(10);
        $this->resetPage();
    }
}
