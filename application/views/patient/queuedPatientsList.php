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

      function dismiss(nm,id)
      {
        bootbox.confirm("Are you sure you want to dismiss a patient called " + nm + "?", function(result) {
            if(result) {
          $.ajax({
          url: '<?php echo base_url(); ?>group/expel_user/' + id,
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
    <style type="text/css">
      table { 
        counter-reset: line-number; 
      }
      td:first-child:before {
        content: counter(line-number) ".";
        counter-increment: line-number;
        padding-right: 0.3em; 
      }
    </style>


    <div id="editCompany" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Dismiss a patient undergoing treatment</h4>
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
            <form class="form" id="firstForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Patient Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter the patient's full name"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Phone Number:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter the patient's phone number"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender:</label>
                <div class="col-sm-6">
                  <div class="col-md-6">
                    <label><input type="radio" name="gender"> Male</label>
                  </div>
                  <div class="col-md-6">
                    <label><input type="radio" name="gender"> Female</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Birth:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter the patient's date of birth"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Location:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter the patient's location"/>
                </div>
              </div>

              <div style="width: 100%; height: 12px; border-bottom: 1px solid black; text-align: center; margin-bottom:20px">
                <span style="font-size: 16px; background-color: #fff; padding: 0 10px;"> Guardian's Details </span>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Guardian Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter the guardian's full name"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Guardian Phone Number:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter the guardian's phone number"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender:</label>
                <div class="col-sm-6">
                  <div class="col-md-6">
                    <label><input type="radio" name="gender_guardian"> Male</label>
                  </div>
                  <div class="col-md-6">
                    <label><input type="radio" name="gender_guardian"> Female</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Relationship with Patient:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Select Relationship with Patient"/>
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
      <h2><i class="fa fa-users"></i> List of Queued Patients</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Patients</a></li>
          <li class="active">Queued Patients</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Today's Patients on the Queue</h5>
            <p class="mb20">View and attend to Patients on the Queue</p>
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
                    <th>Lab Request</th>
                    <th>Attended By</th>
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
                    <td><?php if($patient->lab_request_id == 0) { echo "No Lab Request";} //check for lab request using lab_request_id
                          else { if($patient->lab_status == 0) {?>
                          <a href="<?php echo base_url(); ?>laboratory/detailedRequest/<?php echo $patient->lab_request_id; ?>/<?php echo $patient->patient_id; ?>">View Lab Request</a>
                        <?php } elseif ($patient->lab_status == 1) { ?>
                          <a href="<?php echo base_url(); ?>laboratory/detailedRequest/<?php echo $patient->lab_request_id; ?>/<?php echo $patient->id; ?>">View Lab Results</a>
                        <?php } else echo "No Lab Request";}?>
                    </td>
                    <td><?php echo $patient->user_name; ?></td>
                    <td><a href="<?php echo base_url(); ?>patients/consultation/<?php echo $patient->patient_id; ?>"><span class="btn btn-success"><i class="fa fa-stethoscope"></i>&nbsp;See Patient</span></a>
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