<?php

namespace App\Http\Livewire\Subjects;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
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
        return view('livewire.subjects.index', [
            'subjects' => $this->subjects
        ]);
    }

    private function onSearchSubject()
    {
        $this->subjects = Subject::orderBy('title', 'asc')
            ->search($this->searchTerm)
            ->paginate(10);

        $this->resetPage();
    }
}
