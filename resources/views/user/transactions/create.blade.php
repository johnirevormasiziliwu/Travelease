<x-app-layout>
	<x-slot name="header">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
					{{ __('Pesan Paket Liburan') }} - {{ $holidayPackage->name }}
			</h2>
	</x-slot>

	<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
					<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
							<div class="p-6 text-gray-900">
								<div class="container mx-auto p-4">
									<h1 class="text-3xl font-bold mb-6">Pesan Paket Liburan</h1>
							
									<div class="bg-white shadow-lg rounded-lg p-6">
											<h2 class="text-2xl font-semibold mb-4">{{ $holidayPackage->name }}</h2>
											<p class="text-gray-700 mb-4">{{ $holidayPackage->description }}</p>
											<form action="{{ route('transactions.store') }}" method="POST">
													@csrf
													<input type="hidden" name="holiday_package_id" value="{{ $holidayPackage->id }}">
													<div class="mb-4">
															<label for="start_date" class="block text-gray-700 text-sm font-medium mb-2">Tanggal Mulai</label>
															<input type="date" id="start_date" name="start_date" class="border border-gray-300 rounded-lg p-2 w-full" required>
															@error('start_date')
																	<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
															@enderror
													</div>
													<div class="mb-4">
															<label for="end_date" class="block text-gray-700 text-sm font-medium mb-2">Tanggal Akhir</label>
															<input type="date" id="end_date" name="end_date" class="border border-gray-300 rounded-lg p-2 w-full" required>
															@error('end_date')
																	<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
															@enderror
													</div>
													<button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 ">Pesan Sekarang</button>
													<a href="{{ route('holiday_packages.show', $holidayPackage->id) }}" type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 float-end ">Batal</a>
											</form>
									</div>
							</div>
							</div>
					</div>
			</div>
	</div>
</x-app-layout>
