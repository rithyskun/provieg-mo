<form action="admin_user_info_modif.php?id=<fly:variable name='id_user'/>" method="post">
	<fieldset>
		<legend>Modify user Information</legend>
		<dl class="table-display">
			<dt>
				<label for="nickname">Nick name</label>
			</dt>
			<dd>
				<input type="text" name="nickname" id="nickname" size="53" maxlength="255" value="<fly:variable name='nickname' />" />
			</dd>
			<dt>
				<label for="first_name">First name</label>
			</dt>
			<dd>
				<input type="text" name="first_name" id="first_name" size="53" maxlength="255" value="<fly:variable name='first_name' />" />
			</dd>
			<dt>
				<label for="last_name">Last name</label>
			</dt>
			<dd>
				<input type="text" name="last_name" id="last_name" size="53" maxlength="255" value="<fly:variable name='last_name' />" />
			</dd>
			<dt>
				<label for="address1">Address 1</label>
			</dt>
			<dd>
				<input type="text" name="address1" id="address1" size="53" maxlength="255" value="<fly:variable name='address1' />" />
			</dd>
			<dt>
				<label for="address1">Address 2</label>
			</dt>
			<dd>
				<input type="text" name="address2" id="address2" size="53" maxlength="255" value="<fly:variable name='address2' />" />
			</dd>
			<dt>
				<label for="zipcode">Zip code</label>
			</dt>
			<dd>
				<input type="text" name="zip_code" id="zip_code" size="53" maxlength="255" value="<fly:variable name='zip_code' />" />
			</dd>
			<dt>
				<label for="city">City</label>
			</dt>
			<dd>
				<input type="text" name="city" id="city" size="53" maxlength="255" value="<fly:variable name='city' />" />
			</dd>
			<dt>
				<label for="country">Country</label>
			</dt>
			<dd>
				<select name="id_country" id="id_country">
					<option selected="true" value="">Please select country</option>
					<fly:list name="countries">
						<option value="<fly:variable name='id_country'/>" <fly:variable name='selected' />>
							<fly:variable name='country' />
						</option>
					</fly:list>
				</select>
			</dd>
			<dd></dd>
			<dd>
				<input type="submit" name="submit" value="Modify" class="bouton" />
			</dd>
		</dl>
	</fieldset>
</form>