{{-- Manage Artworks: manage-listings/index.blade.php --}}

{{--
  Artworks to be managed by the admin are displayed in this view. The admin can view, edit, and archive the artworks from this page. The artworks are displayed in a table format with the following columns: Image, Details, Edit, Archive, and Delete. The admin can click on the Edit button to edit the artwork, and the Archive button to archive the artwork,  The artworks are fetched from the database and displayed in the table.
--}}

<x-layout>
  <x-card class="p-10">
    <div class="text-center text-md mt-5 md:mx-auto">
      <x-search :routename="'manage-listings.search'" />

      @if (request()->has('keywords'))
        <a
          href="{{ route('manage-listings.index') }}"
          class="block mt-4 text-center text-indigo-900 hover:text-indigo-600"
        >
          Clear search
        </a>
      @endif
    </div>

    {{-- Manage Artworks --}}

    <header>
      <h1 class="text-3xl text-center font-bold my-6 text-indigo-900">
        Manage Artworks
      </h1>
      <p class="text-center text-indigo-900">
        Total Artworks: {{ $artworks->count() }}
      </p>
    </header>

    {{-- View Archives Button --}}
    <button class="text-yellow-900 px-6 py-2 rounded-xl">
      {{--
        <a href="{{ route('archive-artworks') }}">
        <i class="fa-solid fa-archive"></i>
        View Archives
        </a>
      --}}
    </button>
    {{-- Table --}}
    <table class="w-full table-auto rounded-sm">
      <tbody>
        {{-- Get Data --}}
        @unless ($artworks->isEmpty())
          @foreach ($artworks as $artwork)
            <tr class="border-gray-300">
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                {{-- Display Image --}}
                <a
                  {{-- href="{{ route('manage-listings', $artwork->id) }} }}" --}}
                >
                  <img
                    src="{{ asset($artwork->image) }}"
                    alt=" "
                    class="object-cover rounded-t-xl w-20 mx-auto"
                  />
                </a>

                <p class="border px-4 py-2 text-center">
                  <i class="fa-solid fa-heart text-rose-900"></i>
                  {{-- Count Favorites --}}
                  @php
                    $i = 0;
                  @endphp

                  @foreach ($favorites as $favorite)
                    @if ($favorite->artwork_id == $artwork->id)
                      @php
                        $i++;
                      @endphp
                    @endif
                  @endforeach

                  @php
                    echo $i;
                  @endphp
                </p>
                {{-- Display Artwork Title / Medium Type and if Featured --}}
                <div class="text-center">
                  <a href="{{ route('home') }}">
                    <p>{{ $artwork->title }}</p>
                    <p class="text-sm text-yellow-900">
                      {{ $artwork->medium }}
                    </p>
                    @if ($artwork->featured)
                      <p class="">FEATURED</p>
                    @endif
                  </a>
                </div>
              </td>

              {{-- Display Details --}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <x-card>
                  {{-- Display if Original is Available: if so: Price, Size, and Substrate --}}
                  <p class="text-indigo-900 font-bold text-sm">
                    Original ID: {{ $artwork->id }}
                  </p>

                  @if ($artwork->original)
                    <div class="text-indigo-900 text-sm">
                      <i class="text-green-900 fa-solid fa-check inline"></i>
                      <p class="inline text-indigo-900 font-bold text-sm">
                        Original: Available
                      </p>
                      <h1>Price: ${{ $artwork->original_price }}</h1>
                      <h1>
                        Size:
                        {{ $artwork->original_dimension }}
                      </h1>
                      <h1>
                        Substrate:
                        {{ $artwork->original_substrate }}
                      </h1>
                    </div>
                  @else
                    <div class="text-indigo-900 text-sm">
                      <i class="text-rose-900 fa-solid fa-times inline"></i>
                      <p class="inline text-indigo-900 font-bold">
                        Original Not Available
                      </p>
                    </div>
                  @endif
                  <div class="text-indigo-900 text-sm">
                    <i
                      class="text-sm text-green-900 fa-solid fa-check inline"
                    ></i>
                    {{-- Display (always) Prints Available --}}
                    <a href="{{ url('pricings') }}" class="text-indigo-900">
                      <p class="inline text-indigo-900 font-bold text-sm">
                        Prints Available
                      </p>
                    </a>
                    {{-- Description and Tags --}}
                    <p>{{ $artwork->description }}</p>
                    <p class="font-bold">Tags: {{ $artwork->search_tags }}</p>
                    {{-- Image Filename --}}
                    <p class="font-bold">Filename: {{ $artwork->image }}</p>
                  </div>
                </x-card>
              </td>
              {{-- Edit Button --}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <a
                  href="{{ route('artworks.edit', $artwork->id) }}"
                  class="text-stone-600 px-6 py-2 rounded-xl"
                >
                  <i class="fa-solid fa-pen-to-square text-green-900"></i>
                  Edit
                </a>
              </td>
              <td
                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
              ></td>
              {{-- Archive Button --}}
              {{-- Store Archive Data (done from ManageListingController) and delete original artwork --}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <form
                  id="archive-form {{ $artwork->id }}"
                  action="{{ route('manage-listings.archive', $artwork->id) }}"
                  method="POST"
                >
                  @csrf
                  <button
                    type="submit"
                    class="text-red-400 py-2 rounded-xl inline"
                  >
                    <i class="text-rose-900 fa-solid fa-archive inline"></i>
                    <p class="text-md text-stone-600 inline">Archive</p>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            {{-- No Artworks Found --}}
            <td
              class="px-4 py-8 border-t border-b border-gray-300 text-lg text-center"
            >
              No artworks found.
            </td>
          </tr>
        @endunless
        {{-- Link to Archive Listings --}}
        <a
          href="{{ route('archive-listings.index') }}"
          class="text-blue-600 underline text-xs font-normal"
        >
          <i class="fas fa-arrow-left"></i>
          Back to Archived Listings
        </a>
      </tbody>
    </table>
  </x-card>
</x-layout>
