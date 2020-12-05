<?php require_once('views/include/header.php') ?>

<div class="form-connexion-container center-x center-y">
    <form class="connexion-form space-around column" method='POST' action="<?= SCRIPT_NAME ?>/bank.php/connexion/validation">
        <?php if ($error === 1):?>
            <div class="center-x center-y">
                <h2 class="error-msg">Username or Password incorrect</h2>
            </div>
        <?php endif ?>
        <div class="center-x center-y">
            <input type="text" placeholder="Username" class="form-btn" name="username" required>
        </div>
        <div class="center-x center-y">
            <div>
                <input type="password" placeholder="Password" class="form-btn" name="password" id="password" required>
                <label style="font: normal normal normal 40px/1 FontAwesome;" id="showPassword">&#xf06e;</label>
            </div>
        </div>

        <div class="space-around center-y">
            <div>
                <input type="checkbox" name="stayConnected" id="stayConnected">
                <label for="stayConnected">Rester connecté</label>
            </div>
            <button type="submit" class="submit-btn">Se connecter</button>
        </div>
    </form>
</div>

<script>
    const password = document.querySelector('#password');
    const showPassword = document.querySelector('#showPassword');

    showPassword.addEventListener('click', () => {
        password.type = (password.type === 'password') ? 'text' : 'password';
    });
</script>

