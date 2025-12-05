<div>
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
            <div class="flex flex-col items-center mb-6">
                <img src="/image/panjang.png" alt="Logo" class="h-14 mb-2 object-contain">
                <h2 class="text-[#005da6] font-bold text-lg">Create Account</h2>
                <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-blue-200 to-transparent mt-2"></div>
            </div>

            <form wire:submit="register" class="space-y-4">

                <div class="opacity-0 absolute -z-10 h-0 w-0 overflow-hidden">
                    <label for="user_nickname">Nickname (Do not fill)</label>
                    <input type="text" id="user_nickname" wire:model="user_nickname" tabindex="-1"
                        autocomplete="off">
                </div>
                {{-- Pesan Error Khusus Rate Limit (Jika pesan mengandung kata 'seconds' atau 'detik') --}}
                @error('email')
                    @if (Str::contains($message, ['seconds', 'detik']))
                        <div class="p-3 mb-2 text-xs text-red-800 bg-red-50 border border-red-200 rounded">
                            <strong>Keamanan:</strong> Terlalu banyak percobaan. Silakan tunggu {{ $message }}
                        </div>
                    @endif
                @enderror

                <div>
                    <input type="text" wire:model="username" placeholder="Username"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors @error('name') border-red-500 @enderror">
                    @error('username')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="text" wire:model="name" placeholder="Full Name"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors @error('name') border-red-500 @enderror">
                    @error('name')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="email" wire:model="email" placeholder="Email Address"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors @error('email') border-red-500 @enderror">

                    {{-- Error standar (selain rate limit) --}}
                    @error('email')
                        @if (!Str::contains($message, ['seconds', 'detik']))
                            <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                        @endif
                    @enderror
                </div>

                <div>
                    <input type="password" wire:model="password" placeholder="Password"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="password" wire:model="password_confirmation" placeholder="Confirm Password"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors">
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="w-full text-white bg-[#005da6] hover:bg-[#004a85] font-medium rounded-sm text-sm px-5 py-3 text-center mt-6 transition-all disabled:opacity-50">
                    <span wire:loading.remove>Register</span>
                    <span wire:loading>Creating Account...</span>
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                Already have an account? <a href="{{ route('login') }}"
                    class="text-[#005da6] font-medium hover:underline">Log In</a>
            </div>
        </div>
    </div>
</div>
