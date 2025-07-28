<x-app-layout>
    @include('shared.success-message')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($tasks as $task)
                    <div class="flex justify-between items-center mt-2">
                        <h1 class="text-xl font-bold">{{$task->title}}</h1>
                        @if ($task->status == \app\Enums\TaskStatus::completed)
                        <h2 class="text-gray-500">Terminated</h2>
                        @endif
                        <h2 class="text-gray-500">{{\Carbon\Carbon::parse($task->due_date)->format('d/m/Y')}}</h2>
                    </div>
                    <div class='flex text-sm space-x-2 mt-1'>
                        @include($task->status->view())
                        @include($task->frequency->view())
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
