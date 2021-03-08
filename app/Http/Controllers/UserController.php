<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show current user
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view(
            'user.index',
            [
                'user' => User::findOrFail($id)
            ]
        );
    }
}
