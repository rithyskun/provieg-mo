<?php

class fileManager {

    private static $blackList = array('exe', 'htaccess', 'htpasswd',
                                      'php', 'php3', 'php4', 'php5', 'js');

    /**
     * Gère l'upload de fichier et toutes les erreurs qui s'y rapportent
     * @param $files : le tableau correspondant aux infos sur le fichier $_FILES['nom_champ']
     * @param $nom_serveur : nom du fichier sur le serveur
     * @param $chemin_fichier : répertoire où le fichier doit être uploadé
     */
    static public function uploadFile($files, $nom_serveur, $chemin_fichier) {
        // Vérifie si il y a eu des erreurs lors de l'envoi du formulaire
        if($files['error']) {
            switch($files['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    throw new Exception('Le fichier dépasse la limite autorisée par le serveur');

                case UPLOAD_ERR_FORM_SIZE:
                    throw new Exception('Le fichier dépasse la limite autorisée dans le formulaire HTML');

                case UPLOAD_ERR_PARTIAL:
                    throw new Exception('L\'envoi du fichier a été interrompu pendant le transfert');

                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('Le fichier que vous avez envoyé a une taille nulle');
            }
        }

        extract($files);
        $path = pathinfo($name);

        // Vérifie que le fichier a bien été envoyé sur le serveur
        if(empty($tmp_name) and !is_uploaded_file($tmp_name)) {
            throw new Exception('Le fichier n\'a pas pu être envoyé sur le serveur, veuillez réessayer');
        }

        // Vérification de l'extension du fichier
        if(in_array($path['extension'], self::$blackList)) {
            throw new Exception('Le fichier a été refusé car son format n\'est pas autorisé');
        }

        // Vérification anti hack "\0" (http://phpcodeur.net/articles/php/upload)
        if(preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name)) {
            throw new Exception('Le fichier a été refusé car nom est non valide');
        }

        // Vérifie que le répertoire existe bien
        if(!is_dir($chemin_fichier)) {
        	if (!file_exists($chemin_fichier)) {
				 mkdir($chemin_fichier, 0777);  
			}
        }

        // Vérifie que le fichier n'existe pas déja dans le répertoire
        if(file_exists($chemin_fichier. $nom_serveur)) {
            throw new Exception('Un fichier portant ce nom existe déjà sur le serveur');
        }

        // Vérifie que le déplacement a bien été fait
        if(!move_uploaded_file($tmp_name, $chemin_fichier. $nom_serveur)) {
            throw new Exception('Le fichier n\'a pas pu être déplacé dans le répertoire');
        }

        return true;
    }

    static public function downloadFile() {

    }

    static public function removeFile($filepath) {
        if(!@unlink($filepath))
            throw new Exception('Une erreur s\'est produite lors de la suppression du fichier \''.$filepath.'\'');
        return true;
    }

    static public function moveFile($from, $to) {
        if(!@rename($from, $to))
            throw new Exception('Impossible de déplacer le fichier de \''.$from.'\' vers \''.$to.'\'');
        return true;
    }
    
    static public function copyFile($from, $to) {
    	$pos = strripos($to, '/');
		if ($pos !== false) {
			$path = substr($to, 0, $pos);
			if (!file_exists($path)) {
				        mkdir($path, 0777);  
			}
		}
        if(!@copy($from, $to))
            throw new Exception('Impossible de copier le fichier de \''.$from.'\' vers \''.$to.'\'');
        return true;
    }

}

?>
