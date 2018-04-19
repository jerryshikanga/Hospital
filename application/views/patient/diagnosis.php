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
            url: '<?php echo base_url(); ?>patients/editSymptoms/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#add-symptoms-content').html(html);
               
            }
          });
      }

      function addLab_Request(id)

      {
      $.ajax({
            url: '<?php echo base_url(); ?>patients/editSymptoms/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#add-symptoms-content').html(html);
               
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
    </script>

<?php 
      $details = $patient_details->result()[0];
      @$treatment = $symptoms->result()[0];
      function get_age($datetime)
        {
          $from = new DateTime($datetime);
          $to   = new DateTime('today');
          return($from->diff($to)->y);
        }

      function format_date($datetime)
        {
          $date = date('jS F Y', (strtotime($datetime)));
          return $date;
        }
      function replace($input)
        {
          $input = str_replace(',','<br>',$input);
          return $input;
        }
?> 


    <link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>

    <script src="<?php echo base_url(); ?>assets/custom/js/select/defaults-*.min.js"></script>

    <div id="addSymptoms" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add New Symptoms</h4>
          </div>
          <div class="modal-body" id="add-symptoms-content">
            
          </div>
        </div>
      </div>
    </div>
    <div id="labRequest" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Lab Request</h4>
          </div>
          <div class="modal-body">
            <form class="form">
              <div class="col-md-12 subtitle subtitle-lined">
                  <p>Select one or more lab services</p>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Lab Service: <sup>*</sup></label>
                <div class="col-sm-9">
                  <input type="hidden" name="treatment_id" value="<?php echo $treatment->id; ?>" />
                  <input type="hidden" name="id_of_patient" value="<?php echo $details->patient_id; ?>" />
                  <select class="form-control mb15 selectpicker" name="lab_request" data-live-search="true" data-style="btn-white">
                  <?php foreach ($lab_service->result() as $lab){?>
                    <option value="<?php echo $lab->id; ?>"><?php echo $lab->name; ?> - Ksh. <?php echo $lab->price; ?></option>
                  <?php } ?>
                </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <button type="button" class="btn btn-white btn-xs">Add lab service</button>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Notes: <sup>*</sup></label>
                <div class="col-sm-9">
              <textarea id="wysiwyg" placeholder="Enter Notes concerning the lab request..." class="form-control" rows="3"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Lab Request</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="recommend" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Prescribe Medicine to the Patient</h4>
          </div>
          <div class="modal-body">
            <form class="form">
              <div class="form-group">
                <label class="col-sm-2 control-label">Treatment*:</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" placeholder="Select Treatment"/>
                </div>
              </div>  
              <div class="col-md-12 subtitle subtitle-lined">
                  <p>Click on Add Medicine to add more Prescriptions</p>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Medication*:</label>
                <div class="col-sm-4">
                  <select class="form-control mb15 selectpicker" name="patient_id" data-live-search="true" data-style="btn-white">
                  <?php foreach ($medicines->result() as $medicine){?>
                    <option value="<?php echo $medicine->medicine_id; ?>"><?php echo $medicine->name; ?></option>
                  <?php } ?>
                </select>
                </div>
                <div class="col-sm-3">
                  <input type="text" name="name" class="form-control" placeholder="Times a Day"/>
                </div>
                <div class="col-sm-3">
                  <input type="text" name="name" class="form-control" placeholder="Total Days"/>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <button type="button" class="btn btn-white btn-xs">Add a New Medicine Prescription</button>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Notes*:</label>
                <div class="col-sm-10">
              <textarea id="wysiwyg" placeholder="Enter Notes concerning the prescription..." class="form-control" rows="3"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create Prescription</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="pageheader">
      <h2><i class="fa fa-users"></i> Diagnosis</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Patients</a></li>
          <li class="active">Consultation</li>
        </ol>
      </div>
    </div>

    <div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
          <div class="col-md-6">
             <h3 class="panel-title pull-left"> Name: <small><?php echo $details->name; ?></small></h3></br>
             <h3 class="panel-title pull-left"> Age: <small><?php echo get_age($details->dob); ?></small></h3></br>
             <h3 class="panel-title pull-left"> Last Visit: <small><?php echo format_date($details->last_visit); ?></small></h3>
           </div>
            <div class="col-md-6 text-right">
              <button type="button" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#recommend" ><span class="glyphicon glyphicon-pencil"></span>&nbsp; Prescribe Medicine</button>
              <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#labRequest" onclick="edit('<?php echo @$treatment->id; ?>')" style="margin:0 10px 5px 0;"><span class="fa fa-medkit"></span>&nbsp; Lab Request</button>
              <button type="button" class="btn btn-warning pull-right btn-sm" data-toggle="modal" data-target="#addSymptoms" onclick="edit('<?php echo @$treatment->id; ?>')" style="margin:0 10px 5px 0;"><span class="fa fa-plus"></span>&nbsp; Add Symptoms</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          <table class="table table-invoice" style="margin-top:0px">
            <thead>
              <tr>
                <th class="col-md-4">Symptoms</th>
                <th class="col-md-4" style="text-align:left;">Lab Request</th>
                <th class="col-md-4" style="text-align:left;">Lab Results</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                    <p><?php echo replace(@$treatment->symptoms); ?></p>
                </td>
                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim </td>
                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</td>
              </tr>
              
            </tbody>
          </table>
        </div>
        <div class="clearfix" style></div>
    </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title"><?php echo $details->name; ?>'s History</h4>
          <p>View a summary of the Patient's Medical History.</p>
        </div>
         <div class="table-responsive">
            <table class="table table-invoice">
            <thead>
              <tr>
                <th>Diagnosis</th>
                <th>Doctor</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                    <div class="text-primary"><strong>Malaria</strong></div>
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</small>
                </td>
                <td>Dr. Khan</td>
                <td>27th January, 2016</td>
              </tr>
              <tr>
                <td>
                    <div class="text-primary"><strong>Typhoid</strong></div>
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</small>
                </td>
                <td>Dr. Nish</td>
                <td>7th September, 2015</td>
              </tr>
              <tr>
                <td>
                    <div class="text-primary"><strong>Root Canal</strong></div>
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</small>
                </td>
                <td>Dr. Sarah</td>
                <td>2nd June, 2015</td>
              </tr>
              <tr>
                <td>
                    <div class="text-primary"><strong>Amoeba</strong></div>
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</small>
                </td>
                <td>Dr. Scotfield</td>
                <td>27th October, 2014</td>
              </tr>
            </tbody>
          </table>
          </div><!-- table-responsive -->
      </div>
      
    </div><!-- contentpanel -->