<?php

namespace App\Livewire\Scores;

use Livewire\Component;
use \App\Models\Score;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[title("スコア履歴")]
class ScoreHistory extends Component
{
    use WithPagination;

    public $sortBy = 'total';
    public $sortDirection = 'desc';

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'desc';
        }
    }


    public function render()
    {
        $playerId = auth()->user()->player->id;

        $scoreHistories = Score::with('play.scores.player')
            ->where('player_id', $playerId)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(20);

        return view('livewire.scores.score-history', [
            'scoreHistories' => $scoreHistories
        ]);
    }
}
