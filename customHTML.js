function customTag(tagName,fn){
	document.createElement(tagName);
	//find all the tags occurrences (instances) in the document
	var tagInstances = document.getElementsByTagName(tagName);
  //for each occurrence run the associated function
  for ( var i = 0; i < tagInstances.length; i++) {
	  fn(tagInstances[i]);
  }
}

function inputField(element){
  if (element.attributes.text && element.attributes.name){
	  var text = element.attributes.text.value;
	  var name = element.attributes.name.value;
	  element.innerHTML = "<label for="+name+">"+text+":</label><br>"+
	  "<input type='text' name="+name+" value='' id="+name+" required/><br>"+
	  "<label class='errordiv' id='err_"+name+"' hidden></label><br>";
	  console.log(element);
	  
  }
}
customTag("inputField",inputField);

// var btn = document.getElementById('reg');
// 	var err = document.getElementById('errordiv');
// 	alert(data);
// 	if(err.value !== "No errors")
// 		err.removeAttribute('hidden');
// 	console.log(err,reg);
// 	// btn.addEventListener('click', function(){
//     //     err.removeAttribute('hidden');
//     // });
// 	function showError(err){
// 		console.log(err)
// 	}