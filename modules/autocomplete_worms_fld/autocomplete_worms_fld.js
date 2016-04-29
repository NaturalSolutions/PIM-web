/*
function splitWormsAutocomplete(input) {
	//alert(input.name);
	//alert(input.value);
	
   setTimeout(function () {
			var empName =input.value;
			 var empArray = empName.split("|");
   		//alert(empArray.length);
   		if (  empArray.length ==2 ) {
   			input.value = empArray[1];
   			var lsid_name = input.name.replace('[worms_name]', '[worms_lsid]');
   			document.getElementsByName(lsid_name)[0].value = empArray[0];
   		}
	}, 50);
  
   
}*/
