<x-layout>
  <a
    href="{{ route('artworks.index') }}"
    class="text-indigo-900 text-md my-4 py-2 px-8"
  >
    <i class="fa-solid fa-arrow-alt-circle-left"></i>
    Back to Artworks
  </a>

  <div class="mx-4">
    <div class="text-lg inline text-rose-900 mb-4 rounded-xl py-2 px-6">
      {{-- Display Artwork Image and Details --}}
      <div class="grid grid-cols-1 md:grid-cols-8 gap-6">
        {{-- Row 1 -- Cols 1-3 --}}

        <div
          class="grid grid-cols-1 md:col-span-3 px-5 pt-5 border border-gray-200 bg-indigo-100 rounded-xl"
        >
          <h3 class="text-2xl text-center font-bold mt-10">
            "{{ $artwork->title }}"
          </h3>
          <h2 class="text-xl text-center text-indigo-900 font-bold mb-10">
            {{ ucwords($artwork->medium) }}
          </h2>

          @if ($artwork->original)
            <h2 class="text-lg text-center text-indigo-900">
              Original: ${{ $artwork->original_price }}
            </h2>
            <h2 class="text-lg text-center text-indigo-900">
              Substrate:
              {{ ucwords($artwork->original_substrate) }}
            </h2>
            <h2 class="text-l text-center text-indigo-900 mb-2">
              Dimensions: {{ $artwork->original_dimensions }}
            </h2>
          @else
            <h2 class="text-center">Original Not Available</h2>
          @endif
        </div>
        {{-- Row 1 - Cols 4-6 --}}
        <div
          class="grid grid-cols-1 md:col-span-3 px-5 pt-5 border border-gray-200 bg-indigo-100 rounded-x mx-auto"
        >
          <a
            href="{{ asset($artwork->image) }}"
            data-fancybox="gallery"
            data-caption="{{ $artwork->title }}"
          >
            <img
              class="w-[250px] mr-6 mb-6 rounded-xl"
              src="{{ asset($artwork->image) }}"
              alt="{{ $artwork->title }}"
            />
          </a>
        </div>

        {{-- Row 1 - Cols 7-8 --}}
        <div
          class="grid grid-cols-1 md:col-span-2 text-center md:text-end p-5 border border-gray-200 bg-yellow-50 rounded-x"
        >
          Placeholder for Column 7-8
          <h1 class="w-full font-bold mt-6 md:text-end text-center">
            Print Lookup
          </h1>
          <h2 class="text-lg text-indigo-900 mt-4">
            <a href="{{ url('pricings') }}">Price Chart</a>
          </h2>
        </div>

        {{-- Row 2 - Cols 1-6 --}}
        {{-- Description --}}
        <div
          class="grid grid-cols-1 md:col-span-6 p-5 border border-gray-200 bg-indigo-100"
        >
          <h2 class="text-2xl font-bold mb-4 mr-5 text-rose-900">
            Description
          </h2>
          <h3
            class="text-lg text-indigo-900 space-y-6 font-normal text-justify"
          >
            {{ $artwork->description }}
          </h3>
        </div>

        {{-- Row 2 - Cols 7-8 blank for now --}}
        <div
          class="grid grid-cols-1 md:col-span-2 text-end border p-5 border-gray-200 bg-yellow-50 rounded-x"
        ></div>
        {{-- - Message --}}
        @if (! Auth::guard('admin')->check())
          <div class="grid grid-cols-1 md:col-span-8 w-full">
            <a
              href="{{ route('messages.create', $artwork->id) }}"
              class="bg-indigo-100 text-rose-900 font-semibold hover:bg-indigo-700 hover:text-white w-full py-2 px-4 rounded-full flex items-center justify-center"
            >
              <button
                class="bg-indigo-100 text-rose-900 font-semibold hover:bg-indigo-700 hover:text-white w-full py-2 px-4 rounded-full flex items-center justify-center"
              >
                <i class="fas fa-envelope mr-3"></i>
                Contact Artist
              </button>
            </a>
          </div>
        @endif

        <div class="grid grid-cols-1 md:col-span-8 gap-4 text-end">
          @guest
            @if (! Auth::guard('admin')->check())
              <a href="{{ route('login') }}">
                <p
                  class="bg-indigo-100 text-indigo-900 font-bold w-full py-2 px-4 rounded-full text-center"
                >
                  <i class="fas fa-sign-in mr-3"></i>

                  Log in to add to your favorites!
                </p>
              </a>
            @endif
          @else
            <form
              method="POST"
              action="{{ auth()->user()->favorites()->where('artwork_id', $artwork->id)->exists() ? route('favorites.destroy', $artwork->id) : route('favorites.store', $artwork->id) }}"
              class=""
            >
              @csrf
              @if (auth()->user()->favorites()->where('artwork_id', $artwork->id)->exists())
                @method('DELETE')
                <button
                  class="bg-indigo-100 hover:bg-rose-700 text-rose-900 hover:text-white font-bold w-full py-2 px-4 rounded-full flex items-center justify-center"
                >
                  <i class="fas fa-bookmark mr-3"></i>
                  Remove from Favorites
                </button>
              @else
                <button
                  class="bg-indigo-100 hover:bg-indigo-600 hover:text-white text-rose-900 font-bold w-full py-2 px-4 rounded-full flex items-center justify-center"
                >
                  <i class="fas fa-heart mr-3"></i>
                  Add to Favorites
                </button>
              @endif
            </form>
          @endguest
        </div>

        @auth('admin')
          <div class="w-full grid grid-cols-1 md:col-span-8">
            <form
              method="POST"
              action="{{ route('artworks.destroy', $artwork->id) }}"
              onsubmit="return confirm('Are you sure you want to delete {{ $artwork->title }} ?')"
            >
              @csrf
              @method('DELETE')

              <button
                type="submit"
                class="px-4 py-2 bg-indigo-100 text-rose-900 rounded-full font-semibold hover:bg-rose-700 hover:text-white w-full"
              >
                <i class="fas fa-trash mr-3"></i>
                Delete
              </button>
            </form>
          </div>

          {{-- -  Admins- Only - Edit Button --}}
          <div class="grid grid-cols-1 md:col-span-8 w-full">
            <a href="{{ route('artworks.edit', $artwork->id) }}">
              <button
                type="submit"
                class="bg-indigo-100 text-rose-900 rounded-full font-semibold hover:bg-indigo-700 hover:text-white w-full py-2 px-4 flex items-center justify-center"
              >
                <i class="fas fa-edit mr-3"></i>
                Edit
              </button>
            </a>
          </div>
        @endauth
      </div>
    </div>
  </div>
</x-layout>
