    <script type="text/javascript">
      $(document).ready(function() {
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
            url: '<?php echo base_url(); ?>patients/addPatient',
            type: 'post',
            data: {name:$('#name').val(), phone_number:$('#phone_number').val(), male: $("#male").prop("checked"),
                  female: $("#female").prop("checked"), dob:$('#datepicker').val(), location:$('#location').val()},
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
            url: '<?php echo base_url(); ?>patients/editPatient/' + id,
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

      function format_date($datetime)
      {
        $date = date('jS F Y', (strtotime($datetime)));
        return $date;
      }
    ?>



    <link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>

<style>
    .date {
      z-index:1151 !important; 
    }
</style>

    <div id="editCompany" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Patient Details</h4>
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
            <h4 class="modal-title">Add a Patient</h4>
          </div>
          <div class="modal-body">
            <form class="form" id="addForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Patient Name:</label>
                <div class="col-sm-7">
                  <input type="text" id = "name" name="name" class="form-control" placeholder="Enter the patient's full name"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Phone Number:</label>
                <div class="col-sm-7">
                  <input type="text" id = "phone_number" name="phone_number" class="form-control" placeholder="Enter the patient's phone number"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender:</label>
                <div class="col-sm-6">
                  <div class="col-md-6">
                    <label><input type="radio" id = "male" name="gender" required> Male</label>
                  </div>
                  <div class="col-md-6">
                    <label><input type="radio" id = "female" name="gender" required> Female</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Birth:</label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <div class="bootstrap-timepicker">
                      <input id="datepicker" type="text" name="dob" class="form-control date" placeholder="Enter the patient's date of birth"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Location:</label>
                <div class="col-sm-7">
                  <input type="text" id = "location" name="location" class="form-control" placeholder="Enter the patient's location"/>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Patient</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Patients</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Bracket</a></li>
          <li class="active">Patients</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Patient List</h5>
            <p class="mb20">Add and Edit Patient Details</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStore"><span class="fa fa-plus"></span> Add Patient</button>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Location</th>
                    <th>Last Visit</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients->result() as $patient){?>
                  <tr>
                    <td></td>
                    <td><?php echo $patient->name; ?></td>
                    <td><?php echo $patient->phone_number; ?></td>
                    <td><?php if($patient->gender == 1) echo "Male"; else echo "Female"; ?></td>
                    <td><?php echo get_age($patient->dob); ?></td>
                    <td><?php echo $patient->location; ?></td>
                    <td><?php echo format_date($patient->last_visit); ?></td>
                    <td><span class="btn btn-warning" data-toggle="modal" data-target="#editCompany" onclick="edit('<?php echo $patient->patient_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
                        <a href="<?php echo base_url(); ?>patients/consultation/<?php echo $patient->patient_id; ?>"><span class="btn btn-success"><i class="fa fa-stethoscope"></i>&nbsp;See Patient</span></a>
                    </td>
                  </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div><!-- table-responsive -->
          </div>
        </div><!-- col-md-6 -->
      </div><!-- row -->
    </div><!-- contentpanel -->