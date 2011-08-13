<?php
// set up your alphabet
$alpha = range('A','Z');

if(empty($controller)){
	$controller = $this->params['controller'];
}

?>
<div class="alphabet-sorter">
	<h3>Sort <?php echo $controller; ?> by name:</h3>
	<ul class='alphabet sortby'>
	<?php
		if ($filter == "^[0-9]+") {
			echo "<li class='link selected'>";
			echo $this->Html->link("#", array('controller' => strtolower($controller), 'action' => 'index', 'number'), array('class' => 'link_selected')) . "";
		}else{
			echo "<li>";
			echo $this->Html->link("#", array('controller' => strtolower($controller), 'action' => 'index', 'number'), array('class' => 'link')) . "";
		}
	?>
		</li>
	<?php for ($i=0; $i < count($alpha); $i++): 
		// if current letter is not in the links array, do not make it clickable
		if(!in_array($alpha[$i], $links)) {
			echo "<li class='nolink'>";
			echo"<span class='nolink'>" . $alpha[$i] . "</span>";
		} else {
			if ($alpha[$i] == $filter) {
				echo "<li class='link selected'>";
				// if the current letter matches the filter, give it a selected style
				echo $this->Html->link($alpha[$i], array('controller' => strtolower($controller), 'action' => 'index', $alpha[$i]), array('class' => 'link_selected')) . "";
			} else {
				echo "<li class='link'>";
				echo $this->Html->link($alpha[$i], array('controller' => strtolower($controller), 'action' => 'index', $alpha[$i]), array('class'=>'link')) . "";
			}
		}
	?>
		</li>
	<?php endfor; ?>
	<div class='clear'></div>
	</ul>
</div>
