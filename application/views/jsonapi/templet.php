<form role="form" action="http://site.demo4site.com/gotherapy/jsonapi/newuser/" method="POST" enctype="multipart/form-data" id="control-form" name="student_form" >
                
              
                
              <div class="box-body">
                   <div class="form-group">
                  <label for="exampleInputFirstname"> Firstname </label>
                  <input type="text" name="f_name" class="form-control" id="exampleInputfirstname" placeholder="Enter Firstname" data-validation="alphanumeric">
                    
                   </div>
                  <div class="form-group">
                  <label for="exampleInputLastname"> Lastname </label>
                  <input type="text" class="form-control" id="exampleInputlastname" placeholder="Enter Lastname" name="l_name" data-validation="alphanumeric">
                  
                  </div>
                  <div class="form-group">
                  <label for="exampleInputAddress" data-validation="alphanumeric">Address</label>
                  <textarea class="form-control" id="exampleInputaddress" placeholder="Enter Adderss" name="add" data-validation="required" data-validation="length" data-validation-length="max10"></textarea>
                  
                  </div>
                   
                <div class="form-group">
                  <label for="exampleInputEmail1"> Email address </label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" data-validation="email" data-validation-error-msg="E-mail is not valid" >
                  <label id="msg_email" style="width:250px;"></label>
                </div>
                     <div class="form-group">
                          <label for="exampleInputgender">Gender</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="optionsRadios" value="Male" data-validation="required">
                     &nbsp; Male
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="optionsRadios" value="Female">
                     &nbsp; Female
                    </label>
                     </div>
                        
                     </div>
                  
              </div>
              <div class="box-footer">
                  <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary" >Submit</button>
              </div>
            </form>