<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{
    /**
     * ユーザーをGoogleの認証ページにリダイレクトする
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * 認証後にGoogleからのコールバックを受信する
     */
    public function handleGoogleCallback()
    {
        // statelessでproxyのstate不一致エラーを防ぐ
        $google_account = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $google_account->getEmail())->first();

        if ($user) {

            $user->update([
                'google_id' => $google_account->getId(),
            ]);
        } else {

            $user = User::create([
                'email' => $google_account->getEmail(),
                'name' => $google_account->getName(),
                'google_id' => $google_account->getId(),
                'email_verified_at' => now(),
            ]);
            
        }

        Auth::login($user);

        // // ログイン直後にセッションを即時保存し、確実に反映させる
        // request()->session()->regenerate(); // セッション固定攻撃対策
        // request()->session()->put('auth_id', $user->id);
        // request()->session()->save();

        // // デバッグ用
        // dd(Auth::check(), Auth::user());

        return redirect()->route('dashboard');
    }
}
