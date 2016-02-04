<script type="text/javascript" src="/js/angular.js"></script>

<script type="text/javascript" src="/js/search.js"></script>



<div ng-app="app">
    <div ng-controller="searchCtrl">


<?php echo $this->Form->create(); ?>
<label>Origine</label>
<select name="data[selectedOrigine]" ng-model="origine">
    <option value="0">Choisissez une origine</option>
    <?php foreach ($origines as $origine) {
        echo "<option value='".$origine['Origine']['id']."'>".$origine['Origine']['label']."</option>" ;
    }
    ?>
</select>
</br>
<label>Cepage</label>
<select name="data[selectedCepage]" ng-model="cepage">
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
        <td>Commentaire</td>
        <td>Appreciation</td>
    </tr>

<?php $i=0;?>

<?php foreach($vins as $vin) {
    echo "<tr ng-show=\"isSearched(".$vin['Cepage']['id'].",".$vin['Origine']['id'].")\">";
    echo "<input type='hidden' name='data[vins][".$i."][Vin][id]'value=" . $vin['Vin']['id'] . "></input>";
    echo "<input type='hidden' name='data[vins][".$i."][Vin][Price][devise]'value=" . $vin['Origine']['devise'] . "></input>";
    echo "<td>" . $vin['Origine']['label'] . "</td>";
    echo "<td>" . $vin['Cepage']['label'] . "</td>";
    echo "<td>";
    echo "<input name='data[vins][".$i."][Vin][Price][down]'value=" . $vin['Price']['down'] . "></input>".$vin['Origine']['devise'];
    echo "</td>";
    echo "<td>";
    echo "<input name='data[vins][".$i."][Vin][Price][up]'value=" . $vin['Price']['up'] . "></input>".$vin['Origine']['devise'];
    echo "</td>";
    echo "<td>";
    echo "<input name='data[vins][".$i."][Vin][Comment][commentaire]'value=" . $vin['Comment']['commentaire'] . "></input>";
    echo "</td>";
    ?>

    <td>
        <select name="data[vins][<?php echo $i;?>][Vin][Price][appreciation]">
            <option value="-1"<?php if($vin['Price']['appreciation']==-1) {echo "selected";}?>>buyers Market</option>
            <option value="0"<?php if($vin['Price']['appreciation']==0) {echo "selected";} ?>>normal Market</option>
            <option value="1"<?php if($vin['Price']['appreciation']==1) {echo "selected";} ?>>sellers Market</option>
        </select>
        <button><a href="/vin/<?php echo $vin['Vin']['id']?>/delete">Delete</a></button>
    </td>
    </tr>
<?php $i++;}?>

</table>

<?php echo $this->Form->end('Sauvegarder'); ?>
    </div>
</div>
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
