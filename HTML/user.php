<?php
include ('./server/db_infos.php');
include ('./server/db.php');
include ('./server/users.php');
include ('./server/verif.php');



// Instance de la classe Database et obtenir la connexion
$db = new Database();
$connect = $db->get_connexion();

// Instance de la classe User en passant la connexion
$user = new User($connect);
$user->email_user = $_SESSION['user_email'];
$user->getnbTache();
$resultats = $user->appercuTaches();
$taches = $user->afficherTaches();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateur</title>
    <link rel="stylesheet" href="../CSS/user.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">



</head>

<body>
    <main>
        <aside id="menu" class="menu" style="">
            <div class="log"> <img src="../images/mise-en-forme/icone_GESTACHE.png" alt=""><i id="bar_gauche"
                    class="las la-bars"></i>
            </div>
            <nav>
                <h4>Informations</h4>
                <ul class="liste-information">
                    <li>Nombre de tâches <span
                            class="nbr-proj"><?php echo isset($_SESSION['nbre_tache']) ? $_SESSION['nbre_tache'] : 'null' ?></span>
                    </li>
                </ul>
                <h4>Dashboard</h4>
                <ul class="liste-prj">
                    <li style="background-color:#44bba4" class="lien-accueil"><a href="#accueil"
                            class="lien">Accueil</a><i class="las la-home"></i></li>
                    <li style="" class="lien-taches"><a href="#taches" class="lien">Tâches</a><i
                            class="las la-pencil-alt"></i></li>
                </ul>
                <a class="deconnexion" href="./request/deconnexion-request.php">Déconnexion <i
                        class="las la-sign-out-alt"></i></a>
            </nav>
            <p class="cpr citation"><i class="las la-copyright"></i>2024 GesTâches - Tous droits réservés</p>
        </aside>
        <section id="principale" class="principale">
            <header>
                <div id="log">
                    <i id="bar_droite" class="las la-bars"></i>
                </div>
                <h2 id="champsCourant">ACCUEIL</h2>
                <figure>
                    <img src="<?php echo isset($_SESSION['photo_user']) ? $_SESSION['photo_user'] : '../images/mise-en-forme/img-2.jpg'; ?>"
                        alt="votre photo">
                    <figcaption>
                        <?php echo isset($_SESSION['nom_user']) ? $_SESSION['nom_user'] : 'Votre nom'; ?>
                    </figcaption>
                </figure>
            </header>

            <section id="accueil" style="">
                <article class="acc-1">
                    <img src="../images/mise-en-forme/img-2.jpg" alt="quelqu'un qui liste ses tâches">
                    <div class="text">
                        <h2>Pêt à conquerir votre journée ?</h2>
                        <p>Chaque tâche accomplie est un pas de plus en plus vers vos objectifs. <br>
                            Organisez, priorisez et réalisez avec efficacité. Bonne gestion !
                        </p>
                    </div>
                </article>

                <!-- Apperçu tâches -->
                </article>
                <h1>Apperçu des Tâches</h1>
                <article class="acc-2">
                    <div class="prj-container">
                        <?php
                        if (!isset($resultats)) {
                            echo "<p style='font-size:14px'> Oups...Aucune tâche enregistrée " . "<a href='ajouter.php' style='text-decoration:none; color:#44bba4'>clicker ici pour jouter une nouvelle tâche ?<p>";
                        } else { ?>
                            <?php foreach ($resultats as $resultat) { ?>
                                <div class="prj-elem">
                                    <?php echo $resultat['description_tache'] ?>

                                    <div class="prj-info">
                                        <h4 class="<?php ?>"><?php echo $resultat['nom_tache'] ?></h4>
                                        <h4><?php echo $resultat['date_tache'] ?></h4>
                                        <h4><?php echo $resultat['heure_tache'] ?></h4>
                                        <h4><?php echo $resultat['statut_tache'] == 0 ? 'non-terminé' : 'terminé' ?></h4>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } ?>
                    </div>

                </article>
            </section>

            <!-- Partie Tâches -->

            <section id="tache" style="display:none">
                <div class="projet-text">
                    <figure>
                        <figcaption>Ici, vous pouvez consulter toutes vos tâches en cours, en attente, et terminées.
                            Gardez un œil sur vos progrès et restez organisé pour atteindre vos objectifs. Bonne
                            gestion et bonne journée !
                            <span class="logo">...!!!</span>
                        </figcaption>

                        <img src="../images/mise-en-forme/img-3.jpg" alt="">
                    </figure>
                </div>
                <!-- <div id="projet-search">
                    <label for="search">faire une recherche</label>
                    <div class="input-elem">
                        <input type="text" name="search" id="search" placeholder="exemple: monProjet1">
                        <i class="las la-search"></i>
                    </div>
                </div>
                <p>ou</p>
                <div id="projet-filter">
                    <p>Filtrer par </p>
                    <div class="projet-filter-choice">
                        <input type="radio" name="en-cours" id="en-cours">
                        <label for="en-cours">en attente</label>
                        <input type="radio" name="termine" id="termine">
                        <label for="termine">terminée</label>
                    </div>
                    <i class="las la-list-ul"></i>

                </div> -->
                <h1>Mes tâches <a href="ajouter.php"><i class="las la-plus-circle"></i></a></h1>
                <article class="prj-1">

                    <?php
                    if ((!isset($taches))) { ?>
                        <tr>
                            <?php echo "<p style='font-size:14px'> Oups...Aucune tâche enregistrée. Cliquer sur + pour ajouter une nouvelle tâche <p>"; ?>
                        </tr>
                    <?php } else { ?>
                        <table class="box-shadow">
                            <thead>
                                <tr>
                                    <th class="nom">Noms</th>
                                    <th class="desc">Descriptions</th>
                                    <th class="date">Dates</th>
                                    <th class="date">heures</th>
                                    <th class="etat">Statuts</th>
                                    <th class="etat">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($taches as $tache) { ?>
                                    <tr class="edit">
                                        <td class="nom"><?php echo isset($tache['nom_tache']) ? $tache['nom_tache'] : 'nom' ?>
                                        </td>
                                        <td class="desc">
                                            <?php echo isset($tache['description_tache']) ? $tache['description_tache'] : 'description' ?>
                                        </td>
                                        <td class="date">
                                            <?php echo isset($tache['date_tache']) ? $tache['date_tache'] : 'date ' ?>
                                        </td>
                                        <td class="date">
                                            <?php echo isset($tache['heure_tache']) ? $tache['heure_tache'] : 'heure ' ?>
                                        </td>
                                        <td class="etat">
                                            <?php echo $tache['statut_tache'] == 0 ? 'non-terminé' : 'terminé' ?>
                                        </td>
                                        <td class="etat">
                                            <a href="./modifier-user.php ? id=<?php echo $tache['nom_tache'] ?>"><i
                                                    class="las la-edit"></i></a>
                                            <a href="./request/supp-tache-request.php ? id=<?php echo $tache['nom_tache'] ?>"><i
                                                    class="las la-trash edit-icon"></i></a>
                                        </td>
                                    </tr>

                                <?php }
                    } ?>

                        </tbody>

                    </table>
                    <!-- <i class="las la-print" style="font-size:2rem; cursor:pointer ;"></i> -->
                </article>

            </section>
        </section>
    </main>

    <script src="../JS/user-nav.js" defer></script>

    <script src="../JS/user.js" defer></script>
    <script src="../JS/modif-tache.js" defer></script>


</body>

</html>