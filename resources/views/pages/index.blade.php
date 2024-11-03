<x-layout>
  <main class="container mx-auto p-8">
    <x-featured :artworks="$featuredArtworks" />
    <div class="z-40">
      <x-info-boxes />
    </div>
    <div class="z-10">
      <x-recent :artworks="$recentArtworks" />
    </div>
  </main>
  <x-bottom-banner />
</x-layout>
