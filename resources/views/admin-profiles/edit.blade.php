{{-- Profile Info Form --}}
<x-layout>
    <main class="container mx-auto p-8">
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-profile-form :user="$admin" :route="'admin-profiles.update'" />
        </section>
    </main>
</x-layout>
