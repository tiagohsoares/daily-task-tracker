
<h1>{{ $category->exists ? 'Editar' : 'Nova' }} Categoria</h1>

<form action="{{ $category->exists ? route('category.update', $category) : route('category.store') }}" method="POST">
    @csrf
    @if($category->exists)
        @method('PUT')
    @endif

    <div>
        <label for="name">Nome</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
        @error('name')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">{{ $category->exists ? 'Atualizar' : 'Criar' }}</button>
</form>