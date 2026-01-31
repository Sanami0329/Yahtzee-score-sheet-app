<x-layouts.app :title="__('Dashboard')">
    @if (session('success'))
        <div class="flex justify-center mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex justify-center mt-8">
        <flux:button icon="play" :href="route('play.create')" wire:navigate class="flex justify-center w-48 text-lg font-semibold px-4 py-3 !bg-brand-yellow-200 hover:!bg-brand-yellow-100 hover:!font-bold !text-black rounded-lg shadow-md">
            ゲームを始める
        </flux:button>
    </div>
</x-layouts.app>
