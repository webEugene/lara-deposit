@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            <div>
                <h2 class="mt-4 text-center text-3xl font-bold text-gray-900">
                    Вклад на депозит
                </h2>
            </div>
            @if(session()->has('status-error'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status-error') }}
                </div>
            @endif
            <form class="mt-8 space-y-6" action="{{ route('deposits.store') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="number" name="invested" id="invested" min="0" value="0" step="0.001"
                           pattern="^\d+(?:\.\d{1,3})?$" placeholder="Положить на депозит 0.00"
                           class="bg-gray-100 border-2 w-full p-4 rounded-lg"
                    >
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Положить
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
