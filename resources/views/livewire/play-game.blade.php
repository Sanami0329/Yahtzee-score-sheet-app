<div class="overflow-x-auto mx-auto">
    <form wire:submit="save">
        <div class="flex justify-center gap-0">
            {{-- score name&description --}}
            <table class="w-auto border-collapse border-1 border-gray-600 font-normal text-gray-800">
                {{-- Column Headers --}}
                <thead>
                    <tr class="h-10 bg-white">
                        <th class="min-w-48 border border-gray-600 text-left font-semibold"></th>
                        <th class="min-w-60 border border-gray-600 text-center font-semibold">スコアの説明</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Upper Section --}}
                    @foreach([
                    ['name' => 'Ones', 'dice' => '⚀', 'desc' => '1の目の合計', 'eng_desc' => 'Count and add only Ones'],
                    ['name' => 'Twos', 'dice' => '⚁', 'desc' => '2の目の合計', 'eng_desc' => 'Count and add only Twos'],
                    ['name' => 'Threes', 'dice' => '⚂', 'desc' => '3の目の合計', 'eng_desc' => 'Count and add only Threes'],
                    ['name' => 'Fours', 'dice' => '⚃', 'desc' => '4の目の合計', 'eng_desc' => 'Count and add only Fours'],
                    ['name' => 'Fives', 'dice' => '⚄', 'desc' => '5の目の合計', 'eng_desc' => 'Count and add only Fives'],
                    ['name' => 'Sixes', 'dice' => '⚅', 'desc' => '6の目の合計', 'eng_desc' => 'Count and add only Sixes'],
                    ] as $row)
                    <tr class="h-10 bg-brand-red-400">
                        <th class="min-w-48 border border-gray-600 font-semibold">
                            <div class="flex items-center px-3 gap-4">
                                <span class="w-12 text-left">{{ $row['name'] }}</span>
                                <span class="text-3xl font-light">{{ $row['dice'] }}</span>
                            </div>
                        </th>
                        <td class="border border-gray-600 px-3">
                            {{ $row['desc'] }}
                        </td>
                    </tr>
                    @endforeach

                    {{-- Upper Totals --}}
                    @foreach ([
                    ['name' => 'UPPER SCORE', 'desc' => '', 'eng_desc' => ''],
                    ['name' => 'BONUS', 'desc' => '上段合計が63点以上で35点', 'eng_desc' => 'Score 35 if upper-score ≧ 63'],
                    ['name' => 'UPPER TOTAL', 'desc' => '', 'eng_desc' => ''],
                    ] as $item)
                        <tr class="h-10 bg-brand-red-300">
                            <th class="min-w-48 px-3 border border-gray-600 font-semibold text-lg text-left">{{ $item['name'] }}</th>
                            <td class="min-w-60 px-3 border border-gray-600">{{ $item['desc'] }}</td>
                        </tr>
                    @endforeach


                    {{-- Lower Section --}}
                    @foreach([
                    ['name' => '3 of a Kind', 'desc' => '同じ目が3つ以上で全部の合計', 'eng_desc' => 'Add total of all dice'],
                    ['name' => '4 of a Kind', 'desc' => '同じ目が4つ以上で全部の合計', 'eng_desc' => 'Add total of all dice'],
                    ['name' => 'Full House', 'desc' => '同じ目が3つと2つで25点', 'eng_desc' => 'Score 25'],
                    ['name' => 'Small Straight', 'desc' => '連番4つで30点', 'eng_desc' => 'Score 30'],
                    ['name' => 'Large Straight', 'desc' => '連番5つで40点', 'eng_desc' => 'Score 40'],
                    ['name' => 'YAHTZEE', 'desc' => '同じ目が5つで50点', 'eng_desc' => 'Score 50'],
                    ['name' => 'Chance', 'desc' => '全部の目の合計', 'eng_desc' => 'Total of all 5 dice'],
                    ] as $row)
                    <tr class="bg-brand-blue-400 h-10">
                        <th class="min-w-48 px-3 border border-gray-600 text-left font-semibold">{{ $row['name'] }}</th>
                        <td class="min-w-60 px-3 border border-gray-600">{{ $row['desc'] }}</td>
                    </tr>
                    @endforeach

                    {{-- Yahtzee Bonus --}}
                    <tr class="h-16 bg-brand-blue-400">
                        <th class="min-w-48 px-3 border border-gray-600 text-left font-semibold">YAHTZEE BONUS</th>
                        <td class="min-w-60 px-3 border border-gray-600">2回目以降は1回100点</td>
                    </tr>

                    {{-- Lower Total --}}
                    <tr class="h-10 bg-brand-blue-300">
                        <th class="min-w-48 px-3 border border-gray-600 text-left font-semibold text-lg">LOWER TOTAL</th>
                        <td class="min-w-60 px-3 border border-gray-600"></td>
                    </tr>

                    {{-- Grand Total --}}
                    <tr class="h-16 bg-brand-yellow-300 border-t-4 border-double border-gray-600 font-bold text-xl">
                        <th class="min-w-48 py-4 px-3 border border-gray-600 text-left font-bold">GRAND TOTAL</th>
                        <td class="min-w-60 p-4 px-3 border border-gray-600 font-bold"></td>
                    </tr>
                </tbody>
            </table>

            {{-- Score Columns --}}
            <div class="flex">
                @foreach ($players as $player)
                    <livewire:score-column
                        :key="'score-column-' . $player['id']"
                        :play-id="$playId"
                        :player-id="$player['id']"
                        :player-name="$player['name']" />
                @endforeach
            </div>
        </div>
        <div class="flex items-center justify-center mt-6 mb-2 gap-8">
            <!-- <flux:button wire:click="" class="w-24 text-lg font-semibold">中止</flux:button> -->
            <flux:button type="submit" class="w-24 text-lg font-semibold !bg-brand-yellow-200 hover:!bg-brand-yellow-100 hover:!font-bold !text-black" variant="primary">登録</flux:button>
            <!-- <flux:button wire:click="resetScore" class="w-24 text-lg font-semibold">リセット</flux:button> -->
        </div>
    </form>
    <script>
        // バリデーションエラーのアラート表示
        window.addEventListener('show-validation-error', (event) => {
            alert(event.detail.error); // detailでカスタムイベントのデータを受け取る
        });
    </script>
</div>
