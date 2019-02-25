<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 19/02/19
 * Time: 11:33
 */
class MainLayout extends TTemplateControl
{
    /**
     * Déconnecte un utilisateur.
     * Cette méthode répond à l'évènement OnClick du lien "se déconnecter".
     * @param mixed sender : celui qui a généré l'évènement
     * @param mixed param : paramètres de l'évènement
     */
    public function logoutButtonClicked($sender,$param)
    {   //die("Je suis là ici !!!");
        $this->Application->getModule('auth')->logout();
        $url = "prado-demos".$this->Service->constructUrl($this->Service->DefaultPage);
        $this->Response->redirect($url);
    }
}
?>