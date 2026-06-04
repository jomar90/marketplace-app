<x-layout>
    <x-slot:heading>
        Add Product
    </x-slot:heading>

    <form method="POST" action="/products">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Add Product</h2>


                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="product">Product</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="product" id="product" placeholder="Keyboard" />

                            <x-form-error name="product" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="slug">Slug</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="slug" id="slug" placeholder="keyboard" />

                            <x-form-error name="slug" />
                        </div>
                    </x-form-field>


                    <x-form-field>
                        <x-form-label for="price">Price</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="price" id="price" type="number" placeholder="€100" />

                            <x-form-error name="price" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="stock">Stock</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="stock" id="stock" placeholder="10" />

                            <x-form-error name="stock" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="description">Description</x-form-label>

                        <div class="mt-2">
                            <x-form-input
                                name="description"
                                id="description"
                                class="border-gray-300 rounded-md shadow-sm w-full"
                            />

                            <x-form-error name="description" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <div class="flex items-center gap-2 mt-2">
                            <input type="checkbox" name="is_promoted" id="is_promoted" value="1"
                                class="rounded border-gray-300">

                            <x-form-label for="is_promoted">
                                Promote this product
                            </x-form-label>
                        </div>

                        <x-form-error name="is_promoted" />
                    </x-form-field>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <x-form-button>Save</x-form-button>
        </div>
    </form>
</x-layout>
