<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <h3 class="text-lg font-semibold mb-4">
      Contact Artist
      @isset($artwork)
        about "{{ $artwork->title }}"

        {{--
          @php
          $message->artwork_title = $artwork->title;
          // $message->artwork_image = asset($artwork->image);
          @endphp
        --}}
      @endisset
    </h3>
    <form
      method="POST"
      enctype="multipart/form-data"
      action="{{ route('messages.store') }}"
    >
      @csrf

      <x-inputs.text
        id="artwork_title"
        type="hidden"
        name="artwork_title"
        @if (isset($artwork))
        value="{{ $artwork->title }}"
        @else
        value="null"
        @endif
      />

      @isset($user)
        <x-inputs.text
          id="user_id"
          type="hidden"
          name="user_id"
          value="{{ Auth::user()->id }}"
        />
      @endisset

      <x-inputs.text id="name" name="name" label="Name" :required="true" />
      <x-inputs.text
        id="email"
        type="email"
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
      <div class="pt-3">
        <x-inputs.text-area
          id="body"
          name="body"
          label="Message"
          :required="true"
        />
      </div>
      <x-inputs.file id="image" name="image" label="Upload a Photo" />

      <button
        type="submit"
        class="bg-indigo-900 hover:bg-indigo-500 text-white px-4 py-2 rounded-md"
      >
        Send Message
      </button>
    </form>
  </x-card>
</x-layout>
