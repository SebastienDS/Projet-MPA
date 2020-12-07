<div class="header">
    <a href="<?= SCRIPT_NAME ?>/bank.php/client">
        <img src="<?= SCRIPT_NAME ?>/public/img/logo.png" width="200" height="200">
    </a>

    <div class="max-height grow">
        <a href="<?= SCRIPT_NAME ?>/bank.php/client/mesComptes" class="headerBtn center-x center-y">
            Mes Comptes
        </a>
        <a href="<?= SCRIPT_NAME ?>/bank.php/client/tresorerie" class="headerBtn center-x center-y">
            Trésorerie
        </a>
        <a href="<?= SCRIPT_NAME ?>/bank.php/client/mesImpayes" class="headerBtn center-x center-y">
            Mes Impayés
        </a>
    </div>

    <div>
        <ul id="menu-deroulant">
            <li>
                <a href="<?= SCRIPT_NAME ?>/bank.php/showInfo">
                    <img src="<?= SCRIPT_NAME ?>/public/img/profil.png" width="200" height="200">
                </a>
                <ul>
                    <li><a href="<?= SCRIPT_NAME ?>/bank.php/changePassword">Changer de Mot de Passe</a></li>
                    <li><a href="<?= SCRIPT_NAME ?>/bank.php/logout">Se déconnecter</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
