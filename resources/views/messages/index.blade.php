<x-layout>
  <x-card class="p-10">
    <header>
      <h1 class="text-3xl text-center font-bold my-6 text-cyan-700">
        Messages
      </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
      <tbody>
        {{-- Get messages from database --}}
        @unless ($messages->isEmpty())
          @foreach ($messages as $message)
            
          <tr class="border-gray-300">
              <td class="px-4 py-8 border-t border-b border-gray-300">
                
                @if ($message->image)
                <img
                  class="object-cover rounded-t-xl w-[100px] mx-auto"
                  src="{{ asset($message->image) }}"
                  alt=" "
                  class="object-cover rounded-t-xl w-20 mx-auto"
                />
              @endif
         

         {{-- Display Original Message Date and Time --}}
         @unless ($message->created_at == null)
           <div class="text-rose-800 text-center">
             <p class="text-xs">
               {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('America/New_York')->format('m-d-y') }}
             </p>
             <p class="text-xs">
               {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('America/New_York')->format('h:i a') }}
             </p>
           </div>
         @endunless
       </td>
       {{-- Display Message Details --}}
       <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
         <x-card>
           {{-- Name --}}
           <h1>{{ $message->name }}</h1>
           <div class="text-cyan-500 font-bold text-sm">
             {{-- Category --}}
             <div>
               <p class="inline">Subject:</p>
               <span class="font-normal inline text-cyan-800">
                 {{ $message->subject }}
               </span>
             </div>

             {{-- Message --}}
             <div class="mb-4">
               <p class="inline">Message:</p>
               <span class="font-normal text-cyan-800 inline">
                 {{ $message->body }}
               </span>
             </div>
                     
                  {{-- Image File Name --}}
                  @unless       ($message->image == null)
                    <div>
                    <p class="font-bold mt-4 text-cyan-500 text-xs inline "> Filename: </p>
                    <span class="font-normal text-xs inline text-cyan-800 mt-4">{{ $message->image }}</span>
                  </div>
                    @endunless
                </x-card>
              </td>
              {{-- Display the reply message if it exists --}}
                @if ($message->reply)
                  <td class="px-4 py-8 border-t border-b 
                border-gray-300 text-md "> 
                    <p class="font-bold mb-4 text-cyan-500"> Reply Message: </p>
                    <p class="text-sm font-normal text-cyan-700">{{ $message->reply }} </p>
                      {{-- Date and time of reply --}}
                    <p class="text-sm mt-2 text-rose-600">{{$message->updated_at->setTimezone('America/New_York')->format('m-d-y') }}</p>
                    <p class="text-sm text-rose-600"> {{ $message->updated_at->setTimezone('America/New_York')->format( ' h:i a') }}</p>
                  </td>

              {{-- Display Reply Button if no reply exists. On Click - Redirects to reply form--}}
                @else
                  <td class="px-4 py-8 border-t border-b 
              border-gray-300 text-lg">
                    <a href="{{url('admins/-messages/reply-mail/' . $message->id)}} " 
                  class="text-cyan-500 px-6 py-2 rounded-xl">
                    <i class="fa-solid fa-reply"></i>
                      Reply
                    </a>
                  </td>
                @endif

              {{-- Archive and Delete Button --}}
                 {{-- Store Archive Data from Controller--}}
              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <form id="archive-delete-form-{{ $message->id }}" action="/messages/archive-delete-message/ {{$message->id}}" 
                  method="POST">
                    @csrf
                    <button type="submit" class="text-red-400  py-2 rounded-xl">
                      <i class="text-cyan-600 fa-solid fa-archive"></i>
                      <p class="text-sm text-stone-600">Archive</p>
                        
                    </button>
                </form>
            </td>
            </tr>
          @endforeach    
        @else
          <tr>
            {{-- if no messages exist --}}
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg text-center">
              No messages.
            </td>
            @endif
            {{-- Button to view archive page --}}
            <button class="text-cyan-400 px-6 py-2 rounded-xl">
              <a href="{{route('archive-messages')}}">
                <i class="fa-solid fa-archive"></i> View Archived Messages
              </a>
            </button>
          </tr>
      </tbody>
    </table>
  </x-card>
</x-layout>
