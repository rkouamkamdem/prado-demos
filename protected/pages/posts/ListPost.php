<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 22/02/19
 * Time: 11:45
 */

use Prado\Web\UI\TPage;

class ListPost extends TPage
{
    /**
     * Initialise le TRepeater.
     * Cette méthode est appelé par le framework lors de l'initialisation de la page
     * @param mixed param : paramètres de l'évènement
     */
    public function onInit($param)
    {
        parent::onInit($param);
        if(!$this->IsPostBack) // la page est chargée pour la première fois ?
        {
            //récupère le nombre total de messages
            $this->Repeater->VirtualItemCount=PostRecord::finder()->count();
            // rempli le TRepeater avec les données
            $this->populateData();
        }
    }

    /**
     * Gestionnaire d'évènement pour OnPageIndexChanged du TPager.
     * Cette méthode est appelée lors du changement de page
     */
    public function pageChanged($sender,$param)
    {
        // change l'index de la page courante par le nouvel index
        $this->Repeater->CurrentPageIndex=$param->NewPageIndex;
        // rempli de nouveau le TRepeater
        $this->populateData();
    }

    /**
     * détermine quelle page doit être affichée et remplie
     * TRepeater avec les données lues
     */
    protected function populateData()
    {
        $offset=$this->Repeater->CurrentPageIndex*$this->Repeater->PageSize;
        $limit=$this->Repeater->PageSize;
        if($offset+$limit>$this->Repeater->VirtualItemCount)
            $limit=$this->Repeater->VirtualItemCount-$offset;
        $this->Repeater->DataSource=$this->getPosts($offset,$limit);
        //var_dump($this->Repeater->DataSource); die();
        $this->Repeater->dataBind();
    }
    /**
     * lis les données à partir de la base de données en utilisant les fonctionnalités offset et limit.
     */
    protected function getPosts($offset, $limit)
    {
        // construit les critères de la requête
        $criteria=new TActiveRecordCriteria;
        $criteria->OrdersBy['create_time']='desc';
        $criteria->Limit=$limit;
        $criteria->Offset=$offset;
        // lit les messages en fonction des critères précédents
        return PostRecord::finder()->withAuthor()->findAll($criteria);
    }
}