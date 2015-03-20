			<div id="page">
                <fly:block name="message">
                <div id="login-message" class="<fly:variable name='class_message'/>">
    				<fly:variable name="message" />
    			</div>
    			</fly:block>
    			<div id="login-page">
    				<div id="login-form">
    					<h1>Login</h1>
    					<form method="post">
    						<p>
    							<label for="user">Login</label>
    							<input type="text" name="user" id="user" />
    						</p>
    						<p>
    							<label for="pass">Password</label>
    							<input autocomplete="off" type="password" name="pass" id="pass" />
    						</p>
    						<p class="bouton">
    							<input type="submit" value="Sign in" class="bouton" />
    						</p>
    					</form>
    				</div>
    				<div id="login-text">
    					<img src="<fly:variable name='rep_img' />security.png" />
    					<p>Welcome to ProVIVA Global</p>
    					<p>Thank you to authenticate to access all the services offered.</p>
    				</div>
    				<div class="clear"></div>
    			</div>
    			<script language="JavaScript" type="text/javascript">
    				$(document).ready(function() {
                        $('#user').focus();
                    });
    			</script>
            </div>
