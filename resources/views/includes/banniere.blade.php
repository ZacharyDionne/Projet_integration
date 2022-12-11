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

    $alertes = App\Models\Alerte::where('conducteur_id', $conducteur->id)->where('idEmploye', 0)->where('actif', 1)->get();
    $nbAlertes = count($alertes);


    @endphp
    <img src="{{ asset('images/logo_BLANC.png') }}" width="48" height="48" class="banLogo displayBig align-center">
    @if ($conducteur)
    <a class="topnavButton noMargin navbar-brand font-tr align-middle" href="{{ route('fiches.index', $conducteur->id) }}">
        <div class="text-nav">
            <i class="fa fa-calendar fa-fw align-items-center"></i>
            <span>Voir vos fiches</span>
        </div>
    </a>
    @elseif ($employe)
    @if ($employe->type_id === 1)
    <a class="topnavButton noMargin navbar-brand font-tr" href="{{ route('conducteurs.index') }}">
        <div class="text-nav">
            <i class="fa fa-user fa-fw align-items-center"></i>
            <span>Conducteurs</span>
        </div>
    </a>
    @elseif ($employe->type_id === 2)
    <a class="topnavButton noMargin navbar-brand font-tr" href="{{ route('employes.index') }}">
        <div class="text-nav">
            <i class="fa fa-user fa-fw align-items-center"></i>
            <span>Employés</span>
        </div>
    </a>
    @endif
    @else
    <script>
        alert("Une erreur est survenue: (Impossible d'obtenir l'ID utilisateur) \nSi le problème persiste, veuillez contacter votre responsable.");
    </script>
    @endif

    <a class="btnAlerte topnavButton noMargin navbar-brand font-tr" href="{{ route('alertes.index') }}">
        <div class="text-nav">
            @if ($nbAlertes <= 0) 
            <i class="fa fa-bell-slash fa-fw" width="50" height="50" class="d-inline-block align-center" aria-hidden="true"></i>
            <span>Notifications</span>
            @else
            <div class="position-relative">
                <i class="fa fa-bell position-relative" width="50" height="50" class="d-inline-block align-center" aria-hidden="true"></i>
                <div class="icon-badge">{{ $nbAlertes }}</div>
            </div>
            <span class="ml-2">Notifications</span>
            @endif
        </div>
    </a>

    <a class="font-tr btnDeco" href="{{ route('connexion.logout') }}">
        <div class="text-nav">
            <i class="fa fa-sign-out fa-fw" width="50" height="50" class="d-inline-block align-center" aria-hidden="true"></i>
            <span>Déconnexion</span>
        </div>
    </a>

</nav>