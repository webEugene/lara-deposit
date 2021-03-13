<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class TransactionsController
 * @package App\Http\Controllers
 */
class TransactionsController extends Controller
{
    /**
     * TransactionsController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Get list of all transactions of current user
     * @return Application|Factory|View
     */
    public function index()
    {
        $current_user = auth()->user()->id;
        $transactions = Transactions::with('user')->where('user_id', $current_user)->get();

        return view('transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Accrue Transaction
     *
     * @param $deposit
     * @param $wallet
     * @param $accruePercent
     */
    public function accrueTransaction($deposit, $wallet, $accruePercent)
    {
        Transactions::create(
            [
                'type' => 'accrue',
                'user_id' => $deposit->user_id,
                'deposit_id' => $deposit->id,
                'wallet_id' => $wallet->id,
                'amount' => $accruePercent,
            ]
        );
    }

    /**
     * Close Deposit Transaction
     *
     * @param $deposit
     * @param $wallet
     */
    public function closeDepositTransaction($deposit, $wallet)
    {
        Transactions::create(
            [
                'type' => 'close_deposit',
                'user_id' => $deposit->user_id,
                'deposit_id' => $deposit->id,
                'wallet_id' => $wallet->id,
                'amount' => $wallet->balance,
            ]
        );
    }
}
