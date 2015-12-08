<table>
    <tr>
        <td>Nom </td>
        <td>Prenom</td>
        <td>Login</td>
        <td>Société</td>
        <td>Pays</td>
        <td>Actions</td>
    </tr>

<?php
foreach ($clients as $client){
    echo "<tr><td>".$client['Client']['nom']."</td><td>".$client['Client']['prenom']."</td><td>".$client['Client']['login']."</td><td>".$client['Client']['societe']."</td><td>".$client['Client']['pays']."</td>";
    echo "<td>";
    if($client['Client']['etat']==0) {
        echo "<a href='client/".$client['Client']['id']."/disable'>";
        echo "<button>Reactiver</button></a>";
    } else {
        echo "<a href='client/".$client['Client']['id']."/disable'>";
        echo "<button>Desactiver</button></a>";
    }
    echo "<a href='client/edit/".$client['Client']['id']."''>";
    echo "<button>Modifier</button></a>";
    echo "<a href='client/".$client['Client']['id']."/delete'>";
    echo "<button>Supprimer</button></a>";
    echo "</td></tr>";
}
?>
</table>
<a href='client/add'><button>Ajouter un client</button></a>