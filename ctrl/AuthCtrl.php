<?php

namespace Ctrl;

use Manager\UserManager;
use PDO;

class AuthCtrl extends Controller
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * AuthCtrl constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->userManager = new UserManager($db);
    }
    /**
     * @return void
     */
    public function loginForm(): void
    {
        require_once 'view/connexion.php';
        require_once 'view/template.php';
    }

    /**
     * @param string $pseudo
     * @param string $pwd
     * @return void
     */
    public function login(string $pseudo, string $pwd): void
    {
        // Effectuer la vérification et la connexion
        if ($loginOk) {
            $_SESSION['auth']['pseudo'] = $pseudo;
            header("Location: index.php");
        } else {
            $this->loginForm();
        }
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        session_destroy();
        require_once 'view/logout.php';
        require_once 'view/template.php';
    }

    /**
     * @return void
     */
    public function subscribe()
    {
        require_once 'view/inscription.php';
        require_once 'view/template.php';
    }

}