<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="{{ URL('/images/logo.jpeg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body class="flex flex-col w-full h-full bg-slate-600">
    {{-- i can use the same component structure but with different content --}}
    <x-layout>
        <div class="w-full h-full flex justify-center items-center">
            <div class=" w-1/2 mx-auto p-4 bg-slate-200 dark:bg-slate-900 rounded-lg">
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input name="email" type="email" id="base-input" class="@error('email')
                            border-red-500
                        @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input name="password" type="password" id="base-input" class="@error('password')
                            border-red-500
                        @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <div class="mb-6">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Login</button>
                        </div>
                    </div>
                </form>
                <div>Don't have an account ? <a href="{{ route('register') }}" class="text-blue-600">Register</a></div>
            </div>
        </div>
    </x-layout>
</body>
</html>
