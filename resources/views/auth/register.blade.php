<x-guest-layout>
    <div class="min-h-screen flex">
        <div class="w-1/2 flex justify-center items-center bg-white">
            <div class=" w-1/2">
                <p
                    class="mb-2 text-4xl font-bold font-montserrat text-transparent bg-clip-text bg-gradient-to-r from-red_1 to-white">
                    REGISTER USER
                </p>
                <p class="mb-5 text-red_2 font-bold">Sistem Informasi Rancangan Siar UTY FM MEDARI</p>
                <form class="mx-auto" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-bold text-gray-900">Nama</label>
                        <input type="name" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-red_2 focus:border-red_2 block w-full py-3 px-4"
                            placeholder="nama user" required />
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-red_2 focus:border-red_2 block w-full py-3 px-4"
                            placeholder="youremail@mail.com" required />
                    </div>
                    <div class="mb-5">
                        <label for="hak_akses" class="block mb-2 text-sm font-bold text-gray-900">Hak Akses</label>
                        <select id="hak_akses" name="hak_akses"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-red_2 focus:border-red_2 block w-full py-3 px-4">
                            <option selected disabled> --- </option>
                            <option value="traffic">Traffic</option>
                            <option value="penyiar">Penyiar</option>
                            <option value="program_director">Program Director</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-900 te">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-red_2 focus:border-red_2 block w-full py-3 px-4"
                            placeholder="password" required />
                    </div>
                    <div class="mb-5">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-bold text-gray-900 te">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-red_2 focus:border-red_2 block w-full py-3 px-4"
                            placeholder="konfirmasi password" required />
                    </div>
                    <button type="submit"
                        class="mt-8 
                        {{-- bg-lime-500 --}}
                        bg-yellow_1 bg-opacity-70
                        hover:shadow-xl hover:bg-red_1 hover:bg-opacity-70 transition duration-300 text-gray-600 hover:text-white py-3 rounded-full block font-semibold w-full ">Register</button>
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
    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-guest-layout>
