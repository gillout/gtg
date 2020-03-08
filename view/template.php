<!DOCTYPE html>

<html lang="fr">

	<head>

		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Récapitulatif de cours en développement">
		<meta name="keywords" content="">

		<title>Giltg</title>
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style/style.css">

	</head>

	<body>

		<header>

			<nav id="nav_header">

				<div>
				<!--
				<input id="zone_recherche" type="text" name="recherche" placeholder="Chercher" autofocus>
				<button id="btn_recherche" type="submit"><img src="<?php //echo MYSITE_PATH; ?>img/icons/loupe.png" alt="Bouton loupe" title="Lancez la recherche"></button>
				-->
					<a class="ws-nowrap" href="<?= ROOT_DIR ?>ctrl/autres_liens.ctrl.php">Autres sites</a>
				</div>

				<ul>

					<li><a href="<?= ROOT_DIR ?>index.php">Accueil</a></li>

					<li><a href="<?= ROOT_DIR ?>ctrl/vietnam.ctrl.php">Vietnam</a></li>

					<?php if (isset($_SESSION['nomUser']))	: ?>
						<li><a href="<?= ROOT_DIR ?>ctrl/user/warhammer.ctrl.php">Warhammer JDRF</a></li>
						<li><a href="<?= ROOT_DIR ?>ctrl/deconnexion.php">Déconnexion</a></li>
					<?php else : ?>
						<li><a href="<?= ROOT_DIR ?>ctrl/connexion.ctrl.php">Connexion</a></li>
					<?php endif; ?>

				</ul>

			</nav>

			<div>

				<figure>
					<?php if (isset($_SESSION['nomUser']) AND $_SESSION['nomUser'] == 'gilleste') : ?>
						<a href="<?= ROOT_DIR ?>ctrl/admin/accueil-admin.ctrl.php"><img src="<?= __DIR__ ?>/../imgs/logo.png" alt="Logo"></a>
					<?php else : ?>
						<img src="<?= ROOT_DIR ?>imgs/thumbmails/logo.png" alt="Logo">
					<?php endif; ?>
				</figure>

				<div>
					<h1>GILTG</h1>
				</div>

			</div>

		</header>

		<main>

            <?php if (isset($navSide)) { echo $navSide; } ?>

            <?= $section ?>

            <?php if (isset($supportAside) || isset($codeAside) || isset($siteExtAside)) : ?>
			    <div id="asides">

                    <?php if (isset($supportAside)) { echo $supportAside; } ?>
                    <?php if (isset($codeAside)) { echo $codeAside; } ?>
                    <?php if (isset($siteExtAside)) { echo $siteExtAside; } ?>

			    </div>
            <?php endif; ?>

		</main>

		<footer>

			<div>
				<p><a href="<?= ROOT_DIR ?>ctrl/contact.ctrl.php">Contact</a></p>
			</div>

			<div>
				<p>© Copyright 2019 - <strong><a href="#">Giltg.fr</a></strong> - <span class="ws-nowrap">Tous droits réservés</span></p>
			</div>

			<div>

			</div>

		</footer>

		<!-- Chargement du JavaScript Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<!-- Chargement d'autres JavaScript -->
        <script src="<?= ROOT_DIR ?>script/.js"></script>

	</body>

</html>