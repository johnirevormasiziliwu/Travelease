<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
									<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
										<h2 class="text-2xl font-bold mb-6">Buat Pembayaran</h2>
								
										<form action="{{ route('payments.store') }}" method="POST">
												@csrf
								
											
												<div class="mb-4">
														<label for="transaction_id" class="block text-sm font-medium text-gray-700">Pilih Transaksi</label>
														<select id="transaction_id" name="transaction_id" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" required onchange="updateAmount()">
																<option value="">Pilih Transaksi</option>
																@foreach ($transactions as $transaction)
																		<option value="{{ $transaction->id }}" data-price="{{ $transaction->total_price }}">
																				{{ $transaction->holidayPackage->name }} - Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
																		</option>
																@endforeach
														</select>
														@error('transaction_id')
																<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
														@enderror
												</div>

												<div class="mb-3">
													<label for="">Tanggal Mulai</label>
													<input type="text" class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" value="{{ $transaction->formatted_start_date }}">
												</div>
												<div class="mb-3">
													<label for="">Tanggal Berakhir</label>
													<input type="text" class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" value="{{ $transaction->formatted_end_date }}">
												</div>

												
													<div class="mb-4">
														<label for="amount" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran (Rp)</label>
														<input type="number" id="amount" name="amount" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 font-bold" min="1" readonly required>
														@error('amount')
																<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
														@enderror
												</div>
						
												<div class="mb-4">
														<label for="payment_method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
														<select id="payment_method" name="payment_method" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" required>
																<option value="">Pilih Metode Pembayaran</option>
																<option value="credit_card">Credit Card</option>
																<option value="bank_transfer">Bank Transfer</option>
																<option value="paypal">PayPal</option>
														</select>
														@error('payment_method')
																<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
														@enderror
												</div>
								
											
								
											
												<div class="flex justify-end">
														<button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700">Bayar Sekarang</button>
												</div>
										</form>
								</div>
							
                </div>
            </div>
        </div>
    </div>
		<script>
			function updateAmount() {
					
					const transactionSelect = document.getElementById('transaction_id');
			
					const amountInput = document.getElementById('amount');
	
				
					const selectedOption = transactionSelect.options[transactionSelect.selectedIndex];
	
				
					const totalPrice = selectedOption.getAttribute('data-price');
	
					
					if (totalPrice) {
							amountInput.value = totalPrice;
					} else {
							amountInput.value = '';
					}
			}
	</script>
</x-app-layout>
