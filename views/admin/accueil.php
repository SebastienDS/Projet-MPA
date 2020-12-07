<?php require_once('views/include/header.php') ?>

<div class="bandeau flex-end center-y">
    <form>
        <input type="text" placeholder="Recherche" name="search">
        <button type="submit">Rechercher</button>
    </form>
</div>

<div class="bg-white">
    <div class="center-x center-y p-15">
        <a href="<?= SCRIPT_NAME ?>/bank.php/admin/ajoutProfil" class="btn">Ajouter un profil</a>
    </div>

    <?php foreach ($comptes as $compte): ?>
        <a href="<?= SCRIPT_NAME ?>/bank.php/admin/updateProfil/<?= $compte->id ?>">
            <div class="space-between compteItem center-y">
                <div>
                    <?= $compte->nom ?> <?= $compte->prenom ?>
                </div>

                <form id="deleteForm">
                    <img src="<?= SCRIPT_NAME ?>/public/img/trash.png" alt="delete button" height="50">
                    <input type="hidden" name="id" value="<?= $compte->id ?>">
                </form>
            </div>
        </a>
    <?php endforeach ?>
</div>




<div id="modal" class="modal">

    <div class="modal-content column space-around center-y">
        <p>
            Avez-vous l'accord du Product Owner ? <br>
            (Cette action est définitive et irréversible)
        </p>

        <div class="space-around w-70">
            <form id="submitBtn" action="<?= SCRIPT_NAME ?>/bank.php/admin/deleteProfil/" method="POST">
                <button type="submit" class="btn-success">Oui</button>
            </form>
            <button class="btn-failure" id="closeBtn">Non</button>
        </div>
    </div>

</div>

<script>
    const modal = document.getElementById("modal");
    const closeBtn = document.getElementById("closeBtn");
    const submitBtn = document.getElementById("submitBtn");
    const deleteForms = document.querySelectorAll("#deleteForm");
    let selected = null;

    deleteForms.forEach(btn => {
        btn.addEventListener('click', (e) => {
            modal.style.display = 'block';
            selected = btn.querySelector('input').value;
            e.preventDefault();
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    submitBtn.addEventListener('click', () => {
        submitBtn.action += selected;
    })
</script>