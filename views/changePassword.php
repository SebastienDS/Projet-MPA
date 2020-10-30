<?php require_once('views/include/header.php') ?>

<div class="form-connexion-container center-x center-y">
    <form class="connexion-form space-around column" method='POST' action="<?= SCRIPT_NAME ?>/bank.php/password/validation">
        <?php if ($error):?>
            <div class="center-x center-y">
                <?php if ($error === 1): ?>
                    <h2 class="error-msg">Le nouveau mot de passe ne correspond pas à la confirmation</h2>
                <?php elseif ($error === 2): ?>
                    <h2 class="error-msg">Le nouveau mot de passe doit etre different de l'ancien</h2>
                <?php elseif ($error === 3): ?>
                    <h2 class="error-msg">L'ancien mot de passe est incorrect</h2>
                <?php endif ?>
            </div>
        <?php endif ?>
        <div class="center-x center-y">
            <input type="password" placeholder="Ancien Mot de Passe" class="form-btn" name="lastPassword" required>
        </div>
        <div class="center-x center-y">
            <input type="password" placeholder="Nouveau Mot de Passe" class="form-btn" name="newPassword" required>
        </div>
        <div class="center-x center-y">
            <input type="password" placeholder="Confirmer Mot de Passe" class="form-btn" name="newPasswordConfirm" required>
        </div>

        <div class="center-x center-y">
            <button type="submit" class="submit-btn">Confirmer</button>
        </div>
    </form>
</div>
