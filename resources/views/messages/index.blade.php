<x-layout>
  <x-card>
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

  <header>
    <h1 class="text-2xl text-center font-bold my-6 text-indigo-900">Messages</h1>
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
                              
      {{-- Display the Uploaded Image if it exists --}}
                                
                  <a href="{{ asset($message->image) }}"
                  data-fancybox
                  data-caption="{{$message->image}}">
                                  
                  <img src="{{ asset ($message->image) }}"
                  class="object-cover rounded-t-xl w-[100px] mx-auto"  />
                  </a>
                
        {{-- Download Image --}}    
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
                @unless ($message->created_at == null)
                  <div class="text-rose-800 text-center font-semibold">
                    <p class="text-xs inline">
                    {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('America/New_York')->format('m-d-y') }} /
                    </p>
                    <p class="text-xs inline text-center font-semibold">
                    {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('America/New_York')->format('h:i a') }}
                    </p>
                  </div>
                @endunless 
              </td>


              <td  class="px-4 py-8 border-t border-b border-gray-300" >                            
          {{-- Display Message Details --}}

          {{-- Name --}}
                <h1 class="text-sm font-bold inline text-indigo-900 underline">Name:<h1 class="text-sm font-semibold text-black  inline">  {{ $message->name }}</h1><br>
                         
          {{-- Email --}}
                <a href="mailto:{{ $message->email }}" >
                  <h1 class="text-sm font-bold inline text-indigo-900 underline">Email:<h1 class="text-indigo-500 font-bold text-sm inline"> {{ $message->email }}</a>
                          
          {{-- Subject --}}
                <div>
                  <h1 class="text-sm font-bold inline text-indigo-900 underline">Subject:</h1>
                  <span class="font-semibold text-sm inline text-black"
                    >{{ $message->subject }}</span>
                </div>

          {{-- Artwork --}}
                         
                <p class="text-sm font-bold  text-indigo-900 underline inline"> Artwork:</p>
                @if ($message->artwork_title != null)
                    {{$message->artwork_title}} 
                            
                @else
                  <p class="text-indigo-900 font-semibold pb-5 text-sm inline">No Artwork </p>
                @endif 

            {{-- User --}}
                      
                <h1 class="text-sm font-bold inline text-indigo-900 underline"><br>User:</h1>   
                @if ($message->sender_id == null)
                  <h1 class="text-sm font-semibold text-black  inline"> Guest<br></h1>
                @else
                  <h1 class="text-sm font-semibold text-black  inline">  {{ $message->user->firstname}} {{$message->user->lastname}}</h1>
                @endif

            {{-- Message body --}}
                <div>
                  <p class="text-sm font-bold inline text-indigo-900 underline ">Message:</p>
                  <h1 class="font-semibold text-sm inline text-black pb-4">{{ $message->body }}</h1>
                </div>
                             
            {{-- Display the reply message if it exists --}}
                @if ($message->reply)
                  <div class="p-4 mt-4  border border-gray-300 text-md"
                          >
                    <p class="font-bold mb-4 text-indigo-500 underline">Reply Message:</p>
                    <p class="text-sm font-normal text-indigo-700 mb-4">{{ $message->reply }}
                    </p>
            {{-- Date and time of reply --}}
                              
                    <p class="text-xs mt-2 text-rose-900 font-semibold inline">
                    {{ $message->updated_at->setTimezone('America/New_York')->format('m-d-y') }} /
                    </p>
                    <p class="text-xs text-rose-900 font-semibold inline">
                    {{ $message->updated_at->setTimezone('America/New_York')->format(' h:i a') }}</p>
                  </div>
                </td>

          {{-- Display Reply Button if no reply exists. On Click - Redirects to reply form --}}
                @else
                  <div class= "text-lg">
                    <a href="{{route('messages.edit', $message->id)}}"
                      class="text-indigo-500 px-6 py-2 rounded-xl text-md">
                      <i class="fa-solid fa-reply text-center p-6"></i>Reply
                    </a>
                  </div>
                @endif

            {{-- Archive Button --}}
            {{-- Store Archive Data from Controller --}}
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                      >
                  <form
                  id="archive-form{{ $message->id }}"
                  action='{{route('messages.archive', $message->id)}}'
                  method="POST"
                          >
                    @csrf
                    <button
                    type="submit"
                    class="text-red-400 py-2 rounded-xl">
                              
                      <i class="text-indigo-600 fa-solid fa-archive"
                      >
                      </i>
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
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg text-center"
                  >
                No messages.
              </td>
            </tr>
          @endif
           {{-- Link to Archived Messages --}}
           
           <a
           href="{{ route('archive-messages.index') }}"
           class="text-blue-600 underline text-xs font-normal"
            >
              <i class="fas fa-arrow-left"></i>
              Back to Archived Messages
            </a>
          
          </tbody>
        </table>
      </main>
    </x-card>
</x-layout>
