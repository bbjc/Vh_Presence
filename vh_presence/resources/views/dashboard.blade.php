<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('members.create') }}"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ajouter un membre
            </a>      
        </div>
        
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session()->has('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <span class="font-medium">{{ session('success') }}</span> 
                      </div>
                    @endif
                    <p class="text-4xl font-bold text-gray-900 dark:text-white mb-12">Liste des Membres</p>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nom
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Prenom
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sexe
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Anniversaire
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Modifier</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($membres as $membre)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $membre->nom }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $membre->prenom }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $membre->sexe }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $membre->date_anniversaire }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="#" class="text-red-600" onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')) { document.getElementById('delete-form-{{ $membre->id }}').submit(); }">
                                            Supprimer
                                        </a>
                                        <a href="{{ route('members.edit', $membre->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
                                    </td>
                                    <form id="delete-form-{{ $membre->id }}" action="{{ route('members.destroy', $membre->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
