<?php

$connect_host = "pyrois.univ-fcomte.fr";
$connect_user = "UserCla";
$connect_passwd = "C&lm2p2lBDcla."; 
$connect_database = "test_catalogue";

$connexion = new mysqli($connect_host, $connect_user, $connect_passwd, $connect_database);
if (mysqli_connect_errno()) {
	("Echec de la connexion : " . mysqli_connect_error());
	exit();
}
$sql="SELECT nom, prenom, mailperso, datenaiss, telperso, adressepays, debutant FROM stagiaire where stagiaire.id_stagiaire=".$_GET['id_stagiaire']."";
$result = array();

if($res=$connexion->query($sql)){
	$data = $res->fetch_assoc();
       
           $result['nom'] = $data['nom'];
           $result['prenom'] = $data['prenom'];
           $result['mailperso'] = $data['mailperso'];
           $result['datenaiss'] = $data['datenaiss'];
           $result['telperso'] = $data['telperso'];
           $result['adressepays'] = $data['adressepays'];
           $result['debutant'] = $data['debutant'];
       
       
}

$connexion->close();
echo json_encode($result);
		?>
