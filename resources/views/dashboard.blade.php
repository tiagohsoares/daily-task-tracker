<x-app-layout>
    @include('shared.success-message')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-1 space-y-6 justify-end">

                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap items-center gap-4">
                    <label for="status" class="text-gray-700 dark:text-gray-300 font-medium">
                        Status:
                    </label>

                    <select name="status" id="status" onchange="this.form.submit()"
                        class="w-52 sm:w-60 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 px-3 py-2 shadow-sm">
                        <option value="">Selecione o status</option>
                        @foreach (App\Enums\TaskStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ request('status') === $status->value ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>

                    <label for="frequency" class="text-gray-700 dark:text-gray-300 font-medium">
                        Frequência:
                    </label>
                    <select name="frequency" id="frequency" onchange="this.form.submit()"
                        class="w-52 sm:w-60 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 px-3 py-2 shadow-sm">
                        <option value="">Selecione a frequência</option>
                        @foreach (App\Enums\TaskFrequency::cases() as $frequency)
                            <option value="{{ $frequency->value }}" {{ request('frequency') === $frequency->value ? 'selected' : '' }}>
                                {{ $frequency->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
                        <h4 class="text-gray-500 dark:text-gray-300 text-sm">Total de Tarefas</h4>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">
                            {{ $tasks->count() }}
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
                        <h4 class="text-gray-500 dark:text-gray-300 text-sm">Nesta Semana</h4>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">
                            {{ $tasks->where('due_date', '<', now()->addDays(8))->count() }}
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
                        <h4 class="text-gray-500 dark:text-gray-300 text-sm">Concluídas</h4>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-2">
                            {{ $tasks->where('status', 'completed')->count() }}
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
                        <h4 class="text-gray-500 dark:text-gray-300 text-sm">Pendentes</h4>
                        <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mt-2">
                            {{ $tasks->where('status', 'pending')->count() }}
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Resumo Gráfico</h3>
                    <canvas id="myChart" height="180"></canvas>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if($tasks->isEmpty())
                            <div class="flex justify-between items-center">
                                <h5 id="mensagem" class="text-lg text-gray-600 dark:text-gray-300">Nenhuma tarefa cadastrada</h5>
                                <a href="{{route('task.create')}}"
                                    class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-medium">
                                    Criar Tarefa
                                </a>
                            </div>
                        @else
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Minhas Tarefas</h3>
                                <a href="{{route('task.create')}}"
                                    class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-medium">
                                    Criar Tarefa
                                </a>
                            </div>

                            <div class="space-y-4">
                                @foreach ($tasks as $task)
                                    <div
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition">
                                        <div class="flex justify-between items-center">
                                            <div class="flex justify-between items-center space-x-3">
                                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                                    {{ $task->title }}
                                                </h2>
                                                <h3 class="text-base text-gray-500 dark:text-gray-300">
                                                    {{ $task->category->name ?? 'Sem categoria' }}
                                                </h3>
                                            </div>

                                            <span class="text-base text-gray-500">Due:
                                                {{ \Carbon\Carbon::parse($task->due_date)->format('d/m') }}</span>
                                        </div>

                                        <h3 class="text-sm text-gray-500 dark:text-gray-300">
                                            {{ $task->description ?? '' }}
                                        </h3>

                                        <div class="flex justify-between items-center mt-3 text-sm">
                                            <div class="flex items-center space-x-2">
                                                @include($task->status->view())
                                                @include($task->frequency->view())
                                            </div>
                                            <div>
                                                <a href="{{ route('task.show', $task->id) }}"
                                                    class="text-blue-600 dark:text-blue-400 hover:underline">
                                                    Ver detalhes
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{ $tasks->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($tasks->isNotEmpty())
        {{-- Chart.js --}}
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('myChart').getContext('2d');

                const data = {
                    labels: ['Total', 'Semana', 'Concluídas', 'Pendentes'],
                    datasets: [{
                        label: 'Tarefas',
                        data: [
                                            {{ $tasks->count() }},
                                            {{ $tasks->where('due_date', '<', now()->addDays(8))->count() }},
                                            {{ $tasks->where('status', 'completed')->count() }},
                            {{ $tasks->where('status', 'pending')->count() }}
                        ],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(239, 68, 68, 0.7)'
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(239, 68, 68, 1)'
                        ],
                        borderWidth: 1
                    }]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: true }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#6B7280'
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#6B7280'
                                }
                            }
                        }
                    }
                };
                new Chart(ctx, config);
            </script>
        @endpush
    @endif
</x-app-layout>
