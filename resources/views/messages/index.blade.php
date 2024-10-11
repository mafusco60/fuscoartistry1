<x-layout>
    <x-card class="">
    <header>
        <h1 class="text-2xl text-center font-bold my-6 text-indigo-900">
            Messages
        </h1>
    </header>
    <main class="container  mx-auto p-8">

    {{-- Display Messages in a Table --}}
    <table class="w-full table-auto rounded-sm">
        <tbody>
            {{-- Get messages from database --}}
            @if ($messages->isNotEmpty())
                {{-- Display Messages --}}

                @foreach ($messages as $message)
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300">
                            @if ($message->image)
                                {{-- Display Image if it exists --}}
                                <p class="text-indigo-500 font-bold">
                                    User Upload:
                                </p>

                                <a
                                    href="{{ asset($message->image) }}"
                                    data-fancybox="gallery"
                                    data-caption="{{ $message->image }}"
                                >
                                    <img
                                        class="object-cover rounded-t-xl w-[100px]"
                                        src="{{ asset($message->image) }}"
                                        alt=" "
                                        width="0"
                                        height="0"
                                        class="object-cover rounded-t-xl w-[20px] h-[30px]"
                                    />
                                </a>
                            @endif

                            {{-- Display Original Message Date and Time --}}
                            @unless ($message->created_at == null)
                                <div class="text-rose-800">
                                    <p class="text-xs inline">
                                        {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('America/New_York')->format('m-d-y') }}
                                    </p>
                                    <p class="text-xs inline">
                                        {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('America/New_York')->format('h:i a') }}
                                    </p>
                                </div>
                            @endunless
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300">                            {{-- Display Message Details --}}

                            {{-- Name --}}
                            <h1 class="text-sm font-bold inline text-indigo-900">
                                Name: <h1 class="text-sm font-semibold text-black  inline">{{ $message->name }}
                            </h1><br>
                            {{-- User --}}
                            @if ($message->sender_id == null)
                            <h1 class="text-sm font-bold inline text-indigo-900">User: <h1 class="text-sm font-semibold text-black  inline">Guest</h1><br>
                            @else
                            <h1 class="text-sm font-bold inline text-indigo-900">
                                    User: <h1 class="text-sm font-semibold text-black  inline">{{ $message->user->name }}
                                </p>
                            @endif
                            {{-- Email --}}
                            <a href="mailto:{{ $message->email }}" >
                              <h1 class="text-sm font-bold inline text-indigo-900">Email: <h1 class="text-indigo-500 font-bold text-sm inline">{{ $message->email }}</a>
                            
                            {{-- Subject --}}
                            <div>
                              <h1 class="text-sm font-bold inline text-indigo-900">Subject:</h1>
                                <span
                                    class="font-semibold text-sm inline text-black"
                                >
                                    {{ $message->subject }}
                                </span>
                            </div>

                            {{-- Message body --}}
                            {{-- <div class="mb-4"> --}}
                                <p class="text-sm font-bold inline text-indigo-900">Message:</p>
                                 <h1 class="font-semibold text-sm inline text-black">
                                    {{ $message->body }}
                                </h1>
                            </div>
                            @if ($message->artwork_id != null)
                                {{-- Display Artwork Listing Image if it exists --}}
                                <p class="text-indigo-900 font-bold">
                                    {{$message->artwork->title}}: {{ $message->artwork_id }}
                                </p>
                                <img
                                    src="{{ asset($message->artwork->image) }}"
                                    alt=" "
                                    class="object-cover w-[40px]"
                                />
                            @else
                                <p class="text-indigo-900 font-semibold pb-5 text-sm">No Image</p>
                            @endif

                            {{-- </x-card> --}}
                        </td>
                        {{-- Display the reply message if it exists --}}
                        @if ($message->reply)
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-md"
                            >
                                <p class="font-bold mb-4 text-indigo-500">
                                    Reply Message:
                                </p>
                                <p class="text-sm font-normal text-indigo-700">
                                    {{ $message->reply }}
                                </p>
                                {{-- Date and time of reply --}}
                                <p class="text-sm mt-2 text-rose-600">
                                    {{ $message->updated_at->setTimezone('America/New_York')->format('m-d-y') }}
                                </p>
                                <p class="text-sm text-rose-600">
                                    {{ $message->updated_at->setTimezone('America/New_York')->format(' h:i a') }}
                                </p>
                            </td>

                            {{-- Display Reply Button if no reply exists. On Click - Redirects to reply form --}}
                        @else
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a
                                    href="{{route('messages.edit', $message->id)}}"
                                    class="text-indigo-500 px-6 py-2 rounded-xl"
                                >
                                    <i class="fa-solid fa-reply"></i>
                                    Reply
                                </a>
                            </td>
                        @endif

                        {{-- Archive Button --}}
                        {{-- Store Archive Data from Controller --}}
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <form
                                id="archive-form-{{ $message->id }}"
                                action="/messages/archive/ {{ $message->id }}"
                                method="POST"
                            >
                                @csrf
                                <button
                                    type="submit"
                                    class="text-red-400 py-2 rounded-xl"
                                >
                                    <i
                                        class="text-indigo-600 fa-solid fa-archive"
                                    ></i>
                                    <p class="text-sm text-stone-600">
                                        Archive
                                    </p>
                                </button>
                            </form>
                        </td>
                    </tr>
                
                @endforeach
            @else
                <tr>
                    {{-- if no messages exist --}}
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg text-center"
                    >
                        No messages.
                    </td>
                    {{-- Button to view archive page --}}
                    <button class="text-indigo-400 px-6 py-2 rounded-xl">
                        <a href="{{ route('archive-messages') }}">
                            <i class="fa-solid fa-archive"></i>
                            View Archived Messages
                        </a>
                    </button>
                </tr>
            @endif
        </tbody>
    </table>
    </main>
    </x-card>
</x-layout>
