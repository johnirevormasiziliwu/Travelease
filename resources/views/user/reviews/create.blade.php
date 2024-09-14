<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-bold text-3xl">

                    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800">Beri Ulasan Anda</h2>

                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-700">{{ $holidayPackage->name }}</h3>
                            <p class="text-gray-600 font-normal text-sm my-2">{{ $holidayPackage->description }}</p>
                        </div>


                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="holiday_package_id" value="{{ $holidayPackage->id }}">


                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="rating">Rating</label>
                                <select name="rating" id="rating"
                                    class="block w-full border rounded-lg py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-indigo-200">
                                    <option value="5">⭐⭐⭐⭐⭐ - Sangat Baik</option>
                                    <option value="4">⭐⭐⭐⭐ - Baik</option>
                                    <option value="3">⭐⭐⭐ - Cukup</option>
                                    <option value="2">⭐⭐ - Kurang</option>
                                    <option value="1">⭐ - Sangat Buruk</option>
                                </select>
                            </div>


                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                    for="comment">Komentar</label>
                                <textarea name="comment" id="comment" rows="4"
                                    class="block w-full border rounded-lg py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-indigo-200"
                                    placeholder="Tulis ulasan Anda di sini..."></textarea>
                            </div>


                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm py-2 px-4 font-normal rounded-lg transition duration-200">
                                    Kirim Ulasan
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
