<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/accueil.css">
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
    <?php require_once('include/headerAccueil.php') ?>

    <div class="form-connexion-container center">
        <form class="connexion-form space-around column">
            <div class="center">
                <input type="text" placeholder="Username" class="form-btn" name="username">
            </div>
            <div class="center">
                <input type="text" placeholder="Password" class="form-btn" name="password">
            </div>

            <div>
                <input type="checkbox" name="stayConnected" id="stayConnected">
                <label for="stayConnected">Rester connecté</label>
            </div>
            <div class="">
                <button type="submit" class="submit-btn">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>