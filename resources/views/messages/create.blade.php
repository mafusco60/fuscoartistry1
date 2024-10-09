<x-layout>
    <h3 class="text-lg font-semibold mb-4">
        @if ($artwork->title ?? false)
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-1 pt-16">
                    Contact Artist about "{{ $artwork->title }}"
                </div>
                <div class="col-span-1">
                    <img
                        src="{{ asset($artwork->image) }}"
                        alt="{{ $artwork->title }}"
                        class="w-20 h-20 object-cover rounded-md"
                    />
                </div>
            </div>
        @else
                Contact Artist
        @endif
    </h3>
    <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ route('messages.store', $artwork->id) }}"
    >
        @csrf
        <x-inputs.text type="hidden" id="artwork_id" name="artwork_id" />

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
</x-layout>