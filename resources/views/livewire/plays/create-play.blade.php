<div class="flex justify-center sm:pt-8">

    <div class="overflow-x-auto min-w-xl h-dvh sm:h-auto bg-gray-50 px-10 pt-4 pb-8 text-zinc-900">

        <h1 class="m-4 font-semibold text-lg text-center">プレーヤーの名前を入力してください</h1>

        <div class="min-w-full p-4">
            <form wire:submit.prevent="save" class="flex flex-col gap-4">
                {{-- user --}}
                <div class="flex gap-4 items-center mb-4">
                    <flux:input class="pointer-events-none border-1 border-gray-400 !text-black" name="user" :value="auth()->user()?->name" readonly />
                    <div class="w-12 shrink-0"></div>
                </div>

                {{-- subusers(players) --}}
                @foreach($subuserArray as $i => $subuser)
                <div class="mb-4">
                    <div class="flex gap-4 items-center">
                        <flux:input class="bg-white border-1 border-gray-400" wire:model="subuserArray.{{ $i }}" placeholder="player{{ $i + 1 }}" />
                        <flux:button wire:click="removeInput({{ $i }})" class="w-12 shrink-0 !text-red-400">{{ __('削除') }}</flux:button>
                    </div>
                    @error("subuserArray.$i")
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach

                @if (count($subuserArray) < 6)
                    <div class="flex justify-end mb-4">
                    <flux:button wire:click="addInput" class="w-12">{{ __('追加') }}</flux:button>
        </div>
        @endif

        {{-- submit button --}}
        <flux:button type="submit" class="mx-auto w-48 text-lg font-semibold !bg-brand-yellow-400 hover:!bg-brand-yellow-600 hover:!font-bold !text-zinc-900" variant="primary">
            {{ __('このメンバーで始める') }}
        </flux:button>
    </div>

    </form>
</div>
</div>
</div>