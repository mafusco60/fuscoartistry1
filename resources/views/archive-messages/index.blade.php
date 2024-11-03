<x-layout>
  <x-card>
    <div class="text-center text-md mt-5 md:mx-auto">
      <x-search :routename="'archive-messages.search'" />
      @if (request()->has('keywords'))
        <a
          href="{{ route('archive-messages.index') }}"
          class="block mt-4 text-center text-indigo-900 hover:text-indigo-600"
        >
          Clear search
        </a>
      @endif
    </div>
    <header>
      <h1 class="text-xl text-center font-bold my-6 text-indigo-900">
        Archived Messages
      </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
      <tbody>
        {{-- Get messages from database --}}
        @unless ($archive_messages->isEmpty())
          @foreach ($archive_messages as $archive_message)
            <tr class="border-gray-300">
              <td class="px-4 py-8 border-t border-b border-gray-300">
                {{-- Display Uploaded Image File --}}
                @if ($archive_message->archive_upload)
                  <img
                    class="object-cover rounded-t-xl w-[100px] mx-auto"
                    src="{{ asset($archive_message->archive_upload) }}"
                    alt=" "
                    class="object-cover rounded-t-xl w-20 mx-auto"
                  />
                @endif

                {{-- Display Original Message Date and Time --}}
                @unless ($archive_message->original_creation_date == null)
                  <div class="text-rose-800 text-center">
                    <p class="text-xs">
                      {{ \Carbon\Carbon::parse($archive_message->original_creation_date)->setTimezone('America/New_York')->format('m-d-y') }}
                    </p>
                    <p class="text-xs">
                      {{ \Carbon\Carbon::parse($archive_message->original_creation_date)->setTimezone('America/New_York')->format('h:i a') }}
                    </p>
                  </div>
                @endunless
              </td>
              {{-- Display Message Details --}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <x-card>
                  {{-- Contact Name - May be different from the session sender --}}
                  <div class="text-indigo-500 font-semibold text-sm">
                    <h1>
                      {{ $archive_message->archive_name }}
                    </h1>
                  </div>
                  {{-- Session Sender name --}}
                  <div class="text-sm">
                    <label
                      for="user-name"
                      class="inline-block text-sm font-semibold text-indigo-900"
                    >
                      Sender:
                    </label>

                    <p class="text-indigo-700 inline text-sm">
                      {{ $archive_message->archive_sender_id ? $archive_message->user->firstname : 'Guest' }}
                    </p>
                    {{-- Artwork Title --}}
                    <div>
                      <label
                        for="artwork_title"
                        class="text-sm font-semibold text-indigo-900"
                      >
                        Artwork:
                      </label>
                      <p class="text-indigo-700 inline text-sm">
                        {{ $archive_message->archive_listing_id ? $archive_message->artwork->title : 'No Artwork' }}
                      </p>
                    </div>

                    {{-- Subject --}}
                    <div>
                      <p class="text-indigo-900 font-semibold text-sm inline">
                        Subject:
                      </p>
                      <span class="text-indigo-700 inline text-sm">
                        {{ $archive_message->archive_subject }}
                      </span>
                    </div>
                    {{-- Message --}}
                    <div class="text-indigo-900 font-semibold text-sm inline">
                      <p class="text-indigo-900 inline text-sm">Message:</p>
                      <span class="font-normal mb-4 text-indigo-800 inline">
                        {{ $archive_message->archive_body }}
                      </span>
                    </div>
                    {{-- Reply Message - if exists --}}
                    <div class="text-indigo-900 font-semibold text-sm">
                      Reply Message:
                      @unless ($archive_message->archive_reply == null)
                        <span
                          class="font-normal text-sm text-indigo-800 inline"
                        >
                          {{ $archive_message->archive_reply }}
                        </span>
                      @else
                        <span class="font-normal text-sm text-rose-800 inline">
                          No reply noted.
                        </span>
                      @endunless
                    </div>

                    {{-- Email with Link --}}
                    <a href="mailto:{{ $archive_message->archive_email }}">
                      <p
                        class="text-blue-600 underline text-xs font-normal mt-4"
                      >
                        {{ $archive_message->archive_email }}
                      </p>
                    </a>

                    {{-- Filename --}}
                    <div class="text-xs text-indigo-800 font-bold">
                      <p class="inline">Filename:</p>
                      <span class="font-normal inline">
                        {{ $archive_message->archive_upload }}
                      </span>
                    </div>

                    {{-- Display Reply Date and Time --}}
                    @unless ($archive_message->reply_creation_date == null)
                      <div class="text-indigo-900 text-xs font-bold">
                        <p class="inline">Replied:</p>
                        <span class="font-normal">
                          {{ \Carbon\Carbon::parse($archive_message->reply_creation_date)->setTimezone('America/New_York')->format('m-d-y') }}
                        </span>
                        <span class="font-normal">
                          {{ \Carbon\Carbon::parse($archive_message->reply_creation_date)->setTimezone('America/New_York')->format(' h:i a') }}
                        </span>
                      </div>
                    @endunless

                    {{-- Display Archive Date and Time --}}
                    @unless ($archive_message->created_at == null)
                      <div class="text-indigo-900 text-xs font-bold">
                        <span class="inline">Archive:</span>
                        <span class="font-normal">
                          {{ $archive_message->created_at->setTimezone('America/New_York')->format('m-d-y') }}
                        </span>
                        <span class="font-normal">
                          {{ $archive_message->created_at->setTimezone('America/New_York')->format(' h:i a') }}
                        </span>
                      </div>
                    @endunless
                  </div>
                </x-card>
              </td>
              {{-- Restore Button --}}
              {{-- Restore Archive Data from Controller --}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <form
                  id="restore {{ $archive_message->id }}"
                  action="/archive-messages/{{ $archive_message->id }}/restore"
                  method="POST"
                >
                  @csrf
                  <button type="submit" class="text-red-400 py-2 rounded-xl">
                    <i
                      class="text-indigo-600 fa-solid fa-trash-restore-alt"
                    ></i>
                    <p class="text-sm text-stone-600">Restore</p>
                  </button>
                </form>
              </td>
              {{-- Delete --}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <form
                  id="delete-form"
                  action="{{ route('archive-messages.destroy', $archive_message->id) }}"
                  method="POST"
                >
                  @csrf
                  @method('DELETE')
                  <button
                    id="delete-form"
                    type="submit"
                    class="text-red-400 px-6 py-2 rounded-xl"
                  >
                    <i class="fa-solid fa-trash text-lg"></i>
                    <p class="text-sm text-stone-600">Delete</p>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            {{-- if no messages exist, display this message: --}}
            <td
              class="px-4 py-8 border-t border-b border-gray-300 text-lg text-center"
            >
              No archived messages.
            </td>
          </tr>
        @endunless
        {{-- Link to Messages --}}
        <a
          href="{{ route('messages.index') }}"
          class="text-blue-600 underline text-xs font-normal"
        >
          <i class="fas fa-arrow-left"></i>
          Back to Messages
        </a>
      </tbody>
    </table>
  </x-card>
</x-layout>
