<?php

use Prado\Web\UI\TPage;

/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 20/02/19
 * Time: 17:07
 */
class LoginUser extends TPage
{

    public function onInit($param)
    {
        if (strpos($this->Application->getModule('auth')->ReturnUrl, "console") !== false) {
            ;
        }
        //$this->Master->mainHead->Controls[] = '<link rel="stylesheet" type="text/css" href="/quickspotfr/themes/quickspot/console.css" />';
    }

    /**
     * Vérifie la validité du nom d'utilisateur et du mot de passe.
     * Cette méthode implémente l'évènement <tt>OnServerValidate</tt> du validateur <tt>TCustomValidator</tt>.
     * @param mixed sender : celui qui a généré l'évènement
     * @param mixed param : paramètres de l'évènement
     */
    public function validateUser($sender,$param)
    {
        $authManager=$this->Application->getModule('auth');
        if(!$authManager->login($this->Username->Text,$this->Password->Text))
            $param->IsValid=false; // indique au validateur que la validation à échoué
    }
    /**
     * Rédirige le navigateur vers l'URL originellement demandée si la validation est Ok.
     * Cette méthode implémente l'évènement <tt>OnClick</tt> du bouton "envoyer".
     * @param mixed sender : celui qui a généré l'évènement
     * @param mixed param : paramètres de l'évènement
     */
    public function loginButtonClicked($sender,$param)
    {
        if($this->Page->IsValid) // toutes les validations sont ok ?
        {
            //récupère l'URL de la page protégée qui avait été demandée par l'utilisateur
            $url=$this->Application->getModule('auth')->ReturnUrl;
            if(empty($url)) // l'utilisateur à accéder à la page de connexion directement
                $url= "prado-demos".$this->Service->DefaultPageUrl;
            $this->Response->redirect($url);
        }
    }
}