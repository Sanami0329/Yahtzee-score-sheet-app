<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('ログイン')" :description="__('')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('メールアドレス')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com" />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('パスワード')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable />

                @if (Route::has('password.request'))
                <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                    {{ __('パスワードをお忘れですか？') }}
                </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('ログイン状態を保持する')" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('ログイン') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
            <span>{{ __('アカウントをお持ちでないですか？') }}</span>
            <flux:link :href="route('register')" wire:navigate>{{ __('アカウント作成') }}</flux:link>
        </div>
        @endif

        <div class="text-sm text-center text-zinc-800 dark:text-zinc-400">
            <span class="inline-block mb-6">{{ __('もしくは') }}</span>
            <flux:button href="{{ route('auth.google') }}" class="w-full dark:!bg-zinc-700 dark:hover:!bg-zinc-800" data-test="login-button">
                {{ __('Googleアカウントでログイン') }}
            </flux:button>
        </div>
    </div>
</x-layouts.auth>