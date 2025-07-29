<x-app-layout>
    @include('shared.success-message')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($tasks as $task)
                        <div class="flex justify-between items-center mt-2">
                            <h1 class="text-xl font-semibold">{{$task->title}}</h1>
                            <h2 class="text-gray-500">{{\Carbon\Carbon::parse($task->due_date)->format('d-m')}}</h2>
                        </div>
                        <div class='flex text-sm space-x-2 mt-1 items-center'>
                            @include('components.' . $task->status)
                            @include('components.' . $task->frequency)
                            <div class='bg-gray-100 text-gray-300 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-100 dark:text-gray-700'>{{$task->name}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>