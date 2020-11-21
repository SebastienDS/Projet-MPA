<?php require_once('views/include/header.php') ?>

<div class="bandeau flex-end center-y">
    <form action="<?= SCRIPT_NAME ?>/bank.php/admin">
        <input type="text" placeholder="Recherche">
        <button type="submit">Rechercher</button>
    </form>
</div>

<div class="bg-white">
    <div class="center-x center-y p-15">
        <a href="<?= SCRIPT_NAME ?>/bank.php/admin/ajoutCompte" class="btn">Ajouter un compte</a>
    </div>

    <?php foreach ($comptes as $i => $compte): ?>
        <div>
            <div class="space-between compteItem center-y">
                <div class="column">
                    <div>
                        <?= $compte->nom ?> <?= $compte->prenom ?>
                    </div>
                    <div>
                        Numéro de SIREN
                    </div>
                </div>

                <img src="<?= SCRIPT_NAME ?>/public/img/trash.png" alt="delete button" height="50" id="deleteBtn" key="<?= $i ?>">
            </div>
        </div>
    <?php endforeach ?>

</div>




<div id="modal" class="modal">

    <div class="modal-content column space-around center-y">
        <p>
            Avez-vous l'accord du Product Owner ? <br>
            (Cette action est définitif et irréversible)
        </p>

        <div class="space-around w-70">
            <form>
                <button type="submit" class="btn-success" id="submitBtn">Oui</button>
            </form>
            <button class="btn-failure" id="closeBtn">Non</button>
        </div>
    </div>

</div>

<script>
    const modal = document.getElementById("modal");
    const deleteBtns = document.querySelectorAll("#deleteBtn");
    const closeBtn = document.getElementById("closeBtn");
    const submitBtn = document.getElementById("submitBtn");
    let selected = null;

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.style.display = 'block';
            selected = btn.getAttribute('key');
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    submitBtn.addEventListener('click', () => {
        fetch(`<?= SCRIPT_NAME ?>/bank.php/admin/deleteCompte/${selected}`, { method: 'POST' });
    })
</script>