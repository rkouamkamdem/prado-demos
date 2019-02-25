<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 20/02/19
 * Time: 17:12
 */
// Include TDbUserManager.php file which defines TDbUser
use Prado\Security\TDbUser;

Prado::using('System.Security.TDbUserManager');
/**
 * La classe BlogUser.
 * BlogUser représente les données utilisateurs à conserver en session.
 * L'implémentation par défaut conserve le nom et le rôle de l'utilisateur.
 */
class BlogUser extends TDbUser
{
    /**
     * Créer un objet de type BlogUser basé sur le nom de l'utilisateur.
     * Cette méthode est requise par TDbUser. Cet objet vérifie si l'utilisateur
     * est bien présent en base de données. Si oui, un objet BlogUser
     * est créé et initialisé.
     * @param string le nom de l'utilisateur
     * @return l'objet BlogUser, null si le nom de l'utilisateur est invalide.
     */
    public function createUser($username)
    {
        // utilise l'Active Record UserRecord pour chercher l'utilisateur username
        $userRecord = UserRecord::finder()->findByPk($username);
        if($userRecord instanceof UserRecord) // si trouvé
        {
            $user= new BlogUser($this->Manager);
            $user->Name=$username; // enregistre le nom de l'utilisateur
            $user->Roles=($userRecord->role==1?'admin':'user'); // et son rôle
            $user->IsGuest=false;
            // l'utilisateur n'est pas un invité
            return $user;
        }
        else
            return null;
    }
    /**
     * Vérifie que le nom d'utilisateur et son mot de passe sont correct.
     * Cette méthode est requise par TDbUser.
     * @param string le nom de l'utilisateur
     * @param string le mot de passe
     * @return boolean en fonction de la validité de la vérification.
     */
    public function validateUser($username,$password)
    {
// utilise l'Active Record UserRecord pour vérifier le nom d'utilisateur couplé au mot de passe.
        return UserRecord::finder()->findBy_username_AND_password($username,$password)!==null;
    }
    /**
     * @return boolean indiquant si l'utilisateur est un administrateur.
     */
    public function getIsAdmin()
    {
        return $this->isInRole('admin');
    }
}