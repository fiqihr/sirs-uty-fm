<x-guest-layout>
    <div class="min-h-screen flex">
        <div class="w-1/2 flex justify-center items-center bg-gradient-to-br from-primary to-white">
            <div class=" w-1/2">
                <p class="mb-2 text-4xl font-bold">SIRS</p>
                <p class="mb-5 text-gray-500">Sistem Informasi Rancangan Siar UTY FM MEDARI</p>
                <form class="mx-auto" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                            placeholder="youremail@mail.com" required />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-900 te">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                            placeholder="your password" required />
                    </div>
                    <button type="submit"
                        class="mt-8 
                        {{-- bg-lime-500 --}}
                        bg-secondary
                        hover:shadow-xl transition duration-300 text-white py-2 rounded-lg text-sm block font-semibold w-full">Sign
                        In</button>
                </form>
            </div>
        </div>
        <div class="w-1/2 relative">
            <img src="{{ asset('images/studio2.jpeg') }}" class="w-full h-full object-cover" alt="">
            <div class="absolute left-10 rigt-10 bottom-10 backdrop-blur-xl p-10 text-white">
                <p class="mb-1"></p>
                <p class="text-xl text-right font-semibold rounded-lg">Hits Tanpa Henti</p>
            </div>
        </div>


    </div>
</x-guest-layout>
