<?php require_once('include/headerAccueil.php') ?>

<div class="form-connexion-container center">
    <form class="connexion-form space-around column" method='POST' action='connexionValidation'>
        <div class="center">
            <input type="text" placeholder="Username" class="form-btn" name="username">
        </div>
        <div class="center">
            <input type="password" placeholder="Password" class="form-btn" name="password">
        </div>

        <div class="space-around">
            <div class="center">
                <input type="checkbox" name="stayConnected" id="stayConnected">
                <label for="stayConnected">Rester connecté</label>
            </div>
            <button type="submit" class="submit-btn">Se connecter</button>
        </div>
    </form>
</div>