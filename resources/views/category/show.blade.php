<x-app-layout>
<div> 
    @include('shared.success-message')
    <title>{{$category->name}}</title>
    <div class="inline-flex flex-wrap align-middle items-center">
        <span class="text-blue-700"> Criar Categoria </span>
    @include('category.form')

    <x-modal name="category-deletion" focusable>
        <form method="POST" action="{{route('category.destroy', $category->id)}}">
        @csrf
        @method('delete')
    </x-modal>
    <button type="submit" class="bg-red-700 rounded-sm shadow-sm hover:underline">Delete</button>
</div>
</x-app-layout>
