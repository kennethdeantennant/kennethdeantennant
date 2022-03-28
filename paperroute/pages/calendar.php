<?php
	$daily = new Daily();
	$other = new Other();

	function cellColor($recorded)
	{
		$color="white";
		if ($recorded=="yes") $color = "#EAEAEA";
		return $color;
	}
?>
<form name="frmEntry" action="index.php?page=logout" method="post">
<div class="smallText" align="center"><?php echo($user->getName()); ?>&nbsp;(not you, <a href="javascript: frmEntry.submit();" class="smallLink">logout</a>)</div><br />
<table align="center" width="100%" >
    <tr>
        <td align="center">
            <?php 
                $firstDay=date("Y-m-d", strtotime(date('m').'/01/'.date('Y').' 00:00:00'));
                $begDate=$firstDay;
                if(isset($_GET["month"])) $begDate = $_GET["month"];
                $month = substr($begDate,5,2);
                $year = substr($begDate,0,4);
                // Build Top of Calendar
            ?>
            <table width='810' cellspacing='0' cellpadding='2' bgcolor='white' border='1'>
                <tr>
                    <td align='center' bgColor='gainsboro' valign='top' class='calendarHeader'><a href='index.php?month=<?php echo(date("Y-m-d",strtotime(date("Y-m-d", strtotime($begDate)) . " -1 month"))) ?>' class='nextMonth'>&lt;&lt;</a>&nbsp;<?php echo(date("F Y", mktime(0,0,0,$month,1,$year))) ?>&nbsp;<a href='index.php?month=<?php echo(date("Y-m-d",strtotime(date("Y-m-d", strtotime($begDate)) . " +1 month"))); ?>' class='nextMonth'>&gt;&gt;</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width='810' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td>
                                    <table width='810' cellspacing='0' cellpadding='0' border='1'>
                                        <tr bgcolor='navy'>
                                            <td align='center' width='100'>
                                                <span style='font-family: Comic Sans MS; font-size: 16pt; color: white;'>Sun</span>
                                            </td>
                                            <td align='center' width='100'>
                                                <span style='font-family: Comic Sans MS; font-size: 16pt; color: white;'>Mon</span>
                                            </td>
                                            <td align='center' width='100'>
                                                <span style='font-family: Comic Sans MS; font-size: 16pt; color: white;'>Tue</span>
                                            </td>
                                            <td align='center' width='100'>
                                                <span style='font-family: Comic Sans MS; font-size: 16pt; color: white;'>Wed</span>
                                            </td>
                                            <td align='center' width='100'>
                                                <span style='font-family: Comic Sans MS; font-size: 16pt; color: white;'>Thu</span>
                                            </td>
                                            <td align='center' width='100'>
                                                <span style='font-family: Comic Sans MS; font-size: 16pt; color: white;'>Fri</span>
                                            </td>
                                            <td align='center' width='100'>
                                                <span style='font-family: Comic Sans MS; font-size: 16pt; color: white;'>Sat</span>
                                            </td>
                                        </tr>
                                        <tr height='75' valign='top'>
                                        <?php 
                                            // Build Blank Spaces
                                            $day=date("w", mktime(0,0,0,$month,1,$year));
                                            if($day>0)
                                            {
                                        ?>
                                            <td colspan='<?php echo($day) ?>'></td>
                                        <?php
                                                $day+=1;
                                            }
                                            else
                                            {
                                                $day=1;
                                            }
                                            // Build Days
                                            $calcDay=0;
                                            $createdDate=date("Y-m-d", mktime(0,0,0,$month,1,$year));
                                            $totalAmount = 0;
                                            for ($day=$day; $day<=date("t", mktime(0,0,0,$month,1,$year))+date("w", mktime(0,0,0,$month,1,$year)); $day++)
                                            {
                                                $calcDay++;
                                                $createdDate=date("Y-m-d", mktime(0,0,0,substr($createdDate,5,2),$calcDay,substr($createdDate,0,4)));
                                                $amount = $daily->getAmountTotal($createdDate) + $other->getAmountTotal($createdDate);
												$count = $daily->getCountTotal($createdDate) + $other->getCountTotal($createdDate);
                                                if($createdDate<date("Y-m-d"))
                                                {
                                        ?>
                                            <td height='75' bgColor='<?php echo(call_user_func('cellColor',"yes")) ?>' class='day' align='right' valign='top'>
                                                    <a href='index.php?page=day&date=<?php echo($createdDate) ?>' class='mainLink'><?php echo($calcDay) ?></a><br /><?php echo($count."-$".number_format($amount,2,'.','')) ?>
                                            </td>
                                        <?php 	}elseif($createdDate==date("Y-m-d")){	?>
                                            <td height='75' bgColor='<?php echo(call_user_func('cellColor',"no")) ?>' class='day' align='right' style='color: green;' valign='top'>
                                                    <a href='index.php?page=day&date=<?php echo($createdDate) ?>' class='mainLink'><?php echo($calcDay) ?></a><br /><span style='color: black;'><?php echo($count."-$".number_format($amount,2,'.','')) ?></span>
                                            </td>
                                        <?php 	}else{	?>
                                            <td height='75' bgColor='<?php echo(call_user_func('cellColor',"no")) ?>' class='day' align='right' valign='top'>
                                        <?php echo($calcDay) ?>
                                            </td>
                                        <?php
                                                }
                                                if ($day%7==0 && $day!=0)
                                                {
                                        ?>
                                        </tr>
                                        <tr height='20'>
                                        <?php
                                                }
                                                $totalAmount += $amount;
												$totalCount += $count;
                                            }
                                            $day=8-date("w", mktime(0,0,0,substr($createdDate,5,2),substr($createdDate,7,2),substr($createdDate,0,4)));
											if($day > 0)
											{
                                        ?>
                                            <td colspan='<?php echo($day) ?>' align='center' class='day'>
                                                <?php echo($totalCount."-$".number_format($totalAmount,2,'.','')) ?>
                                            </td>
                                        </tr>
                                        <?php
											}else{
                                        ?>
                                        </tr>
                                        <tr height='20'>
                                            <td colspan='<?php echo($day) ?>' align='center' class='day'>
                                                <?php echo($totalCount."-$".number_format($totalAmount,2,'.','')) ?>
                                            </td>
                                        </tr>
                                        <?php
											}
                                        ?>
                                    </table>
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