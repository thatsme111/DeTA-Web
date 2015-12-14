(function(){

window.oojsmvc = new (function oojsmvc(){
	this.version = "1.0.0";
})();

oojsmvc.OnClickListener = {
	event: "click",
	eventHandler: function(module){
		module.onclick();
	},
};

window.addEventListener("load", function(){

//::generated code::

});

})();
