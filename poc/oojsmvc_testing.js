(function(){

	window.oojsmvc = new (function oojsmvc(){
		this.version = "1.0.0";
	})();

	// oojsmvc.EmailModule = function(){
	// 	this.moduleName = "email";
	// }
	oojsmvc.EmailModule = {
		moduleName : "email"
	}
	// var o = new oojsmvc();
	// console.log(new oojsmvc.EmailModule());
})();
// console.log(window.oojsmvc);


	// function loadClass(class_data){
	// 	var class_name = class_data.substring(6, class_data.indexOf("{"));
	// 	var property_name = "id";
	// 	console.log("loading class:"+class_name);

	// 	window[class_name] = new Object();
	// 	window[class_name].id = "email";
	// 	// var test = new window[class_name];
	// 	console.log(window[class_name]);
	// }
	
	// function require(filename){
	// 	var xhttp = new XMLHttpRequest();
 //  		xhttp.onreadystatechange = function() {
	// 		if (xhttp.readyState == 4 && xhttp.status == 200) {
	// 	  		loadClass(xhttp.responseText);
	// 		}
 //  		};
	// 	xhttp.open("GET", filename, true);
	// 	xhttp.send();
	// }
	// require("Model/EmailModel.js");
//	var file_content = "Class Person{var id;function getId(){return this.id;}}";

	//string uncompressed
	// Person = function(){
	// 	this.id = 0;
	// 	this.getId = function(){
	// 		return this.id;
	// 	}
	// }
	// var person = new Person();
	// person.id = 12;
	// console.log(person.getId());

	// //string compressed
	// a=function(){this.aa=0;this.ab=function(){return this.aa;}};var b=new a();b.aa=12;
	// console.log(b.ab());
