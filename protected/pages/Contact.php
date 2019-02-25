<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 19/02/19
 * Time: 11:14
 */

class Contact extends TPage
{
    /*
    public function onPreInit($param)
    {
        parent::onPreInit($param);
        $this->MasterClass='Path.To.NewLayout';
    }
    */

    /**
     * Gestionnaire d'évènement pour OnClick (bouton submit).
     * @param TButton le bouton qui a générer l'évènement
     * @param TEventParameter les paramètres de l'évènement (null dans ce cas)
     */
    public function submitButtonClicked($sender, $param)
    {
        if ($this->IsValid) // vérifie que les validations sont Ok
        {
            // récupère le nom de l'utilisateur, son email et son commentaire
            $name = $this->Name->Text;
            $email = $this->Email->Text;
            $feedback = $this->Feedback->Text;

            // envoie un email à l'administrateur avec les informations
            $this->mailFeedback($name, $email, $feedback);
        }
    }

    protected function mailFeedback($name, $email, $feedback)
    {
        // implémentation de l'envoi de l'email
    }
}
?>