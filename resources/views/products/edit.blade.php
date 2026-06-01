<x-layout>
    <x-slot:heading>
        Edit Product: {{ $product->name }}
    </x-slot:heading>

    <form method="POST" action="/products/{{ $product->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="Shift Leader"
                                    value="{{ $product->name }}"
                                    required>
                            </div>

                            @error('name')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @if(auth()->user()->isAdmin())

                    <div class="sm:col-span-4">
                        <label for="user_id"
                            class="block text-sm font-medium leading-6 text-gray-900">
                            Seller
                        </label>

                        <div class="mt-2">
                            <select
                                name="user_id"
                                id="user_id"
                                class="border-gray-300 rounded-md shadow-sm w-full"
                            >
                                @foreach ($users as $user)
                                    <option
                                        value="{{ $user->id }}"
                                        {{ $product->user_id == $user->id ? 'selected' : '' }}
                                    >
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @endif

                    <div class="sm:col-span-4">
                        <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                            >
                                <input
                                    type="text"
                                    name="slug"
                                    id="slug"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="$50,000 Per Year"
                                    value="{{ $product->slug }}"
                                    required>
                            </div>

                            @error('slug')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                            >
                                <input
                                    type="text"
                                    name="price"
                                    id="price"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="€100"
                                    value="{{ $product->price }}"
                                    required>
                            </div>

                            @error('price')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="category_id"
                            class="block text-sm font-medium leading-6 text-gray-900">
                            Category
                        </label>

                        <div class="mt-2">
                            <select
                                name="category_id"
                                id="category_id"
                                class="border-gray-300 rounded-md shadow-sm w-full"
                                required
                            >
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="text-xs text-red-500 font-semibold mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="stock"
                            class="block text-sm font-medium leading-6 text-gray-900">
                            Stock
                        </label>

                        <div class="mt-2">
                            <input
                                type="number"
                                name="stock"
                                id="stock"
                                value="{{ $product->stock }}"
                                class="block w-full rounded-md border-gray-300"
                                required
                            >

                            @error('stock')
                                <p class="text-xs text-red-500 font-semibold mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="description"
                            class="block text-sm font-medium leading-6 text-gray-900">
                            Description
                        </label>

                        <div class="mt-2">
                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                class="block w-full rounded-md border-gray-300"
                                required
                            >{{ $product->description }}</textarea>

                            @error('description')
                                <p class="text-xs text-red-500 font-semibold mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                                    </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>

            <div class="flex items-center gap-x-6">
                <a href="/products/{{ $product->id }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>

                <div>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="/products/{{ $product->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
