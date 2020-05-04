var userId;
var userPass;
var helpText;

// Get the modal

    function init()
    {
        var myForm = document.getElementById("myForm");
        userId = document.getElementById("id");
        userPass = document.getElementById("userpass");
        
        helpText = document.getElementById("helpText");
        myForm.onsubmit = check;
		myForm.onreset = func2;
    } // end function init
    
	function check()
    {
        var pass = "";
        
		if (userId.value == "")
            pass = "Please enter your ID.<br/>";
        else if (!userId.value.match(/[1-3]{1}/))
            pass = "ID should be one Number only.<br/>";
        
		if (userPass.value == "")
            pass = pass + "Please enter your Password.<br/>";
    		
		if (pass != "")
        {
            helpText.innerHTML = pass;
            helpText.style.backgroundColor = "yellow";
            return false;
        } 
		else
            return true;
    }
    
	function func2()
    {
        return confirm("Are you sure you want to cancel?");
    }
	
    window.addEventListener("load", init, false);