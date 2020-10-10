<?php require_once('views/include/headerClient.php'); ?>

<div class="form-connexion-container center">
    <form class="connexion-form space-around column" method='POST' action='passwordValidation'>
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
