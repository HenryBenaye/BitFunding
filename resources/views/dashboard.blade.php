<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @foreach($projects as $project)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{route("project.show", $project->id)}}">{{$project->name}}</a>
                        <p>{{$project->user->name}}</p>
                        <p>{{$project->description}}</p>
                        <div>
                            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                <div
                                    class="bg-purple-600 text-xs font-medium text-blue-100 text-center p-1.5 leading-none rounded-full"
                                    style="width: {{$project->progress}}%">
                                    {{$project->progress}}%

                                </div>
                            </div>
                            <div class="w-full flex flex-row justify-between px-2">
                                <p>€0</p>
                                <p>€{{$project->goal}}</p>
                            </div>
                        </div>
                        @if($project->user_id != Auth::user()->id)
                            <div>
                                <a href="{{route('deposit',$project->id)}}" class="">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
