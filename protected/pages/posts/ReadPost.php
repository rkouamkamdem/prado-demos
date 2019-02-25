<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 22/02/19
 * Time: 11:47
 */

use Prado\Web\UI\TPage;
use BlogException;
use BlogErrorHandler;

class ReadPost extends TPage
{
    private $_post;

    /**
     * lis les données du message.
     * cette méthode est appelée lors de l'initialisation de la page
     * @param mixed param : paramètres de l'évènement
     */
    public function onInit($param)
    {
        parent::onInit($param);
        // id du message passé par un paramètre GET
        $postID=(int)$this->Request['id'];

        // lis le message ainsi que les données correspondantes à l'auteur
        $this->_post = PostRecord::finder()->withAuthor()->findByPk($postID);

        if( $this->_post===null ) // si l'id du message est invalide
            throw new BlogException(404, 'Impossible de trouver le message demandé.'); //THttpException(500, 'Impossible de trouver le message demandé.');

        // défini le titre de la page comme étant celui du message
        $this->Title = $this->_post->title;

        //var_dump($this->_post); die(); //var_dump($this->Post);
    }

    /**
     * @return PostRecord retourne l'objet PostRecord correspondant au message
     */
    public function getPost()
    {
        return $this->_post;
    }

    /**
     * supprime le message actuellement visualisé
     * cette méthode est appelée par l'évènement OnClick du bouton "Supprimer"
     */
    public function deletePost($sender,$param)
    {
        // seul l'auteur ou un administrateur peuvent supprimer le message
        if(!$this->canEdit())
            throw new THttpException('Nous n\'êtes pas autorisé à effectuer cette action.');

        // le supprime de la base de données
        $this->_post->delete();

        // redirige le navigateur vers la page d'accueil
        $url = "prado-demos".$this->Service->DefaultPageUrl;
        $this->Response->redirect($url);
    }

    /**
     * @return boolean infiquant si le message peut être modifier ou supprimer par l'utilisateur actuel
     */
    public function canEdit()
    {
        //var_dump($this->Post); die();
        // seul l'auteur ou un administrateur peuvent modifier/supprimer le message
        return $this->User->Name===$this->Post->author_id || $this->User->IsAdmin;
    }


}