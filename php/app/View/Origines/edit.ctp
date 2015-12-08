<?php echo $this->Form->create('cepage'); ?>
<?php
echo $this->Form->input('label', array('name'=>"data[Origine][label]" ,'value' => $origine['Origine']['label']));
?>
<?php echo $this->Form->end('Sauvegarder'); ?>