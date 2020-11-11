<?php
$name = array("lanirne", "aduh", "qifuat", "toda", "anevi", "samid", "kifuat");
sort($name);

$clength = count($name);
for($x = 0; $x < $clength; $x++) {
  echo $name[$x];
  echo "<br>";
}
?>
