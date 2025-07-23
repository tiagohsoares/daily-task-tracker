<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex-col grid-cols-4">
                    @if (!empty($categories))
                        @foreach ($categories as $category)
                            <table class="pl-6 items-center align-middle">
                            @foreach ($category as $key => $value)
                               <tr><th>{{$key}}</th><td>{{$value}}</tr>
                            @endforeach
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
