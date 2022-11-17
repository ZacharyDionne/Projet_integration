<?php
    namespace App\Http\Modules;

    use Throwable;

    /*
        Fait l'équivalent des Gates Laravel, mais retourne null si
        la base de données est innaccessible au lieu de lancer une erreur.

        null    -> base de données inaccessible
        false   -> accès refusé
        true    -> accès authorisé
    
    */
    class Filtre {

        public static function estAdmin()
        {
            try
            {
                $utilisateur = auth()->guard('employe')->user();
            }
            //impossible de vérifier les prévilèges de l'utilisateur
            catch (Throwable $e)
            {
                return null;
            }

            if (!$utilisateur)
                return false;
    
    
            if ($utilisateur->type_id != 2)
                return false;
            
            return true;

        }

        public static function estContreMaitre()
        {
            try
            {
                $utilisateur = auth()->guard('employe')->user();
            }
            //impossible de vérifier les prévilèges de l'utilisateur
            catch (Throwable $e)
            {
                return null;
            }

            if (!$utilisateur)
                return false;
    
            if ($utilisateur->type_id != 1)
                return false;

            return true;
        }

        public static function estLeConducteur()
        {
            try
            {
                $utilisateur = auth()->user();
            }
            //impossible de vérifier les prévilèges de l'utilisateur
            catch (Throwable $e)
            {
                return null;
            }

            if (!$utilisateur)
                return false;

            if ($conducteur->id != $id)
                return false;

            return true;
        }

        public static function estAdminOuContreMaitre()
        {
            
            try
            {
                $utilisateur = auth()->guard('employe')->user();
            }
            //impossible de vérifier les prévilèges de l'utilisateur
            catch (Throwable $e)
            {
                return null;
            }

            if (!$utilisateur)
                return false;
    
    
            if ($utilisateur->type_id != 1 && $utilisateur->type_id != 2)
                return false;
            
            return true;
        }
    }
?>