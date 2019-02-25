<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 20/02/19
 * Time: 17:05
 */
class AdminUser extends TPage
{
    /**
     * Remplis la grille avec la liste des utilisateurs.
     * Cette méthode est appelée lors de l'initialisation de la page.
     * @param mixed param : paramètres de l'évènement
     */
    public function onInit($param)
    {
        parent::onInit($param);
// lit tout les comptes utilisateurs
        $this->UserGrid->DataSource=UserRecord::finder()->findAll();
// et les associes à la grille
        $this->UserGrid->dataBind();
    }
/**
 * Supprime un compte utilisateur.
 * Cette méthode répond à l'évènement OnDeleteCommand.
 * * @param mixed sender : celui qui a généré l'évènement
 * @param mixed param : paramètres de l'évènement
 */
    public function deleteButtonClicked($sender,$param)
    {
        // récupère l'identifiant du bouton sur lequel on a cliqué
        $item=$param->Item;
        // récupère auprès de la grille la clé primaire correspondante à l'identifiant
        $username=$this->UserGrid->DataKeys[$item->ItemIndex];
        // supprime le compte utilisateur en utilisant la clé primaire
        UserRecord::finder()->deleteByPk($username);

        $url = "prado-demos".$this->Service->constructUrl('users.AdminUser');
        // redirige l'utilisateur vers la page d'accueil
        $this->Response->redirect($url);
    }
}