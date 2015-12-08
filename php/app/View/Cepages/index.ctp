<table>
    <tr>
        <td>Label </td>
    </tr>

    <?php
    foreach ($cepages as $cepage){
        echo "<tr><td>".$cepage['Cepage']['label']."</td>";
        echo "<td>";
        echo "<a href='cepage/edit/".$cepage['Cepage']['id']."''>";
        echo "<button>Modifier</button></a>";
        echo "<a href='cepage/".$cepage['Cepage']['id']."/delete'>";
        echo "<button>Supprimer</button></a>";
        echo "</td></tr>";
    }
    ?>
</table>
<a href='cepage/add'><button>Ajouter un Cepage</button></a>