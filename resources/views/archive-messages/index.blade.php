<x-layout>
  <x-card class="p-10">
    <header>
      <h1 class="text-xl text-center font-bold my-6 text-indigo-900">
        Archived Messages
      </h1>
    </header>
    {{-- Button to view archive page --}}
    <button class="text-indigo-400 px-6 py-2 rounded-xl">
      <a href="{{ route('messages.index') }}">
          <i class="fa-solid fa-archive"></i>
          View Messages
      </a>
  </button>

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
                    <p class="text-sm">
                      {{ \Carbon\Carbon::parse($archive_message->original_creation_date)->setTimezone('America/New_York')->format('m-d-y') }}
                    </p>
                    <p class="text-sm">
                      {{ \Carbon\Carbon::parse($archive_message->original_creation_date)->setTimezone('America/New_York')->format('h:i a') }}
                    </p>
                  </div>
                @endunless

                {{-- </div> --}}
              </td>
              {{-- Display Message Details --}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <x-card>
                  {{-- Name --}}
                  <h1>{{ $archive_message->archive_name }}</h1>
                  <div class="text-indigo-500 font-bold text-sm">
                    {{-- Subject --}}
                    <div>
                      <p class="inline">Subject:</p>
                      <span class="font-normal inline text-indigo-800">
                        {{ $archive_message->archive_subject }}
                      </span>
                    </div>
                    {{-- Message --}}
                    <div class mb->
                      <p class="inline">Message:</p>
                      <span class="font-normal mb-4 text-indigo-800 inline">
                        {{ $archive_message->archive_body }}
                      </span>
                    </div>
                    {{-- Reply Message - if exists --}}
                    @unless ($archive_message->archive_reply == null)
                      <div class="mb-4">
                        <p class="inline font-bold text-indigo-500">
                          Reply Message:
                          <span class="font-normal text-indigo-800 inline">
                            {{ $archive_message->archive_reply }}
                          </span>
                        </p>
                        @else
                        <span> No Reply Noted. </span>
                      </div>
                    @endunless

                    {{-- Email with Link --}}
                  <div> <a 
                      href="mailto:{{ $archive_message->archive_email }}"><p class="text-blue-600 underline text-xs font-normal mt-4">
                     {{ $archive_message->archive_email }}</p>
                    </a>
                  </div>

                    {{-- Filename --}}
                    <div class="text-xs text-indigo-800 font-bold">
                      <p class="inline">Filename:</p>
                      <span class="font-normal inline">
                        {{ $archive_message->archive_upload }}
                      </span>
                    </div>

                    {{-- Display Reply Date and Time --}}
                    @unless ($archive_message->reply_creation_date == null)
                      <div class="text-rose-800 text-xs font-bold">
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
                      <div class="text-rose-800 text-xs font-bold">
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
                 {{-- Restore Archive Data from Controller--}}
                 <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                  <form id="restore {{ $archive_message->id }}" action='/archive-messages/{{$archive_message->id}}/restore' method="POST">
                      @csrf
                      <button type="submit" class="text-red-400  py-2 rounded-xl">
                        <i class="text-indigo-600 fa-solid fa-trash-restore-alt"></i>
                        <p class="text-lg text-stone-600">Restore</p>
                      </button>
                  </form>
              </td>
              {{-- Delete --}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <form
                  id="delete-form"
                  action="{{route('archive-messages.destroy', $archive_message->id)}}"
                  method="POST"
                >
                  @csrf
                  @method('DELETE')
                  <button
                    id="delete-form"
                    type="submit"
                    class="text-red-400 px-6 py-2 rounded-xl"
                  >
                    <i class="fa-solid fa-trash"></i>
                    Delete
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
      </tbody>
    </table>
  </x-card>
</x-layout>
