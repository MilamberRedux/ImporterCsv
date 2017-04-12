<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Csv Importer</title>
<style>
	
	body{
		background-color:#202020;
	}
	.wrapper{
		margin-left:3%;
		margin-right:3%;
	}
	.column{
		margin-top:50px;
		padding:35px;
		border-radius:25px;
		background-color:#606060;
		width:92%;
	}
	.halfcolumn{		
		margin-right:1%;
		margin-top:50px;
		padding:35px;
		border-radius:25px;
		background-color:#606060;
		float:left;
		width:43%;
		
	}

	.ligne{
		min-height:29px;
		margin-left:4%;
		margin-right:4%;
		margin-top:10px;
		clear:both;
	}
	.right{
		float:right;
		margin-right:15%;
	}
	
	.message{
		margin-top:50px;
		padding:15px;
		border-radius:20px;
		width:92%;
		font-weight:bold;
		background-color:#606060;
	}
	.message-error{
		background-color:red;
		color:white;				
	}
	.message-success{
		background-color:green;
		color:white;
	}

</style>
</head>
<body>

	<div class="wrapper">	
		<?php
			if(isset($_GET['message'])){
				echo urldecode($_GET['message']);
			}
		?>
	<form action="http://localhost/perso/importerCsv/main.php" method="post" enctype="multipart/form-data">
		<div class="halfcolumn">
			<div class="ligne">
				<span class="label">Adresse de la base</span>
				<input type="text" name="base_url" class="right"/>
			</div>	
			<div style="clear:both;"></div>
			<div class="ligne">
				<span class="label">Login</span>
				<input type="text" name="base_login" class="right"/>
			</div>
			<div style="clear:both;"></div>
			<div class="ligne">
				<span class="label">Mot de passe</span>
				<input type="password" name="base_pass" class="right"/>
			</div>
			<div class="ligne">
				<span class="label">Nom de la base</span>
				<input type="text" name="base_name" class="right"/>
			</div>
			<div class="ligne">
				<span class="label">Nom de la table des articles</span>
				<input type="text" name="base_table" class="right"/>
			</div>
		</div>
		<div class="halfcolumn">	
			<div class="ligne">
				<span class="label">Fichier csv à importer</span>
				<input type="file" name="file" class="right"/>
				<input name="MAX_FILE_SIZE" value="999999999" type="hidden">
			</div>
			<div class="ligne">
				<span class="label">Nombre de lignes d'entête</span>
				<input type="text" name="file_entete" class="right" placeholder="1"/>
			</div>
			<div class="ligne">				
					<span class="label">Correspondance CSV - Table : </span><br/>

				<textarea rows="10" cols="200" style="float:left;width:40%;margin-right:15px;" name="correspondance" id="correspondance"></textarea>
				<div style="float:left;width:55%;">
					indiquez le numéro de colone du csv suivi du nom du champ
					correspondant dans la table des articles (un par ligne), exemple: <br/>
					2$titre<br/>
					3$text<br/>
					5$url_article<br/>
				</div>				
			</div>
			<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
		<div class="column">
			<div class="ligne">
				<span class="label">Lancer l'import: </span>
				<input type="submit" name="submit" title="Lancer"/>
				
			</div>
		</div>
	</form>
	</div>
	

</body>
</html>
