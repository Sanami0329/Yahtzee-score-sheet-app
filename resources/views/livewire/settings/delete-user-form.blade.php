<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('アカウントの削除') }}</flux:heading>
        <flux:subheading>{{ __('') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('アカウントを削除') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('本当にアカウントを削除しますか？') }}</flux:heading>

                <flux:subheading>
                    {{ __('アカウントを削除すると、保存したデータ等も永久的に失われます。それでもアカウントを削除する場合は、以下にパスワードを入力してアカウントの削除を完了してください。') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('パスワード')" type="password" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('キャンセル') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit">{{ __('アカウントを削除') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</section>