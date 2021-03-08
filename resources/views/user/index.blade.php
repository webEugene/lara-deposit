@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg justify-between">
            <div class="flex">
                <div class="w-1/2 justify-between">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate ">
                        {{ $user->login }}
                    </h2>
                    <div class="flex">
                        Кошелёк: <span class="ml-2 font-bold text-green-600">${{ number_format($user->wallet->balance / 100, 2) }}</span>
                    </div>
                </div>
                <div class="w-1/2 justify-between">
                    <ul class="flex items-center justify-end mb-5">
                        <li class="mr-2">
                            <a href="{{ route('wallet.edit', $user->wallet->id) }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                 Пополнить баланс
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="{{ route('deposits.create') }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Положить на депозит
                            </a>
                        </li>
                    </ul>
                    <ul class="flex items-center justify-end">
                        <li class="mr-2">
                            <a href="{{ route('deposits.index') }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Таблица депозитов
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transactions.index') }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Таблица транзакций
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
