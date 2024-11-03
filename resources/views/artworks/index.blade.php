<x-layout>
  <div class="text-center text-md mt-5 md:mx-auto">
    <x-search />
  </div>

  @if (request()->has('keywords'))
    <a
      href="{{ route('artworks.index') }}"
      class="block mt-4 text-center text-indigo-900 hover:text-indigo-600"
    >
      Clear search
    </a>
  @endif

  <main class="container mx-auto p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      @forelse ($artworks as $artwork)
        <x-artwork-card :artwork="$artwork" />
      @empty
        <h2>No artworks found</h2>
      @endforelse
    </div>
    <div class="mt-6 p-4"></div>
    {{ $artworks->links() }}
  </main>
</x-layout>
