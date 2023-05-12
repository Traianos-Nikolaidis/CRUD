<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Application</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add your CSS links here -->
</head>

<body>
    <header>
        <nav>
            <!-- Your navigation links go here -->
            <a href="/" class="btn btn-primary">Home</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <!-- Footer content goes here -->
    </footer>
    <!-- Add your JS scripts here -->
</body>

</html>
