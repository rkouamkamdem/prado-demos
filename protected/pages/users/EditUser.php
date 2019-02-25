<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 20/02/19
 * Time: 17:07
 */
class EditUser extends TPage
{
    /**
     * Initialise les champs avec les données de l'utilisateur.
     * Cette méthode est appelée par le framework lorsque la page est initialisée.
     * @param mixed param : paramètres de l'évènement
     */
    public function onInit($param)
    {
        parent::onInit($param);
        if(!$this->IsPostBack) // est-ce que c'est le premier appel à la page
        {
            // Lit les informations de l'utilisateur. C'est équivalent à :
            // $userRecord=$this->getUserRecord();
            $userRecord=$this->UserRecord;
            // Rempli les contrôles avec les données de l'utilisateur
            $this->Username->Text=$userRecord->username;
            $this->Email->Text=$userRecord->email;
            $this->Role->SelectedValue=$userRecord->role;
            $this->FirstName->Text=$userRecord->first_name;
            $this->LastName->Text=$userRecord->last_name;
        }
    }
    /**
     * Enregistre les modifications si tous les validateurs sont Ok.
     * Cette méthode répond à l'évènement OnClick du bouton "Enregistrer".
     * @param mixed sender : celui qui a généré l'évènement
     * @param mixed param : paramètres de l'évènement
     */
    public function saveButtonClicked($sender,$param)
    {
        //var_dump($sender); var_dump($param); die();

        if($this->IsValid) // toutes les validations Ok ?
        {
            // Lit les informations de l'utilisateur.
            $userRecord=$this->UserRecord;
            // Enresgistre les valeurs dans les champs de la BDD
            $userRecord->username=$this->Username->Text;
            // mets à jour le mot de passe s'il n'est pas vide
            if(!empty($this->Password->Text))
                $userRecord->password=$this->Password->Text;
            $userRecord->email=$this->Email->Text;
            // mets à jour le rôle si l'utilisateur actuel est un administrateur
            if($this->User->IsAdmin)
                $userRecord->role=(int)$this->Role->SelectedValue;
            $userRecord->first_name=$this->FirstName->Text;
            $userRecord->last_name=$this->LastName->Text;
            // enregistre les modifications dans la BDD
            $userRecord->save();

            $url = "prado-demos"."prado-demos".$this->Service->DefaultPageUrl;
            // redirige vers la page d'accueil
            $this->Response->redirect($url);
            //$this->Response->redirect("prado-demos".$this->Service->DefaultPageUrl);
        }
    }
    /**
     * Retourne l'utilisateur qui doit être mis à jour.
     * @return UserRecord l'utilisateur qui doit être modifié.
     * @throws THttpException si l'utilisateur n'existe pas.
     */
    protected function getUserRecord(){
        // l'utilisateur à modifié est l'utilisateur actuellement connecté(C'est le Username de l'utilisateur en cours)
        $username=$this->User->Name;

        // si la variable GET 'username' n'est pas vide et que l'utilisateur actuel
        // est un administrateur, nous utilisons la variable GET à la place
        if($this->User->IsAdmin && $this->Request['username']!==null)
            $username=$this->Request['username'];

        // lit les données de l'utilisateur par Active Record
        $userRecord=UserRecord::finder()->findByPk($username);
        if(!($userRecord instanceof UserRecord))
            throw new THttpException(500,'Username is invalid.');
        return $userRecord;
    }
}