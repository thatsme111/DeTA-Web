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
oojsmvc.EmailModule = 
{
	curr_instance: document.getElementById('email'),
	id : "email",

	EmailModule:function(){
		this.curr_instance.value = "example@domain.com";
	},
	onclick:function(){
		console.log(oojsmvc.SubmitModule.curr_instance.id);
	},







};
oojsmvc.EmailModule.EmailModule();
oojsmvc.SubmitModule = 
{
	curr_instance: document.getElementById('submit'),
	id : "submit",
	SubmitModule:function(){
		console.log(oojsmvc.EmailModule.curr_instance.value);




	},
	onclick:function(){
		console.log(this.curr_instance.value);
	},
};
oojsmvc.SubmitModule.SubmitModule();

document.getElementById('submit').addEventListener(oojsmvc.OnClickListener.event,function(){
	oojsmvc.OnClickListener.eventHandler(oojsmvc.SubmitModule);
});
});

})();
