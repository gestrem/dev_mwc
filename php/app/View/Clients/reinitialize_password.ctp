<?php if($print) { ?>
<?php echo $this->Form->create('client'); ?>
<?php

echo $this->Form->input('password',array('name'=>"data[pass1]"));
echo $this->Form->input('password',array('name'=>"data[pass2]"));

?>
<?php echo $this->Form->end('Sauvegarder'); ?>
<?php }?>