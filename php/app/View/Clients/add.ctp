<?php echo $this->Form->create('client'); ?>
<?php
echo $this->Form->input('login', array('name'=>"data[Client][login]"));
echo $this->Form->input('nom', array('name'=>"data[Client][nom]"));
echo $this->Form->input('prenom', array('name'=>"data[Client][prenom]"));
echo $this->Form->input('password',array('name'=>"data[pass1]"));
echo $this->Form->input('password',array('name'=>"data[pass2]"));
echo $this->Form->input('societe', array('name'=>"data[Client][societe]"));
echo $this->Form->input('email', array('name'=>"data[Client][email]"));
?>
<?php echo $this->Form->end('Sauvegarder'); ?>