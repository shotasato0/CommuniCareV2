<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // リクエストから 'name' と 'username_id' のデータを抽出。only メソッドは、指定されたキーに対応するデータを配列で返す。
        $request->user()->fill($request->only('name', 'username_id'));

        // モデルの変更をデータベースに保存
        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // セッションからドメイン情報を取得し、セッションが存在しない場合はリクエストから取得
        $domain = session('tenant_domain', $request->getHost());

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info('セッションが再生成されました');

        return Redirect::to('http://' . $domain . '/home'); // 必要に応じて 'http://' を 'https://' に変更
    }

}
