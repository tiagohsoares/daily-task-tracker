<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task: ') . $task->title }}
        </h2>
    </x-slot>

    @include('shared.success-message')

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Formulário de edição da categoria --}}
                <div class="mb-6">
                    @include('task.form')
                </div>

                {{-- Ações --}}
                <div class="flex justify-end space-x-4">
                    {{-- Botão de exclusão que aciona o modal --}}
                    <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'category-deletion')">
                        Excluir Categoria
                    </x-secondary-button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de confirmação de exclusão --}}
    <x-modal name="category-deletion" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Tem certeza que deseja excluir esta categoria?
            </h2>

            <div class="mt-6 flex justify-end space-x-4">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <form method="POST" action="{{ route('task.destroy', $task->id) }}">
                    @csrf
                    @method('delete')
                    <x-danger-button>
                        Confirmar Exclusão
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-modal>
</x-app-layout>

