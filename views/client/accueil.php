<?php require_once('views/include/header.php') ?>

<?php if ($success): ?>
    <div class="success center-x center-y">
        <?php if ($success === 1): ?>
            <h2>Connexion reussie</h2>
        <?php elseif ($success === 2): ?>
            <h2>Changement de mot de passe reussie</h2>
        <?php endif ?>
    </div>
<?php endif ?>
