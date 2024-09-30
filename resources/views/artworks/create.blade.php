

<x-layout>
 {{-- <x-card class="p-10 max-w-lg mx-auto mt-24">  --}}
    <header class="text-center">
      <h2 class="text-2xl font-bold mb-1">Add an Artwork</h2>
      <p class="mb-4"></p>
    </header>

    <form method="POST" action="/artworks" enctype="multipart/form-data">
      @csrf

      <div class="mb-2">
        <label for="image" class="inline-block text-sm mb-2">Image</label>
        <input
          type="file"
          class="text-sm border border-gray-200 rounded p-2 w-full"
          name="image"
          id="image"
        />
        @error('image')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-2">
        <label for="medium" class="inline-block text-sm mb-2">
          Type of Artwork
        </label>
        <select
          class="text-sm border border-gray-200 rounded p-2 w-full"
          name="medium"
          id="medium"
          value="{{ old('medium') }}"
        >
          <option value="Other">Other</option>
          <option value="Graphite">Graphite</option>
          <option value="Color Pencil">Color Pencil</option>
          <option value="Charcoal">Charcoal</option>
          <option value="Alcohol Marker">Alcohol Marker</option>
          <option value="Ink">Ink</option>
          <option value="Oil Painting">Oil Painting</option>
          <option value="Oil Pastel">Oil Pastel</option>
          <option value="Soft Pastel">Soft Pastel</option>
          <option value="Acrylic Painting">Acrylic Painting</option>
          <option value="Watercolor">Watercolor</option>
          <option value="Mixed Media">Mixed Media</option>
          <option value="Digital Art">Digital Art</option>
        </select>

        @error('medium')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-2">
        <label for="title" class="inline-block text-sm mb-2">
          Artwork Title
        </label>
        <input
          type="text"
          class="text-sm border border-gray-200 rounded p-2 w-full"
          name="title"
          placeholder="Example: The Dancer"
          value="{{ old('title') }}"
          id="title"
        />

        @error('title')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-2">
        <label for="search_tags" class="inline-block text-sm mb-2">
          Tags 
        </label>
        <input
          type="text"
          class="text-sm border border-gray-200 rounded p-2 w-full"
          name="search_tags"
          id="search_tags"
          placeholder="Example: Dancer, Ballet, Graceful"
          value="{{ old('search_tags') }}"
        />

        @error('search_tags')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-2">
        <label for="description" class="inline-block text-sm mb-2">
          Artwork Description
        </label>
        <textarea
          class="text-sm border border-gray-200 rounded p-2 w-full"
          name="description"
          id="description"
          rows="2"
          placeholder="Example: An acrylic portrait of a young dancer."
        >{{ old('description') }}</textarea>

        @error('description')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-2">
        <label for="featured" class="inline-block text-sm mb-2">Featured</label>
        <select
          name="featured"
          id="featured"
          class="text-sm border rounded"
        >
          <option value='1'>Yes</option>
          <option value='0'>No</option>
        </select>
      </div>

      <div class="mb-2">
        <label for="original" class="inline-block text-sm mb-2">Original</label>
        <select
          name="original"
          id="original"
          class="text-sm border rounded"
        >
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="mb-2">
        <label for="original_price" class="inline-block text-sm mb-2">
        Original Price        </label>
        <input
          class="text-sm border border-gray-200 rounded p-2 w-full"
          name="original_price"
          id="original_price"
  
        {{ old('original_price') }}/>

        @error('original_price')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-2">
        <label for="original_substrate" class="inline-block text-sm mb-2">
        Original Substrate        </label>
        <input
          class="text-sm border border-gray-200 rounded p-2 w-full"
          name="original_substrate"
          id="original_substrate"
  
        {{ old('original_substrate') }}/>

        @error('original_substrate')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-2">
        <label for="original_dimensions" class="inline-block text-sm mb-2">
        Original Dimensions        </label>
        <input
          class="text-sm border border-gray-200 rounded p-2 w-full"
          name="original_dimensions"
          id="original_dimensions"
  
        {{ old('original_dimensions') }}/>

        @error('original_dimensions')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-2">
        <button type="submit" class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-blue-700">
          Submit
        </button>
      </div>
    </form>
  {{-- </x-card> --}}
</x-layout>
