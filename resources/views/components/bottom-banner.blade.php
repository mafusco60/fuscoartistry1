
@props([ 
'heading' => 'Enjoy exploring our collection.', 'subheading' => 'Find just the right piece to enhance your space!'
])


<section class="container mx-auto my-6">
    <div
        class="bg-blue-800 text-white rounded p-4 flex items-center justify-between flex-col md:flex-row gap-4"
    >
        <div>
            <h2 class="text-xl font-semibold">{{$heading}}</h2>
            <p class="text-gray-200 text-lg mt-2">
              {{$subheading}}
            </p>
        </div>
        
        <x-button-link url="/artworks/create" icon="edit" textClass="text-white" :block="true">Create Artwork</x-button-link >



           {{--  href="create-job.html"
            class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300" --}}
   
    </div>
</section>
