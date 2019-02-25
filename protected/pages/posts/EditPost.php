<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 22/02/19
 * Time: 11:44
 */

use Prado\Web\UI\TPage;


class EditPost extends TPage
{
    /**
     * initialise les contrôles de saisies avec les données du message.
     * cette méthode est appelée lors de l'initialisation de la page
     * @param mixed param : paramètres de l'évènement
     */
    public function onInit($param)
    {
        parent::onInit($param);
// récupère les données de l'utilisateur. Equivalent à:
        //$postRecord=$this->getPost();
        $postRecord=$this->Post;
// vérification des droits: seul l'auteur ou un administrateur peuvent modifier le message
        if($postRecord->author_id!==$this->User->Name && !$this->User->IsAdmin)
            throw new THttpException(500,'Vous n êtes pas autoriser à modifier ce message.');
        if(!$this->IsPostBack) // est-ce le premier appel à la page
        {
// rempli les contrôles avec les données du message
            $this->TitleEdit->Text = $postRecord->title;
            $this->ContentEdit->Text = $postRecord->content;
            //Rajouté par Roméo le 25/02/2019
            //$this->AuthorEdit->Text = $postRecord->author->username;
           //$this->PostDateCreatedEdit = date('m/d/Y h:m:sa', $postRecord->create_time) ;
        }
    }

/**
 * Enregistre si toutes les validations sont Ok
 * cette méthode répond à l'évènement OnClick du bouton "Enregistrer".
 * @param mixed sender : celui qui a généré l'évènement
 * @param mixed param : paramètres de l'évènement
 */
    public function saveButtonClicked($sender,$param)
    {
        if($this->IsValid) // toutes les validations sont ok ?
        {
// récupère les données de l'utilisateur. Equivalent à:
// $postRecord=$this->getPost();
            $postRecord = $this->Post;
// affecte les données saisies aux champs de la BDD
            $postRecord->title=$this->TitleEdit->SafeText;
            $postRecord->content=$this->ContentEdit->SafeText;
// enregistre les données par la méthode save de l'Active Record
            $postRecord->save();
// redirige le navigateur vers la page ReadPost
            $url = "prado-demos".$this->Service->constructUrl('posts.ReadPost',array('id'=>$postRecord->post_id));
            $this->Response->redirect($url);
        }
    }

    /**
     * retourne les données du message devant être modifiées.
     * @return PostRecord les données devant être modifiés.
     * @throws THttpException si le message est inexistant.
     */
    protected function getPost()
    {
// l'ID du message devant être modifié passé par un paramètre GET
        $postID=(int)$this->Request['id'];
// utilise Active Record pour lire le message correspondant à cet ID
        $postRecord=PostRecord::finder()->findByPk($postID);
        if($postRecord===null)
            throw new THttpException(500,'Message inexistant.');
        return $postRecord;
    }

}