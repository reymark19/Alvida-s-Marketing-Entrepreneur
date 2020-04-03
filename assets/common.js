

  

$(document).ready(function(){



      carousel('.banner');
    
});

// // Select all links with hashes
//     $('a[href*="#"]')
//       // Remove links that don't actually link to anything
//       .not('[href="#"]')
//       .not('[href="#0"]')
//       .click(function(event) {
//         // On-page links
//         if (
//           location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
//           && 
//           location.hostname == this.hostname
//         ) {
//           // Figure out element to scroll to
//           var target = $(this.hash);
//           target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
//           // Does a scroll target exist?
//           if (target.length) {
//             // Only prevent default if animation is actually gonna happen
//             event.preventDefault();
//             $('html, body').animate({
//               scrollTop: target.offset().top
//             }, 1000, function() {
//               // Callback after animation
//               // Must change focus!
//               var $target = $(target);
//               $target.focus();
//               if ($target.is(":focus")) { // Checking if the target was focused
//                 return false;
//               } else {
//                 $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
//                 $target.focus(); // Set focus again
//               };
//             });
//           }
//         }
//       });

function carousel(selector){
  var curSlides = 1;
  var totalSlides = 0;

  //get the total slides
    $(selector).each(function(){
      totalSlides++;
    });
    //console.log('totalSlides ' + totalSlides);

  //set interval by 3secs
  setInterval(function(){ 
    //add variable for the counter of each
    //deffer to currSlides
    var cnt = 1;
    $(selector).each(function(){
      //First condition is when the current slides is same as the counter of each then initiate
      if(cnt == curSlides && totalSlides != curSlides){
        $(this).css('opacity',1);
      }
      //if the reach in last slide then reset the curSlides
      else if(cnt == curSlides && totalSlides == curSlides){
        $(this).css('opacity',1);
        curSlides = 1;
      }
      else if(cnt == totalSlides){
        $(this).css('opacity',0); 
        //add 1 for the next slide counter
        curSlides++;

      }
      //if the CurSlides in not equal to the Counter of each
      else{
        $(this).css('opacity',0);     
      }
      //console.log('cnt ' + cnt + ' curSlides ' + curSlides);
      cnt++;

    });

  }, 5000);
}

function addDialog(diag,button){
  var dialog = document.querySelector(diag);
    var showDialogButton = $(button);
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }

      //console.log(dialog);
    showDialogButton.click(function(){
      try {
      dialog.showModal();
      }
      catch(err) {
        //console.log(err);
      }
      
      //erase 
      $(dialog).find('form')[0].reset();
      //CKEDITOR.instances['description'].setData('');
      $(diag + ' form .is-invalid').each(function(){
        $(this).removeClass('is-invalid');
        $(this).removeClass('is-dirty');
      });
      //change the title
      $(dialog).find('.modal-title').html($(this).attr('data-title'));
      $(dialog).find('form').attr('action',$(this).attr('data-url'));

    });
    dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });
}

function success(msg){
  var snackbarContainer = document.querySelector('.mdl-snackbar');
  //var showToastButton = document.querySelector('#demo-show-toast');
  $('.mdl-snackbar').addClass('success');
  $('.mdl-snackbar').removeClass('error');
  $('.mdl-snackbar').removeClass('warning');
  var data = {
    message: msg,
    timeout: 900
  };
  snackbarContainer.MaterialSnackbar.showSnackbar(data);
}
function error(msg){
  var snackbarContainer = document.querySelector('.mdl-snackbar');
  //var showToastButton = document.querySelector('#demo-show-toast');
  $('.mdl-snackbar').removeClass('success');
  $('.mdl-snackbar').addClass('error');
  $('.mdl-snackbar').removeClass('warning');
  var data = {
    message: msg,
    timeout: 3000
  };
  snackbarContainer.MaterialSnackbar.showSnackbar(data);
}
function warning(msg){
  var snackbarContainer = document.querySelector('.mdl-snackbar');
  //var showToastButton = document.querySelector('#demo-show-toast');
  $('.mdl-snackbar').removeClass('success');
  $('.mdl-snackbar').removeClass('error');
  $('.mdl-snackbar').addClass('warning');
  var data = {
    message: msg,
    timeout: 3000
  };
  snackbarContainer.MaterialSnackbar.showSnackbar(data);
}

function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Byte';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
};

  //NINO

  //Uses: add this when closing a modal to have additional functionality

  //To Remove value in inputs, remove validation and reset table(optional)

  function modalCloseAndReset(table){

    $('.modal').find('input').removeClass('valid');

    $('.modal').find('.input-field').removeClass('valid');

    $('.modal').modal('close');

    $('.modal').find('form').validate().resetForm();

    $('.modal').find('div.errorlabel').remove();

    $('form :input').each(function(){

      $(this).val('');

    })

    $('form .resetIfClose').each(function(){

      $(this).text('');

    })

    if(table != null){

      $(table).DataTable().ajax.reload();

    }

  }

  //NINO

  function modalClose(modalname){

    if(modalname == null){
      $('.modal').find('.valid').removeClass('valid');
      $('.modal').find('input').removeClass('valid');
      $('.modal').find('.input-field').removeClass('valid');
      $('.modal').find('form').validate().resetForm();
      $('.modal').find('div.errorlabel').remove();
      $('form :input').each(function(){$(this).val('');})
      $('form .resetIfClose').each(function(){$(this).text('');})
      $('.modal').modal('close');
    }
    else{
      $("#"+modalname).modal('close');
      $("#"+modalname).find('form').removeClass('valid');
      $("#"+modalname).find('input').removeClass('valid');
      $("#"+modalname).find('.input-field').removeClass('valid');
      $("#"+modalname).find('.modal').find('div.errorlabel').remove();
      if ($("#"+modalname).find('form').html() != undefined) 
      {
        $("#"+modalname).find('form').validate().resetForm();
        $("#"+modalname).find('form :input').each(function(){$(this).val('');$(this).parent().removeClass('valid')})
        $("#"+modalname).find('form .resetIfClose').each(function(){$(this).text('');})
      }
    }
    loadingClose();
  }

  function modalOpen(modalname){

    if(modalname == null){
      $('.modal').find('.valid').removeClass('valid');
      $('.modal').find('input').removeClass('valid');
      $('.modal').find('.input-field').removeClass('valid');
      $('.modal').find('form').validate().resetForm();
      $('.modal').find('div.errorlabel').remove();
      $('form :input').each(function(){$(this).val('');})
      $('form .resetIfClose').each(function(){$(this).text('');})
      $('.modal').modal('open');
    }
    else{
      $("#"+modalname).modal('open');
      $("#"+modalname).find('.valid').removeClass('valid');
      $("#"+modalname).find('input').removeClass('valid');
      $("#"+modalname).find('.input-field').removeClass('valid');
      $("#"+modalname).find('.modal').find('div.errorlabel').remove();
      if($("#"+modalname).find('form').html() != undefined){
        $("#"+modalname).find('form').validate().resetForm();
        $("#"+modalname).find('form :input').each(function(){$(this).val('');$(this).parent().removeClass('valid');})
        $("#"+modalname).find('form .resetIfClose').each(function(){$(this).text('');$(this).parent().removeClass('valid')})
      }
    }

  }

  //NINO

  //Uses: add this when closing a modal to have additional functionality

  //To Remove value in inputs, remove validation and reset table(optional)

  function thisModalCloseAndReset(table, modal, resetform){

    if(modal != null){

      $('.modal').find('input').removeClass('valid');

      $(modal).modal('close');

      $('.modal').find('form').validate().resetForm();

      $(modal).find('div.errorlabel').remove();

    }

    if(table != null){

      $(table).DataTable().ajax.reload();

    }

    if(resetform){

        $('form :input').each(function(){

          $(this).val('');

      });

    }

  }



  //NINO

  //Reload Datatable

  function reload(table, resetform){

      $("#"+table).DataTable().draw('page');

      if(resetform){

        $('form :input').each(function(){

          $(this).val('');

        })

      }

  }

  //NINO

  //show image

  function readURL(input) {

      if (input.files && input.files[0]) {

          var reader = new FileReader();



          reader.onload = function (e) {

              $('.display-image').attr('src', e.target.result);

          }



          reader.readAsDataURL(input.files[0]);

      }

  }

    function imagesPreview(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr({src: event.target.result,width:"100px"}).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };


  //$('.error, .errorlabel').remove();}



$(document).ready(function(){

  $('ul.tabs').tabs();

});



function formatDate(date) {

    var d = new Date(date),

        month = '' + (d.getMonth() + 1),

        day = '' + d.getDate(),

        year = d.getFullYear();



    if (month.length < 2) month = '0' + month;

    if (day.length < 2) day = '0' + day;



    return [year, month, day].join('-');

}



function parseDate(str) {

    var mdy = str.split('/');

    return new Date(mdy[2], mdy[0], mdy[1]);

}

function parseDatev2(str) {

    var mdy = str.split('-');

    return new Date(mdy[0], mdy[1]-1, mdy[2]);

}

function daydiff(first, second) {

    return Math.round((second-first)/(1000*60*60*24));

}



function getMonthName(str){

  var mdy = str.split('-');

  var monthNames = ["January", "February", "March", "April", "May", "June",

    "July", "August", "September", "October", "November", "December"

  ];



  var d = new Date(mdy[0], mdy[1]-1, mdy[2]);



  return monthNames[d.getMonth()];

}



function getThisYear(str){

  var mdy = str.split('-');

  var d = new Date(mdy[0], mdy[1]-1, mdy[2]);

  

  return mdy[0];

}

function money(mon) {
  if (mon != null && mon != "") {
    if (mon >= 0) 
    {
      return  "₱"+mon.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    else{
      mon = mon * -1;
      return  "-₱"+mon.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
  }
  else{
    return  "₱"+0;
  }
}

function moneyStandard(mon) {
  if (mon != null && mon != "") {
    if (mon >= 0) 
    {
      return  mon.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    else{
      mon = mon * -1;
      return  mon.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
  }
  else{
    return  0;
  }
}

function mail(description,email){

  $.ajax({

    type: 'ajax',

    method: 'POST',

    url: 'Reservation/mail',

    data: {description:description,email:email},

    async: false,

    dataType: 'json',

    success: function(){
      modalCloseAndReset();

    }

  });

}

function loadingOpen(argument) {
  $('body').find('.progress').removeClass('hide');
}
function loadingClose(argument) {
  $('body').find('.progress').addClass('hide');
}

//when images loaded is error
$('img').error(function(){
  console.log('Images cannot be loaded..');
});

//card swipe
const swipeActions = ["swipeLeft", "swipeRight"];

function findRealTarget(target) {
  for (let rule of swipeActions) {
    if (target.classList.contains(rule)) {
      return target;
    }
  }
  if (target.parentElement) {
    return findRealTarget(target.parentElement);
  }
  return target;
}

function remove(target, direction) {
  let offset = 0;
  
  if (direction === Hammer.DIRECTION_LEFT) {
    offset = 0 - document.body.offsetWidth - target.offsetWidth;
  } else {
    offset = document.body.offsetWidth + target.offsetWidth;
  }
  
  target.classList.add("removing");
  target.style.transform = `translateX(${offset}px)`;
}

function onSwipe(ev) {
  let target = findRealTarget(ev.target);
  let isRemoving = target.classList.contains("removing");
  
  let types = {};
  let offset = 0;
  let opacity = 1;
  
  for (let action of swipeActions) {
    types[action] = target.classList.contains(action);
  }
  
  // disable browser scrolling
  ev.preventDefault();

  if (!isRemoving) {
    switch(ev.type) {
      case 'panright':
      case 'panleft':
        offset = ev.distance;
        target.classList.remove("returning");

        if (types.swipeLeft && ev.offsetDirection === Hammer.DIRECTION_LEFT) {
          opacity = 1 - offset / target.offsetWidth + .25;
          offset = 0 - offset;
          target.style.transform = `translateX(${offset}px)`;
          target.style.opacity = opacity;
        } else if (types.swipeRight && ev.offsetDirection === Hammer.DIRECTION_RIGHT) {
          opacity = 1 - offset / target.offsetWidth + .25;
          target.style.transform = `translateX(${offset}px)`;
          target.style.opacity = opacity;
        } else {
          target.style.transform = "translateX(0px)";
          target.style.opacity = 1;
        }
        break;

      case 'swipeleft':
        if (types.swipeLeft) {
          remove(target, ev.offsetDirection);
        }
        break;
      case 'swiperight':
        if (types.swipeRight) {
          remove(target, ev.offsetDirection);
        }
        break;

      case 'pancancel':
      case 'panend':
        if (ev.distance > target.offsetWidth * .75) {
          remove(target, ev.offsetDirection);
        } else {
          target.classList.add("returning");
          target.style.transform = "translateX(0px)";
          target.style.opacity = 1;
        }
        break;
    }
  }
}

for (let action of swipeActions) {
  document.querySelectorAll(`.${action}`).forEach(function(element) {
    let swipeHandler = new Hammer(element, {});
    swipeHandler.on('panend pancancel panleft panright swipeleft swiperight', onSwipe);
  });
}

function addDialogInit() {
  setTimeout(function(){  addDialog('dialog','.show-dialog'); }, 500);
}