<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Facture</title>

<style>

body{
    font-family: DejaVu Sans;
    margin:40px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table, th, td{
    border:1px solid #000;
}

th, td{
    padding:10px;
}

h1{
    text-align:center;
}

</style>

</head>

<body>

<h1>FACTURE</h1>

<p>
<strong>N° Facture :</strong>
{{ $facture->numero_facture }}
</p>

<p>
<strong>Date :</strong>
{{ $facture->date_facture }}
</p>

<p>
<strong>Client :</strong>
{{ optional(optional($facture->reservation)->client)->nom }}
</p>

<p>
<strong>Chambre :</strong>
{{ optional(optional($facture->reservation)->chambre)->numero }}
</p>

<table>

<tr>
    <th>Description</th>
    <th>Valeur</th>
</tr>

<tr>
    <td>Nombre de nuits</td>
    <td>{{ $facture->nombre_nuits }}</td>
</tr>

<tr>
    <td>TVA</td>
    <td>{{ $facture->tva }} FCFA</td>
</tr>

<tr>
    <td>Montant total</td>
    <td>
        {{ number_format($facture->montant_total,0,',',' ') }}
        FCFA
    </td>
</tr>

</table>

<br>

<p>
<strong>Statut :</strong>
{{ $facture->statut }}
</p>

</body>
</html