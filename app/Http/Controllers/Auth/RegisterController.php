<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerNewUser(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
            [
                'login' => 'required|max:30',
                'email' => 'required|email|max:191',
                'password' => 'required|confirmed|max:30',
            ]
        );

        User::create(
            [
                'login' => $request->login,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );
        auth()->attempt($request->only('email', 'password'));
        // Create Wallet with value 0
        if (auth()->user()->id) {
            (new WalletController())->create();
        }
        return redirect()->route('user.index', auth()->user()->id);
    }
}
