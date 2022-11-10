<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-italic text-xl text-blue-800 leading-tight">
                <a href="/browse-pages">{{__('Browse Pages')}}</a>
            </h2>
            <br>
            @admin
                <h2 class="font-italic text-xl text-blue-800 leading-tight">
                            <a href="/admin-panel">{{ __('Admin Panel') }}</a>
                        </h2>
            @endadmin
            <br>
            <h2 class="font-italic text-xl text-blue-800 leading-tight">
                <a href="/user-settings">{{__('User Settings')}}</a>
            </h2>
            <br>
            <h2 class="font-italic text-xl text-blue-800 leading-tight">
                <a href="/user-pages">{{__('Your Pages')}}</a>
            </h2>
            <br>
            <h2 class="font-italic text-xl text-blue-800 leading-tight">
                <a href="/create-page">{{__('Create a Page')}}</a>
            </h2>
            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
