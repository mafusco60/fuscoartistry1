<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lightbox2 Test</title>
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
            rel="stylesheet"
        />
    </head>
    <body>
        <a
            href="https://via.placeholder.com/600"
            data-lightbox="test"
            data-title="Test Image"
        >
            <img src="https://via.placeholder.com/150" alt="Test Image" />
        </a>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof lightbox !== 'undefined') {
                    console.log('Lightbox2 is initialized');
                } else {
                    console.log('Lightbox2 is not initialized');
                }
            });
        </script>
    </body>
</html>
