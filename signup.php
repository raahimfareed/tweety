    <form action="includes/user/signup.inc.php" method="post" class="customform white">
        <h5 class="grey-text text-darken-4">
            Signup
        </h5>
        <div class="row">
            <div class="col s12 input-field">
                <input type="text" id="signup_screenName" name="screenName" required />
                <label for="signup_screenName">Full Name</label>
            </div>
            <div class="col s12 input-field">
                <input type="text" id="userUID" name="userUID" required />
                <label for="userUID">Username</label>
            </div>
            <div class="col s12 input-field">
                <input type="email" id="signup_email" name="signupEmail" required />
                <label for="signup_email">Email</label>
            </div>
            <div class="col s12 input-field">
                <input type="password" id="signup_password" name="signupPassword" required />
                <label for="signup_password">Password</label>
            </div>
            <div class="col s12">
                <p class="right-align">
                    <button class="btn blue" type="submit" name="signup">Signup</button>
                </p>
            </div>
        </div>
    </form>
