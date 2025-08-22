<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>


    @include('shared.success-message')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($categories->isEmpty())
                    <p class="text-gray-700 dark:text-gray-200 mb-4">Nenhuma categoria cadastrada.</p>
                    <a href="{{route('category.create')}}"
                        class="text-white text-sm px-4 py-2 bg-blue-700 rounded-lg hover:bg-blue-800">
                        Criar Categoria
                    </a>
                @else
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Categorias</h3>
                        <a href="{{route('category.create')}}"
                            class="text-white text-sm px-4 py-2 bg-blue-700 rounded-lg hover:bg-blue-800">
                            Criar Categoria
                        </a>
                    </div>

                    <ul class="space-y-2">
                        @foreach($categories as $category)
                            <li class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-3 rounded">
                                <span class="text-gray-800 dark:text-gray-200">{{ $category->name }}</span>
                                <div class="space-x-2">
                                    <a href="{{ route('category.show', $category->id) }}"
                                        class="text-blue-600 hover:underline">Show</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
