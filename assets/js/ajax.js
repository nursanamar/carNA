function ambil(){
var xhr = new XMLHttpRequest();
var data;
xhr.onreadystatechange =function(){
	if(this.readyState === 4 && this.status === 200){
		 data = JSON.parse(this.responseText);
	}
};
xhr.open("GET","localhost/carNa",true);
xhr.send();
return data;
}