<?php
	$date=date("d.m");
	$ip=$_SERVER["REMOTE_ADDR"];
	$file1="ip".$str.".txt";
	$file2="count".$str.".txt";
	if(!file_exists($file2))
	{
		$total=1;
		$today=1;
		$ipkol=1;
		$count=$total."\n".$date."\n".$today;
		
		$chek=fopen($file2,"w+");
		fwrite($chek, $count);
		fclose($chek);
		$ip2=fopen($file1,"w+");
		fwrite($ip2, $ip."\n");
		fclose($ip2);
	}
	else
	{
		$file=file($file2);
		foreach($file as $stroka) $mass[]=$stroka;
		$total=(int)$mass[0];
		$data2=(float)$mass[1];
		$today=(int)$mass[2];
		$total+=1;
		if($data2!=$date) $today=1;
		else $today+=1;
		
		$count2=$total."\n".$date."\n".$today;
		$chek=fopen($file2,"w+");
		flock($chek, LOCK_EX);
		fwrite($chek, $count2);
		flock($chek, LOCK_UN);
		fclose($chek);
		$ip2=file($file1);
		$ipkol=count($ip2);
		if(in_array($ip."\n", $ip2)==false)
		{
			$ipopen=fopen($file1,"a");
			flock($ipopen, LOCK_EX);
			fwrite($ipopen, $ip."\n");
			flock($ipopen, LOCK_UN);
			$ipopen+=1;
			fclose($ipopen);
		}
	}
?>