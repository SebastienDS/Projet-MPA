<div class="header">
    <a href='/bank.php/client'>
        <img src="<?= SCRIPT_NAME ?>/public/img/logo.png" width="200" height="200">
    </a>

    <div class="max-height grow">
        <div class="headerBtn center">
            Mes Comptes
        </div>
        <div class="headerBtn center">
            Mes Impayés
        </div>
    </div>

    <div>
        <ul id="menu-deroulant">
            <li>
                <a href='/bank.php/client/showInfo'>
                    <img src="<?= SCRIPT_NAME ?>/public/img/logo.png" width="200" height="200">
                </a>
                <ul>
                    <li><a href="/bank.php/client/changePassword">Changer de Mot de Passe</a></li>
                    <li><a href="/bank.php/client/logout">Se déconnecter</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>