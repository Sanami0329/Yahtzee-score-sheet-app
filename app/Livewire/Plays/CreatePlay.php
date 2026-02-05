<?php

namespace App\Livewire\Plays;

use App\Models\Play;
use App\Models\Subuser;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;

#[Title("プレーヤー入力")]
class CreatePlay extends Component
{

    public $playerArray = [];

    // #[Validate('max:10')]
    // public $tmpPlayer;

    // public array $tmpPlayerArray = [];

    // public $subuserArray = [];


    public function mount()
    {
        $this->playerArray = [''];
    }


    public function addInput()
    {
        $this->tmpPlayerArray[] = '';
    }

    public function removeInput($index)
    {
        // 削除
        unset($this->tmpPlayerArray[$index]);
        // 空欄詰め直し
        $this->tmpPlayerArray = array_values($this->tmpPlayerArray);
    }

    public function getPlayerStatus($index)
    {
        if (!isset($this->playerArray[$index])) {
            return null;
        } elseif ($this->playerArray[$index]['id'] !== null) {
            return 'registered';
        } else {
            return 'temporary';
        }
    }

    public function chosen($subuserId, $index)
    {
        $subuser = Subuser::findOrFail($subuserId);

        $this->playerArray[$index] = [
            'id'   => $subuser->id,
            'name' => $subuser->name,
        ];
    }

    public function updatedTmpPlayer($index) //updatedをつけてプロパティ更新直後に実行
    {
        $this->validateOnly("tmpPlayerArray.$index");
    }

    public function save()
    {
        // 空欄を除外
        $this->tmpPlayerArray = array_filter($this->tmpPlayerArray);

        $this->tmpPlayerArray = array_values($this->tmpPlayerArray);

        $this->validate();

        $subusersData = [];


        $subusersData[] = [
            'id' => $subuser->id,
            'name' => $subuser->name,
        ];
        session(['subusers.data' => $subusersData,]);

        return redirect()->route('play.prepare');
    }

    public function render()
    {
        $subusers = Subuser::where('user_id', auth()->id())->paginate(10);

        return view('livewire.plays.create-play', [
            'subusers' => $subusers
        ]);
    }
}
