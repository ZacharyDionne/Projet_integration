<?php
    namespace App\Http\Modules;

    use Throwable;

    class Gate {

        /*
            null    -> une erreur interne
            false   -> accès refusé
            true    -> accès accepté
        */
        public static function estAdmin()
        {

            $utilisateur = auth()->guard('employe')->user();
            

            if (!$utilisateur)
                return false;
    
    
            if ($utilisateur->type_id != 2)
                return false;
            
            return true;
        }

        public static function estContreMaitre()
        {
            if (!auth()->check())
                return false;

            $utilisateur = auth()->guard('employe')->user();

            if (!$utilisateur)
                return false;
    
    
            if ($utilisateur->type_id != 1)
                return false;
            
            return true;
        }

        public static function estLeConducteur()
        {
            if (!auth()->check())
                return false;

            $utilisateur = auth()->user();

            if (!$utilisateur)
                return false;

            return $conducteur->id == $id;
        }
    }
?>