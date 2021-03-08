@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <h2 class="text-2xl mb-2 font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate ">
                Deposits List
            </h2>
            <table class="min-w-max w-full table-auto">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-center">Сумма вклада</th>
                    <th class="py-3 px-6 text-center">Процент</th>
                    <th class="py-3 px-6 text-center">Количество текущих начислений</th>
                    <th class="py-3 px-6 text-center">Сумма начислений</th>
                    <th class="py-3 px-6 text-center">Статус депозита</th>
                    <th class="py-3 px-6 text-center">Дата</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                @forelse($deposits as $deposit)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $deposit->id }}</td>
                        <td class="py-3 px-6 text-center">${{ number_format($deposit->invested / 100, 2) }}</td>
                        <td class="py-3 px-6 text-center">{{ number_format($deposit->percent / 100, 2) }}%</td>
                        <td class="py-3 px-6 text-center">{{ $deposit->duration }}</td>
                        <td class="py-3 px-6 text-center">{{ $deposit->accrue_times }}</td>
                        <td class="py-3 px-6 text-center">
                            @if($deposit->active === 1)
                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">открытый</span>
                            @endif
                            @if($deposit->active === 0)
                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">закрытый</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">{{ $deposit->created_at }}</td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-center" colspan="7">No deposits</td>
                    </tr>
                @endforelse
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
