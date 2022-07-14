<h1 class="pageHeader">Reset your password</h1>

<div class="contactContent" style="justify-content: center;">
    <form onsubmit="checkPassword(event)" id="resetForm" method="post" action="<?= site_url() ?>/auth/do_reset">
        <label for="emailReset">Email:</label>
        <input type="email" name="emailReset" id="resetEmail">
        <label for="passwordreset" id="passwordLabel">New Password:</label>
        <input type="password" name="passwordReset" id="resetPassword">
        <label for="passwordReset">Repeat Password:</label>
        <input type="password" name="passwordReset2" id="repeatPassword">
        <button type="submit" class="goToButton" style="font-size: 20px !important;">Reset Password</button>
    </form>
    <script>
    function checkPassword(event) {
        let password1 = document.getElementById("resetPassword").value;
        let password2 = document.getElementById("repeatPassword").value;
        if (password1 != password2) {
            event.preventDefault();
            document.getElementById("passwordLabel").innerHTML = "Make sure your passwords match";
            document.getElementById("passwordLabel").style.color = "red";
            return false;
        }
        return true
    }
    </script>
</div>