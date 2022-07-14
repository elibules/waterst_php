<h1 class="pageHeader">Login or Make an Account</h1>

<div class="contactContent loginContent">

    <form action="<?= site_url() ?>/auth/login" method="post">
        <h2>Login</h2>
        <label for="emailLogin">Email:</label>
        <input type="text" name="emailLogin" id="loginEmail">
        <label for="passwordLogin">Password:</label>
        <input type="password" name="passwordLogin" id="loginPassword">
        <button type="submit" class="goToButton">Login</button>
        <a href="<?= site_url() ?>/auth/reset" style="text-align: center; margin-top: 1rem;">Forgot your password?</a>
    </form>
    <div class="divLine"></div>
    <form onsubmit="register(event, '<?= site_url() ?>')" id="registerForm" method="post"
        action="<?= site_url() ?>/auth/register">
        <h2>Register</h2>
        <label for="fullName">Full Name:</label>
        <input type="text" name="fullName">
        <label for="emailRegister">Email:</label>
        <input type="email" name="emailRegister" id="registerEmail">
        <label for="passwordRegister" id="passwordLabel">Password:</label>
        <input type="password" name="passwordRegister" id="registerPassword">
        <label for="passwordRegister">Repeat Password:</label>
        <input type="password" name="passwordRegister2" id="repeatPassword">
        <button type="submit" class="goToButton">Make Account</button>
    </form>
    <script>
    function register(event, site_url) {
        let password1 = document.getElementById("registerPassword").value;
        let password2 = document.getElementById("repeatPassword").value;
        if (password1 != password2) {
            event.preventDefault();
            document.getElementById("passwordLabel").innerHTML = "Make sure your passwords match";
            document.getElementById("passwordLabel").style.color = "red";
            return false;
        }
    }
    </script>
</div>