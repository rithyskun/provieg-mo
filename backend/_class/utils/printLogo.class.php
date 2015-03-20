<?php
class printLogo {
	var $img_logo = '';
	var $img_pic = '';
	
	var $dpx = 5;
	var $dpy = 5;

	function createImageAndLogo($pic_file, $logo_file=LOGO) {
		try{
	        $pic_info = @getimagesize($pic_file);
	        if($pic_info[2]==IMAGETYPE_GIF){
	        	$this->img_pic = imagecreatefromgif($pic_file);
			}elseif($pic_info[2]==IMAGETYPE_JPEG){
	        	$this->img_pic = imagecreatefromjpeg($pic_file);
			}elseif($pic_info[2]==IMAGETYPE_PNG){
	        	$this->img_pic = imagecreatefrompng($pic_file);
			}else{
				return;
			}
	        $logo_info = @getimagesize($logo_file);
	        if($logo_info[2]==IMAGETYPE_GIF){
	        	$this->img_logo = imagecreatefromgif($logo_file);
			}elseif($logo_info[2]==IMAGETYPE_JPEG){
	        	$this->img_logo = imagecreatefromjpeg($logo_file);
			}elseif($logo_info[2]==IMAGETYPE_PNG){
	        	$this->img_logo = imagecreatefrompng($logo_file);
			}else{
				return;
			}
			//pic transparency
		    if($pic_info[2] == IMAGETYPE_GIF  || ($pic_info[2] == IMAGETYPE_PNG)) {
				$trnprt_indx = imagecolortransparent($this->img_pic);
				//If we have a specific transparent color
				if($trnprt_indx >= 0) {
                	//$img_out = imagecreatetruecolor($pic_info[0],$pic_info[1]);
			        // Get the original image's transparent color's RGB values
			        $trnprt_color    = imagecolorsforindex($this->img_pic, $trnprt_indx);
			        // Allocate the same color in the new image resource
			        $trnprt_indx    = imagecolorallocate($this->img_pic, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
			        // Completely fill the background of the new image with allocated color.
			        imagefill($this->img_pic, 0, 0, $trnprt_indx);
			        // Set the background color for new image to transparent
			        imagecolortransparent($this->img_pic, $trnprt_indx);
			     }
		      // Always make a transparent background color for PNGs that don't have one allocated already
		      elseif ($pic_info[2] == IMAGETYPE_PNG) {
		        // Turn off transparency blending (temporarily)
		        imagealphablending($this->img_pic, false);
		 
		        // Create a new transparent color for image
		        $color = imagecolorallocatealpha($this->img_pic, 0, 0, 0, 127);
		 
		        // Completely fill the background of the new image with allocated color.
		        imagefill($this->img_pic, 0, 0, $color);
		 
		        // Restore transparency blending
		        imagesavealpha($this->img_pic, true);
		      }
		    }
		}catch(Exception $e){
			return;
		}
	}
	/**** $margin: (top,right,bottom,left) 
	  Ex:
	  $margin_per_pic="2,2"
	  ==>1/2 for x and 1/2 for y ==> logo is in middle of pic
	  */
	function setAlign($align=null,$margin=null,$margin_dynamic=false) {
		try{
			//set width and height to margin logo in picture
			if($margin){
				list($mt, $mr, $mb, $ml) = explode(',', $margin);
			}else{
				$mt = 0;
				$mr = 0;
				$mb = 0;
				$ml = 0;
			}
			if($margin_dynamic==true && $margin){
				$mt = $mt>0?(imagesx($this->img_pic)/$mt):0;
				$mr = $mr>0?(imagesy($this->img_pic)/$mr):0;
				$mb = $mb>0?(imagesy($this->img_pic)/$mb):0;
				$ml = $ml>0?(imagesy($this->img_pic)/$ml):0;
			}			
			if($align){
				if ($align ==ALIGN_TOP_LEFT) {
					$this->dpy = $mt;
					$this->dpx = $ml;
				} elseif ($align ==ALIGN_TOP_RIGHT) {
					$this->dpy = $mt;
					$this->dpx = imagesx($this->img_pic)-(imagesx($this->img_logo)+$mr);
				} elseif ($align ==ALIGN_BOTTOM_RIGHT) {
					$this->dpy = imagesy($this->img_pic)-(imagesy($this->img_logo)+$mb);
					$this->dpx = imagesx($this->img_pic)-(imagesx($this->img_logo)+$mr);
				} elseif ($align ==ALIGN_BOTTOM_LEFT) {
					$this->dpy = imagesy($this->img_pic)-(imagesy($this->img_logo)+$mb);
					$this->dpx = $ml;
				} elseif ($align ==ALIGN_BOTTOM_CENTER) {
					$this->dpy = imagesy($this->img_pic)-(imagesy($this->img_logo)+$mb);
					$dc = imagesx($this->img_pic)/2;
					$dc2 = imagesx($this->img_logo)/2;
					$this->dpx = $dc-$dc2;
				} elseif ($align ==ALIGN_TOP_CENTER) {
					$this->dpy = $mt;
					$dc = imagesx($this->img_pic)/2;
					$dc2 = imagesx($this->img_logo)/2;
					$this->dpx = $dc-$dc2;
				}
			}else{
					$this->dpy = 0;
					$this->dpx = 0;
			}
		
		}catch(Exception $e){
			return ;
		}
	}

	function insertLogo($align,$margin=null,$margin_dynamic=null) {
		try{
			$this->setAlign($align,$margin,$margin_dynamic);
			$sx = imagesx($this->img_logo);
			$sy = imagesy($this->img_logo);
			imagecopy($this->img_pic, $this->img_logo, $this->dpx, $this->dpy, 0, 0, $sx, $sy);		
		}catch(Exception $e){
			return ;
		}
	}

	function showImage($pic_file) {
		try{
	        $path = pathinfo($pic_file);
	        if(strtolower ($path['extension'])=='gif'){
	        	$functionImageOutput = 'imagegif';
			}elseif(strtolower ($path['extension'])=='jpg' ||strtolower ($path['extension'])=='jpeg'){
	        	$functionImageOutput = 'imagejpeg';
			}elseif(strtolower ($path['extension'])=='png'){
	        	$functionImageOutput = 'imagepng';
			}
			$functionImageOutput($this->img_pic,$pic_file);
			//imagejpeg($this->img_pic,$pic_file);
			imagedestroy($this->img_pic);
	        imagedestroy($this->img_logo);	    
		}catch(Exception $e){
			return ;
		}
	}
}