<div class="flex justify-center sm:pt-8">
    <div class="overflow-x-auto min-w-2xl h-dvh sm:h-auto bg-gray-100 py-4 text-zinc-800 px-20">

        <h1 class="mt-6 font-semibold text-lg text-center">登録メンバー</h1>

        <div class="flex justify-end mb-4">
            <flux:button class="w-36 !border-gray-300 !bg-gray-50 hover:!bg-brand-red-100 hover:!font-bold !text-gray-800 text-center">{{ __('＋  メンバー追加') }}</flux:button>
        </div>

        <table class="min-w-full border-1 border-gray-300 bg-gray-50 text-left">
            <tbody class="divide-y divide-gray-300">
                @foreach($subusers as $i => $subuser)
                    <tr class="bg-white hover:bg-brand-blue-100 gap-4">
                        <td class="pl-4 py-2 whitespace-nowrap">{{ $i + 1 }}</td>
                        <td class="pr-4 py-2 whitespace-nowrap">{{ $subuser->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ページネーション --}}
        <div class="my-4">
            {{ $subusers->links('vendor.livewire.tailwind') }}
        </div>

    </div>
</div>
