@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="py-12">
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">
            {{ $task->exists ? 'Editar' : 'Nova' }} Task
        </h1>

        <form action="{{ $task->exists ? route('task.update', $task) : route('task.store') }}" method="POST"
            class="space-y-6">
            @csrf
            @if($task->exists)
                @method('PUT')
            @endif

            {{-- Campo nome --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nome da task
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                   Categoria
                </label>
                <select name="category_id" id="category_id"
                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Selecione uma categoria</option>
                    @foreach($task->category as $category)
                        <option value="{{ $task->category_id }}" {{ old('category_id', $task->category_id) }}>
                            {{ $task->category_name }}
                        </option>
                    @endforeach
                </select>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Description
                </label>
                <input type="text" name="description" id="description"
                    value="{{ old('description', $task->description) }}"
                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Due Date
                </label>
                <input type="datetime-local" name="due_date" id="due_date"
                    value="{{  old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : now()) }}"
                    required
                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                <input type="radio" id="weekly" name="frequency" value="WEEKLY">
                <label for="weekly">Weekly</label>
                <input type="radio" id="monthly" name="frequency" value="MONTHLY">
                <label for="monthly">Monthly</label><br>
                <input type="radio" id="daily" name="frequency" value="DAILY">
                <label for="daily">Daily</label><br>
                @error('frequency')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <input type="radio" id="pending" name="status" value="PENDING">
                <label for="pending">Pending</label>
                <input type="radio" id="in_progress" name="status" value="IN PROGRESS">
                <label for="in_progress">In Progress</label>
                <input type="radio" id="completed" name="status" value="COMPLETED">
                <label for="completed">Completed</label>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botão --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700 shadow-sm transition">
                    {{ $task->exists ? 'Atualizar' : 'Criar' }}
                </button>
            </div>
        </form>
    </div>
</div>
