{{-- Manage Listing Archives:  /admins/archive_listings/index.blade.php --}}
<x-layout>
  <x-card class="p-10">
    <div class="text-center text-md mt-5 md:mx-auto">
      <x-search :routename="'archive-listings.search'" />

      @if (request()->has('keywords'))
        <a
          href="{{ route('archive-listings.index') }}"
          class="block mt-4 text-center text-indigo-900 hover:text-indigo-600"
        >
          Clear search
        </a>
      @endif
    </div>

    <header>
      <h1 class="text-3xl text-center font-bold my-6 text-indigo-800">
        Archive Listings
      </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
      <tbody>
        @unless ($archive_listings->isEmpty())
          @foreach ($archive_listings as $archive_listing)
            <tr class="border-gray-400">
              <td class="px-4 py-8 border-t border-b border-gray-400 text-lg">
                <img
                  src="{{ asset($archive_listing->archive_image) }}"
                  alt=" "
                  class="object-cover rounded-t-xl w-20 mx-auto blur-xs"
                />
                <div class="text-center text-stone-400">
                  {{ $archive_listing->archive_title }}
                  <p class="text-sm text-stone-400">
                    {{ $archive_listing->archive_medium }}
                  </p>
                  @if ($archive_listing->archive_featured)
                    <p class="">FEATURED</p>
                  @endif
                </div>
              </td>

              <td class="px-4 py-8 border-t border-b border-gray-400 text-lg">
                <x-card>
                  <h1 class="text-xl text-stone-400 mb-2">
                    Active ID:
                    {{ $archive_listing->original_artwork_id }}
                  </h1>

                  @if ($archive_listing->archive_original)
                    <div class="text-stone-400 text-sm">
                      <i class="text-stone-400 fa-solid fa-check inline"></i>
                      <p class="inline text-stone-400 font-bold text-sm">
                        Original: Available
                      </p>
                      <h1>
                        Price: ${{ $archive_listing->archive_original_price }}
                      </h1>
                      <h1>
                        Size:
                        {{ $archive_listing->archive_original_dimensions }}
                      </h1>
                      <h1>
                        Substrate:
                        {{ $archive_listing->archive_original_substrate }}
                      </h1>
                    </div>
                  @else
                    <div class="text-stone-400 text-sm">
                      <i class="text-stone-400 fa-solid fa-times inline"></i>
                      <p class="inline text-stone-400 font-bold">
                        Original Not Available
                      </p>
                    </div>
                  @endif
                  <div class="text-stone-400 text-sm">
                    <i
                      class="text-sm text-stone-400 fa-solid fa-check inline"
                    ></i>
                    <a href="{{ url('pricings') }}" class="text-stone-400">
                      <p class="inline text-stone-400 font-bold text-sm">
                        Prints Available
                      </p>
                    </a>

                    <p>
                      {{ $archive_listing->archive_original_description }}
                    </p>
                    <p class="font-bold">
                      Tags:
                      {{ $archive_listing->archive_search_tags }}
                    </p>
                    <p class="font-bold">
                      Filename:
                      {{ $archive_listing->archive_image }}
                    </p>
                  </div>
                </x-card>
              </td>

              {{-- Restore Button --}}
              {{-- Restore Archive Data to Current Listing from ArchiveListingController --}}
              <td class="px-4 py-8 border-t border-b border-gray-400 text-lg">
                <form
                  id="restore-form"
                  action="{{ route('archive-listings.restore', $archive_listing->id) }}"
                  method="POST"
                >
                  @csrf

                  <button type="submit" class="text-red-400 py-2 rounded-xl">
                    <i
                      class="text-indigo-600 fa-solid fa-trash-restore-alt"
                    ></i>
                    <p class="text-lg text-stone-600">Restore</p>
                  </button>
                </form>
              </td>
              <td class="px-4 py-8 border-t border-b border-gray-400 text-md">
                {{-- Permanently Delete --}}
                <form
                  id="delete-form"
                  action="/archive-listings/{{ $archive_listing->id }}/destroy"
                  method="POST"
                >
                  @csrf
                  @method('DELETE')
                  <button
                    id="delete-form"
                    type="submit"
                    class="text-red-600 px-6 py-2 rounded-xl"
                  >
                    <i class="fa-solid fa-trash"></i>
                    Permanently Delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td
              class="px-4 py-8 border-t border-b border-gray-400 text-lg text-center"
            >
              No archive listings found.
            </td>
          </tr>
        @endunless

        {{-- Link to Manage Listings --}}
        <a
          href="{{ route('manage-listings.index') }}"
          class="text-blue-600 underline text-xs font-normal"
        >
          <i class="fas fa-arrow-left"></i>
          Back to Manage Listings
        </a>
      </tbody>
    </table>
  </x-card>
</x-layout>
