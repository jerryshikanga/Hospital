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
                  name: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in the Company name!"
                          }
                      }
                  }, 
                  shift_day: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in number of shifts per day!"
                                }
                            }
                        },
                  shift_week: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in number of shifts per week!"
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
            url: '<?php echo base_url(); ?>company/addCompany',
            type: 'post',
            data: $('#addForm :input'),
            dataType: 'html',   
            success: function(html) {
            $('#addForm')[0].reset();
            $('#addStore').modal('hide');
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
          });
        });
      });

      function edit(id)
      {
      $.ajax({
            url: '<?php echo base_url(); ?>company/edit/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#edit-admin-content').html(html);
               
            }
          });
      }

      function rm(nm,id){
        bootbox.confirm("Are you sure you want to delete Company called " + nm + "?", function(result) {
            if(result) {
            
          $.ajax({
          url: '<?php echo base_url(); ?>company/deleteCompany/' + id,
          type: 'post',
          data: {id: id},
          dataType: 'html',   
          success: function(html) {
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
          }
        });
          
          }
          
        }); 
      }

      $(function() {
      $( "#datepicker" ).datepicker();
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

      function format_date($datetime)
      {
        $date = date('jS F Y', (strtotime($datetime)));
        return $date;
      }

      ?>

    <link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>

    <div id="editCompany" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Company Info Details</h4>
          </div>
          <div class="modal-body" id="edit-admin-content">
            
          </div>
        </div>
      </div>
    </div>

    <div id="addStore" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add an Appointment</h4>
          </div>
          <div class="modal-body">
            <form class="form" id="firstForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Select Patient:</label>
                <div class="col-sm-9">
                <select class="form-control mb15 selectpicker" name="patient_id" data-live-search="true" data-style="btn-white">
                  <?php foreach ($patients->result() as $patient){?>
                    <option value="<?php echo $patient->patient_id; ?>"><?php echo $patient->name; ?> - <?php echo get_age($patient->dob); ?>, <?php if($patient->gender == 1) echo "Male"; else echo "Female"; ?></option>
                  <?php } ?>
                </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Appointment Date:</label>
                <div class="col-sm-5">
                  <div class="input-group mb15">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <div class="bootstrap-timepicker">
                      <input id="datepicker" type="text" class="form-control" placeholder="Select Appointment Date"/>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="input-group mb15">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    <div class="bootstrap-timepicker">
                      <input id="timepicker" type="text" class="form-control" placeholder="Appointment Time"/>
                    </div>
                  </div>
                </div>

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Appointment</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Appointments</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>patients">Patients</a></li>
          <li class="active">Appointments</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Appointment List</h5>
            <p class="mb20">View and Add New Appointments</p>
          </div>
          <div class="col-md-6 text-right">
            <a href="<?php echo base_url();?>appointments/addAppointment" class="btn btn-success" role="button"><span class="fa fa-plus"></span> Add Appointment</a>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Patient Name</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Location</th>
                    <th>Appointment Date</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments->result() as $appointment){?>
                  <tr>
                    <td><?php echo $appointment->appointment_id; ?></td>
                    <td><?php echo $appointment->name; ?></td>
                    <td><?php echo $appointment->phone_number; ?></td>
                    <td><?php if($appointment->gender == 1) echo "Male"; else echo "Female"; ?></td>
                    <td><?php echo get_age($appointment->dob); ?></td>
                    <td><?php echo $appointment->location; ?></td>
                    <td><?php echo format_date($appointment->date); ?></td>
                  </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div><!-- table-responsive -->
          </div>
        </div><!-- col-md-6 -->
      </div><!-- row -->
    </div><!-- contentpanel -->