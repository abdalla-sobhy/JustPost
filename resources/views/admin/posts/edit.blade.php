<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body class="flex flex-col w-full">
    {{-- i can use the same component structure but with different content --}}
    <x-layout>
        <div class="w-full h-5/6 flex justify-center items-center">
            <div class=" w-1/2 mx-auto p-4 bg-slate-200 dark:bg-slate-900 rounded-lg">
                <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input name="title" type="text" id="base-input" value="{{ old('title', $post->title) }}" class="@error('title')
                            border-red-500
                        @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">content</label>
                        <textarea name="content" id="message" rows="4" class="@error('content')
                            border-red-500
                        @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ old('content', $post->content) }} </textarea>
                        @error('content')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Thumbnail</label>
                        <input value="{{ old('thumbnail', $post->thumbnail) }}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="thumbnail" name="thumbnail" type="file">
                        @error('thumbnail')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <div class="mb-6">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-layout>
</body>
</html>
