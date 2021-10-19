<?php 

$hotels = [
    "Disney's Hotel New York - The Art of Marvel",
    "Disney's Newport Bay Club",
    "Disney's Sequoia Lodge",
    "Disney's Hotel Cheyenne",
    "Disney's Hotel Santa Fe",
    "Villages Nature® Paris by Center Parcs",
    "Disney's Davy Crockett Ranch",
    "Dream Castle Fabulous Hotels Group",
    "Magic Circus Fabulous Hotels Group",
    "Radisson Blu Hotel Paris, Marne-la-Vallée",
    "Adagio Marne-la-Vallée Val d'Europe",
    "Explorers Fabulous Hotels Group",
    "Campanile Val de France",
    "Hôtel l’Elysée Val d’Europe",
    "B&B Hôtel",
];?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation en ligne</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <h1>Réservation en ligne</h1>
    <div class="container">
        <form action="validation.php" id="reservationForm">
            <div class="form-input">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-input">
                <label for="name">Prénom</label>
                <input type="text" class="form-control" name="name" id="firstname">
            </div>
            <div class="input-group">
                <div class="label">
                    <span>Dates</span>  
                </div>
                <div>
                    <input type="date" class="form-control" name="name" id="firstname" placeholder="Arrivée">
                </div>
                <div>
                    <input type="date" class="form-control" name="name" id="firstname" placeholder="Arrivée">
                </div>
            </div>
            <div class="form-input">
                <label for="name">Hôtel</label>
                <select name="hotel" id="hotel">
                    <?php foreach($hotels as $key => $hotel):?>
                        <option value="<?= $hotel;?>"><?= $hotel;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-input">
                <label for="name">Nombre d'adultes</label>
                <select name="adult_nb" id="adult_nb">
                    <?php for($i = 0; $i < 7; $i++) :?>
                        <option value="<?= $i;?>"><?= $i;?></option>
                    <?php endfor;?>
                </select>
            </div>
            <div class="form-input">
                <label for="child_nb">Nombre d'enfants</label>
                <select name="child_nb" id="child_nb">
                    <?php for($i = 0; $i < 11; $i++) :?>
                        <option value="<?= $i;?>"><?= $i;?></option>
                    <?php endfor;?>
                </select>
            </div>
            <div class="switch">
                <div class="label">
                    <span>Petit-dejeuner</span>
                </div>
                <input type="checkbox" name="switch" id="switch">
                <label for="switch"></label>
            </div>
            <div class="form-input">
                <label for="arrival_time">Heure d'arrivée prévue</label>
                <input type="time" class="form-control" name="arrival_time" id="arrival_time">
            </div>
            <div class="form-input">
                <label for="comment">Commentaire</label>
                <textarea name="comment" id="comment" rows="5"></textarea>
            </div>
            <div class="form-submit">
                <input type="submit" value="Demande de réservation">
            </div>
        </form>
    </div>
    <script src="js/app.js"></script>
</body>
</html>

