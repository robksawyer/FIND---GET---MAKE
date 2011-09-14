<?php 
echo $_GET['callback'] . '(' . json_encode($content_for_layout) . ')'; 
?> 
