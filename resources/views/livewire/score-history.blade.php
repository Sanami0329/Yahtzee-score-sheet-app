<div class="flex justify-center sm:pt-8">
    <div class="overflow-x-auto min-w-2xl h-dvh sm:h-auto bg-gray-100 py-4 text-zinc-800 px-20">

        <h1 class="m-6 font-semibold text-lg text-center">スコア履歴</h1>

        <table class="min-w-full divide-y divide-gray-300 bg-gray-50 text-center">
            <thead class="bg-gray-200 text-center">
                <tr>
                    <th class="min-w-20 px-4 py-2">
                        日付
                        <button wire:click="sort('created_at')" class="text-center text-xs">
                            @if($sortBy === 'created_at')
                                {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                            @endif
                        </button>
                    </th>
                    <th class="min-w-20 px-4 py-2">
                        自己スコア
                        <button wire:click="sort('total')" class="text-center text-xs">
                            @if($sortBy === 'total')
                                {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                            @endif
                        </button>
                    </th>
                    <th class="px-4 py-2">勝者</th>
                    <th class="px-4 py-2">参加メンバー</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($scoreHistories as $score)
                    <tr class="bg-white hover:bg-brand-blue-100">
                        <td class="px-4 py-2 whitespace-nowrap">{{ $score->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $score->total }}</td>
                        @php
                            $highestScorePlayer = $score->play->scores->sortByDesc('total')->first();
                        @endphp
                        <td class="px-4 py-2 whitespace-nowrap">
                            @if ($highestScorePlayer)
                                {{ $highestScorePlayer->player->name }}
                            @endif
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-left">
                            {{ $score->play->scores->where('player_id', '!=', auth()->id())->pluck('player.name')->implode('、') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ページネーション --}}
        <div class="mt-4 mb-4">
            {{ $scoreHistories->links('vendor.livewire.tailwind') }}
        </div>

    </div>
</div>
