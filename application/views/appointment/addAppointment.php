        <script type="text/javascript">
      $(document).ready(function() {
      $("#active_").change(function() {
          if(this.checked) {
              $('#active').val(1);
          }
        else
          $('#active').val(0);
      });
          $('#addForm').bootstrapValidator({
              message: 'This value is not valid',
              feedbackIcons: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  date: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in the appointment date!"
                          }
                      }
                  }, 
                  time: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in the appointment time!"
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
            url: '<?php echo base_url(); ?>appointments/saveAppointment',
            type: 'post',
            data: $('#addForm :input'),
            dataType: 'html',   
            success: function(html) {
            $('#addForm')[0].reset();
            $('#addStore').modal('hide');
            bootbox.alert(html, function()
              {
              window.open('<?php echo base_url(); ?>appointments',"_self");
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

    <?php
      function get_age($datetime)
      {
        $from = new DateTime($datetime);
        $to   = new DateTime('today');
        $years = ($from->diff($to)->y);
        if($years <= 0)
        {
          $months = ($from->diff($to)->m);
          if($months <= 0)
            return (($from->diff($to)->d).'  '."Days");
          else
            return $months.'  '."Months";
        }
        else
            return $years.'  '."Years";

      }
      ?>


    <link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>



    <div class="pageheader">
      <h2><i class="fa fa-users"></i> Add an Appointments</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>patients">Patients</a></li>
          <li><a href="<?php echo base_url(); ?>appointments">Appointments</a></li>
          <li class="active">Add Appointment</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title">Book Appointment</h4>
          <p>Select the date and time the patient will consult the Doctor</p>
        </div>
        <div class="panel-body">
          
          <form class="form" id="addForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Select Patient:</label>
                <div class="col-sm-9">
                <!-- <select class="form-control mb15 selectpicker" name="patient_id" data-live-search="true" data-style="btn-white"> -->
                <select class="form-control" name="patient_id" data-live-search="true" data-style="btn-white">
                  <?php foreach ($patients->result() as $patient){?>
                    <option value="<?php echo $patient->patient_id; ?>"><?php echo $patient->name; ?>  -  <?php if($patient->gender == 1) echo "Male"; else echo "Female"; ?>, <?php echo get_age($patient->dob); ?></option>
                  <?php } ?>
                </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Appointment Date:</label>
                <div class="col-sm-9">
                  <div class="input-group mb15">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <div class="bootstrap-timepicker">
                      <input id="datepicker" type="text" name="date" class="form-control" placeholder="Select Appointment Date"/>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Appointment</button>
              </div>
            </form>
        </div><!-- panel-body -->
        
      </div><!-- panel -->
      
    </div><!-- contentpanel -->
    