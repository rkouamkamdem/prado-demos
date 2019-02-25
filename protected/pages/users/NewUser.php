<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 20/02/19
 * Time: 17:07
 */

class NewUser extends TPage
{
    /**
     * Vérifie si le nom d'utilisateur existe dans la base de données.
     * Cette méthode répond à l'évènement OnServerValidate du validateur username.
     * @param mixed sender : celui qui a généré l'évènement
     * @param mixed param : paramètres de l'évènement
     */
    public function checkUsername($sender,$param)
    {
        // valide si l'utilisateur existe
        $param->IsValid=UserRecord::finder()->findByPk($this->Username->Text)===null;
    }
    /**
     * Créer un nouveau compte utilisateur si tous les champs sont valides.
     * Cette méthode répond à l'évènement OnClick du bouton "create".
     * @param mixed sender : celui qui a généré l'évènement
     * @param mixed param : paramètres de l'évènement
     */
    public function createButtonClicked($sender,$param)
    {
        if($this->IsValid) // si toutes les validations sont ok
        {
            // rempli l'objet UserRecord avec les données saisies
            $userRecord=new UserRecord;
            $userRecord->username=$this->Username->Text;
            $userRecord->password=$this->Password->Text;
            $userRecord->email=$this->Email->Text;
            $userRecord->role=(int)$this->Role->SelectedValue;
            $userRecord->first_name=$this->FirstName->Text;
            $userRecord->last_name=$this->LastName->Text;
            // l'enregistre dans la base de données par la méthode save de l'Active Record
            $userRecord->save();
            $url = "prado-demos".$this->Service->DefaultPageUrl;
            $url1 = "prado-demos".$this->Service->constructUrl('users.AdminUser');
            // redirige l'utilisateur vers la page d'accueil
            $this->Response->redirect($url1);
        }
    }
}