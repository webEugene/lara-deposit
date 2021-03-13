<?php

namespace App\Http\Controllers;

use App\Models\Deposits;
use App\Models\Wallet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

/**
 * Class DepositsController
 * @package App\Http\Controllers
 */
class DepositsController extends Controller
{
    /**
     * DepositsController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Get list of all deposits of current user
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $current_user = auth()->user()->id;
        $deposits = Deposits::with('user')->where('user_id', $current_user)->orderByDesc('id')->get();
        return view('deposits.index', ['deposits' => $deposits]);
    }

    /**
     * @return View|Factory|Application
     */
    public function create()
    {
        return view('deposits.create');
    }

    /**
     * Save new deposite
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $wallet = Wallet::find(auth()->user()->id);
        if (!$wallet) {
            return redirect('deposits/create')->with('status-error', 'Кошелек не найден');
        }

        $input = $request->input('invested');

        if ($input >= '10' && $input <= '100') {
            $wallet->balance = $wallet->balance - $input;
            $percent = 20;
            //  Transaction
            DB::transaction(
                function () use ($wallet, $input, $percent) {
                    //  Create deposite of current user
                    auth()->user()->deposits()->create(
                        [
                            'wallet_id' => $wallet->id,
                            'invested' => $input,
                            'percent' => $percent,
                            'duration' => 10,
                            'active' => 1
                        ]
                    );
                    // Get last created deposit
                    $lastCreatedDeposit = Deposits::orderBy('id', 'desc')->first();

                    //  Renew balance of wallet
                    (new WalletController())->decreaseBalance($wallet->balance, $wallet->id);
                    // Add transaction
                    auth()->user()->transactions()->create(
                        [
                            'type' => 'create_deposit',
                            'wallet_id' => $wallet->id,
                            'deposit_id' => $lastCreatedDeposit->id,
                            'amount' => $input,
                        ]
                    );
                }
            );

            return redirect()->route('user.index', auth()->user()->id);
        } else {
            return redirect('deposits/create')->with('status-error', 'Сумма депозита меньше 10 или больше 100 единиц');
        }
    }

    /**
     * Charging Percent From Deposit To Wallet Method
     *
     * @param $depositID
     */
    public function chargingPercentFromDeposit($depositID)
    {
        $deposit = Deposits::findOrFail($depositID);

        if ($deposit->active !== 0 && $deposit->duration !== 0) {
            $duration = --$deposit->duration;
            $accrue_times = ++$deposit->accrue_times;

            $wallet = Wallet::findOrFail($deposit->wallet_id);
            $accruePercent = ($deposit->invested / 100) * $deposit->percent;
            $wallet->balance = $wallet->balance + $accruePercent;

            (new WalletController())->increaseBalance($wallet->balance, $deposit->wallet_id);

            if ($duration !== 0) {
                //  Transaction
                DB::transaction(
                    function () use ($deposit, $duration, $accrue_times, $wallet, $accruePercent) {
                        $deposit->fill(
                            ['duration' => $duration, 'accrue_times' => $accrue_times]
                        )->save();
                        (new TransactionsController())->accrueTransaction($deposit, $wallet, $accruePercent);
                    }
                );
            } else {
                DB::transaction(
                    function () use ($deposit, $duration, $accrue_times, $wallet) {
                        $deposit->fill(
                            ['active' => 0, 'duration' => $duration, 'accrue_times' => $accrue_times]
                        )->save();

                        (new TransactionsController())->closeDepositTransaction($deposit, $wallet);
                    }
                );
            }
        }
    }
}
