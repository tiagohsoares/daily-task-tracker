<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>
    <div class="flex justify-between">
        <a href="{{route('category.create')}}" class="text-white text-sm items-center pl-6 pr-6 bg-blue-700 rounded-lg hover:underline"> Criar Categoria </a>
    
    @if($categories->isEmpty())
        <p>Nenhuma categoria cadastrada.</p>
    @else
    </div>
        <ul>
            @foreach($categories as $category)
                <li>{{ $category->name }}</li>
                <a href={{route('category.edit', $category->id)}}> Edit </a>
                <a href={{route('category.destroy', $category->id)}}> Delete </a>
            @endforeach
        </ul>
    @endif

</x-app-layout>

    