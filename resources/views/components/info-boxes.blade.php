{{-- Info Boxes: components/info-boxes.blade.php --}}

{{-- --------------- Info Boxes --------------- --}}
{{-- Three cards with Headings and links to other views on the website: Gallery / Contact Form / Pricing Charts --}}

<section>
  <div class="container-xl lg:container m-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 rounded-lg">
      {{-- Box One: Gallery Link --}}
      <div class="bg-yellow-50 p-6 rounded-lg shadow-lg">
        <h2 class="text-indigo-900 text-2xl font-bold">
          For Browsers and Buyers
        </h2>
        <p class="text-indigo-900 mt-2 mb-8 text-sm">
          Log in and bookmark your favorite art pieces.
        </p>

        <div class="mt-5">
          <x-button-link
            url="/artworks"
            icon="paint-brush"
            textClass="text-yellow-50"
            bgClass="bg-black"
            hoverClass="hover:bg-indigo-900"
            :block="true"
          >
            Browse
          </x-button-link>
        </div>
      </div>

      {{-- Box Two: Contact Form Link --}}

      <div class="bg-indigo-100 p-6 rounded-lg shadow-lg">
        <h2 class="text-yellow-900 text-2xl font-bold">
          Find Something You Like ...
        </h2>
        <p class="text-indigo-900 mt-2 mb-8 text-sm">
          but not quite right? Request something similar.
        </p>
        <div class="mt-5">
          <x-button-link
            url="/messages/create"
            icon="envelope"
            textClass="text-indigo-50"
            bgClass="bg-black"
            hoverClass="hover:bg-indigo-900"
            :block="true"
          >
            Contact Us
          </x-button-link>
        </div>
      </div>

      {{-- Box Three: Price Chart Link --}}

      <div class="bg-yellow-50 p-6 rounded-lg shadow-lg">
        <h2 class="text-indigo-900 text-2xl font-bold">
          Check Out Pricing Charts
        </h2>
        <p class="text-indigo-900 mt-2 mb-8 text-sm">
          Original not available? Get a high quality print.
        </p>
        <div class="my-5">
          <x-button-link
            url="/pricings"
            icon="dollar"
            textClass="text-yellow-50"
            bgClass="bg-black"
            hoverClass="hover:bg-indigo-900"
            :block="true"
          >
            View Prices
          </x-button-link>
        </div>
      </div>
    </div>
  </div>
</section>
