<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">
            🏨 Hotel Management
        </a>

        <div>

            <a href="/" class="btn btn-light me-2">
                Dashboard
            </a>

            <a href="/chambres" class="btn btn-light me-2">
                Chambres
            </a>

            <a href="/clients" class="btn btn-light me-2">
                Clients
            </a>

            <a href="/reservations" class="btn btn-light">
                Réservations
            </a>
            <a href="/factures" class="btn btn-light me-2">
    Factures
</a>
            @if(Auth::user()->role == 'admin')
    <a href="/users" class="btn btn-dark">
        Utilisateurs
    </a>
@endif
     

        </div>

<div class="d-flex align-items-center">

    
        @if(Auth::check())
    <span class="text-white me-3 fw-bold">
        👤 {{ Auth::user()->name }} ({{ Auth::user()->role }})
    </span>
@endif
    </span>

    <form action="/logout" method="POST">
        @csrf
        <button class="btn btn-danger btn-sm">
            Déconnexion
        </button>
    </form>

</div>

</div>
</nav>

<div class="container mt-4">

    @yield('content')

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>