<?php

namespace App\Livewire;

use Livewire\Component;
use \Livewire\WithPagination;
use \App\Models\Score;
class ScoreHistory extends Component
{
    public $sortBy = 'score';
    public $sortDirection = 'asc';

    public function sort($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function histories()
    {
        return Score::with('play.scores.player')
            ->where('player_id', auth()->id())
            ->orderBy('total', 'desc')
            ->paginate(10);
    }


    public function render()
    {
        return view('livewire.score-history');
    }
}
