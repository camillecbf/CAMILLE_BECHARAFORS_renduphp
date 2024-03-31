<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Twitter</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Explorer</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Profil</a></li>
            </ul>
        </nav>
        <section class="feed">
            <?php if(!empty($user)): ?>
                <h3>Je suis <?= $user ?></h3>
            <?php endif; ?>
            <form id="tweetForm" action="action.php" method="POST">
                <?php if(!empty($user)): ?>
                    <input type="hidden" name="user" value="<?= $user ?>">
                <?php endif; ?>
                <textarea placeholder="Que voulez-vous raconter aujourd'hui ?" name="message"></textarea>
                <button type="submit">Tweeter</button>
            </form>
            
            <div class="tweets">
                <!-- Les tweets seront ajoutés ici -->

                <?php foreach ($tweets as $tweet) : ?>
                <div class="tweet">
                    <h1> <?=  $tweet['pseudo'] ?></h1>
                    <h3> <?=  $tweet['message'] ?></h3>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="delete" value="<?= $tweet['message'] ?>">
                        <button id="delbut" type="submit">SUPPRIMER</button>
                    </form>
                </div>
                <?php endforeach; ?>
        
            </div>
        </section>
    </div>
</body>
</html>
