<?php
//This is the script that deletes all the xml files from the message folder.

  if (!empty($_GET['checker'])) {
	foreach (new DirectoryIterator('messages/') as $fileInfo) {
		if(!$fileInfo->isDot()) {
			unlink($fileInfo->getPathname());
		}
	}
	echo "Please refresh the page";
  } else {
?>
<form action="delete.php" method="get">
  <input type="hidden" name="checker" value="run">
  <input type="submit" value="Delete all Messages">
</form>
<?php
  }
?>
