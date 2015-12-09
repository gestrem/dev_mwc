<?php echo $this->Form->create('cepage'); ?>
<?php
echo $this->Form->input('label', array('name'=>"data[Origine][label]" ,'value' => $origine['Origine']['label']));
echo $this->Form->input('devise', array('name'=>"data[Origine][devise]" ,'value' => $origine['Origine']['devise']));
?>
<?php echo $this->Form->end('Sauvegarder'); ?>