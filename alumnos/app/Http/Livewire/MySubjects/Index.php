<?php

namespace App\Http\Livewire\MySubjects;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm = "";
    private $subjects;

    public function mount()
    {
        $this->subjects = auth()->user()->subjects;
    }

    public function render()
    {
        $this->onSearchSubject();
        return view('livewire.subjects.index', [
            'subjects' => $this->subjects
        ]);
    }

    private function onSearchSubject()
    {
        $this->subjects = auth()->user()->subjects()
            ->search($this->searchTerm)
            ->paginate(10);

        $this->resetPage();
    }
}
