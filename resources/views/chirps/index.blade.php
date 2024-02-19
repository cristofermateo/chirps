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
                <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">

            @foreach ($chirps as $chirp)
                {{ $chirp->message }}
                {{ $chirp->id }}
                {{ $chirp->created_at }}
                {{ $chirp->editado }}
                {{ $chirp->user->name }} {{ $chirp->user_id }}
                @if ($chirp->created_at != $chirp->updated_at )
                <small>editado</small>
                @endif


                @can ('update', $chirp)

                <x-dropdown>

                    <x-slot name="trigger">
                    <button>abrir</button>
                </x-slot>



                    <x-slot name="content">
                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                            {{ __('edit Chirp') }}
                        </x-dropdown-link>
                        <br><br>

                    </x-slot>

                </x-dropdown>

                @endcan


            </div>
            @endforeach
    </div>
</x-app-layout>
