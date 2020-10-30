<?php require_once('views/include/header.php') ?>

<div class="bandeau center-y">
    Nouveau Client
</div>

<form class="formAjoutClient bg-white" name="inputForm">

    <div class="rowFormAjout">
        <div class="formInput">
            <div>N° SIREN</div>
            <div class="flex-end">
                <input type="text" placeholder="N° SIREN" id="siren" required>
            </div>
        </div>

        <div class="formInput">
            <div>Prénom</div>
            <div class="flex-end">
                <input type="text" placeholder="Prénom" id="prenom" required>
            </div>
        </div>
    </div>

    <div class="rowFormAjout">
        <div class="formInput">
            <div>Nom</div>
            <div class="flex-end">
                <input type="text" placeholder="Nom" id="nom" required>
            </div>
        </div>

        <div class="formInput">
            <div>Mot de passe</div>
            <div class="flex-end">
                <input type="password" placeholder="Mot de passe" id="password" required>
            </div>
        </div>
    </div>
</form>

<div class="footer-fixed flex-end center-y">

    <div class="DL-btns space-around">
        <a href="<?= SCRIPT_NAME ?>/bank.php/admin" class="btn">Annuler</a>
       
        <form method="POST" name="submitForm">
            <button class="btn" id="submitBtn">Confirmer</button>

            <input type="hidden" name="siren">
            <input type="hidden" name="prenom">
            <input type="hidden" name="nom">
            <input type="hidden" name="password">
        </form>
    </div>
</div>

<script>
    const submitBtn = document.querySelector('#submitBtn')
    const siren = document.querySelector('#siren');
    const prenom = document.querySelector('#prenom');
    const nom = document.querySelector('#nom');
    const password = document.querySelector('#password');


    submitBtn.addEventListener('click', (e) => {
        if (siren.value === '' || prenom.value === '' || nom.value === '' || password.value === '') {
            e.preventDefault();
        }
        document.forms.submitForm.siren.value = siren.value;
        document.forms.submitForm.prenom.value = prenom.value;
        document.forms.submitForm.nom.value = nom.value;
        document.forms.submitForm.password.value = password.value;
    })
</script>