<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
 <html lang="en">
 <head>
	 <title></title>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <link rel="stylesheet" href="" type="text/css"/>
 </head>
	 <body>
			<script type="text/javascript">
      //function ambil(){
      var xhr = new XMLHttpRequest();
      var data=[];
      xhr.onreadystatechange =function(){
        if(this.readyState === 4 && this.status === 200){
           data = JSON.parse(this.responseText);
        }
      };
      xhr.open("GET","localhost/carNA",true);
      xhr.send();
      
      //return data;
      //}
      //var data = [{"nama":"nsma","kelas":"ndat "},{"nama":"nursan","kelas":"XII TKJ 2"},{"nama":"ina","kelas":"XII TKJ "},{"nama":"rahmat","kelas":"XII TKJ 1"}];
      console.log(data);
			</script>
      <ul id="ul">

      </ul>
	 </body>
 </html>
