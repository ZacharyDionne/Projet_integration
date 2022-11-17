<nav class="navbar navbar-dark bg-tr topnav" id="myTopnav">
    @php
        try
        {
            $conducteur = auth()->user();
            $employe = auth()->guard('employe')->user();
        }
        catch (Throwable $e)
        {
            $conducteur = null;
            $employe = null;
        }
    @endphp
    @if ($conducteur)
        <a class="navbar-brand font-tr" href="{{ route('fiches.index') }}">
            <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center">
            Voir vos fiches
        </a>
    @elseif ($employe)
        @if ($employe->type_id === 1)
        <a class="navbar-brand font-tr" href="{{ route('conducteurs.index') }}">
            <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center">
            Conducteurs
        </a>
        @elseif ($employe->type_id === 2)
        <a class="navbar-brand font-tr" href="{{ route('employes.index') }}">
            <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center">
            Employés
        </a>
        @endif
    @else
        <h1 class="navbar-brand font-tr">Une erreur est survenue. Si le problème persiste, veuillez contacter votre responsable.</h1>
    @endif
            
   


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