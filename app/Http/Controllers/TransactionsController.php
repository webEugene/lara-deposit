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
}
