<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"  @style(['background-color: #fafafa'])>
        <form method="POST" action="{{ route('product.update', $product) }}">
            @csrf
            @method('patch')
            <textarea
                name="name"
                placeholder="{{ __('Add name') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('name', $product->name) }}</textarea>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <textarea
                name="description"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('description', $product->description) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('page.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>