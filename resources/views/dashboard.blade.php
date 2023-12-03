<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                        こんにちは、{{ Auth::user()->name }}さん。<br>
                        メンバーシップへようこそ。
                    </h1>
                    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                        {{ Auth::user()->created_at->format('Y年m月') }}からメンバー
                    </p>
                </div>
                <div class="flex justify-between p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">あなたの会員番号</h2>

                        <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                            {{ Auth::user()->id }}
                        </p>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                        {!! QrCode::margin(1)->generate(Auth::user()->id) !!}
                    </p>
                </div>
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                        <a class="inline-block" href="{{ route('dashboard.pass') }}"><img src="{{ asset('images/JP_Add_to_Apple_Wallet_RGB_101821.svg') }}" alt="Appleウォレットに追加"></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
