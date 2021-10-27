<div class="card-body">
                                  <form action="updateaddressbook.php" method="POST">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">First Name</label>
                                                  <input type="text" name="billingid" hidden class="form-control" value="'.$billingid.'">
                                                  <input type="text" name="billingfname" class="form-control" required value="'.$row['firstname'].'">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Last Name</label>
                                                  <input type="text" name="billinglname" class="form-control" required value="'.$row['lastname'].'">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Email Address</label>
                                                  <input type="text" name="billingemail" class="form-control" required value="'.$row['email_address'].'">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Phone Number</label>
                                                  <input type="text" name="billingphone" class="form-control" required value="'.$row['phone_number'].'">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Address One</label>
                                                  <input type="text" name="billingaddressone" class="form-control" required value="'.$row['address_one'].'">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Address Two</label>
                                                  <input type="text" name="billingaddresstwo" class="form-control" required value="'.$row['address_two'].'">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Postal Code</label>
                                                  <input type="text" name="billingpostalcode" class="form-control" required value="'.$row['postal_code'].'">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Country</label>
                                                  <img id="countryflag'.$billingid.'" src="../img/flags/'.strtolower($row['country']).'.png">
                                                  <select name="country_name" class="form-control billingcountry" id="country'.$billingid.'">';
                                                      $getCountries = "Select countries_iso_code, countries_name from countries";
                                                      $getCountriesQuery = mysqli_query($conn, $getCountries);
                                                      while($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)){
                      
                                                      if($row['country'] == $getCountriesRows['countries_iso_code']){
                      
                                                      echo '<option selected value='.$getCountriesRows[' countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                      }
                                                      else{
                                                      echo '<option value='.$getCountriesRows[' countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                      }
                                                      }
                                                      echo'</select>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label class="bmd-label-floating">Same Shipping Detail ??</label>
                                                  <input data-bs-toggle="collapse" href="#showShippingDetail'.$row['info_id'].'" role="button" class="checksameshipping" aria-expanded="'; if(!$sameShipping){echo " true";} else { echo "false" ;} echo'" aria-controls="showShippingDetail'.$row['info_id'].'" type="checkbox" id="sameshipping'.$billingid.'"'; if($sameShipping){echo "checked ";} echo' name="sameshipping" value="same">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="collapse';if(!$sameShipping){echo " show";}echo'" id="showShippingDetail'.$row['info_id'].'">
                                          <div id="containsShippingDetail'.$billingid.'">';
                                              echo'<div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Fullname</label>
                                                          <input type="text" name="shippingid" hidden class="form-control" value="'.$shippingid.'">
                                                          <input type="text" name="shippingfullname" class="form-control" required ';if(!$sameShipping){echo "value=\"$shippingfullname\"";} else{echo "value=\"\"";}
                                                            echo'>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Email Address</label>
                                                          <input type="text" name="shippingemail" class="form-control" required ';if(!$sameShipping){echo "value=\"$shippingemail\"";} else{echo "value=\"\"";}
                                                            echo'>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Phone Number</label>
                                                          <input type="text" name="shippingphone" class="form-control" required ';if(!$sameShipping){echo "value=\"$shippingphone\"";} else{echo "value=\"\"";}
                                                            echo'>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Address One</label>
                                                          <input type="text" name="shippingaddressone" class="form-control" required ';if(!$sameShipping){echo "value=\"$shippingaddressone\"";} else{echo "value=\"\"";}
                                                          echo'>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Address Two</label>
                                                          <input type="text" name="shippingaddresstwo" class="form-control" required ';if(!$sameShipping){echo "value=\"$shippingaddresstwo\"";} else{echo "value=\"\"";}
                                                            echo'>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Postal Code</label>
                                                          <input type="text" name="shippingpostalcode" class="form-control" required ';if(!$sameShipping){echo "value=\"$shippingpostalcode\"";} else{echo "value=\"\"";}
                                                            echo'>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-12">
                                                      <div class="form-group">
                                                          <label class="bmd-label-floating">Country</label>
                                                          <img id="shippingcountryflag'.$billingid.'"'; 
                                                        if($sameShipping){
                                                            echo ' src="../img/flags/'.strtolower($row['country']).'.png"';
                                                        }else{ 
                                                          echo ' src="../img/flags/'.strtolower($shippingcountry).'.png"';
                                                        } 
                                                        echo'>
                                                          <select name="shipping_country_name" class="form-control shippingcountry" id="shippingcountry'.$billingid.'">';
                                                              $getCountries = "Select countries_iso_code, countries_name from countries";
                                                              $getCountriesQuery = mysqli_query($conn, $getCountries);
                                                              while($getCountriesRows = mysqli_fetch_assoc($getCountriesQuery)){
                                                              if($sameShipping){
                                                              if($row['country'] == $getCountriesRows['countries_iso_code']){
                      
                                                              echo '<option selected value='.$getCountriesRows[' countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                              }
                                                              else{
                                                              echo '<option value='.$getCountriesRows[' countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                              }
                                                              }
                                                              else{
                                                              if($shippingcountry == $getCountriesRows['countries_iso_code']){
                      
                                                              echo '<option selected value='.$getCountriesRows[' countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                              }
                                                              else{
                                                              echo '<option value='.$getCountriesRows[' countries_iso_code'].'>&#160&#160'.$getCountriesRows['countries_name'].'</option>';
                                                              }
                                                              }
                      
                                                              }
                                                              echo'</select>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <button type="submit" name="submit" class="btn btn-primary pull-right">Update</button>
                                      <div class="clearfix"></div>
                                  </form>
                              </div>