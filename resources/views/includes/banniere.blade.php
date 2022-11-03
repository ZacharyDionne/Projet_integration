<nav class="navbar navbar-dark bg-tr topnav" id="myTopnav">
    <a class="navbar-brand font-tr" href="{{ route('fiches.index') }}">
        <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt="">
        Voir vos fiches
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


    <a class="font-tr btnDeco" href="{{ route('connexion.logout') }}">
        <!-- <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt=""> -->
        <i class="fa fa-sign-out" width="50" height="50" class="d-inline-block align-center" aria-hidden="true"></i>
        Déconnexion
    </a>

    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>

</nav>

<script>
    function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        // remove responsive
        x.className -= " responsive";
    }
    }
</script>