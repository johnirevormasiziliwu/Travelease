<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-4">
                        <h1 class="text-3xl font-bold mb-6">Riwayat Transaksi</h1>

                        @if ($transactions->isEmpty())
                            <p class="text-gray-500">Belum ada transaksi.</p>
                        @else
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                                <thead>
                                    <tr class="bg-gray-100 border-b">
                                        <th class="px-6 py-3 text-left text-gray-600">No</th>
                                        <th class="px-6 py-3 text-left text-gray-600">Nama Paket</th>
                                        <th class="px-6 py-3 text-left text-gray-600">Tanggal Mulai</th>
                                        <th class="px-6 py-3 text-left text-gray-600">Tanggal Akhir</th>
                                        <th class="px-6 py-3 text-left text-gray-600">Total Harga</th>
                                        <th class="px-6 py-3 text-left text-gray-600">Status Pembayaran</th>
                                        <th class="px-6 py-3 text-left text-gray-600">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $index => $transaction)
                                        <tr class="border-b">
                                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4">{{ $transaction->holidayPackage->name }}</td>
                                            <td class="px-6 py-4">{{ $transaction->formatted_start_date }}</td>
                                            <td class="px-6 py-4">{{ $transaction->formatted_end_date }}</td>
                                            <td class="px-6 py-4">Rp
                                                {{ number_format($transaction->total_price, 0, ',', '.') }}</td>

                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-block px-3 py-1 text-sm font-medium {{ $transaction->payment_status === 'paid' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                                    {{ ucfirst($transaction->payment_status) }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 flex gap-4">

                                                <a href="{{ route('transactions.create', $transaction->holiday_package_id) }}"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Pesan
                                                    Lagi</a>


                                                @if ($transaction->payment_status !== 'paid')
                                                    <a href="{{ route('payments.create', $transaction->holiday_package_id) }}"
                                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Bayar
                                                        Sekarang</a>
                                                @else
                                                    @php

                                                        $hasReviewed = \App\Models\Review::where(
                                                            'holiday_package_id',
                                                            $transaction->holiday_package_id,
                                                        )
                                                            ->where('user_id', auth()->id())
                                                            ->exists();
                                                    @endphp


                                                    @if (!$hasReviewed)
                                                        <a href="{{ route('reviews.create', $transaction->holiday_package_id) }}"
                                                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Beri
                                                            Ulasan</a>
                                                    @else
                                                        <span class="bg-orange-400 text-white rounded-md p-3">Ulasan sudah diberikan</span>
                                                    @endif
                                                @endif
                                            </td>



                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
