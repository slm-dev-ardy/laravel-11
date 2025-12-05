<div
    class="h-screen w-full bg-[#1e293b] relative overflow-hidden flex items-center justify-center font-sans antialiased">

    <div class="absolute inset-0 z-0 opacity-40"
        style="
            background: url(https://images.unsplash.com/photo-1635070041078-e363dbe005cb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80),  linear-gradient(rgba(44, 62, 80, 0.85), rgba(26, 26, 26, 0.9));
            background-size: cover;
            background-position: center;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Ubuntu', sans-serif;
            margin: 0;
        ">
    </div>
    <div class="absolute inset-0 z-0 bg-[#15202b]/80"></div>

    <div class="relative z-10 bg-white w-full max-w-[400px] shadow-2xl rounded-sm p-8 mx-4">

        <div class="flex flex-col items-center mb-8">
            <img src="/image/panjang.png" alt="Logo" class="h-16 mb-2 object-contain">
            <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-blue-200 to-transparent mt-4"></div>
        </div>

        <form wire:submit="login" class="space-y-4">

            {{-- ALERT KHUSUS LOCKOUT / ERROR --}}
            @error('email')
                <div
                    class="p-4 mb-2 text-sm rounded-lg
                    {{ Str::contains($message, ['seconds', 'detik']) ? 'bg-red-100 text-red-800 border border-red-200' : 'text-red-600 bg-transparent p-0 mb-0' }}">

                    {{-- Jika pesan mengandung kata 'seconds'/'detik', berarti ini pesan Lockout --}}
                    @if (Str::contains($message, ['seconds', 'detik']))
                        <div class="flex items-center gap-2 font-bold mb-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            AKSES TERKUNCI
                        </div>
                        <p>{{ $message }}</p>
                    @else
                        {{-- Pesan error login biasa (User/Pass salah) --}}
                        <span class="block text-xs mt-1">{{ $message }}</span>
                    @endif
                </div>
            @enderror

            <div>
                <label for="username" class="sr-only">Username</label>
                <input type="username" id="username" wire:model="username" placeholder="Username"
                    class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors duration-200
                       @error('username') border-red-500 ring-1 ring-red-500 @enderror">
                @error('username')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" wire:model="password" placeholder="Password"
                    class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors duration-200
                    @error('username') border-red-500 ring-1 ring-red-500 @enderror">

                @error('password')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <input id="remember" type="checkbox" wire:model="remember"
                        class="w-4 h-4 text-[#005da6] border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-xs text-gray-600">Remember me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-xs text-[#005da6] hover:underline font-medium">
                    Forgot password?
                </a>
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full text-white bg-[#005da6] hover:bg-[#004a85] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-3 text-center flex items-center justify-center gap-2 transition-all mt-6 disabled:opacity-50 disabled:cursor-not-allowed">

                <svg wire:loading wire:target="login" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>

                <span wire:loading.remove wire:target="login">Log in</span>
                <span wire:loading wire:target="login">Verifying...</span>
            </button>
        </form>

        <div
            class="mt-10 flex justify-between items-center text-[10px] text-gray-400 font-light border-t border-gray-100 pt-2">
            <span>© {{ date('Y') }} 1.0.0.dev</span>
            <span class="hover:text-[#005da6] cursor-pointer">Register New Account</span>
        </div>
    </div>
</div>
