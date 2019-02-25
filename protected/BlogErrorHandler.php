<?php
/**
 * Created by PhpStorm.
 * User: romeo
 * Date: 25/02/19
 * Time: 15:23
 */

Prado::using('System.Exceptions.TErrorHandler');
Prado::using('Application.BlogException');
use BlogException;
class BlogErrorHandler extends TErrorHandler
{
    /**
     * Renvoi le fichier gabarit utilisé pour afficher l'erreur.
     * Cette méthode surcharge la méthode originale.
     */
    protected function getErrorTemplate($statusCode,$exception)
    {
        // on utilise notre propre gabarit pour BlogException
        if($exception instanceof BlogException)
        {
            // Récupère le chemin du fichier de gabarit : protected/error.html
            $templateFile=Prado::getPathOfNamespace('Application.error','.html');
            //die('Je passe par ici !! [ if($exception instanceof BlogException)] ');
            return file_get_contents($templateFile);
        }
        else{
            //var_dump($exception);
            //die('Je passe par ici !! [ else du if($exception instanceof BlogException) ]  $statusCode == ['.$statusCode.'] ');
            // sinon on utilise le gabarit par défaut.
            return parent::getErrorTemplate($statusCode,$exception);
        }
    }

    /**
     * Gère les erreurs causées par les utilisateurs.
     * Cette méthode surcharge la méthode originale.
     * Elle est appelée lorsqu'une exception utilisateur est générée.
     */

    protected function handleExternalError($statusCode,$exception)
    {
        // Journaliser l'erreur (seulement pour BlogException)
        if($exception instanceof BlogException)
            Prado::log($exception->getErrorMessage(),TLogger::ERROR,'BlogApplication');
        // Appelle l'implémentation de la classe parente
        parent::handleExternalError($statusCode,$exception);
    }
}