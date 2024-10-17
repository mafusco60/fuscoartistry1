<x-layout>
    <main class="container mx-auto p-8">
        <section class="flex flex-col md:flex-row gap-4">
            <x-profile-form :user="$user" />
            <div class="">
                <x-favorites :favorites="$favorites" :artworks="$artworks" />
            </div>
        </section>
    </main>
    <x-bottom-banner />
</x-layout>
