(function(){

window.oojsmvc = new (function oojsmvc(){
	this.version = "1.0.0";
})();

window.addEventListener("load", function(){
	oojsmvc.EmailModule = new (function(){
		this.element = document.getElementById('email');
		this.onChange = function(event){
			console.log(this.__proto__.constructor.name);
		}
	})();

	oojsmvc.EmailModule.element.addEventListener("change", oojsmvc.EmailModule.onChange);
});

})();
