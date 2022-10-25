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
        <!-- <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt=""> -->
        <i class="fa fa-cog" width="50" height="50" class="d-inline-block align-center" aria-hidden="true"></i>
        paramètres
    </a>
    <a class="font-tr" href="{{ route('connexion.logout') }}">
        <!-- <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt=""> -->
        <i class="fa fa-sign-out" width="50" height="50" class="d-inline-block align-center" aria-hidden="true"></i>
        Déconnexion
    </a>

</nav>