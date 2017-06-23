<?php

require_once 'server/myClass.php';
$db = new myClass();

function compress_image($source_url, $destination_url, $quality) {

	$info = getimagesize($source_url);

	if ($info['mime'] == 'image/jpeg')
	$image = imagecreatefromjpeg($source_url);

	elseif ($info['mime'] == 'image/gif')
	$image = imagecreatefromgif($source_url);

	elseif ($info['mime'] == 'image/png')
	$image = imagecreatefrompng($source_url);

	imagejpeg($image, $destination_url, $quality);
	return $destination_url;
}

if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];

if (!file_exists('images/'.$_POST['itemBy'])) {
    mkdir('images/'.$_POST['itemBy'], 0777, true);
}

$fi = new FilesystemIterator('images/'.$_POST['itemBy'].'/', FilesystemIterator::SKIP_DOTS);
$count = iterator_count($fi);

$temp = explode(".", $_FILES["userImage"]["name"]);
$newfilename = 'images/'.$_POST['itemBy']."/".($count+1).'.jpg';

#echo $newfilename;

$targetPath = 'images/'.$_POST['itemBy']."/".$_FILES['userImage']['name'];
$db->addItem($newfilename,$_POST['itemName'],$_POST['itemDesc'],$_POST['itemPrice'],$_POST['itemQua'],$_POST['itemBox'],$_POST['itemVendor'],$_POST['itemLocation'],$_POST['itemBy']);
$sourcePath = compress_image($sourcePath, $newfilename, 10);
move_uploaded_file($sourcePath,$newfilename);


?>
<?php
}
}
?>