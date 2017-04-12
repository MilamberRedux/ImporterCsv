<?php
ini_set("upload_max_filesize", "1024M");
ini_set("post_max_size", "1024M");
ini_set('max_execution_time', 900); // 900 secondes = 15mn

$conf_nb_ligne_entete=$_POST['file_entete'];
//le numéro de la première colone risque d'être compté comme un or les tableaux commencent à 0 en php
$conf_num_premiere_colone_csv=1; 

//controle import fichier
if(isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])){
	$filename=$_FILES['file']['tmp_name'];
}else{
	$message= "<div class='message message-error'>Fichier Obligatoire</div>";
	header('Location: index.php?message='.urlencode($message));
	die;
}


//connexion bdd
if(empty($_POST['base_login']) || empty($_POST['base_pass']) || empty($_POST['base_name'])|| empty($_POST['base_url'])){
	$message= "<div class='message message-error'>Données de connexion à la base de données incomplètes</div>";
	header('Location: index.php?message='.urlencode($message));
	die;
}

$BDD=new mysqli($_POST['base_url'],$_POST['base_login'],$_POST['base_pass'],$_POST['base_name']);
if ($BDD->connect_errno) {	
	$message= "<div class='message message-error'>"."Echec lors de la connexion à MySQL : (" . $BDD->connect_errno . ") " . $BDD->connect_error."</div>";
	header('Location: index.php?message='.urlencode($message));
	die;
}


//correspondance fichier/Base
$corres_tmp=explode("\n",$_POST['correspondance']);
$corres=array();
foreach ($corres_tmp as $val){
	$string=explode("$", $val);
	if(count($string)==2){
		$corres[$string[0]-$conf_num_premiere_colone_csv]=$string[1];
	}
}

$values=join(",",array_values($corres));
$sqlInsert="Insert into ".$_POST['base_table']." (".$values.") values (";

$handle=fopen($filename, "r");
$cpt=0;
while($row=fgetcsv($handle,null,",")){
	if($cpt<$conf_nb_ligne_entete){$cpt++;continue;}
	$data=array();
	foreach ($corres as $key=>$val){
		$tmp=$BDD->real_escape_string($row[$key]);
		$data[]="'".$tmp."'";
	}
	
	$data=join(',',$data);
	$query=$sqlInsert.$data.");";
	
	$BDD->query($query);
	$cpt++;
}
$message="<div class='message message-success'>Fichier csv traités: ".($cpt-$conf_nb_ligne_entete)." article(s) trouvés et importés.</div>";
header('Location: index.php?message='.urlencode($message));


?>
