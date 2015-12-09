<table>
    <tr>
        <td>Label </td>
        <td>Devise </td>
    </tr>

    <?php
    foreach ($origines as $origine){
        echo "<tr><td>".$origine['Origine']['label']."</td>";
        echo "<td>";
        echo $origine['Origine']['devise']."</td>";
        echo "<td>";
        echo "<a href='origine/edit/".$origine['Origine']['id']."''>";
        echo "<button>Modifier</button></a>";
        echo "<a href='origine/".$origine['Origine']['id']."/delete'>";
        echo "<button>Supprimer</button></a>";
        echo "</td></tr>";
    }
    ?>
</table>
<a href='origine/add'><button>Ajouter une Origine</button></a>