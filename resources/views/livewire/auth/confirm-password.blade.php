<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header
            :title="__('パスワードの確認')"
            :description="__('続行する前にパスワードを再度確認してください。')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="password"
                :label="__('パスワード')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable />

            <flux:button variant="primary" type="submit" class="w-full" data-test="confirm-password-button">
                {{ __('確認') }}
            </flux:button>
        </form>
    </div>
</x-layouts.auth>