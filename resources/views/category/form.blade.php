<div class="py-12">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">
                {{ $category->exists ? 'Editar' : 'Nova' }} Categoria
            </h1>

            <form action="{{ $category->exists ? route('category.update', $category) : route('category.store') }}"
                method="POST" class="space-y-6">
                @csrf
                @if($category->exists)
                    @method('PUT')
                @endif

                {{-- Campo nome --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nome da Categoria
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botão --}}
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700 shadow-sm transition">
                        {{ $category->exists ? 'Atualizar' : 'Criar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    