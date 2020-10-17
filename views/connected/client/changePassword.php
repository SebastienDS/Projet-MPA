<?php require_once('views/include/headerClient.php'); ?>

<div class="form-connexion-container center">
    <form class="connexion-form space-around column" method='POST' action="<?= SCRIPT_NAME ?>/bank.php/client/password/validation">
        <?php if ($error):?>
            <div class="center">
                <?php if ($error === 1): ?>
                    <h2 class="error-msg">Le nouveau mot de passe ne correspond pas à la confirmation</h2>
                <?php elseif ($error === 2): ?>
                    <h2 class="error-msg">Le nouveau mot de passe doit etre different de l'ancien</h2>
                <?php elseif ($error === 3): ?>
                    <h2 class="error-msg">L'ancien mot de passe est incorrect</h2>
                <?php endif ?>
            </div>
        <?php endif ?>
        <div class="center">
            <input type="password" placeholder="Ancien Mot de Passe" class="form-btn" name="lastPassword">
        </div>
        <div class="center">
            <input type="password" placeholder="Nouveau Mot de Passe" class="form-btn" name="newPassword">
        </div>
        <div class="center">
            <input type="password" placeholder="Confirmer Mot de Passe" class="form-btn" name="newPasswordConfirm">
        </div>

        <div class="center">
            <button type="submit" class="submit-btn">Confirmer</button>
        </div>
    </form>
</div>
