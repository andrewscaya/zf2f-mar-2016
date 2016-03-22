<?php echo $this->partial('application/widgets/top_left'); ?>
<?php echo $this->partial('application/widgets/lower_left'); ?>
<br>
<ul>
<li>A: <?= $this->apple ?></li>
<li>B: <?= $this->banana ?></li>
</ul>
<?= get_class($this); ?>
