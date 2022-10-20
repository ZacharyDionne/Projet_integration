<nav class="navbar navbar-dark bg-tr">
    <a class="navbar-brand font-tr" href="{{ route('fiches.index') }}">
        <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt="">
        Fiches
    </a>
            
    <a class="font-tr" href="
        @if (auth()->user())
            {{ route('conducteurs.edit', [auth()->user()->id]) }}
        @else
            {{ route('employeurs.edit', [auth()->guard('employeur')->user()->id]) }}
        @endif
    ">
        <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt="">
        paramètres
    </a>
    <a class="font-tr" href="{{ route('connexion.logout') }}">
        <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt="">
        Déconnexion
    </a>

</nav>