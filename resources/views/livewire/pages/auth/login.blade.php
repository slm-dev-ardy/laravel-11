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
            margin: 0;">
    </div>

    <div class="absolute
        inset-0 z-0 bg-[#15202b]/80"></div>

    <div class="relative z-10 bg-white w-full max-w-[400px] shadow-2xl rounded-sm p-8 mx-4">

        <div class="flex flex-col items-center mb-8">
            <img src="/image/panjang.png" alt="Logo" class="h-16 mb-2 object-contain">

            <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-blue-200 to-transparent mt-4"></div>
        </div>

        <form wire:submit="login" class="space-y-4">

            <div>
                <label for="email" class="sr-only">User name / Email</label>
                <input type="email" id="email" wire:model="email" placeholder="User name" maxlength="20"
                    autocomplete="off" autofocus
                    class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors duration-200
                       @error('email') border-red-500 ring-1 ring-red-500 @enderror">

                @error('email')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" wire:model="password" placeholder="Password"
                    class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition-colors duration-200
                       @error('password') border-red-500 @enderror">

                @error('password')
                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="#" class="text-xs text-[#005da6] hover:underline font-medium">
                    Forgot password?
                </a>
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full text-white bg-[#005da6] hover:bg-[#004a85] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-3 text-center flex items-center justify-center gap-2 transition-all mt-6 disabled:opacity-50">

                <svg wire:loading wire:target="login" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r=" 10" stroke="currentColor"
                        stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>

                <svg wire:loading.remove wire:target="login" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>

                <span wire:loading.remove wire:target="login">Log in</span>
                <span wire:loading wire:target="login">Processing...</span>
            </button>
        </form>

        <div
            class="mt-10 flex justify-between items-center text-[10px] text-gray-400 font-light border-t border-gray-100 pt-2">
            <span>© {{ date('Y') }} 1.0.0.dev</span>
            <span>SPK Application</span>
        </div>
    </div>
</div>
