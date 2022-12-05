<x-app-layout>
    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('deposit.store') }}">
            @csrf

            <!-- Project Name -->
            <div>
                <p class="font-semibold text-xl">{{$project->name}}</p>
            </div>
            <!-- Amount -->
            <div class="mt-4">
                <x-input-label for="amount" :value="__('Hoeveel')" />

                <x-text-input id="amount" class="block mt-1 w-full"
                              type="number"
                              name="amount"/>
            </div>

            <!-- Project Message -->
{{--            <div class="mt-4">--}}
{{--                <x-input-label for="project_description" :value="__(' Omschrijving')" />--}}

{{--                <x-text-input id="project_description" class="block mt-1 w-full"--}}
{{--                              type="text"--}}
{{--                              name="project_description"/>--}}
{{--            </div>--}}



            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ml-3">
                    {{ __('Klaar') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
