<x-layout>
    <x-slot:heading>
        Add Book
    </x-slot:heading>

    <form method="POST" action="/books">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Add Book</h2>


                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Title</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="title" id="title" placeholder="CEO" />

                            <x-form-error name="title" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="auhor">Author</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="author" id="author" placeholder="Stephen King" />

                            <x-form-error name="author" />
                        </div>
                    </x-form-field>


                    <x-form-field>
                        <x-form-label for="publication_year">Publication Year</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="publication_year" id="publication_year" type="number" placeholder="1990"/>

                            <x-form-error name="publication_year" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="pages">Pages</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="pages" id="pages" placeholder="500" />

                            <x-form-error name="pages" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="publisher_id">Publisher</x-form-label>

                        <div class="mt-2">
                            <select name="publisher_id" id="publisher_id" class="border-gray-300 rounded-md shadow-sm w-full">

                                <!-- Placeholder -->
                                <option value="" disabled {{ old('publisher_id') ? '' : 'selected' }}>
                                    Select a publisher
                                </option>

                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}"
                                        {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach

                            </select>

                            <x-form-error name="publisher_id" />
                        </div>
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
