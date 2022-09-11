/*!

 =========================================================
 * Bootstrap Wizard - v1.1.1
 =========================================================
 
 * Product Page: https://www.creative-tim.com/product/bootstrap-wizard
 * Copyright 2017 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/bootstrap-wizard/blob/master/LICENSE.md)
 
 =========================================================
 
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 */

// Get Shit Done Kit Bootstrap Wizard Functions

searchVisible = 0;
transparent = true;

$(document).ready(function(){

    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();

    // Code for the Validator
    var $validator = $('.wizard-card form').validate({
		  rules: {
		    botToken: {
		      required: true,
		      minlength: 15
		    },
		    channelID: {
		      required: true,
		      minlength: 5
		    }
        }
	});

    $('#testCon').on('click', function(){
        checkBot();
    });

    $('#copyToken').on('click', function(){
        copy2clipboard()
    });

    $('#fin').on('click', function(){
        storeCreds();
    });

    // Wizard Initialization
  	$('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function(tab, navigation, index) {
        	var $valid = $('.wizard-card form').valid();
        	if(!$valid) {
        		$validator.focusInvalid();
        		return false;
        	}
        },

        onInit : function(tab, navigation, index){

          //check number of tabs and fill the entire row
          var $total = navigation.find('li').length;
          $width = 100/$total;
          var $wizard = navigation.closest('.wizard-card');

          $display_width = $(document).width();

          if($display_width < 600 && $total > 3){
              $width = 50;
          }

           navigation.find('li').css('width',$width + '%');
           $first_li = navigation.find('li:first-child a').html();
           $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
           $('.wizard-card .wizard-navigation').append($moving_div);
           refreshAnimation($wizard, index);
           $('.moving-tab').css('transition','transform 0s');
       },

        onTabClick : function(tab, navigation, index){

            var $valid = $('.wizard-card form').valid();

            if(!$valid){
                return false;
            } else {
                return true;
            }
        },

        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;

            var $wizard = navigation.closest('.wizard-card');

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $($wizard).find('.btn-next').hide();
                $($wizard).find('.btn-finish').show();
            } else {
                $($wizard).find('.btn-next').show();
                $($wizard).find('.btn-finish').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();

            setTimeout(function(){
                $('.moving-tab').text(button_text);
            }, 150);

            var checkbox = $('.footer-checkbox');

            if( !index == 0 ){
                $(checkbox).css({
                    'opacity':'0',
                    'visibility':'hidden',
                    'position':'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity':'1',
                    'visibility':'visible'
                });
            }

            refreshAnimation($wizard, index);
        }


        

  	});


    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function(){
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function(){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked','true');
        }
    });

    $('.set-full-height').css('height', 'auto');

});



 //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(window).resize(function(){
    $('.wizard-card').each(function(){
        $wizard = $(this);
        index = $wizard.bootstrapWizard('currentIndex');
        refreshAnimation($wizard, index);

        $('.moving-tab').css({
            'transition': 'transform 0s'
        });
    });
});

function refreshAnimation($wizard, index){
    total_steps = $wizard.find('li').length;
    move_distance = $wizard.width() / total_steps;
    step_width = move_distance;
    move_distance *= index;

    $wizard.find('.moving-tab').css('width', step_width);
    $('.moving-tab').css({
        'transform':'translate3d(' + move_distance + 'px, 0, 0)',
        'transition': 'all 0.3s ease-out'

    });
}

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};

function checkBot() {
    resetIndicators();
    $("#botConnectionGroup").show();
    var botToken = document.getElementById("botToken").value;
    $.ajax({
        url: "https://api.telegram.org/bot" + botToken + "/getMe",
        type: "GET",
        dataType: "json",
        timeout : 5000,
        success: function (data, status) {
            if (data.ok) {
                $("#botIndicator").html("<i class='fa fa-check' aria-hidden='true'></i>");
                $("#botIndicator").css("color", "green");
                $("#botConnection").html("Bot Connection Success! Bot name: " + data.result.first_name);
                checkChannel();
            }},
        error: function (xhr, desc, err) {
            $("#botIndicator").html("<i class='fa fa-times' aria-hidden='true'></i>");
            $("#botIndicator").css("color", "red");
            $("#botConnection").html("Bot Connection Failed")
        }
        });
};

function checkChannel() {
    $("#channelConnectionGroup").show();
    var botToken = document.getElementById("botToken").value;
    var channelName = document.getElementById("channelID").value;
    $.ajax({
        url: "https://api.telegram.org/bot" + botToken + "/getChat?chat_id=" + channelName,
        type: "GET",
        dataType: "json",
        timeout : 5000,
        success: function (data, status) {
            if (data.ok) {
                $("#channelIndicator").html("<i class='fa fa-check' aria-hidden='true'></i>");
                $("#channelIndicator").css("color", "green");
                $("#channelConnection").html("Channel Connection Success! Channel name: " + data.result.title);
                $("#nextBtn").prop( "disabled", false);
                $("#finalToken").val(botToken);
                $("#finalChannel").val(channelName);
            }},
        error: function (xhr, desc, err) {
            $("#channelIndicator").html("<i class='fa fa-times' aria-hidden='true'></i>");
            $("#channelIndicator").css("color", "red");
            $("#channelConnection").html("Channel Connection Failed")
        }
        });
}

function resetIndicators() {
    $("#botConnectionGroup").hide()
    $("#botIndicator").html("<i class='fa fa-spinner fa-spin spinning' aria-hidden='true'></i>");
    $("#botIndicator").css("color", "black");
    $("#botConnection").html("Connecting to bot...");
    $("#channelIndicator").html("<i class='fa fa-spinner fa-spin spinning' aria-hidden='true'></i>");
    $("#channelIndicator").css("color", "black");
    $("#channelConnection").html("Connecting to channel...");
    $("#channelConnectionGroup").hide()
    $("#nextBtn").prop( "disabled", true);
};

function copy2clipboard() {
    //copy to clipboard
    var copyText = document.getElementById("botToken");
    copyText.select();
    document.execCommand("copy");
    // alert
    alert("Copied API Token to clipboard");
};

function storeCreds() {
    // submit form
    $('botForm').submit();
}