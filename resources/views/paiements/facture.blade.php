<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture de Paiement</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4CAF50;
        }

        .facture-details {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .facture-details p {
            margin: 10px 0;
            font-size: 1.1em;
        }

        .facture-details .label {
            font-weight: bold;
        }

        .total-amount {
            font-size: 1.3em;
            color: #4CAF50;
            font-weight: bold;
        }

        .facture-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Facture de Paiement</h2>
        <div class="facture-details">
            <p><span class="label">Client :</span> {{ $paiement->client->name }}</p>
            <p><span class="label">Email :</span> {{ $emailClient }}</p>
            <p><span class="label">Adresse :</span> {{ $adresseClient }}</p>
            <p><span class="label">Produit :</span> {{ $produit->name }}</p>
            <p><span class="label">Quantité :</span> {{ $quantite }}</p>
            <p><span class="label">Prix Unitaire :</span> {{ number_format($prixUnitaire, 2) }}
                {{ $devise == 'Ariary' ? 'Ar' : ($devise == 'Euro' ? '€' : ($devise == 'Dollars' ? '$' : $devise)) }}
            </p>
            <p><span class="label">Total :</span> {{ number_format($totalPaiement, 2) }}
                {{ $devise == 'Ariary' ? 'Ar' : ($devise == 'Euro' ? '€' : ($devise == 'Dollars' ? '$' : $devise)) }}
            </p>
            <p><span class="label">Date :</span> {{ \Carbon\Carbon::parse($paiement->datePaiement)->format('d/m/Y') }}
            </p>
            <p><span class="label">Status :</span> {{ ucfirst($paiement->statusPaiement) }}</p>
        </div>

        <div class="total-amount">
            <p>Total à payer : {{ number_format($totalPaiement, 2) }}
                {{ $devise == 'Ariary' ? 'Ar' : ($devise == 'Euro' ? '€' : ($devise == 'Dollars' ? '$' : $devise)) }}
            </p>
        </div>

        <div class="facture-footer">
            <p>Merci de votre achat !</p>
            <p>Si vous avez des questions, n'hésitez pas à nous contacter.
                <br><br>
                <p>
                    Email:tsimanaryalliance@gmail.com
                    <br><br>
                    Numéro:+261344510268
                </p>

            </p>
        </div>
    </div>
</body>

</html>
