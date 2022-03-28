<form name="frmEntry" action="" method="post">
<table cellspacing="0" cellpadding="0" width="700px" align="center" border="1" bordercolor="black" class='page'>
	<tr>
		<td align="center" class="text">
			<blockquote>
			<br />
			If you are already registered to use this tool, you may login at anytime.
			<p />
			</blockquote>
			<table cellspacing="0" cellpadding="1">
				<tr>
					<td class="text" align="right">
						&nbsp;&nbsp;&nbsp;&nbsp;Username
					</td>
					<td align="left">
						<input type="Text" name="txtUsername" id="txtUsername" maxsize="30" size="12">
					</td>
				</tr>
				<tr>
					<td class="text" align="right">
						&nbsp;&nbsp;&nbsp;&nbsp;Password
					</td>
					<td>
						<input name="txtPassword" type="password" id="txtPassword" maxsize="30" size="12">
						<input type="Submit" name="btnSubmit" value="Login" class='button' onClick="javascript: frmEntry.action='';frmEntry.submit();">
					</td>
				</tr>
			</table>
			<?php
				if($_SESSION["logon"] == "I") echo("<p align='center'><span class='error'>ERROR - Invalid Password!</span>");
			?>
			<blockquote>
			<hr size="1" color="black" width="75%" />
			<p>If you would like to register to use this tool,<br />please send an e-mail to <a href="mailto:kstennant@cableone.net" class="email">kstennant@cableone.net</a><br />with a <strong>username</strong>, <strong>password</strong>, and <strong>contact information</strong>.
			<!--<p />To change your password, <a href="index.php?page=change" class="email">click here</a>.<p />The registration will be completed upon approval.-->
			</blockquote>
		</td>
	</tr>
	<tr height="25">
		<td class="updated" align="center" colspan="2" bgcolor="#ECECEC">
			Webmaster and Design by <a href="mailto:kstennant@cableone.net" class="email">Ken Tennant</a>
		</td>
	</tr>

</table>
</form>