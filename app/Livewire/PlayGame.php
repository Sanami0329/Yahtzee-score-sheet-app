<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;


#[Title("Yahtzee Play")]
class PlayGame extends Component
{
    public int $playId;
    public array $players = [];

    public array $validationResult = [];
    public ?string $errorMsg = null;


    public function mount()
    {
        // sessionからデータを受け取る
        $this->playId = session('play_id');
        $this->players = session('players');

        if (!$this->playId || empty($this->players)) {
            return redirect()->route('play.create');
        }

    }


    /*
     save() →　validation-resultを受け取り実行する
    */

    protected $listeners = [
        'send-validation-result' => 'validationResultUpdate',
    ];

    public function validationResultUpdate($playerId, $errorMessage)
    {
        $this->validationResult[$playerId] = $errorMessage;

        // 全player分のvalidationResultが揃ったらtrySaveを実行
        if (count($this->validationResult) === count($this->players)) {
            $this->trySave();
        }
    }

    public function trySave()
    {
        if (!$this->canSave()) {
            $this->dispatch('show-validation-error', error: $this->errorMsg);
            $this->validationResult = [];
            return;
        }

        $this->dispatch('save-player-score');
        $this->validationResult = [];
    }

        private function canSave(): bool
    {
        foreach ($this->validationResult as $error) {
            if ($error !== null) {
                $this->errorMsg = $error;
                return false;
            }
        }

        return true;
    }


    public function save()
    {
        $this->dispatch('request-validation');
    }

    public function render()
    {
        return view('livewire.play-game', ['players' => $this->players]);
    }
}
