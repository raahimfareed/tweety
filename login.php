<form action="includes/user/login.inc.php" method="post" class="customform white">
    <h5 class="grey-text text-darken-4">
        Login
    </h5>
    <div class="row">
        <div class="col s12 input-field">
            <input type="email" id="login_email" name="loginEmail" required />
            <label for="login_email">E-mail</label>
        </div>
        <div class="col s12 input-field">
            <input type="password" id="login_password" name="loginPassword" required />
            <label for="login_password">Password</label>
        </div>
        <div class="col s6">
            <p>
                <small><a href="#!"><i>Forgot your password?</i></a></small>
            </p>
        </div>
        <div class="col s6">
            <p class="right-align">
                <button class="btn blue" type="submit" name="login">Login</button>
            </p>
        </div>
    </div>
</form>