                            <?php
                            echo'<form id="msform" method="POST" enctype="multipart/form-data" action="database/registerdata.php" autocomplete="off">                            
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Account</strong></li>
                                <li id="personal"><strong>Personal</strong></li>
                                <li id="personal"><strong>Business</strong></li>
                                <li id="payment"><strong>Documents</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> <br> <!-- fieldsets -->                                      
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Account Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 4</h2>
                                        </div>
                                    </div>
                                    <label class="fieldlabels">Email: *</label>
                                    <p id="errormail"></p>
                                    <input type="email" oninput="checkEmail()" id="email_register" required name="email" placeholder="Email Id" autocomplete="off" />
                                    <label class="fieldlabels">Password: *</label>
                                    <p id="errorpass"></p>
                                    <input type="password" oninput="checkPassword()" id="password_register" required name="password" placeholder="Password" autocomplete="off" />                                                                        
                                    <label class="fieldlabels">Wholesale User?  &nbsp;<input type="checkbox" id="isWholesaleUser" name="isWholesaleUser" /></label>
                                    
                                </div>                                
                                <input type="button" id="step1" name="next" class="next action-button" value="Next" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Personal Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 2 - 4</h2>
                                        </div>
                                    </div> <label class="fieldlabels">Full Name: *</label>
                                    <p id="errorname"></p>
                                    <input type="text" id="fullname" oninput="checkName()" name="name" placeholder="Full Name" required autocomplete="off" />
                                    <label class="fieldlabels">Age: *</label>
                                    <p id="errorage"></p>
                                    <input type="number" oninput="validateAge()" id="age" name="age" placeholder="Age" required autocomplete="off" />
                                    <label class="fieldlabels">Contact No: *</label> <br />
                                    <span id="valid-msg" class="hide">✓ Valid</span>
                                    <span id="error-msg" class="hide"></span>
                                    <input type="tel" name="phone_number[main]" id="phone" required autocomplete="off" />
                                    <label style="margin-top: 25px;" class="fieldlabels">Gender: *</label> <br>
                                    <select name="gender" id="genderFromRegister" aria-placeholder="Choose gender" required>
                                        <option value="notselected" disabled="" selected="">Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="private">Rather not say.</option>
                                    </select>
                                    <br><br>
                                    <!-- <input type="text" maxlength="10" id="phone" name="phno" placeholder="Contact No." />                                      -->
                                </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Image Upload:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 3 - 4</h2>
                                        </div>
                                    </div>
                                    <p style="color:black; margin-bottom:8px; font-size:medium;" id="msg">Add profile picture for your account. This step can be skipped.</p>
                                    <div id="imgContainer">                                    
                                        <div id="imgArea"><img id="usericon" src="./img/register_usericon.png">
                                            <div class="progressBarImageUpload">
                                                <div class="bar"></div>
                                                <div class="percent">0%</div>
                                            </div>
                                            <div id="imgChange"><span>Change Photo</span>
                                                <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">      
                                                <input id="profileimage" type="text" hidden name="imagename">
                                                <input id="finalsubmit" hidden type="submit" name="sumbit" value="submit" />
                                            </div>
                                        </div>

                                        <p style="color:black;margin:8px 0px; font-size:medium;cursor:pointer;" id="reset" onclick="resetUpload()">Reset</p>                                                                                
                                    </div>                                                                        
                                </div>
                                <button type="button" style="display:none;" id="proceedtofinal"  name="skipped" class="next action-button">Next Step</button> <input id="submitForm" type="button" name="change" class="action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />                                                    
                                <br/> <br/>
                                
                                                    <div class="alert alert-danger alert-dismissible" id="errormessage" style="display: none; margin-top:20px;">
                                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                    <span id="errormsg"></span>                                                                                                
                                                    <hr>
                                                    <span id="errordetail" class="mb-0"></span>        
													<a href="#" id="closemsg" class="close" aria-label="danger">×</a>
												</div>                                                
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Finish:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 4 - 4</h2>
                                        </div>
                                    </div> <br><br>
                                    <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="img/success.png"></div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="purple-text text-center">An email verification link has been sent to your email. Please verify before logging in.</h5>
                                            <h5 class="purple-text text-center">Redirecting to homepage...</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form> '; 
                        ?>