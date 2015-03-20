<fly:include name="infodoc" />
<h1>Language</h1>
<dl class="detail">
	<dt>Visible</dt>
	<dd><fly:variable name="visible" /></dd>
	<dt>Language</dt>
	<dd><fly:variable name="language_name" /></dd>
	<dt>Language code</dt>
	<dd><fly:variable name="language_code" /></dd>
	<dt>Country code</dt>
	<dd><fly:variable name="country_code" /></dd>
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