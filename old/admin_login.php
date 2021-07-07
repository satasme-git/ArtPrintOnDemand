<?php
session_start();
?>

<!DOCTYPE html><html class=''>
<head>

	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<link rel="stylesheet" href="../css/login.css">
	
	<link rel="shortcut icon" href="../../../images/logos/art_print_on_demand.png" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="../../../images/logos/art_print_on_demand.png">

	</head>
<body>
<!-- LOGIN MODULE -->
<div class="login">
	<div class="wrap">
		<!-- TOGGLE -->
		<div id="toggle-wrap">
			<div id="toggle-terms">
				<div id="cross">
					<span></span>
					<span></span>
				</div>
			</div>
		</div>

		<!-- RECOVERY -->
		<div class="recovery">
			<h2>Password Recovery</h2>
			<p>Enter either the <strong>email address</strong> or <strong>username</strong> on the account and <strong>click Submit</strong></p>
			<p>We'll email instructions on how to reset your password.</p>
			<form class="recovery-form" action="" method="post">
				<input type="text" class="input" id="user_recover" placeholder="Enter Email or Username Here">
				<input type="submit" name="submit" class="button" value="Submit">
			</form>
			<p class="mssg">An email has been sent to you with further instructions.</p>
		</div>

		<!-- SLIDER -->
		<div class="content">
			<!-- LOGO -->
			<div class="logo">
				<a href="#"><img src="../../../images/logos/art_print_on_demand.png" alt=""></a>
			</div>
			<!-- SLIDESHOW -->
			<div id="slideshow">
				<div class="one">
				    <a href="#"><img src="../../../images/logos/art_print_on_demand.png" alt=""></a>
					<!--<h2><span>Abstract</span></h2>-->
					<!--<p>Sign up to attend any of hundreds of events nationwide</p>-->
				</div>
				<!--<div class="two">-->
				<!--	<h2><span>Africa</span></h2>-->
					<!--<p>Thousands of instant online classes/tutorials included</p>-->
				<!--</div>-->
				<!--<div class="three">-->
				<!--	<h2><span>Animal</span></h2>-->
					<!--<p>Create your own groups and connect with others that share your interests</p>-->
				<!--</div>-->
				<!--<div class="four">-->
				<!--	<h2><span>Kitchen</span></h2>-->
					<!--<p>Share your works and knowledge with the community on the public showcase section</p>-->
				<!--</div>-->
			</div>
		</div>
		<!-- LOGIN FORM -->
		<div class="user">
			<!-- ACTIONS
            <div class="actions">
                <a class="help" href="#signup-tab-content">Sign Up</a><a class="faq" href="#login-tab-content">Login</a>
            </div>
            -->
			<div class="form-wrap">
				<!-- TABS -->
				<div class="tabs">
					<h3 class="login-tab"><a class="log-in active" href="#login-tab-content"><span>Login</span></a></h3>
<!--					<h3 class="signup-tab"><a class="sign-up" href="#signup-tab-content"><span>Sign Up</span></a></h3>-->
				</div>
				<!-- TABS CONTENT -->
				<div class="tabs-content">
					<!-- TABS CONTENT LOGIN -->
					<div id="login-tab-content" class="active">
					<?php
								if(!empty( $_SESSION['message']))
								echo $_SESSION['message'];
								
							?>
						<form class="login-form" action="loginAd.php" method="post">
							<input type="text" name="username" class="input" id="user_login" autocomplete="off" placeholder="Email or Username">
							<input type="password" name="password" class="input" id="user_pass" autocomplete="off" placeholder="Password">
							<input type="checkbox" class="checkbox" checked id="remember_me">
							<!--<label for="remember_me">Remember me</label>-->
							<input type="submit"  name="submit" class="btn-primary" value="Login" style="width: 30%;background-color: #69DDC9;">
						</form>
						<div class="help-action">
							<p><i class="fa fa-arrow-left" aria-hidden="true"></i><a class="forgot" href="#">Forgot your password?</a></p>
						</div>
					</div>
					<!-- TABS CONTENT SIGNUP -->
<!--					<div id="signup-tab-content">-->
<!--						<form class="signup-form" action="admin_form.php" method="post">-->
<!--							<input type="email" class="input" id="user_email" autocomplete="off" placeholder="Email">-->
<!--							<input type="text" class="input" id="user_name" autocomplete="off" placeholder="Username">-->
<!--							<input type="password" class="input" id="user_pass4" autocomplete="off" placeholder="Password">-->
<!--							<input type="submit" class="btn-primary" value="Sign Up" style="width: 30%;background-color: #69DDC9;">-->
<!--						</form>-->
<!--						<div class="help-action">-->
<!--							<p>By signing up, you agree to our</p>-->
<!--						</div>-->
<!--					</div>-->
				</div>
			</div>
		</div>
	</div>
</div>


<script >/* LOGIN - MAIN.JS - dp 2017 */

// LOGIN TABS
$(function() {
    var tab = $('.tabs h3 a');
    tab.on('click', function(event) {
        event.preventDefault();
        tab.removeClass('active');
        $(this).addClass('active');
        tab_content = $(this).attr('href');
        $('div[id$="tab-content"]').removeClass('active');
        $(tab_content).addClass('active');
    });
});

// SLIDESHOW
// $(function() {
//     $('#slideshow > div:gt(0)').hide();
//     setInterval(function() {
//         $('#slideshow > div:first')
//             .fadeOut(1000)
//             .next()
//             .fadeIn(1000)
//             .end()
//             .appendTo('#slideshow');
//     }, 3850);
// });

// CUSTOM JQUERY FUNCTION FOR SWAPPING CLASSES
(function($) {
    'use strict';
    $.fn.swapClass = function(remove, add) {
        this.removeClass(remove).addClass(add);
        return this;
    };
}(jQuery));

// SHOW/HIDE PANEL ROUTINE (needs better methods)
// I'll optimize when time permits.
$(function() {
    $('.agree,.forgot, #toggle-terms, .log-in, .sign-up').on('click', function(event) {
        event.preventDefault();
        var terms = $('.terms'),
            recovery = $('.recovery'),
            close = $('#toggle-terms'),
            arrow = $('.tabs-content .fa');
        if ($(this).hasClass('agree') || $(this).hasClass('log-in') || ($(this).is('#toggle-terms')) && terms.hasClass('open')) {
            if (terms.hasClass('open')) {
                terms.swapClass('open', 'closed');
                close.swapClass('open', 'closed');
                arrow.swapClass('active', 'inactive');
            } else {
                if ($(this).hasClass('log-in')) {
                    return;
                }
                terms.swapClass('closed', 'open').scrollTop(0);
                close.swapClass('closed', 'open');
                arrow.swapClass('inactive', 'active');
            }
        }
        else if ($(this).hasClass('forgot') || $(this).hasClass('sign-up') || $(this).is('#toggle-terms')) {
            if (recovery.hasClass('open')) {
                recovery.swapClass('open', 'closed');
                close.swapClass('open', 'closed');
                arrow.swapClass('active', 'inactive');
            } else {
                if ($(this).hasClass('sign-up')) {
                    return;
                }
                recovery.swapClass('closed', 'open');
                close.swapClass('closed', 'open');
                arrow.swapClass('inactive', 'active');
            }
        }
    });
});

// DISPLAY MSSG
$(function() {
    $('.recovery .button').on('click', function(event) {
        event.preventDefault();
        $('.recovery .mssg').addClass('animate');
        setTimeout(function() {
            $('.recovery').swapClass('open', 'closed');
            $('#toggle-terms').swapClass('open', 'closed');
            $('.tabs-content .fa').swapClass('active', 'inactive');
            $('.recovery .mssg').removeClass('animate');
        }, 2500);
    });
});

// DISABLE SUBMIT FOR DEMO
$(function() {
    $('.button').on('click', function(event) {
        $(this).stop();
        event.preventDefault();
        return false;
    });
});
//# sourceURL=pen.js
</script>
</body></html>