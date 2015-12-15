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
	defaultValue : "example@domain.com",
	onclick:function(){
		console.log(oojsmvc.SubmitModule.curr_instance.id);
	},
};
document.getElementById('email').addEventListener(oojsmvc.OnClickListener.event,function(){
	oojsmvc.OnClickListener.eventHandler(oojsmvc.EmailModule);
});oojsmvc.SubmitModule = 
{
	curr_instance: document.getElementById('submit'),
	id : "submit",
	onclick:function(){
		console.log(oojsmvc.EmailModule.curr_instance.value);
	},
};
document.getElementById('submit').addEventListener(oojsmvc.OnClickListener.event,function(){
	oojsmvc.OnClickListener.eventHandler(oojsmvc.SubmitModule);
});
});

})();
