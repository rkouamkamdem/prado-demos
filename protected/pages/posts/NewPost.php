<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 22/02/19
 * Time: 11:46
 */

use Prado\Web\UI\TPage;

class NewPost extends TPage
{
    /**
     * création d'un nouveau message si toutes les données sont valides.
     * cette méthode est appelée par l'évènement OnClick du bouton "Ajouter".
     * @param mixed sender : celui qui a généré l'évènement
     * @param mixed param : paramètres de l'évènement
     */
    public function createButtonClicked($sender,$param)
    {
        if($this->IsValid) // tous les validateurs sont Ok ?
        {
            $postRecordArray = PostRecord::finder()->findAll();
            $nbrPost = count($postRecordArray);
            $idpost = $nbrPost + 1;

            // créer un nouvel objet PostRecord avec les données du formulaire
            $postRecord = new PostRecord;
            // utiliser SafeText à la place de Text évite les attaques XSS
            $postRecord->post_id = $idpost;
            $postRecord->title = $this->TitleEdit->SafeText;
            $postRecord->content = $this->ContentEdit->SafeText;
            $postRecord->author_id = $this->User->Name;
            $postRecord->create_time = time();
            $postRecord->status = 0;
            // enregistre les données dans la BDD par la méthode save de l'Active Record
            $postRecord->save();
            // redirige le navigateur vers le message nouvellement créé
            $url = "prado-demos".$this->Service->constructUrl('posts.ReadPost',array('id'=>$postRecord->post_id));
            $this->Response->redirect($url);
        }
    }
}