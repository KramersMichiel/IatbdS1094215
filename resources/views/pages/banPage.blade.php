<x-app-layout>
    <div class="w-full h-full flex justify-center content-center">
        <form method="POST" enctype="multipart/form-data" action="{{ route('ban.store', $user) }}"  class="bg-white w-5/6 md:w-3/4 lg:w-1/3 h-full mt-16 rounded-lg p-4">
            @csrf
            <div class="w-full h-full flex flex-col gap-4">
                <label for="reason" class="">Give a reason why this user should be banned:</label>
                <textarea
                    name="reason"
                    placeholder="{{ __('Reason for ban') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                <div class="flex justify-between">
                    <div>
                        <label for="duration" class="">How long should the user be banned for:</label>
                        <select name="duration" class="mt-2">
                            <option value="2">2 weeks</option>
                            <option value="4">4 weeks</option>
                            <option value="52">1 year</option>
                            <option value="104000">permanent</option>
                        </select>
                    </div>
                    <x-primary-button class="mt-4">{{ __('Ban user') }}</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>