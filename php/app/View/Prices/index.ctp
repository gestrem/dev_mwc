</br>
<?php echo $this->Form->create(); ?>
<label>Origine</label>
<select name="data[selectedOrigine]">
    <option value="0" >Choisissez une origine</option>
    <?php foreach ($origines as $origine) {
        echo "<option value='".$origine['Origine']['id']."'>".$origine['Origine']['label']."</option>" ;
    }
    ?>
</select>
</br>
<label>Cepage</label>
<select name="data[selectedCepage]">
    <option value="0" >Choisissez un cepage</option>
    <?php foreach ($cepages as $cepage) {
        echo "<option value='".$cepage['Cepage']['id']."'>".$cepage['Cepage']['label']."</option>" ;
    }
    ?>
</select>
<?php echo $this->Form->end('Rechercher'); ?>

<?php echo $this->Form->create('prices', array('action' => 'savePrices')); ?>

<table>
    <tr>
        <td>Origine</td>
        <td>Cepage</td>
        <td>Pris bas</td>
        <td>Prix haut</td>
        <td>Appreciation</td>
    </tr>

<?php $i=0;?>

<?php foreach($vins as $vin) {
    echo "<tr>";
    echo "<input type='hidden' name='data[vins][".$i."][Vin][id]'value=" . $vin['Vin']['id'] . "></input>";
    echo "<input type='hidden' name='data[vins][".$i."][Vin][Price][devise]'value=" . $vin['Origine']['devise'] . "></input>";
    echo "<td>" . $vin['Origine']['label'] . "</td>";
    echo "<td>" . $vin['Cepage']['label'] . "</td>";
    echo "<td>";
    echo "<input name='data[vins][".$i."][Vin][Price][down]'value=" . $vin['Price']['down'] . "></input>".$vin['Origine']['devise'];
    echo "</td>";
    echo "<td>";
    echo "<input name='data[vins][".$i."][Vin][Price][up]'value=" . $vin['Price']['up'] . "></input>".$vin['Origine']['devise'];
    echo "</td>";?>

    <td>
        <select name="data[vins][<?php echo $i;?>][Vin][Price][appreciation]">
            <option value="-1"<?php if($vin['Price']['appreciation']==-1) {echo "selected";}?>>buyers Market</option>
            <option value="0"<?php if($vin['Price']['appreciation']==0) {echo "selected";} ?>>normal Market</option>
            <option value="1"<?php if($vin['Price']['appreciation']==1) {echo "selected";} ?>>sellers Market</option>
        </select>
    </td>
    </tr>
<?php $i++;}?>

</table>

<?php echo $this->Form->end('Sauvegarder'); ?>

<?php echo $this->Form->create('prices', array('action' => 'addvin')); ?>
<label>Origine</label>
<select name="data[Vin][origine_id]">
    <option value="0" >Choisissez une origine</option>
    <?php foreach ($origines as $origine) {
        echo "<option value='".$origine['Origine']['id']."'>".$origine['Origine']['label']."</option>" ;
    }
    ?>
</select>
<label>Cepage</label>
<select name="data[Vin][cepage_id]">
    <option value="0" >Choisissez un cepage</option>
    <?php foreach ($cepages as $cepage) {
        echo "<option value='".$cepage['Cepage']['id']."'>".$cepage['Cepage']['label']."</option>" ;
    }
    ?>
</select>
<?php echo $this->Form->end('Sauvegarder'); ?>