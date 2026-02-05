<?php

namespace App\Livewire\Plays;

use Livewire\Component;
use App\Models\Play;
use App\Models\Player;
use Illuminate\Support\Facades\DB;


class PreparePlay extends Component
{
    public function mount()
    {
        // createplayでsessionに保存した内容を取り出し、playgameのための情報を再度sessionに保存

        $createdPlayers = session('created.players.data');

        if (!$createdPlayers) {
            return redirect()->route('play.create');
        }

        // 新しいplayを発行
        $play = Play::create([
            'user_id' => auth()->id(),
        ]);


        $playerArray = [];

        // Playersからuserを取得してplayerArrayに格納
        $userPlayer = Player::where([
            'user_id' => auth()->id(),
            'subuser_id' => null,
        ])->first();

        $playerArray[] = [
            'isRegistered' => true,
            'id' => $userPlayer->id,
            'name' => $userPlayer->name,
        ];


        // sessionに保存されたcreatedPlayersを取り出してplayersに追加
        foreach ($createdPlayers as $createdPlayer) {
            if ($createdPlayer['isRegistered']) {
                $subuserPlayer = Player::where('subuser_id', $createdPlayer['id'])->first();

                $playerArray[] = [
                    'isRegistered' => true,
                    'id' => $subuserPlayer['id'],
                    'name' => $subuserPlayer['name'],
                ];
            } else {
                $playerArray[] = [
                    'isRegistered' => false,
                    'id' => null,
                    'name' => $createdPlayer['name'],
                ];
            }
        }

        session([
            'play.id' => $play->id,
            'players' => $playerArray,
        ]);

        session()->forget('created.players.data');

        return redirect()->route('play.game');
    }

    public function render()
    {
        return null; // view不要
    }
}
