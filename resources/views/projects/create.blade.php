<x-app-layout>
    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('projects.store') }}">
            @csrf

            <!-- Project Name -->
            <div>
                <x-input-label for="project_name" :value="__(' Naam')" />

                <x-text-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" :value="old('project_name')" required autofocus />

            </div>

            <!-- Project Description -->
            <div class="mt-4">
                <x-input-label for="project_description" :value="__(' Omschrijving')" />

                <x-text-input id="project_description" class="block mt-1 w-full"
                              type="text"
                              name="project_description"/>
            </div>

            <!-- Project Goal -->
            <div class="mt-4">
                <x-input-label for="project_goal" :value="__('Doel')" />

                <x-text-input id="project_goal" class="block mt-1 w-full"
                              type="number"
                              name="project_goal"/>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ml-3">
                    {{ __('Klaar') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
