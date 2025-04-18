<x-guest-layout>
    <div class="min-h-screen flex">
        <div class="w-1/2 flex justify-center items-center bg-white">
            <div class=" w-1/2">
                <p
                    class="mb-2 text-6xl font-bold font-montserrat text-transparent bg-clip-text bg-gradient-to-r from-red_1 to-white">
                    SIRS
                </p>
                <p class="mb-5 text-red_2">Sistem Informasi Rancangan Siar UTY FM MEDARI</p>
                <form class="mx-auto" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-red_2 focus:border-red_2 block w-full py-3 px-4"
                            placeholder="youremail@mail.com" required />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-900 te">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-red_2 focus:border-red_2 block w-full py-3 px-4"
                            placeholder="your password" required />
                    </div>
                    <button type="submit"
                        class="mt-8 
                        {{-- bg-lime-500 --}}
                        bg-yellow_1 bg-opacity-70
                        hover:shadow-xl hover:bg-red_1 hover:bg-opacity-70 transition duration-300 text-gray-600 hover:text-white py-3 rounded-full block font-semibold w-full ">Sign
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
