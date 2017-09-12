/**
 * 
 */$(document).ready(function(){
	
       jQuery.validator.addMethod(
			   "regex",
			    function(value, element, regexp) {
			        if (regexp.constructor != RegExp)
			           regexp = new RegExp(regexp);
			        else if (regexp.global)
			           regexp.lastIndex = 0;
			           return this.optional(element) || regexp.test(value);
			    },"votre prix ne doit pas contenir des chiffres"
			 );
	   
	   jQuery.extend(jQuery.validator.messages, {
		    required: "votre champ est obligatoire",
		    remote: "votre message",
		    email: "votre message",
		    url: "votre message",
		    date: "votre message",
		    dateISO: "votre message",
		    number: "votre message",
		    digits: "votre message",
		    creditcard: "votre message",
		    equalTo: "votre message",
		    accept: "votre message",
		    maxlength: jQuery.validator.format("votre message {0} caractéres."),
		    minlength: jQuery.validator.format("votre message {0} caractéres."),
		    rangelength: jQuery.validator.format("votre message  entre {0} et {1} caractéres."),
		    range: jQuery.validator.format("votre message  entre {0} et {1}."),
		    max: jQuery.validator.format("votre message  inférieur ou égal à {0}."),
		    min: jQuery.validator.format("votre message  supérieur ou égal à {0}.")
		  });


$('#submit').click(function(){

	validateForm();
  
	 jQuery("#formStep").validate({
		   rules: {
			   "nom":{
		            "required": true,
		            "minlength": 2,
		            "maxlength": 60000
		            },
		         "description":{
			            "required": true,
			            "minlength": 2,
			            "maxlength": 60000
			         },
			     "prix":{
				            "required": true,
				            "minlength": 2,
				            "regex":/^[+-]?\d+(\.\d+)?$/
				         },
	              },
	  validClass: "success"
	   });
	

});


function validateForm(){

	
    var floatReg = /^[+-]?\d+(\.\d+)?$/;
    var nom = $('#nom').val();
    var prix = $('#prix').val();
    var inputVal = new Array(nom,prix);

        if(inputVal[0] == ""){
        	 $('#nom').css("border-color", "red");
        	 $('.alert').css("display", "none");
        	
           } 
        else
        {
       	 $('#nom').css("border-color", "green");
       	
          } 
       
  
        if(inputVal[1] == ""){
        	 $('#prix').css("border-color", "red");
        	 $('.alert').css("display", "none");
        	
            } 
        else if(!floatReg.test(prix)){
          	 $('#prix').css("border-color", "red");
          	 $('.alert').css("display", "none");
          
        }
        else
        {
        	 $('#prix').css("border-color", "green");
       	
          } 
       
        	

       

             
}   

});