<div>
    <flux:table :paginate="$this->orders">
        <flux:table.columns>
            <flux:table.column sortable :sorted="$sortBy === 'date'" :direction="$sortDirection" wire:click="sort('date')">日付</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'total'" :direction="$sortDirection" wire:click="sort('total')">自己スコア</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'winner'" :direction="$sortDirection" wire:click="sort('winner')">勝者</flux:table.column>
            <flux:table.column >参加メンバー</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach ($this->historyies as $history)
                <flux:table.row :key="$history->id">
                    <flux:table.cell class="whitespace-nowrap">{{ $history->created_at }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $history->total }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $history-> }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $history->members }}</flux:table.cell>
                </flux:table.row>
            @endforeach
            @foreach ($score->samePlayScores as $other)
                @if ($other->id !== $score->id)
                    {{ $other->player_id }}
                @endif
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
