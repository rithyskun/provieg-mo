<!--<div id="logout">
	Hello <strong><fly:variable name="login" /></strong>, connected depuis <fly:variable name="logtime" /> | <a href="<fly:variable name='rep_root' />logout.php">Se déconnecter</a>
</div>
-->
<div id="logout">
	Hello <strong><fly:variable name="login" /></strong>, login since <fly:variable name="logtime" /> | <a href="<fly:variable name='rep_root' />logout.php">Logout</a>
</div>
<div id="fil">
	<fly:list name="fil"> 
		<a href="<fly:variable name='rep_root' /><fly:variable name='url_fichier' />"><fly:variable name="intitule_fichier" /></a> >
	</fly:list>
	<fly:variable name="intitule_fichier_courant" />
</div>