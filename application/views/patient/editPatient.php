	
<script type="text/javascript">
$(document).ready(function() {
    $('#editForm').bootstrapValidator({
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
                              message: "You're required to fill in the Patient's name!"
                          }
                      }
                  }, 
                  phone_number: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in the Patient's phone number!"
                                }
                            }
                        }, 
                  dob: {
                            validators: {
                                notEmpty: {
                                    message: "Please select the date of birth of the patient!"
                                }
                            }
                        },
                  location: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in the Patient's location!"
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
	    url: '<?php echo base_url(); ?>patients/editPatient',
	    type: 'post',
	    data: {name:$('#name').val(), phone_number:$('#phone_number').val(), male: $("#male").prop("checked"),
                  female: $("#female").prop("checked"), dob:$('#datepicker').val(), location:$('#location').val(), patient_id:$('#item_id').val()},
	    dataType: 'html',
	    success: function(html) {
            $('#editForm')[0].reset();
            $('#editCompany').modal('hide');
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
    });
  });
});

 $(function() {
        $( "#datepicker" ).datepicker();
        $('#timepicker').timepicker({ 'timeFormat': 'H:i:s' });
      });
</script>

    <script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>

<style>
    .date
    {
      z-index:1151 !important; 
    }
</style>

	<form id="editForm" method="post" class="form-horizontal">
	<?php 
	$patient = $patients->result()[0];

      function format_date($datetime)
      {
        $date = date('j-m-Y', (strtotime($datetime)));
        return $date;
      }
	?>
  <div class="form-group">
          <input type="hidden" id="item_id" name="item_id" value="<?php echo $patient->patient_id; ?>" />
                <label class="col-sm-3 control-label">Patient Name:</label>
                <div class="col-sm-7">
                  <input type="text" id = "name" name="name" class="form-control" placeholder="Enter the patient's full name" value="<?php echo $patient->name; ?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Phone Number:</label>
                <div class="col-sm-7">
                  <input type="text" id = "phone_number" name="phone_number" class="form-control" placeholder="Enter the patient's phone number" value="<?php echo $patient->phone_number; ?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender:</label>
                <div class="col-sm-6">
                  <div class="col-md-6">
                    <label><input type="radio" id = "male" name="gender" <?php if($patient->gender == 1) echo "checked"; ?> required> Male</label>
                  </div>
                  <div class="col-md-6">
                    <label><input type="radio" id = "female" name="gender" <?php if($patient->gender == 0) echo "checked"; ?> required> Female</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Birth:</label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <div class="bootstrap-timepicker">
                      <input id="datepicker" type="text" name="dob" class="form-control date" placeholder="Enter the patient's date of birth" value="<?php echo format_date($patient->dob); ?>"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Location:</label>
                <div class="col-sm-7">
                  <input type="text" id = "location" name="location" class="form-control" placeholder="Enter the patient's location" value="<?php echo $patient->location; ?>"/>
                </div>
              </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	</form>