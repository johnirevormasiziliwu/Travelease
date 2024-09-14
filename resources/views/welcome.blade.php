
	<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Travelease</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <div class="container mx-auto p-4">
                                        <h1 class="text-3xl font-bold mb-6">Paket Liburan</h1>
                                
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                                @foreach ($holidayPackages as $package)
                                                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                                                        <div class="p-6">
                                                                <h2 class="text-xl font-semibold mb-2">{{ $package->name }}</h2>
                                                                <p class="text-gray-600 mb-4">{{ Str::limit($package->description, 100) }}</p>
                                                                <div class="flex items-center justify-between">
                                                                        <span class="text-lg font-semibold">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                                                        <a href="{{ route('holiday_packages.show', $package->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Lihat Detail</a>
                                                                </div>
                                                        </div>
                                                </div>
                                                @endforeach
                                        </div>
                                </div>
                                </div>
                        </div>
                </div>
        </div>
    </body>
    </html>

