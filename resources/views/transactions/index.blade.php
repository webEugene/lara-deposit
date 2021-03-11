@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <h2 class="text-2xl mb-2 font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate ">
                Transactions List
            </h2>
            <table class="min-w-max w-full table-auto">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-center">Тип</th>
                    <th class="py-3 px-6 text-center">Сумма</th>
                    <th class="py-3 px-6 text-center">Дата</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                @forelse($transactions as $transaction)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $transaction->id }}</td>
                    <td class="py-3 px-6 text-center">
                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $transaction->type }}</span></td>
                    <td class="py-3 px-6 text-center">${{ $transaction->amount }}</td>
                    <td class="py-3 px-6 text-center">{{ $transaction->created_at }}</td>
                </tr>
                @empty
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-center" colspan="4">No transactions</td>
                    </tr>
                @endforelse
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
