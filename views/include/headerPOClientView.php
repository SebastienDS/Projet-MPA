<div class="header">
    <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner">
        <img src="<?= SCRIPT_NAME ?>/public/img/logo.png" width="200" height="200">
    </a>

    <div class="max-height grow">
        <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>" class="headerBtn center-x center-y">
            Comptes
        </a>
        <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/impayes" class="headerBtn center-x center-y">
            Impayés
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
