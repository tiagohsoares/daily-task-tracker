@if (session('success'))
    <div class="mb-4 rounded-md bg-green-100 border border-green-300 p-4 relative text-green-800 dark:bg-green-900 dark:border-green-700 dark:text-green-100 shadow-sm">
        <span class="block text-sm font-medium">
            {{ session('success') }}
        </span>
        <button type="button" 
                class="absolute top-2 right-2 text-green-800 dark:text-green-100 hover:text-green-600"
                onclick="this.parentElement.remove();"
                aria-label="Fechar">
            &times;
        </button>
    </div>
@endif
@if (session('failed'))
<div class="mb-4 rounded-md bg-red-100 border border-red-300 p-4 relative text-red-800 dark:bg-red-900 red:border-green-700 dark:text-red-100 shadow-sm">
    <span class="block text-sm font-medium">
        {{ session('failed') }}
    </span>
    <button type="button" 
            class="absolute top-2 right-2 text-red-800 dark:text-red-100 hover:text-red-600"
            onclick="this.parentElement.remove();"
            aria-label="Fechar">
        &times;
    </button>
</div>
@endif
    