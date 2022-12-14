<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @foreach($projects as $project)
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{route("project.show", $project->id)}}">{{$project->name}}</a>
                        <p>{{$project->user->name}}</p>
                        <p>{{$project->description}}</p>
                        <div class="flex flex-row">
                            <p>{{$project->progress}}</p>
                            <progress id="file" value="{{$project->progress}}" max="{{$project->goal}}"></progress>
                            <p>{{$project->goal}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
