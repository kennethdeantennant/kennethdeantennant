<form name='frmView' action='' method='post'>

<table width='800' cellpadding='10' cellspacing='0' color='black' align='center' class='page'>

	<tr>

		<td colspan='2' class='heading' align='center' height='600' valign='top'>

			<table width='800' cellpadding='10' cellspacing='0' color='black' align='center'>

				<tr>

					<td valign='top'>

						<table cellspacing='0' cellpadding='0' width='100%'>

							<tr>

								<td>

									<span class='heading'>My Personal Journal</span>

								</td>

								<td align='right'>

									<a href="index.php?page=view"><img src="images/return.gif" alt="Return" border="0"></a></td>

							</tr>

							<tr>

								<td class="data" colspan="2" align="center">

									<hr size='1' color='black'>

									<strong>View Entries by Year and Month</strong><p />

									<?php

										$year=$_GET["year"];

										$print=$_GET["print"];

										$prior=$year-1;

										$next=$year+1;

										$current=date("Y");

										print("<a href='index.php?page=view&print=$print&year=$prior' class='yearLink' title='Prior Year'>&lt&lt</a>&nbsp;<a href='index.php?page=view&print=$print&year=$current' class='yearLink'>Current Year</a>&nbsp;<a href='index.php?page=view&print=$print&year=$next' class='yearLink' title='Next Year'>&gt&gt</a>");

									?>

									<hr size='1' color='black'>

								</td>

							</tr>

						</table>

						<table cellspacing="0" cellpadding="5" align="center" width="100%">

							<tr>

								<td align="center" height="225" valign="top">

									<?php

										BuildCalendar(1,$year,$user->getId());

									?>

								</td>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(2,$year,$user->getId()); ?>

								</td>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(3,$year,$user->getId()); ?>

								</td>

							</tr>

							<tr>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(4,$year,$user->getId()); ?>

								</td>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(5,$year,$user->getId()); ?>

								</td>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(6,$year,$user->getId()); ?>

								</td>

							</tr>

							<tr>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(7,$year,$user->getId()); ?>

								</td>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(8,$year,$user->getId()); ?>

								</td>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(9,$year,$user->getId()); ?>

								</td>

							</tr>

							<tr>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(10,$year,$user->getId()); ?>

								</td>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(11,$year,$user->getId()); ?>

								</td>

								<td align="center" height="225" valign="top">

									<?php BuildCalendar(12,$year,$user->getId()); ?>

								</td>

							</tr>

						</table>

					</td>

				</tr>

			</table>

		</td>

	</tr>

</table>

</form>