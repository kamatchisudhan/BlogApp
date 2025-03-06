

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">My Blog</a>
            <a class="navbar-brand" href="{{route('users.index')}}">API User</a>
            <button id="darkModeToggle" class="btn btn-dark">Dark Mode</button>
            
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    
    <script>
        document.getElementById('darkModeToggle').addEventListener('click', function() {
            document.body.classList.toggle('bg-dark');
            document.body.classList.toggle('text-light');
        });
    </script>
</body>
</html>
