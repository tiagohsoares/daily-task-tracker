<x-app-layout>
    @include('shared.success-message')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <section>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg justify-between flex">
                    Total de Tarefas<br>
                    {{ $tasks->count() }}
                <div>
                    Quantidade de tarefas nesta semana<br>
                    {{ $tasks->where('due_date', '<',now()->addDays(8))->count()}}
                </div>
                <div>
                    Quantidade de tarefas concluidas<br>
                    {{ $tasks->where('status', 'completed')->count() }}
                </div>
            </div>
        </div>
    </section>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($tasks->isEmpty())
                        <div class="flex justify-between">
                            <h1> Nenhuma tarefa cadastrada </h1>
                            <a href="{{route('task.create')}}"
                                class="text-white text-sm items-center pl-6 pr-6 bg-blue-700 rounded-lg hover:underline">
                                Criar Task </a>
                    @else
                            <div class="flex justify-between items-center mt-2">
                                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Tasks</h3>
                                <a href="{{route('task.create')}}"
                                    class="text-white text-sm px-4 py-2 bg-blue-700 rounded-lg hover:bg-blue-800">
                                    Criar Task</a>
                            </div>
                            @foreach ($tasks as $task)
                                <section>
                                    <div class="flex justify-between items-center mt-2">
                                        <div class="flex items-center space-x-2">
                                            <h1 class="text-lg font-medium">{{$task->title}}</h1>
                                            <span
                                                class="text-sm text-gray-400">{{$task->category->name ?? 'Sem categoria'}}</span>
                                        </div>
                                        <h2 class="text-gray-500">{{\Carbon\Carbon::parse($task->due_date)->format('d-m')}}</h2>
                                    </div>
                                    <div class='flex justify-between text-sm space-x-2 mt-1 items-center'>
                                        <div class="flex space-x-2 items-center">
                                            @include($task->status->view())
                                            @include($task->frequency->view())
                                        </div>
                                        <div class="flex justify-between space-x-4">
                                            <a class="dark:bg-blue-500 rounded-sm p-1 shadow-sm" href={{route('task.show', $task->id)}}> Show </a>
                                        </div>
                                    </div>
                                </section>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config // We'll add the configuration details later.
                );
            </script>
        @endpush
</x-app-layout>