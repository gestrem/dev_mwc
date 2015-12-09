<?php echo $this->Form->create('origine'); ?>
<?php
echo $this->Form->input('label', array('name'=>"data[Origine][label]"));
echo $this->Form->input('devise', array('name'=>"data[Origine][devise]"));
?>
<?php echo $this->Form->end('Sauvegarder'); ?>