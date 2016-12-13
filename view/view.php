<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
 <html lang="en">
 <head>
	 <title></title>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <link rel="stylesheet" href="" type="text/css"/>
 </head>
	 <body>
			<?php 
				print_r($hasil);
				echo "<hr>";
				var_dump($hasil);
				echo "<hr>";
				//print_r($tabel);
				foreach($hasil as $col => $value){
					echo $value['nama']." = ".$value['kelas']."<br>";
				}
				echo "<hr>";
				//print_r($model);
			?>
	 </body>
 </html>