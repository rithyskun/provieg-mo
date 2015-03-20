<?php

class imageManager extends fileManager {
    
    /**
     * Reduction de la taille de l'image
     */     
    static public function resizeImage($originalFile, $new_width, $new_height) {
        
        // vérifie si le fichier existe
        if(!file_exists($originalFile)) {
            throw new Exception('Le fichier à redimensionner n\'existe pas');
        }
        // vérifie si le répertoire cible de l'image redimensionné existe  
        /*if(!is_dir($filepath . $resizepath)) {
            throw new Exception('Le répertoire de destination de l\'image redimensionnée n\'existe pas, '.$filepath . $resizepath);
        }*/
            
        if(! (list($width, $height, $type, $attr) = @getimagesize($originalFile)) ) {
            return;
            //throw new Exception('Le fichier ne peut être redimensionné car il ne s\'agit pas d\'une image');
        } 
        
        if($width > $new_width || $height > $new_height) {
            $ratio = $width / $height;
            if($ratio >= 1) { // plus large que haut
                $nw = $new_width;
                $nh = $height / ($width / $new_width);
            } 
            else {
                $nw = $width / ($height / $new_height);
                $nh = $new_height;
            }

			$neededMemory = neededMemoryImage($originalFile);
            if($neededMemory > 64*1048576) {
				try {
	                $log = new logManager();
		            $log->write("From imageManager->resizeTo($originalFile, $resizeFile, $new_width, $new_height) :");
	             	$log->write('Memory limit: '.ini_get('memory_limit'));
	            	$log->write('Needed memory: '.format_size($neededMemory));
	            	$log->save();
					$log->mail(MAIL_WEBMASTER);
				}
				catch(Exception $e) {
					throw new Exception('L\'image ne peut être redimensionnée car elle est trop grosse');
				}
				throw new Exception('L\'image ne peut être redimensionnée car elle est trop grosse');
            }
            else {
	            // creation de l'image de sortie
	            $img_in  = imagecreatefromjpeg($originalFile);
	            $img_out = imagecreatetruecolor($nw, $nh);
	            imagecopyresampled($img_out, $img_in, 0, 0, 0, 0, imagesx($img_out), imagesy($img_out), imagesx($img_in), imagesy($img_in));

	            // enregistrement de la nouvelle image
	            imagejpeg($img_out, $originalFile, 85);

	            imagedestroy($img_in);
	            imagedestroy($img_out);
            }
        }
    }
    
    static public function resizeImageTo($originalFile, $resizeFile, $to_width, $to_height, $overwrite = false) {

        // vérifie si le fichier existe
        if(!file_exists($originalFile)) {
            throw new Exception('The file to resize is not exist');
        }
        
        // vérifie si une image portant ce nom n'existe pas deja
        if(!$overwrite and file_exists($resizeFile)) {
            return;
            //throw new Exception('Un fichier portant le nom de l\'image redimensionnée existe déjà');
        }

        if(! (list($width, $height, $type, $attr) = @getimagesize($originalFile)) ) {
            return;
            //throw new Exception('Le fichier ne peut être redimensionné car il ne s\'agit pas d\'une image');
        }

        if($width > $to_width || $height > $to_height) {
		    // Get the original geometry and calculate scales
		    $xscale=$width/$to_width;
		    $yscale=$height/$to_height;
		    
		    // Recalculate new size with default ratio
		    if ($yscale>$xscale){
		        $nw = round($width * (1/$yscale));
		        $nh = round($height * (1/$yscale));
		    }
		    else {
		        $nw = round($width * (1/$xscale));
		        $nh = round($height * (1/$xscale));
		    }
		            

            $neededMemory = neededMemoryImage($originalFile);
            if($neededMemory > 64*1048576) {
				try {
	                $log = new logManager();
		            $log->write("From imageManager->resizeTo($originalFile, $resizeFile, $to_width, $to_height) :");
	             	$log->write('Memory limit: '.ini_get('memory_limit'));
	            	$log->write('Needed memory: '.format_size($neededMemory));
	            	$log->save();
					$log->mail(MAIL_WEBMASTER);
				}
				catch(Exception $e) {
					throw new Exception('L\'image ne peut être redimensionnée car elle est trop grosse');
				}
				throw new Exception('L\'image ne peut être redimensionnée car elle est trop grosse');
            }
            else {
				try {
            	// creation de l'image de sortie
	            $path = pathinfo($originalFile);
	            if($type==IMAGETYPE_GIF){
	            	$img_in  = imagecreatefromgif($originalFile);
				}elseif($type==IMAGETYPE_JPEG){
	            	$img_in  = imagecreatefromjpeg($originalFile);
				}elseif($type==IMAGETYPE_PNG){
	            	$img_in  = imagecreatefrompng($originalFile);
	            	
				}else{
					throw new Exception('Cannot upload this image type');
					return;
				}
				
                $img_out = imagecreatetruecolor($nw, $nh);
			    if($type == IMAGETYPE_GIF  || ($type == IMAGETYPE_PNG)) {
					$trnprt_indx = imagecolortransparent($img_in);
					//If we have a specific transparent color
					if($trnprt_indx >= 0) {				
				        // Get the original image's transparent color's RGB values
				        $trnprt_color    = imagecolorsforindex($img_in, $trnprt_indx);
				        // Allocate the same color in the new image resource
				        $trnprt_indx    = imagecolorallocate($img_out, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
				        // Completely fill the background of the new image with allocated color.
				        imagefill($img_out, 0, 0, $trnprt_indx);
				        // Set the background color for new image to transparent
				        imagecolortransparent($img_out, $trnprt_indx);
				     }
			      // Always make a transparent background color for PNGs that don't have one allocated already
			      elseif ($type == IMAGETYPE_PNG) {
			        // Turn off transparency blending (temporarily)
			        imagealphablending($img_out, false);
			 
			        // Create a new transparent color for image
			        $color = imagecolorallocatealpha($img_out, 0, 0, 0, 127);
			 
			        // Completely fill the background of the new image with allocated color.
			        imagefill($img_out, 0, 0, $color);
			 
			        // Restore transparency blending
			        imagesavealpha($img_out, true);
			      }
			    }
                imagecopyresampled($img_out, $img_in, 0, 0, 0, 0, imagesx($img_out), imagesy($img_out), imagesx($img_in), imagesy($img_in));
                // enregistrement de la nouvelle image
                switch ( $type ) {
			      case IMAGETYPE_GIF:
			        imagegif($img_out,$resizeFile);
			      break;
			      case IMAGETYPE_JPEG:
			        imagejpeg($img_out,$resizeFile,85);
			      break;
			      case IMAGETYPE_PNG:
			      	imagepng($img_out,$resizeFile,9);			        
			      break;
			      default:
			        return false;
			    }
                
				// destruction des images, libération de la mémoire
                imagedestroy($img_in);
                imagedestroy($img_out);
                }catch(Exception $e) {
					throw new Exception($e);
				}
            }
        }
        else { // l'image ne necessite pas de redimensionnement, on la copie simplement
            copy($originalFile, $resizeFile);
        }
    }
}

?>