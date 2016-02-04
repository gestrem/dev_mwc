<?php
if($form==0):  ?>
    <?php echo $this->Form->create('client'); ?>
    <?php
    echo $this->Form->input('login', array('name'=>"data[Client][login]"));
    echo $this->Form->input('lastname', array('name'=>"data[Client][nom]"));
    echo $this->Form->input('firstname', array('name'=>"data[Client][prenom]"));
    echo $this->Form->input('country', array('name'=>"data[Client][pays]"));
    echo $this->Form->input('password',array('name'=>"data[pass1]"));
    echo $this->Form->input('password',array('name'=>"data[pass2]"));
    $devises = array('USD' => 'USD', 'EUR' => 'EUR', 'ZAR' => 'ZAR');
    echo $this->Form->input('Currency', array('name'=>"data[Client][devise_favorite]",'options' => $devises, 'default' => 'EUR'));
    $unites = array('L' => 'Litre', 'G' => 'Gallon');
    echo $this->Form->input('Unit', array('name'=>"data[Client][unite]",'options' => $unites, 'default' => 'L'));
    echo $this->Form->input('Company', array('name'=>"data[Client][societe]"));
    echo $this->Form->input('email', array('name'=>"data[Client][email]"));
    ?>
    <?php echo $this->Form->end('Sauvegarder'); ?>
<?php  endif;?>

<?php
if($form==1):  ?>
    <h1>Please verify your email</h1>
<?php  endif;?>

<?php
if($form==2):  ?>
    <h1>Paiement Paypal</h1>
<?php  endif;?>

<?php
if($form==3):  ?>
    <h1>Invalid client number</h1>
<?php  endif;?>

