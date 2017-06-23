<?php
header('Content-Type: application/json');
require_once 'myClass.php';
$db = new myClass();
if(isset($_GET['user']) && isset($_GET['pass']))
{
	echo json_encode($db->login($_GET['user'],$_GET['pass']));
}
else if(isset($_GET['auser']) && isset($_GET['apass']))
{
	echo json_encode($db->addUser($_GET['auser'],$_GET['apass']));
}
else if(isset($_GET['id']) && isset($_GET['quantity']) && isset($_GET['box']) && isset($_GET['vendor']) && isset($_GET['location']) && isset($_GET['addby']))
{
	echo json_encode($db->updateItem($_GET['id'],$_GET['quantity'],$_GET['box'],$_GET['vendor'],$_GET['location'],$_GET['addby']));
}
else if(isset($_GET['addreject']) && isset($_GET['id']) && isset($_GET['quantity']) && isset($_GET['box']) && isset($_GET['desc']))
{
	echo json_encode($db->rejectItem($_GET['id'],$_GET['quantity'],$_GET['box'],$_GET['desc']));
}
else if(isset($_GET['addissue']) && isset($_GET['id']) && isset($_GET['quantity']) && isset($_GET['name']) && isset($_GET['desc']))
{
	echo json_encode($db->issueItem($_GET['id'],$_GET['quantity'],$_GET['name'],$_GET['desc']));
}
else if(isset($_GET['showall']))
{
	echo json_encode($db->showItems());
}
else if(isset($_GET['issueList']))
{
	echo json_encode($db->IssuedList());
}
else if(isset($_GET['rejectList']))
{
	echo json_encode($db->RejectedList());
}
else if(isset($_GET['submit']) && isset($_GET['id']))
{
	echo json_encode($db->submitedItem($_GET['id']));
}
else if(isset($_GET['show']) && isset($_GET['id']))
{
	echo json_encode($db->showItem($_GET['id']));
}
else if(isset($_GET['issue']) && isset($_GET['id']))
{
	echo json_encode($db->showIssued($_GET['id']));
}
else if(isset($_GET['reject']) && isset($_GET['id']))
{
	echo json_encode($db->showRejected($_GET['id']));
}
else if(isset($_GET['delete']) && isset($_GET['id']))
{
	echo json_encode($db->delItem($_GET['id']));
}
else
{
	echo "API SERVER - Send Request To Get Response.";
}
?>
