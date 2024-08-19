<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page</title>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</head>
<body>
<button onclick="loginWithFacebook()">Login with Facebook</button>
</body>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '875366750738048',
            cookie     : true,
            xfbml      : true,
            version    : 'v14.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    function loginWithFacebook() {
        FB.login(function(response) {
            if (response.authResponse) {
                // User is logged in and authorized
                console.log('Successfully logged in:', response);
            } else {
                // User cancelled login or did not authorize
                console.log('Login cancelled or not authorized.');
            }
        }, { scope: 'email' }); // Specify the required permissions
    }
</script>
</html>