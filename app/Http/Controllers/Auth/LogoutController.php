<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

/**
 * Class LogoutController
 * @package App\Http\Controllers\Auth
 */
class LogoutController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function loggedOut(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
