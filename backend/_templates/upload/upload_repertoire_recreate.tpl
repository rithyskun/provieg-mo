<h1>Création/recréation des miniatures</h1>
<form onsubmit="return false;">
	<div class="flexible_list">		
		<div class="flexible_list_header">
				<div class="flexible_list_title">Format</div>
				<div class="flexible_list_field">Put logo</div>
		</div>
		<fly:list name="list_format">
			<div class="flexible_list_row">
				<div class="flexible_list_title">
					<label>
						<input type="checkbox" id="format_<fly:variable name='i_format' />" name="<fly:variable name='id_format' />" />
						<fly:variable name="nom_format" /> (<fly:variable name="largeur" />x<fly:variable name="hauteur" />)
					</label>
				</div>
				<div class="flexible_list_field">
					<label>
						<input class="putlogo_check" type="checkbox" id="put_logo_<fly:variable name='i_format' />" />
					</label>
				</div>
			</div>
		</fly:list>
	</div>
	Picture file types to recreate: <input class="check_type" type="checkbox" id="jpeg"  /> .jpeg&nbsp;&nbsp;
									<input class="check_type" type="checkbox" id="png"  /> .png&nbsp;&nbsp;
									 <input class="check_type" type="checkbox" id="gif" /> .gif<br />
	Ecraser les anciens fichiers ?
	<label><input type="radio" name="overwrite" value="1" /> Oui</label>
	<label><input type="radio" name="overwrite" value="0" checked="checked" /> Non</label>

	<fly:list name="input_hidden">
	<input type="hidden" id="fichier_<fly:variable name='i_fichier' />" value="<fly:variable name='nom_fichier' />" />
	</fly:list>
	<input type="hidden" id="nb_fichier" value="<fly:variable name='nb_fichier' />" />
	<input type="hidden" id="nb_format" value="<fly:variable name='nb_format' />" />
	<input type="hidden" id="id_repertoire" value="<fly:variable name='id_repertoire' />" />
	<input type="hidden" id="rep_ajax" value="<fly:variable name='REP_AJAX' />" /><br />
	<input type="button" id="create" value="Démarrer" class="bouton" />
</form>
<br />
<div>
	<h3>Résultats de la recréation des miniatures</h3>
	<div>
		<div style="float: left;"><strong>Fichier en cours de traitement</strong> : <span id="nb_traite">0</span>/<span id="nb_global">0</span></div>
		<div id="progress_bar" style="float: left; margin: 2px 6px; border: 1px solid black; width: 100px; height: 10px;">
			<div style="background: black; width: 0%; height: 10px;"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div id="deploy_error"><strong>Erreur</strong> : <span id="nb_error">0</span> erreur(s) survenue(s) durant le traitement (deployer en cliquant)</div>
    <div id="output_error" style="display: none; overflow-y: scroll; border: 1px solid black; height: 120px;"></div>
	<div id="output_finish" style="display: none;">
		<br />
		La recréation des fichiers est terminée, vous pouvez maintenant
		<strong><a href="upload_repertoire_detail.php?id=<fly:variable name='id_repertoire' />">retourner au détail du répertoire</a></strong>
 	</div>
 	<br />
	<div id="deploy_output"><strong>Voir tous les résultats</strong> (déployer en cliquant)</div>
	<div id="output" style="display: none; overflow-y: scroll; border: 1px solid black; height: 120px;"></div>
</div>