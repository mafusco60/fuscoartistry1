
<x-layout>
  <x-slot name="title">Create New Artwork</x-slot>
   <h1>Create New Artwork</h1>
  <form action="/artworks" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Title">
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Create</button>
</x-layout>