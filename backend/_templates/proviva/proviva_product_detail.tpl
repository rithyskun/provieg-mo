<fly:include name="infodoc" />
<h1>Product</h1>
<dl class="detail">
	<dt>Language</dt>
	<dd><fly:variable name="language" /></dd>
	<dt>Visible</dt>
	<dd><fly:variable name="visible" /></dd>
	<dt>Price</dt>
	<dd><fly:variable name="price" /></dd>
	<dt>Title</dt>
	<dd><fly:variable name="title" /></dd>
	<dt>Description</dt>
	<dd><div style="width: 940px; word-wrap: break-word;" id="desc" name="desc"><fly:variable name="desc" /></div></dd>
</dl>
<fly:include name="submenu" />
<script type="text/javascript">
    $(function() {
        $('#table').tableFilter({ 
            imagePath: '<fly:variable name="rep_img" />',
            sortOnLoad: 0,
            stripeClass: 'impair',
            pageLength: 20
        });
    });
</script>