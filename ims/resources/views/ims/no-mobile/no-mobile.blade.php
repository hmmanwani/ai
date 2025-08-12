<!DOCTYPE html>
<html>

<head>
    <title>Access Restricted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 24px;
        }

        p {
            font-size: 18px;
        }
    </style>
    <script>
        // JavaScript to further check screen size
        if (window.innerWidth <= 800 || window.innerHeight <= 600) {
            document.write(
                '<h1>Access Restricted</h1><p>This website is not accessible on mobile devices. Please use a desktop browser to access the site.</p>'
            );
        } else {
            window.location.href = '/';
        }
    </script>

</head>

<body>
    <noscript>
        <h1>Access Restricted</h1>
        <p>This website is not accessible on mobile devices. Please use a desktop browser to access the site.</p>
    </noscript>
</body>

</html>
