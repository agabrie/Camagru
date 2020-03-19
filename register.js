let fname = document.getElementById('fname');
	let lname = document.getElementById('lname');
	let uname = document.getElementById('username');
	let email = document.getElementById('email');
	let passwrd = document.getElementById('passwrd');
	let valid_passwrd = document.getElementById('valid_passwrd');
	var proceed = false;
	var errIndex=["",
		"No First NAME",
		"No Last NAME",
		"USERNAME already exists",
		"No USERNAME",
		"email already in use",
		"No Email",
		"No Password",
		"Password not Strong Enough:<br>Your password must contain Uppercase, Lowercase and digits and must be at least 8 characters long",
		"Passwords dont match",
		"You cannot use special characters in fname",
		"You cannot use special characters in lname",
		"You cannot use special characters in username",
		"invalid format for email address",
		"first name too short",
		"last name too short",
		"username too short"
	]
	var submit = document.getElementById('reg');
	fname.addEventListener('input', function(){
		let errlbl = document.getElementById(`err_${this.name}`);
		let name = this.value;
		let message = errIndex[testFName(name)];
		if(message === ""){
			errlbl.style.display = 'none';
			submit.disabled = false;
			// proceed = true;
		}
		else{
			errlbl.style.display = 'block'
			submit.disabled = true;
		};
		errlbl.innerHTML = message;
	});

	lname.addEventListener('input', function(){
		let errlbl = document.getElementById(`err_${this.name}`);
		let name = this.value;
		let message = errIndex[testLName(name)];
		if(message === ""){
			errlbl.style.display = 'none';
			proceed = true;
		}
		else{
			errlbl.style.display = 'block'
			proceed = false;
		};
		errlbl.innerHTML = message;
	});
	username.addEventListener('input', function(){
		let errlbl = document.getElementById(`err_${this.name}`);
		let name = this.value;
		let message = errIndex[testUName(name)];
		if(message === ""){
			errlbl.style.display = 'none';
			proceed = true;
		}
		else{
			errlbl.style.display = 'block'
			proceed = false;
		};
		errlbl.innerHTML = message;
	});
	email.addEventListener('input', function(){
		let errlbl = document.getElementById(`err_${this.name}`);
		let name = this.value;
		let message = errIndex[testEmail(name)];
		if(message === ""){
			errlbl.style.display = 'none';
			proceed = true;
		}
		else{
			errlbl.style.display = 'block'
			proceed = false;
		};
		errlbl.innerHTML = message;
	});
	passwrd.addEventListener('input', function(){
		let errlbl = document.getElementById(`err_${this.name}`);
		let name = this.value;
		let message = errIndex[testPassword(name)];
		if(message === ""){
			errlbl.style.display = 'none';
			proceed = true;
		}
		else{
			errlbl.style.display = 'block'
			proceed = false;
		};
		errlbl.innerHTML = message;
	});
	valid_passwrd.addEventListener('input', function(){
		let errlbl = document.getElementById(`err_${this.name}`);
		let name = this.value;
		let message = errIndex[testValidPassword(name,passwrd.value)];
		if(message === ""){
			errlbl.style.display = 'none';
			proceed = true;
		}
		else{
			errlbl.style.display = 'block'
			proceed = false;
		};
		errlbl.innerHTML = message;
	});
	function testFName(name){
		let err = 0;
		let patt = /[^\w-_]+/
		if(name.length<3)
			err = 14;
		let spc = name.match(patt);
		if(spc !== null)
			err = 10;
		// console.log(name);
		return( err);
	}
	function testLName(name){
		let err = 0;
		let patt = /[^\w-_]+/
		if(name.length<3)
			err = 15;
		let spc = name.match(patt);
		if(spc !== null)
			err = 11;
		// console.log(name);
		return( err);
	}function testUName(name){
		let err = 0;
		let patt = /[^\w-_]+/
		if(name.length<3)
			err = 16;
		let spc = name.match(patt);
		if(spc !== null)
			err = 12;
		console.log(spc);
		return( err);
	}
	function testEmail(name){
		let err = 0;
		let patt = /^[\w.]+[\w+-][0-9]+@[\w.]+.[\w]{2}/
		if(name.length==0)
			err = 6;
		let spc = name.match(patt);
		if(spc === null)
			err = 13;
		// console.log(name,spc);
		return( err);
	}
	function testPassword(name){
		let err = 0;
		let patt = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/
		if(name.length==0)
			err = 7;
		let spc = name.match(patt);
		if(spc === null)
			err = 8;
		console.log(name,spc);
		return( err);
	}
	function testValidPassword(name,vname){
		let err = 0;
		if(name !== vname)
			err = 9;
		return(err);
	}