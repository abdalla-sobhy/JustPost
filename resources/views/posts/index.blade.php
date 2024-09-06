<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/indexPage.css') }}" >
</head>
<body class="pb-14">
    <x-layout></x-layout>
    {{-- @auth --}}
    <section>
        <div class="flex justify-end mt-8 mr-4">
            <a href="{{ route('posts.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</a>
        </div>
    </section>
    {{-- @endauth --}}

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 place-items-center">
        @foreach ($posts as $post)


<div class="max-w-sm p-6 bg-gray-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-full">
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $post->title }}</h5>
    </a>
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $post->content }}</p>
    <a href="/posts/{{ $post->id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Read more
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
</div>

        @endforeach
</div>

</body>
</html>
