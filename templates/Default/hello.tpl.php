<?php switch ($this->type): case 'dump': ?>   
<pre>
<?php var_dump($this->obj);?>
</pre>
<?php break; ?>
<?php endswitch; ?>