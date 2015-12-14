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

oojsmvc.EmailModule = {
	curr_instance: document.getElementById('email'),
	id : "email",
	defaultValue : "example@domain.com",
	onclick:function(){
		console.log(this.curr_instance.value);
	},
}
document.getElementById('email').addEventListener(oojsmvc.OnClickListener.event,function(){
	oojsmvc.OnClickListener.eventHandler(oojsmvc.EmailModule);
});

});

})();
