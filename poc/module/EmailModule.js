Class EmailModule extends FormModule implements OnClickListener{
	var id = "email";

	function EmailModule(){
		this.value = "example@domain.com";
	}
	function onclick(){
		console.log(SubmitModule.id);
	}
	// function isValid(){
	// 	atpos = this.value.indexOf("@");
	// 	dotpos = this.value.lastIndexOf(".");
	// 	if (atpos < 1 || ( dotpos - atpos < 2 ))
	// 		return false;
	// 	return true;
	// }
}