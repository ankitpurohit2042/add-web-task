$('#addStudent').validate({
	rules :{
		name : {
			required : true,
		},
		grade : {
			required : true,
			lettersonly: true,
			// hasUppercase: true
		},
		image: {
			required: true,
			accept:"jpg,png,jpeg"
			// accept: "jpg|jpeg|png"
		},
		dob: {
			required : true,
	        date : true,
	        // dateITA : true,
		},
		address: {
			required: true
		},
		country:{
			required: true
		},
		state:{
			required: true
		},
		city:{
			required: true
		}
	},
	messages : {
		name : {
			required : "Name is required.",
		},
		grade : {
			required : "Grade is required",
			size: 'Enter valid grade',
			// hasUppercase: 'an'
		},
		image: {
			required: 'Please upload image',
			accept : "Only image type jpg/png/jpeg is allowed"
		},
		dob: {
			required: 'Date of birth is required'
		},
		address: {
			required: "Enter your address."
		},
		country:{
			required: 'Select your country'
		},
		state:{
			required: 'Select your state'
		},
		city:{
			required: 'Select your city'
		}
	},
	submitHandler: function(form) {
        form.submit();
    }
});