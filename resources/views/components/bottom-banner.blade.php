@props([
  'heading' => 'Ready to Transform Your Space?',
  'subheading' => 'Discover unique pieces that speak to your soul!',
])

<section class="container mx-auto my-6">
  <div
    class="bg-indigo-900 text-white rounded p-4 flex items-center justify-between flex-col md:flex-row gap-4"
  >
    <div>
      <h2 class="text-xl font-semibold">{{ $heading }}</h2>
      <p class="text-gray-200 text-lg mt-2">
        {{ $subheading }}
      </p>
    </div>

    <x-button-link
      url="/artworks"
      icon="palette"
      textClass="text-indigo-900"
      :block="true"
    >
      View All Artworks
    </x-button-link>
  </div>
</section>
