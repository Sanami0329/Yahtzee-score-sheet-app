<?php

namespace App\Livewire\Subusers;

use App\Models\Subuser;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddSubuser extends Component
{

    public string $subuserName;

    protected $messages = [
        'subuserName.unique' => '既存の名前と重複しています',
        'subuserName.max' => '10文字以内で入力してください',
    ];

    protected function rules()
    {
        return [
            'subuserName' => [
                'required',
                'string',
                'max:10',
                Rule::unique('subusers', 'name')
                    ->where('user_id', auth()->id()),
            ],
        ];
    }

    public function updatedSubuserName()
    {
        $this->validateOnly('subuserName'); //= $this->subuserName・rules()のキー・wire:model="subuserName"
    }


    public function save()
    {

        $this->validate();

        Subuser::create([
            'user_id' => auth()->id(),
            'name' => $this->subuserName,
        ]);

        return redirect()->route('subusers.show')->with('addStatus', 'メンバーを追加しました。');
    }

    public function render()
    {
        return view('livewire.subusers.add-subuser');
    }
}
