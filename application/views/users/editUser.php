           <form class="form" id="editUserForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter Full name e.g Dr. John Doe" value="<?php echo $user->name;?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Username:</label>
                <div class="col-sm-7">
                  <input type="text" name="username" id="editUsernameInput" class="form-control" placeholder="Enter username e.g john" value="<?php echo $user->username;?>" />
                  <div id="editUsernameCheck"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Password:</label>
                <div class="col-sm-7">
                  <input type="password" name="password" class="form-control" placeholder="Enter Password"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Confirm Password:</label>
                <div class="col-sm-7">
                  <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirm Password"/>
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="col-sm-3 control-label">Select Role:</label>
                <div class="col-sm-7" id="rolesInputDiv"></div>
              </div> -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Edit User</button>
              </div>
            </form>

<script type="text/javascript">
      $(document).ready(function() {
          $('#editUserForm').bootstrapValidator({
              message: 'This value is not valid',
              feedbackIcons: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  name: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in name!"
                          }
                      }
                  },
                  username : {
                      validators:{
                        notEmpty:{
                          message: "You are required to fill username"
                        }
                      }
                  },
                  password: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in password!"
                                },
                                stringLength:{
                                    min:6,
                                    max:20,
                                    message : "The password field must be more than 6 charecters long"
                                },
                                identical:{
                                    field: "passwordConfirm",
                                    message: "Password and password confirm fields must match"
                                }
                            }
                        },
                  passwordConfirm: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in password confirm!"
                                },
                                identical:{
                                    field: "password",
                                    message: "Password and password confirm fields must match"
                                },
                                stringLength:{
                                    min:6,
                                    max:20,
                                    message : "The password field must be more than 6 charecters long"
                                }
                            }
                        }
              }
          })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.ajax({
            url: '<?php echo base_url(); ?>users/edit_user_db/<?php echo $user->user_id;?>',
            type: 'post',
            data: $('#editUserForm :input'),
            dataType: 'json',   
            success: function(response) {
              $('#editUserForm')[0].reset();
              $('#editUserModal').modal('hide');
              bootbox.alert(response.message, function()
              {
                window.location.reload();
              });
            }
          });
        });
      });
    </script>