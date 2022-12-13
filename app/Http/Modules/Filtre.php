<?php
    namespace App\Http\Modules;


    use Illuminate\Support\Facades\Log;

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

        public static function estLeConducteur($id)
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

            if ($utilisateur->id != $id)
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

public static function estLUtilisateur($id)
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
    Log::debug("1");
    if ($utilisateur)
    {
        if ($utilisateur->id == $id)
            return true;
        return false;
    }

    Log::debug("2");
    try
    {
        $utilisateur = auth()->guard('employe')->user();
    }
    //impossible de vérifier les prévilèges de l'utilisateur
    catch (Throwable $e)
    {
        return null;
    }
    Log::debug("3");
    if ($utilisateur)
    {
        if ($utilisateur->id == $id)
            return true;
        return false;
    }
    Log::debug("4");
    return false;

    }
}
?>