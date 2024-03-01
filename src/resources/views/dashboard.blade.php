<x-app-layout>
    <div class="p-5 pt-8 border ignore border-gray-200 not-prose dark:border-gray-800 relative bg-gray-50 dark:bg-gray-800">
        <div class="max-w-5xl mx-auto">
            <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5">
                <a href="/create" class="button" role="button">ADD</button>
                @foreach ($todos as $todo)
                <a href="#" target="_blank" class="relative flex justify-between p-6 border border-gray-200 dark:border-gray-800 dark:bg-black bg-white">
                    <div class="todo-content">
                        <h4 class="title flex items-center justify-between w-full mb-4">{{$todo->title}}</h4>
                        <span class="relative text-xs md:text-sm text-gray-600 dark:text-gray-400">{{$todo->content}}</span>
                    </div>
                    <input type="checkbox" class="w-6 h-6 mt-5 rounded" />
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>