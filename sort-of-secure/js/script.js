/*javascript for my sort of secrue sight*/
//alert ("hello");
var firstPass = document.getElementById('password_one'); 
var secondPass = document.getElementById('password_two');
	function validate()
	{
		if(firstPass.value == secondPass.value)
		{
			document.getElementById('message').style.color = 'black';
			document.getElementById('message').innerHTML = 'passwords match';
			//if the passwords match allow submit to be clickable 
				document.getElementById('subbutton').disabled = false;
		}
		else
		{
			document.getElementById('message').style.color = 'white'; 
			document.getElementById('message').innerHTML = 'passwords do not match';
			//if the passwords don't match disable create account 
				document.getElementById('subbutton').disabled = true;
		}
	}