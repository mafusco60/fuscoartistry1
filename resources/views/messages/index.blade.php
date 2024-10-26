<x-layout>
        {{-- Button to view archive page --}}
        <button class="text-indigo-400 px-6 py-2 rounded-xl">
            <a href="{{ route('archive-messages.index') }}">
                <i class="fa-solid fa-archive"></i>
                View Archived Messages
            </a>
        </button>
    <div class="text-center text-md mt-5 md:mx-auto">
        
        <x-search  
            :routename="'messages.search'" 
        />
        @if (request()->has('keywords'))
        <a
            href="{{ route('messages.index') }}"
            class="block mt-4 text-center text-indigo-900 hover:text-indigo-600"
        >
            Clear search
        </a>
    @endif
    </div>
    <x-card>
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
                                <p class="text-indigo-900 text-sm text-center font-semibold">
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
                                <a href="{{asset('storage/' . $message->image)}}" download>
                                    <i class="fa-solid fa-download mx-auto text-center"></i>
                                    <span class="text-center text-sm">Download Image</span>
                                </a>
                            @else
                                <p class="text-indigo-500 font-semibold text-center text-sm p-4">
                                    No Uploaded Image
                                </p>
                            @endif



                            {{-- Display Original Message Date and Time --}}
                           
                                                {{-- Display Artwork Listing Image if it exists --}}
                             @if ($message->artwork_id != null)
                             <a href="{{ route('artworks.show', $message->artwork_id) }}">
                                <p class="text-indigo-900 font-semibold border border-gray-200 p-3 text-sm text-center">Pertinent Artwork: <br>
                                    {{$message->artwork->title}} 
                                </p>
                             </a>
                                
                            @else
                                <p class="text-indigo-900 font-semibold pb-5 text-sm text-center">No Artwork </p>
                            @endif 
                            @unless ($message->created_at == null)
                            <div class="text-rose-800 text-center">
                                <p class="text-xs inline">
                                    {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('America/New_York')->format('m-d-y') }} /
                                </p>
                                <p class="text-xs inline text-center">
                                    {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('America/New_York')->format('h:i a') }}
                                </p>
                            </div>
                        @endunless


                        {{-- </td> --}}
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
                              <h1 class="text-sm font-bold inline text-indigo-900 underline">Email: <h1 class="text-indigo-500 font-bold text-sm inline">{{ $message->email }}</a>
                            
                            {{-- Subject --}}
                            <div>
                              <h1 class="text-sm font-bold inline text-indigo-900 underline">Subject:</h1>
                                <span
                                    class="font-semibold text-sm inline text-black"
                                >
                                    {{ $message->subject }}
                                </span>
                            </div>

                            {{-- Message body --}}
                            {{-- <div class="mb-4"> --}}
                                <p class="text-sm font-bold inline text-indigo-900 underline ">Message:</p>
                                 <h1 class="font-semibold text-sm inline text-black pb-4">
                                    {{ $message->body }}
                                </h1>
                            </div>
                               
                        {{-- Display the reply message if it exists --}}
                        @if ($message->reply)
                            {{-- <td --}}
                                <div class="p-4 mt-4  border border-gray-300 text-md"
                            >
                                <p class="font-bold mb-4 text-indigo-500 underline">
                                    Reply Message:
                                </p>
                                <p class="text-sm font-normal text-indigo-700 mb-4">
                                    {{ $message->reply }}
                                </p>
                                {{-- Date and time of reply --}}
                                
                                <p class="text-xs mt-2 text-rose-600 inline">
                                    {{ $message->updated_at->setTimezone('America/New_York')->format('m-d-y') }} /
                                </p>
                                <p class="text-xs text-rose-600 inline">
                                    {{ $message->updated_at->setTimezone('America/New_York')->format(' h:i a') }}
                                    
                                </p>
                            </div>
                            </td>

                            {{-- Display Reply Button if no reply exists. On Click - Redirects to reply form --}}
                        @else
                            <div text-lg"
                            >
                                <a
                                    href="{{route('messages.edit', $message->id)}}"
                                    class="text-indigo-500 px-6 py-2 rounded-xl text-md"
                                >
                                    <i class="fa-solid fa-reply text-center p-6"></i>
                                    Reply
                                </a>
                            </div>
                        @endif

                        {{-- Archive Button --}}
                        {{-- Store Archive Data from Controller --}}
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <form
                                id="archive-form{{ $message->id }}"
                                action='{{route('messages.archive', $message->id)}}'
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
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-md">
                            <form
                              id="delete-form"
                              action="{{route('messages.destroy', $message->id)}}"
                              method="POST"
                            >
                              @csrf
                              @method('DELETE')
                              <button
                                id="delete-form"
                                type="submit"
                                class="text-red-400 px-6 py-2  text-sm"
                              >
                                <i class="fa-solid fa-trash "></i>
                                Delete
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
                    
                </tr>
            @endif
        </tbody>
    </table>
    </main>
    </x-card>
</x-layout>
