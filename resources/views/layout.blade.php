<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{$title ?? 'Fusco Artistry'}}</title>
</head>
<body class="bg-gray-100">
    <x-header/>
    <main class="container mx-auto p-8">
    {{$slot}}  
</main>
</body>
</html>