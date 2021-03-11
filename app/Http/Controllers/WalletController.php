<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Wallet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Class WalletController
 * @package App\Http\Controllers
 */
class WalletController extends Controller
{
    /**
     * WalletController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Create new Wallet
     */
    public function create()
    {
        auth()->user()->wallet()->create(
            [
                'balance' => 0,
            ]
        );
    }

    /**
     * Show wallet of current user
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $wallet = Wallet::find($id);

        return view('wallet.show')->with('wallet', $wallet);
    }

    /**
     * Edit form view
     *
     * @param $id
     * @return View|Factory|Application
     */
    public function edit($id)
    {
        return view('wallet.edit', ['id' => Wallet::findOrFail($id)]);
    }

    /**
     * Update wallet balance of current user
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $wallet = Wallet::findOrFail($id);

        $this->validate(
            $request,
            [
                'balance' => 'required',
            ]
        );

        $input = $request->input('balance');
        $wallet->balance = $wallet->balance + $input;

        DB::transaction(
            function () use ($wallet) {
                auth()->user()->transactions()->create(
                    [
                        'type' => 'enter',
                        'wallet_id' => $wallet->id,
                        'amount' => $wallet->balance,
                    ]
                );

                $wallet->fill(['balance' => $wallet->balance])->save();
            }
        );

        return redirect()->route('user.index', auth()->user()->id);
    }

    /**
     * Decrease wallet balance of current user
     *
     * @param $balance
     * @param $id
     */
    public function decreaseBalance($balance, $id)
    {
        $wallet = Wallet::findOrFail($id);
        $wallet->fill(['balance' => $balance])->save();
    }
}
