<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"  @style(['background-color: #fafafa'])>
        <form method="POST" enctype="multipart/form-data" action="{{ route('ban.store', $user) }}">
            @csrf
            <textarea
                name="reason"
                placeholder="{{ __('Reason for ban') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            ></textarea>
            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
            <select name="duration">
                <option value="2">2 weeks</option>
                <option value="4">4 weeks</option>
                <option value="52">1 year</option>
                <option value="104000">permanent</option>
            </select>
            <x-primary-button class="mt-4">{{ __('Ban user') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>