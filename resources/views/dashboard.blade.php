<x-layout>
  <main class="container mx-auto p-8">
    <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <x-profile-form :user="$user" />
      <div class="">
        <x-favorites
          :favorites="$favorites"
          :artworks="$artworks"
          favoritesClass="grid grid-cols-3  gap-4 mb-3 mx-auto"
        />
      </div>
    </section>
  </main>

  <x-bottom-banner />
</x-layout>
