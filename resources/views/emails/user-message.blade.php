<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Fusco Artistry Message</title>
  </head>
  <body>
    <p class="">There has been a new message for Fusco Artistry</p>
    @if ($artwork)
      <p class="">
        The message is regarding the artwork:
        {{ $artwork->title }}
      </p>
    @endif

    <p class="font-bold">The message is from: {{ $message->name }}</p>
    <p class="font-bold">The message is: {{ $message->body }}</p>
    <p class="font-bold">The message is from: {{ $message->email }}</p>
  </body>
</html>
