<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ URL('/images/logo.jpeg') }}" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/lib/js/jquery.emojiarea.min.js')}}"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.3.0/css/emoji.min.css" integrity="sha512-RB5S8EZDBVvQlNJIQNLCMBE/1QzTkmRf+QoYNdOpPu2hIfxvNC/emRQkhiPR0qmya7eYDX+C+hKnp70b0mq49w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
      <!-- ** Don't forget to Add jQuery here ** -->
    <script src="{{ asset('assets/lib/js/config.min.js')}}"></script>
    <script src="{{asset('assets/lib/js/util.min.js')}}"></script>
    <script src="{{asset('assets/lib/js/emoji-picker.min.js')}}"></script>
    <title>Posts</title>
</head>

<body class="bg-slate-600">
    {{-- i can use the same component structure but with different content --}}
    <x-layout>
        <section class="mt-8 mr-4">
            <div class="flex justify-end">
                <div class="flex justify-between">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="text-white bg-transparent hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                    @endcan
                    @can('delete', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-white bg-transparent hover:bg-gray-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        </section>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-slate-800 rounded-lg pt-6">
            <h1 class="text-3xl text-white font-semibold flex justify-center text-center">{{ $post->title }}</h1>
            <main class="mx-auto mt-6 lg:mt-20 space-y-6">
                <p class="text-white p-4 mb-4 whitespace-pre-wrap"> {{ $post->content }} </p>
            </main>
            @if ($post->thumbnail)
                <div class="firstImage flex justify-center w-full  pb-14">
                    <img src="{{ asset($post->thumbnail) }}" alt="cant find the image" />
                </div>
            @endif
        </div>


        <form class="h-full pb-20" method="POST" action="{{ route('comments.store', $post->id) }}">
            @csrf
            <label for="chat" class="sr-only">Your message</label>
            <div class="emoji-picker-container">
            <div class="flex items-center px-3 py-2 rounded-lg dark:bg-gray-700">
                {{-- <button type="button"
                    class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z" />
                    </svg>
                    <span class="sr-only">Add emoji</span>
                </button> --}}
                <div class="relative w-full">
                    <textarea name="comment" data-emojiable="true"
                      class="border-0 peer h-full w-full border-white text-white resize-none border-white bg-transparent pt-4 pb-1.5 font-sans font-normal text-blue-gray-700 outline outline-white outline-0 transition-all placeholder-shown:border-white focus:border-white focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-white"
                      placeholder="Your comment..."></textarea>
                    <label
                      class="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-0 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-900 after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-white peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                    </label>
                  </div>
                <button type="submit"
                    class="-mt-10 inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-gray-400 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </div>

            <div class="flex flex-col gap-0 ">
                {{-- <pre> --}}
                {{-- <?php var_dump($comments); ?> --}}
                {{-- </pre> --}}
                @foreach ($comments as $comment)
                    <div
                        class="w-11/12 ml-9 mt-6 flex flex-col ">
                        <div class="flex flex-row gap-4 items-center">
                            <img class="w-10 h-10 mb-3 rounded-full shadow-lg mt-2 ml-2" src="{{ URL('images/1053244.png') }}" alt="user image" />
                            <h5 class="mb-4 text-xl font-medium text-white dark:text-white">{{ $comment->user->name }}</h5>
                        </div>
                        <div class="p-4 text-white"> {{ $comment->comment }} </div>
                    </div>
                    <div class="w-full flex flex-col justify-center items-center">
                        <hr class="w-10/12">
                    </div>
                @endforeach
            </div>
        </form>


    </x-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.3.0/js/emoji-picker.min.js" integrity="sha512-YfxG/O/w/NLRY0pZ8TfuIZVefdDVyN8MOzfyvieoCQ++vj8+W9RUE3oiCqPCdvSJ3UDliy4WPyWutdewPqHgYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
          // Initializes and creates emoji set from sprite sheet
          window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: '/assets/lib/img/',
            popupButtonClasses: 'fa fa-smile-o' // far fa-smile if you're using FontAwesome 5
          });
          // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
          // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
          // It can be called as many times as necessary; previously converted input fields will not be converted again
          window.emojiPicker.discover();
        });
      </script>
</body>

</html>
