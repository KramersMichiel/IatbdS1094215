<x-app-layout>
    <div class="w-full h-full flex justify-center content-center">
        <form method="POST" action="{{ route('product.update', $product) }}" class="bg-white w-5/6 md:w-3/4 lg:w-1/3 h-full mt-16 rounded-lg p-4">
            @csrf
            @method('patch')
            <div class="w-full h-full flex flex-col gap-4">
                <div>
                    <label for="name">Change name: </label>
                    <textarea
                        name="name"
                        placeholder="{{ __('Change name') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >{{ old('name', $product->name) }}</textarea>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <label for="description">Change description: </label>
                    <textarea
                        name="description"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >{{ old('description', $product->description) }}</textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>
                <div class="mt-4 space-x-2 flex justify-end">
                    <a href="{{ route('page.index') }}">{{ __('Cancel') }}</a>
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>