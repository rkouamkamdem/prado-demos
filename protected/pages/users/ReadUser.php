<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 22/02/19
 * Time: 11:47
 */

use Prado\Web\UI\TPage;

class ReadUser extends TPage
{
    private $_user;

    /**
     * lis les données du message.
     * cette méthode est appelée lors de l'initialisation de la page
     * @param mixed param : paramètres de l'évènement
     */
    public function onInit($param)
    {
        parent::onInit($param);
        // id du message passé par un paramètre GET
        $userID = $this->Request['username'];

        // lis le message ainsi que les données correspondantes à l'auteur
        $this->_user = UserRecord::finder()->findByPk($userID);
        //var_dump($this->_user); die();

        if( $this->_user === null ) // si l'id du message est invalide
            throw new THttpException(500, 'Impossible de trouver le User demandé.');

        // défini le username du User
        //$this->username = $this->_user->username;

        //var_dump($this->_post); die(); //var_dump($this->Post);
    }

    /**
     * @return UserRecord retourne l'objet UserRecord correspondant au User
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * supprime le User actuellement visualisé
     * cette méthode est appelée par l'évènement OnClick du bouton "Supprimer"
     */
    public function deleteUser($sender,$param)
    {
        // seul l'auteur ou un administrateur peuvent supprimer le User
        if(!$this->canEdit())
            throw new THttpException('Nous n\'êtes pas autorisé à effectuer cette action.');

        // le supprime de la base de données
        $this->_user->delete();

        // redirige le navigateur vers la page d'accueil
        $url = "prado-demos".$this->Service->DefaultUserPage;
        $this->Response->redirect($url);
    }

    /**
     * @return boolean infiquant si le message peut être modifier ou supprimer par l'utilisateur actuel
     */
    public function canEdit()
    {
        //var_dump($this->Post); die();
        // seul l'auteur ou un administrateur peuvent modifier/supprimer le message
        return $this->_user->username === $this->User->username || $this->User->IsAdmin;
    }

}