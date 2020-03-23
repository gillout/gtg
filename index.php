<?php

session_start();

require_once 'config' . DIRECTORY_SEPARATOR . 'config.php';
require_once 'config' . DIRECTORY_SEPARATOR . 'Autoloader.php';

use Config\Autoloader;
use Config\MyPdo;
use Ctrl\Admin\LinkCtrl as AdmLnkCtrl;
use Ctrl\Admin\RubricCtrl as AdmRubCtrl;
use Ctrl\Admin\UserCtrl as AdmUsrCtrl;
use Ctrl\Admin\RecetteCtrl as AdmRecCtrl;
use Ctrl\AuthCtrl;
use Ctrl\LinkCtrl;
use Ctrl\HomeCtrl;
use Ctrl\RecetteCtrl;
use Ctrl\RubricCtrl;
use Ctrl\VnCtrl;

Autoloader::register();

$db = new MyPdo();

$_SESSION['User'] = 'gilleste';

//session_destroy();

if (isset($_SESSION['User'])) {
    if($_SESSION['User'] == 'gilleste') {
        if (isset($_GET['target'])) {
            if ($_GET['target'] == 'links') {
                $ctrl = new AdmLnkCtrl($db);
                // Si on est en POST et que le formulaire est validé
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['validate'])) {
                    // Alors on persiste les données
                    if (!isset($_POST['idLink']) && count($_POST) > 1) {
                        $ctrl->add($_POST['label'], $_POST['adrOrFile'], $_POST['idRub'], $_POST['idType']);
                    } elseif (isset($_POST['idLink']) && count($_POST) > 1) {
                        $ctrl->upd($_POST['label'], $_POST['adrOrFile'], $_POST['idRub'], $_POST['idType'], $_POST['idLink']);
                    }
                    // Sinon si on est en POST mais que le formulaire n'est pas validé
                } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Alors on affiche une page de validation
                    $ctrl->validate($_POST);
                } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_POST['validate']) && isset($_GET['idLink'])) {
                    $ctrl->del($_GET['idLink']);
                    // Sinon si on est en GET mais que le formulaire n'est pas validé
                } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idLink'])) {
                    $ctrl->validate($_GET);
                } else { // Sinon on affiche la liste des liens
                    $ctrl->all();
                }
            } elseif ($_GET['target'] == 'typsrubs') {
                $ctrl = new AdmRubCtrl($db);
                $ctrl->all();
            } elseif ($_GET['target'] == 'users') {
                $ctrl = new AdmUsrCtrl($db);
                $ctrl->all();
            } elseif ($_GET['target'] == 'recettes') {
                $ctrl = new AdmRecCtrl($db);
                if (isset($_GET['id'])) {
                    $ctrl->one($_GET['id']);
                } else {
                    $ctrl->all();
                }
            } elseif ($_GET['target'] == 'link') {
                $ctrl = new LinkCtrl($db);
                    if ($_GET['action'] == 'open') {
                        if (isset($_GET['id'])) {
                            $ctrl->open($_GET['id']);
                        }
                    }
            } elseif ($_GET['target'] == 'autres_sites') {
                $ctrl = new HomeCtrl();
                $ctrl->otherSites();
            } elseif ($_GET['target'] == 'vietnam') {
                $ctrl = new VnCtrl($db);
                $ctrl->home();
            } elseif ($_GET['target'] == 'auth') {
                $ctrl = new AuthCtrl($db);
                if ($_GET['action'] == 'logout') {
                    $ctrl->logout();
                } elseif ($_GET['action'] == 'loginForm') {
                    $ctrl->loginForm();
                } elseif ($_GET['action'] == 'login') {
                    $ctrl->login($pseudo, $pwd);
                } elseif ($_GET['action'] == 'subscribe') {
                    $ctrl->subscribe();
                }

            } elseif ($_GET['target'] == 'galerie') {
                $ctrl = new VnCtrl($db);
                $ctrl->galerie();
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
    }

} elseif (isset($_GET['target'])) {
    if ($_GET['target'] == 'link') {
        $ctrl = new LinkCtrl($db);
        if ($_GET['action'] == 'open') {
            if (isset($_GET['id'])) {
                $ctrl->open($_GET['id']);
            }
        }
    } elseif ($_GET['target'] == 'autres_sites') {
        $ctrl = new HomeCtrl();
        $ctrl->otherSites();
    } elseif ($_GET['target'] == 'snippet') {
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
