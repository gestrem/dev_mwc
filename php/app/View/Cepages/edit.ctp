<?php echo $this->Form->create('cepage'); ?>
<?php
echo $this->Form->input('label', array('name'=>"data[Cepage][label]" ,'value' => $cepage['Cepage']['label']));
?>
<?php echo $this->Form->end('Sauvegarder'); ?>