

                <!-- End Toggle Button -->

                <!-- Content -->
                <form class="js-validate" method="post" action="{{route('register')}}">
                    <!-- Signup -->
                    <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                        <!-- Title -->
                        <header class="text-center mb-7">
                            <h2 class="h4 mb-0">Welcome to Electro.</h2>
                            <p>Fill out the form to get started.</p>
                        </header>
                        <!-- End Title -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupEmail">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="signupEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required
                                           data-msg="Please enter a valid email address."
                                           data-error-class="u-has-error"
                                           data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupPassword">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupPasswordLabel">
                                                            <span class="fas fa-lock"></span>
                                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" required
                                           data-msg="Your password is invalid. Please try again."
                                           data-error-class="u-has-error"
                                           data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupConfirmPassword">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupConfirmPasswordLabel">
                                                        <span class="fas fa-key"></span>
                                                    </span>
                                    </div>
                                    <input type="password" class="form-control" name="confirmPassword" id="signupConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" required
                                           data-msg="Password does not match the confirm password."
                                           data-error-class="u-has-error"
                                           data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <div class="mb-2">
                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Get Started</button>
                        </div>

                        <div class="text-center mb-4">
                            <span class="small text-muted">Already have an account?</span>
                            <a class="js-animation-link small text-dark" href="javascript:;"
                               data-target="#login"
                               data-link-group="idForm"
                               data-animation-in="slideInUp">Login
                            </a>
                        </div>

                        <div class="text-center">
                            <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                        </div>

                        <!-- Login Buttons -->
                        <div class="d-flex">
                            <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                <span class="fab fa-facebook-square mr-1"></span>
                                Facebook
                            </a>
                            <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                <span class="fab fa-google mr-1"></span>
                                Google
                            </a>
                        </div>
                        <!-- End Login Buttons -->
                    </div>
                    <!-- End Signup -->

                    <!-- Forgot Password -->
                    <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
                        <!-- Title -->
                        <header class="text-center mb-7">
                            <h2 class="h4 mb-0">Recover Password.</h2>
                            <p>Enter your email address and an email with instructions will be sent to you.</p>
                        </header>
                        <!-- End Title -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="recoverEmail">Your email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="recoverEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="recoverEmail" placeholder="Your email" aria-label="Your email" aria-describedby="recoverEmailLabel" required
                                           data-msg="Please enter a valid email address."
                                           data-error-class="u-has-error"
                                           data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <!-- End Form Group -->

                        <div class="mb-2">
                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Recover Password</button>
                        </div>

                        <div class="text-center mb-4">
                            <span class="small text-muted">Remember your password?</span>
                            <a class="js-animation-link small" href="javascript:;"
                               data-target="#login"
                               data-link-group="idForm"
                               data-animation-in="slideInUp">Login
                            </a>
                        </div>
                    </div>
                    <!-- End Forgot Password -->
                </form>
