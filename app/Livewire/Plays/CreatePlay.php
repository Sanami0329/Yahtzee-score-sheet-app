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

    public function mount()
    {
        $this->playerArray[0] = [
            'isRegistered' => false,
            'id' => null,
            'name' => null,
        ];
    }

    public function updated($property) //プロパティ更新ごとの実行
    {
        $this->validateOnly($property);
    }

    public function chosen($subuserId, $index)
    {
        $subuser = Subuser::findOrFail($subuserId);

        $this->playerArray[$index] = [
            'isRegistered' => true,
            'id'   => $subuser->id,
            'name' => $subuser->name,
        ];
    }

    public function addInput($index)
    {
        $this->playerArray[$index + 1] = [
            'id' => false,
            'id' => null,
            'name' => null,
        ];
    }

    public function removeInput($index)
    {
        // 削除
        unset($this->playerArray[$index]);

        // 空欄詰め直し
        $this->filterPlayerArray();
    }

    private function filterPlayerArray()
    {
        $filteredArray = [];
        foreach ($this->players as $key => $player) {
            if (!empty($player['name'])) {
                $filtered[$key] = $player;
            }
        }

        $this->playerArray = $filteredArray;

        if (empty($this->playerArray)) {
            $this->playerArray[0] = [
                'isRegistered' => false,
                'id' => null,
                'name' => null,
            ];
        }
    }


    // バリデーション
    protected function rules()
    {
        return [
            'playerArray.*.name' => ['required', 'string', 'max:10'],
        ];
    }

    protected $message = [
        'playerArray.*.name.max' => '10文字以内で入力してください',
    ];


    public function save()
    {
        // 空欄詰め直し
        $this->filterPlayerArray();

        // インデックスキー詰め直し
        $this->playerArray = array_values($this->playerArray);

        $this->validate();

        session(['created.players.data' => $this->playerArray]);

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
