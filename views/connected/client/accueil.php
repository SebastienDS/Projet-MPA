<?php require_once('views/include/headerClient.php'); ?>
<?php if ($success): ?>
    <div class="success center">
        <?php if ($success === 1): ?>
            <h2>Connexion reussie</h2>
        <?php elseif ($success === 2): ?>
            <h2>Changement de mot de passe reussie</h2>
        <?php endif ?>
    </div>
<?php endif ?>
