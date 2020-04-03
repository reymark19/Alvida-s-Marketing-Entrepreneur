// Wait for the DOM to be ready
//AUTHOR: NINO ALCUINO
//Dont forget, Form must have name but it must be unique
//Features:
//Validate the inputs
//add attribute in input to validate: validate="TYPE" min="number" max="number" required="true"
//TYPE = "lettersonly","alphanumeric","number","password","email","contact"

jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z_ -]+$/i.test(value);
}, "Only alphabetical characters");

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[,;a-zA-Z0-9()"'._ /%-]+$/i.test(value);
}, "Only alphanumeric characters");

$.validator.addMethod("loginRegex", function(value, element) {
    return this.optional(element) || /^[,;a-zA-Z0-9_-]+$/i.test(value);
}, "Username must contain only letters, numbers, or dashes.");

$.validator.addMethod("contact", function(value, element) {
    return this.optional(element) || /^[+]+$/i.test(value);
}, "Error");

function validate(form){
  var isExist = $(form).val();
  if(isExist != undefined){
    var formName = $(form).attr('name');
    console.log(formName + ' has been validated');
    //alert(formName);
    //First we need to add class "validate" each input that is not hidden
    $("form[name='"+formName+"'] input").not('.datepicker').each(function(){
        $(this).addClass('validate');
    });
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='"+formName+"']").validate({
      // Specify validation rules
      //validate hidden fields like select but MUST HAVE a validate class (ignore all inputs except .validate class)
      ignore: ":not(.validate)", 
      errorElement : 'div',
          errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
              $(placement).append(error)
            } else {
              error.insertAfter(element);
            }
          },
      errorClass: 'error errorlabel',
      highlight: function(element) {
          $(element).parent('div').removeClass('valid').addClass('invalid');;
      },
      unhighlight: function(element) {
          $(element).parent('div').removeClass('invalid').addClass('valid');
      }
    });

    $("form[name='"+formName+"'] input[minlenth]").each(function(){
        if($(this).attr('minlenth') != undefined){
          $(this).rules( "add", {
              minlength: $(this).attr('minlenth')
          });
        }
    });

    $("form[name='"+formName+"'] input[maxlength]").each(function(){
        if($(this).attr('maxlength') != undefined){
          $(this).rules( "add", {
              maxlength: $(this).attr('maxlength')
          });
        }
    });

    $("form[name='"+formName+"'] select.validate").each(function(){
        $(this).rules( "add", {
            required: true
        });
    });

    $("form[name='"+formName+"'] input[validate]").each(function(){
        if($(this).attr('validate') != undefined){
          if($(this).attr('validate') == 'alphanumeric'){
             $(this).rules( "add", {
                  alphanumeric: true
              });
          }
          else if($(this).attr('validate') == 'lettersonly'){
             $(this).rules( "add", {
                  lettersonly: true
              });
          }
          else if($(this).attr('validate') == 'number'){
             $(this).rules( "add", {
                  number: true
              });
          }
          else if($(this).attr('validate') == 'contact'){
             $(this).rules( "add", {
                number: true,
                contact: true
              });
          }
          else if($(this).attr('validate') == 'email'){
             $(this).rules( "add", {
                required: true,
                email: true
              });
          }
          else if($(this).attr('validate') == 'password'){
             $(this).rules( "add", {
                required: true
              });
          }
          else{
            console.log('validate type '+$(this).attr('validate')+' not found');
          }
        }
        else{
          console.log('validate type is undefined');
        }
    });

    $("form[name='"+formName+"'] input[required='true']").each(function(){
        $(this).rules( "add", {
            required: true
        });
    });

  }
  else{
      console.log('validate this '+form+' not found on this UI');
    }
}


//validate image here
function validateImage(image){
  $(image).on('change', function() {
       var file = this.files[0];
       if (file.size > (625000 * 3)) {
        Materialize.toast('Upload size exceed to 15mb', 3000, 'rounded red');
       }
       else{
         $('#btnUpload').removeClass('disabled');
         $('#btnUploadImages').removeClass('disabled');
       }
  });
}

//AutoValidate Every Form Initialization
$("form").each(function(){
  validate($(this));
  //console.log($(this));
});

//created this 011718 by NINO
//force the input that only text was inputted
//8 means backspace
//32 means space
function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key == 9 || key == 32);
};
//created this 011718 by NINO
//force the input that only number was inputted
//8 means backspace
function numberOnly(event) {
  var key = event.keyCode;
  return ((key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 8 || key == 9);
};