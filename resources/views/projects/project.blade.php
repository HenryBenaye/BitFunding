<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden flex items-center flex-col shadow-sm sm:rounded-lg">
                <p class="font-semibold text-2xl">{{$project->name}}</p>
                <span>{{$project->description}}</span>

                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                    <div
                        class="bg-purple-600 text-xs font-medium text-blue-100 text-center p-1.5 leading-none rounded-full"
                        style="width: {{$progress}}%"> {{$progress}}%
                    </div>
                </div>
                <div class="w-full flex flex-row justify-between px-2">
                    <p>€0</p>
                    <p>€{{$project->goal}}</p>
                </div>

            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 mt-4 lg:px-8">
            <div class="bg-white overflow-hidden  flex items-center flex-col shadow-sm sm:rounded-lg">
                @if(Auth::user()->id == $project->user_id)
                    <div class="flex flex-row justify-between w-full px-4">
                        <h1 class="font-bold">Gestorte Bedragen</h1>
                        <h1 class="font-bold">Gebruikers</h1>
                    </div>
                    @foreach($deposits as $deposit)
                        <x-user-project-info :deposit="$deposit"></x-user-project-info>
                    @endforeach
                @else
                    <div class="flex justify-center w-full px-4">
                        <h1 class="font-bold">Gestorte Bedragen</h1>
                    </div>
                    @foreach($deposits as $deposit)
                        <x-project-info :deposit="$deposit"></x-project-info>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
