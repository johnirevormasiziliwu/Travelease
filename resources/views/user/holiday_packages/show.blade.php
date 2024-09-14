<x-app-layout>
	<x-slot name="header">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
					{{ __('Detail Holiday Packages') }} - {{ $holidayPackage->name }}
			</h2>
	</x-slot>

	<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
					<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
							<div class="p-6 text-gray-900">
								<div class="container mx-auto p-4">
									<div class="bg-white shadow-lg rounded-lg overflow-hidden">
											<div class="p-6">
													<h1 class="text-4xl font-bold mb-4">{{ $holidayPackage->name }}</h1>
													<p class="text-gray-700 mb-4">{{ $holidayPackage->description }}</p>
													<div class="flex items-center justify-between mb-6">
															<span class="text-2xl font-semibold">Rp {{ number_format($holidayPackage->price, 0, ',', '.') }}</span>
															<span class="text-gray-500">Durasi: {{ $holidayPackage->duration_days }} hari</span>
													</div>
													<div class="mb-6">
															<h2 class="text-xl font-semibold mb-2">Ketersediaan</h2>
															<p class="text-gray-600">Dari: {{ $holidayPackage->available_from->format('d M Y') }}</p>
															<p class="text-gray-600">Hingga: {{ $holidayPackage->available_until->format('d M Y') }}</p>
													</div>
													<a href="{{ route('transactions.create', $holidayPackage->id) }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Pesan Sekarang</a>
											</div>
									</div>
							</div>
							</div>
					</div>
			</div>
	</div>
</x-app-layout>
