<aside id="code_aside">

    <h2>Code</h2>

    <ul>

        <?php foreach ($links['code'] as $link) : ?>
            <li><a href="<?= $link->getAdrOrFile() ?>"><?= $link->getLabel() ?></a></li>
        <?php endforeach; ?>

    </ul>

</aside>