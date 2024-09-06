<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body class=" pb-20">
    {{-- i can use the same component structure but with different content --}}
    <x-layout>
        <section class="mt-8 mr-4">
            <div class="flex justify-end">
                <div class="flex justify-between">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                    @endcan
                    @can('delete', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        </section>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-slate-50 rounded-lg pt-6">
            <h1 class="text-3xl text-indigo-800 font-semibold flex justify-center text-center">{{ $post->title }}</h1>
        <main class="mx-auto mt-6 lg:mt-20 space-y-6">
            <p class="text-gray-700 p-4 mb-4 whitespace-pre-wrap"> {{ $post->content }} </p>
        </main>
        @if ($post->thumbnail)
        <div class="firstImage flex justify-center w-full  pb-14">
            <img src="{{ asset($post->thumbnail) }}" alt="cant find the image"/>
        </div>
        @endif
        </div>
    </x-layout>
</body>
</html>
