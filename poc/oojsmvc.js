(function(){

window.oojsmvc = new (function oojsmvc(){
	this.version = "1.0.0";
})();

oojsmvc.EmailModule = {
	id : "email",
	defaultValue : "example@domain.com",
	onclick:function(){
		console.log(this.value);
	},
	onchange:function(){
		console.log(this.value);
	},
}
})();
