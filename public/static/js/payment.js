function get(){
	var value1='';
	var radio=document.getElementsByName("bank");
	for(var i=0;i<radio.length;i++)
	{
		if(radio[i].checked == true && radio[i].value<2)
		{
			window.location.href="pay-fail.html";
			value1=radio[i].value;
			
			break;
		}
		else{
			window.location.href="pay-success.html";
		}
	}
	
}
