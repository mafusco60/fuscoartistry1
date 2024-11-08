{{-- Reply Mail /admins/-messages/reply-mail.blade.php --}}
<x-layout>
  <head>
    <title>Reply Form</title>
  </head>
  <body>
    <x-card
      class="bg-gray-50 border border-gray-200 p-10 max-w-lg mx-auto mt-24"
    >
      <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Reply</h2>
      </header>

      @csrf
      {{-- User Name --}}
      <div class="text-md">
        <label for="user-name" class="inline-block text-md mb-2">Sender:</label>
        <p class="text-rose-700 inline">
          {{ $message->sender_id ? $message->user->firstname : 'Guest' }}
        </p>
        <div>
          <label for="user-name" class="text-md mb-2">Artwork:</label>
          <p class="text-rose-700 inline">
            {{ $message->artwork_id ? $message->artwork->title : 'No Artwork' }}
          </p>
        </div>
      </div>

      {{-- Name --}}
      <div class="text-md">
        <label for="name" class="inline-block text-md mb-2">Name:</label>
        <p class="text-rose-700 inline">{{ $message->name }}</p>
      </div>
      {{-- Email --}}
      <div class="">
        <label for="email" class="inline-block mb-2">Email:</label>
        <p class="text-rose-700 inline">
          {{ $message->email }}
        </p>
      </div>
      {{-- Subject --}}
      <div class="mb-3">
        <label for="subject" class="inline-block mb-2">Subject:</label>
        <p class="text-indigo-800 inline">{{ $message->subject }}</p>
      </div>
      {{-- Message Body --}}
      <div class="mb-6">
        <label for="body" class="inline-block text-lg mb-2">Message:</label>
        <p class="text-rose-700 mb-3">
          {{ $message->body }}
        </p>
      </div>
      {{-- Image --}}
      @if ($message->image)
        <div class="mb-6">
          <label for="image" class="inline-block mb-2">Image</label>
          <img
            src="{{ asset($message->image) }}"
            alt=" "
            class="object-cover rounded-t-xl md:rounded-tr-none md:rounded-l-xl w-[100px]"
          />
        </div>
      @endif

      {{-- Reply Form --}}
      <form
        method="POST"
        id="reply-form"
        action="/messages/{{ $message->id }}/update"
      >
        @csrf
        @method('PUT')
        <div class="mb-6 w-full">
          <label class="w-full inline-block text-lg mb-2" for="reply">
            REPLY:
          </label>

          <div class="w-full p-4 border border-rose-500 text-indigo-700">
            <x-text-area
              id="reply"
              name="reply"
              {{-- value="{{ 'reply' }}" --}}
            ></x-text-area>
          </div>
        </div>

        {{-- Submit Button --}}
        <button
          type="submit"
          class="bg-indigo-500 text-white rounded py-2 px-4 hover:bg-rose-800 text-center w-full"
        >
          Submit Reply
        </button>
      </form>
    </x-card>
    {{-- Javascript for Reply Form  to Store and Enteer Mail Client --}}
    <script>
      document
        .getElementById('reply-form')
        .addEventListener('submit', function (event) {
          event.preventDefault();

          const form = event.target;
          const formData = new FormData(form);

          fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'X-Requested-With': 'XMLHttpRequest',
            },
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                // Open the email client
                const mailtoLink = `mailto:${data.email}?subject=${encodeURIComponent(data.subject)}&body=${encodeURIComponent(data.body.replace(/<br>/g, '\n'))}`;
                window.location.href = mailtoLink;

                // Redirect to messages after a short delay
                setTimeout(() => {
                  window.location.href = '/messages';
                }, 3000); // Adjust the delay as needed
              } else {
                alert('Failed to save the reply.');
              }
            })
            .catch((error) => {
              console.error('Error:', error);
              alert('An error occurred while saving the reply.');
            });
        });
    </script>
  </body>
</x-layout>
