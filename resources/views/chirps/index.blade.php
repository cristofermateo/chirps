<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST">
                        @csrf
                        <textarea name="message"
                            class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focusring-indigo-200 dark:focus:ring-opacity-50 text-black"
                            placeholder="¿Qué piensas?">{{ old('message') }}</textarea>

                        <x-input-error :messages="$errors->get('message')" />

                        <x-primary-button>Chirp</x-primary-button>
                    </form>
                </div>
            </div>
            <div>
            </div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rouded-lg divide-y dark:divide-gray-900">
            @foreach ($chirps as $fila)
                {{ $fila->message }}
                {{ $fila->id }}
                {{ $fila->created_at }}
                {{ $fila->user->name }}
                <a href="{{ route('chirps.edit')}}">{{ __('edit Chirp') }}</a>
                <br>
                <br>
            @endforeach
            </div>
    </div>
</x-app-layout>
