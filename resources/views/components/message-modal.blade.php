@props([
    "artwork" => null,
    "sender" => null,
])

<div class="grid grid-cols-1 md:col-span-8 w-full">
  <div x-data="{ open: false }">
    <button
      @click="open = true"
      class="bg-indigo-100 text-rose-900 font-semibold hover:bg-indigo-700 hover:text-white w-full py-2 px-4 rounded-full flex items-center justify-center"
    >
      <i class="fas fa-envelope mr-3"></i>
      Contact Artist
    </button>
    <div
      x-cloak
      x-show="open"
      class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50"
    >
      <div
        @click.away="open = false"
        class="bg-white p-6 rounded-lg shadow-md w-full max-w-md"
      >
        <h3 class="text-lg font-semibold mb-4">
          @if ("artwork" ?? false)
            Contact Artist about "{{ $artwork->title }}"
          @else
              Contact Artist
          @endif
        </h3>
        <form
          method="POST"
          enctype="multipart/form-data"
          @if ($artwork)
              action="{{ route("message.store", $artwork->id) }}"
          @else
              action="{{ route("message.store") }}"
          @endif
        >
          @csrf

          <x-inputs.text id="name" name="name" label="Name" :required="true" />
          <x-inputs.text
            type="email"
            id="email"
            name="email"
            label="Email"
            :required="true"
          />
          <x-inputs.text id="phone" name="phone" label="Phone" />
          <x-inputs.select
            id="subject"
            name="subject"
            label="Reason for Contact"
            :options="[

                'Interest in Artwork'=> 'Interest in Artwork', 
                'Interest in a Similar Artwork'=>'Interest in a Similar Artwork', 
                'Interest in a Commission'=>'Interest in a Commission', 
                'Interest in a quote'=>'Interest in a quote', 
                'Give Feedback'=>'Give Feedback', 
                'Upload a Photo'=>'Upload a Photo', 
                'Other'=>'Other',

            ]"
          />

          <x-inputs.text-area
            id="body"
            name="body"
            label="Message"
            :required="true"
          />
          <x-inputs.file id="image" name="image" label="Upload a Photo" />

          <button
            type="submit "
            class="bg-indigo-900 hover:bg-indigo-500 text-white px-4 py-2 rounded-md"
          >
            Send Message
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
