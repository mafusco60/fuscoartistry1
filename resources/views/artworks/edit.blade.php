<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold mb-1">Edit Artwork</h2>
      <p class="mb-4"></p>
    </header>

    <form
      method="POST"
      action="{{ route('artworks.update', $artwork->id) }}"
      enctype="multipart/form-data"
    >
      @csrf
      @method('PUT')
      <div class="grid grid-cols-3">
        <img
          class="w-[250px] mr-6 mb-6 rounded-xl col-start-2"
          src="{{ asset($artwork->image) }}"
          alt="{{ $artwork->title }}"
        />
      </div>
      <p class="font-bold text-center">{{ $artwork->image }}</p>
      <div class="mb-2">
        <x-inputs.file id="image" name="image" label="Image" />
      </div>

      <div class="mb-2">
        <x-inputs.select
          id="medium"
          name="medium"
          label="Medium"
          value="{{old('medium')}}"
          :options="[ 'Graphite' => 'Graphite', 'Color Pencil' => 'Color Pencil', 'Charcoal' => 'Charcoal', 'Alcohol Marker' => 'Alcohol Marker', 'Ink' => 'Ink', 'Oil Painting' => 'Oil Painting', 'Oil Pastel' => 'Oil Pastel', 'Soft Pastel' => 'Soft Pastel', 'Acrylic Painting' => 'Acrylic Painting', 'Watercolor' => 'Watercolor', 'Mixed Media' => 'Mixed Media', 'Digital Art' => 'Digital Art', 'Other' => 'Other']"
          :value="old('medium', $artwork->medium)"
        />
      </div>

      <div class="mb-2">
        <x-inputs.text
          id="title"
          name="title"
          label="Artwork Title"
          placeholder="Example: The Dancer"
          :value="old('title', $artwork->title)"
        />
      </div>

      <div class="mb-2">
        <x-inputs.text
          id="search_tags"
          name="search_tags"
          label="Search Tags"
          placeholder="Example: Colorful, Abstract, Surreal"
          :value="old('search_tags', $artwork->search_tags)"
        />
      </div>

      <div class="mb-2">
        <x-inputs.text-area
          id="description"
          name="description"
          label="Description"
          placeholder="Example: This piece was inspired by..."
          :value="old('description', $artwork->description)"
        />
      </div>

      <div class="mb-2">
        <x-inputs.select
          id="featured"
          name="featured"
          label="Featured"
          value="{{old('featured')}}"
          :options="[ '1' => 'Yes', '0' => 'No']"
          :value="old('featured', $artwork->featured)"
        />
      </div>

      <div class="mb-2">
        <x-inputs.select
          id="original"
          name="original"
          label="Original"
          value="{{old('original')}}"
          :options="[ '1' => 'Yes', '0' => 'No']"
          :value="old('original', $artwork->original)"
        />
      </div>

      <div class="mb-2">
        <x-inputs.text
          id="original_price"
          name="original_price"
          label="Original Price"
          placeholder="Example: 200"
          type="number"
          :value="old('original_price', $artwork->original_price)"
        />
      </div>

      <div class="mb-2">
        <x-inputs.text
          id="original_substrate"
          name="original_substrate"
          label="Original Substrate"
          placeholder="Example: Artist Paper"
          :value="old('original_substrate', $artwork->original_substrate)"
        />
      </div>

      <div class="mb-2">
        <x-inputs.text
          id="original_dimensions"
          name="original_dimensions"
          label="Original Dimensions"
          placeholder='Example: 12"x14"'
          :value="old('original_dimensions', $artwork->original_dimensions)"
        />
      </div>

      <div class="mb-2">
        <button
          type="submit"
          class="bg-indigo-900 text-white rounded py-2 px-4 hover:bg-blue-700"
        >
          Submit
        </button>
      </div>
    </form>
  </x-card>
</x-layout>
