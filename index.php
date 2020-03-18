<?php

session_start();

require_once 'config/config.php';
require_once 'config/Autoloader.php';

/*
require_once ROOT_DIR . 'ctrl/admin/LinkCtrl.php';
require_once ROOT_DIR . 'ctrl/admin/RubricCtrl.php';
require_once ROOT_DIR . 'ctrl/admin/TypeCtrl.php';
require_once ROOT_DIR . 'ctrl/admin/UserCtrl.php';
require_once ROOT_DIR . 'ctrl/admin/RecetteCtrl.php';
require_once ROOT_DIR . 'ctrl/admin/PhotoCtrl.php';
*/

use Config\Autoloader;
use Config\MyPdo;
//use Ctrl\Admin\LinkCtrl;
use Ctrl\HomeCtrl;
use Ctrl\RecetteCtrl;
use Ctrl\RubricCtrl;
use Ctrl\VnCtrl;

Autoloader::register();

$db = new MyPdo();

/*
if ($_SESSION['pseudo'] = 'gilleste') {
    if ($_GET['target'] == 'autres_sites') {
        $ctrl = new HomeCtrl();
        $ctrl->otherSites();
    }
} elseif ($_GET['target'] == 'acc-admin') {
        $ctrl = new LinkCtrl($db);
        $ctrl->all();
}
*/

if (isset($_GET['target'])) {

    if ($_GET['target'] == 'autres_sites') {
        $ctrl = new HomeCtrl();
        $ctrl->otherSites();

    } elseif ($_GET['target'] == 'snippets') {
        // $ctrl = new SnippetCtrl($db);
        // require ROOT_DIR . 'view/snippets.php';
        require ROOT_DIR . 'view/template.php';

    } elseif ($_GET['target'] == 'vietnam') {
        $ctrl = new VnCtrl($db);
        $ctrl->home();

    } elseif ($_GET['target'] == 'recette') {

        $ctrl = new RecetteCtrl($db);
        if (isset($_GET['id'])) { // Si un id de recette est présent alors on l'affiche
            $ctrl->show($_GET['id']);
        } else { // Sinon on affiche la page vietnam
            $ctrl = new VnCtrl($db);
            $ctrl->home();
        }

    } elseif ($_GET['target'] == 'galerie') {
        $ctrl = new VnCtrl($db);
        $ctrl->galerie();

    } elseif ($_GET['target'] == 'connexion') {
        // $ctrl = new ();
        require ROOT_DIR . 'view/connexion.php';
        require ROOT_DIR . 'view/template.php';

    } elseif ($_GET['target'] == 'rubric') {

        $ctrl = new RubricCtrl($db);
        if (isset($_GET['id'])) { // Si un id de rubrique est présent alors on l'affiche
            $ctrl->show($_GET['id']);
        } else { // Sinon on affiche la page d'accueil
            $ctrl->index();
        }

    } elseif ($_GET['target'] == 'contact') {
        $ctrl = new HomeCtrl();
        $ctrl->contact();
    }

} else {
    $ctrl = new RubricCtrl($db);
    $ctrl->index();
}
