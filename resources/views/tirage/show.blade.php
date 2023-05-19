<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List of Participants</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">

        <div class="jumbotron text-center">
            <h1>Prize won!</h1>
            <h2 class="text-success">
                Félicitations {{ $tirage->name }}!

                Vous avez gagné :
                @if ($tirage->prize == 'tesla')
                    "Voiture Tesla"<br>
                @elseif($tirage == 'weekend_montagne')
                    "Un voyage sur la montagne"<br>
                @elseif($tirage == 'ps5')
                    "Une Console Playstation 5"<br>
                @elseif($tirage == 'pc_gamer')
                    "Un PC Gamer"<br>
                @else
                    "Un Jeu des cartes"<br>
                @endif
            </h2>
            <a class="btn btn-primary" href="{{ route('tirage.create') }}">Retour</a>
            </p>
        </div>
    </div>
</body>

</html>
