<h3>Photos for file</h3>
<!--<fly:include name="include_pagination" />-->	
<!--for photos-artisanat-->
	<fly:list name="list">
	<b>Location: <a href="<fly:variable name='link' />"  target="_blank" /> <fly:variable name="location" /></a> </b><br />
		<img src="<fly:variable name='src_image' />" /><br /><br />
	</fly:list>
<!--end for photos-artisanat-->
<!--for logo or other-->
<fly:block name="image1">
	<b>Location: <a href="<fly:variable name='link' />" target="_blank"  ><fly:variable name="location1" /></a> </b><br />
      	<img src="<fly:variable name='src_image1' />" /><br /><br />	
</fly:block>
<fly:block name="pdf">
<b>Location: <a href="<fly:variable name='link' />" target="_blank"  ><fly:variable name="location2" /></a> </b><br />
 		<iframe src="<fly:variable name='url_pdf' />" frameborder="0" height="800" width="100%" scrolling="no" ></iframe>                       
</fly:block>
<!--end for logo or other-->
<fly:block name="block_nothing">
	No photo for this file
</fly:block>