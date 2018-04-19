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
                  symptoms: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in Patient's presenting complaints!"
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
            url: '<?php echo base_url(); ?>patients/addSymptoms',
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

        //Add Lab Request
        $('#addLab').bootstrapValidator({
              message: 'This value is not valid',
              feedbackIcons: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  symptoms: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in Patient's presenting complaints!"
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
            url: '<?php echo base_url(); ?>laboratory/addRequest',
            type: 'post',
            data: {ids: JSON.stringify(ids), notes: JSON.stringify(notes), treatment_id:$('#treatment_id').val()},
            dataType: 'html',   
            success: function(html) {
            $('#addLab')[0].reset();
            $('#labRequest').modal('hide');
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
          });
        });

        //Add Medicine and Treatment
        $('#addMedicineForm').bootstrapValidator({
              message: 'This value is not valid',
              feedbackIcons: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  symptoms: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in Patient's presenting complaints!"
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
            url: '<?php echo base_url(); ?>laboratory/addMedicine',
            type: 'post',
            data: {medicine: JSON.stringify(medicine), dosage: JSON.stringify(dosage), treatment_id:$('#treatment_id').val(), treatment:$('#treatment_name').val()},
            dataType: 'html',   
            success: function(html) {
            $('#addMedicineForm')[0].reset();
            $('#treatment').modal('hide');
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
          });
        });
      });

    var ids = [];
    var med_ids = [];
    var notes = [];
    var dosage = [];
    var medicine = [];
    var counter = 1;
    var count = 1;

    function add()
    {
      var value = $('#service_id').val();
      ids.push(value);
      notes.push($('#notes').val());
      var option_ = "option[value='" + value + "']";
      var template = '<tr id="' + counter + '"><td>' + counter + '</td><td>' + $(option_).text() + '</td><td>' + $('#notes').val() + '</td><td><a onclick="delete();"><i class="fa fa-trash-o"></i></a></td></tr>';
      $('#service-content').append(template);
      counter ++;
    }

    function addMedicine()
    {
      medicine.push($('#medicine').val());
      dosage.push($('#dosage').val());
      var template = '<tr id="' + count + '"><td>' + count + '</td><td>' + $('#medicine').val() + '</td><td>' + $('#dosage').val() + '</td><td><a onclick="delete();"><i class="fa fa-trash-o"></i></a></td></tr>';
      $('#treatment-content').append(template);
      count ++;
    }

    function ClearFields() {
      document.getElementById("notes").value = "";
    }

    function ClearMed() {
      document.getElementById("medicine").value = "";
      document.getElementById("dosage").value = "";
    }

    </script>
<?php 
      $details = $patient_details->result()[0];
      @$treatment = $treatment_details->result()[0];
      @$presenting = $presenting->result()[0];
      @$history = $history->result()[0];
      @$general = $general->result()[0];
      @$systemic = $systemic->result()[0];
      
      function format_date($datetime)
        {
          $date = date('jS F Y', (strtotime($datetime)));
          return $date;
        }

      function format_date_time($datetime)
        {
          $date = date('jS F Y H:i:s', (strtotime($datetime)));
          return $date;
        }

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


     <!-- Lab Request -->

    <div id="labRequest" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Request for a Lab Test</h4>
          </div>
          <div class="modal-body">
            <form class="form" id="addLab">
              <input type="hidden" id="treatment_id" value="<?php echo @$treatment->id; ?>"/>
              <div class="form-group">
                <label class="col-sm-3 control-label">Lab Service:</label>
                <div class="col-sm-9">
                <!-- <select class="form-control mb15 selectpicker" id="service_id" name="patient_id" data-live-search="true" data-style="btn-white"> -->
                <select class="form-control" id="service_id" name="patient_id" data-live-search="true" data-style="btn-white">
                  <?php foreach ($services->result() as $service){?>
                    <option value="<?php echo $service->id; ?>"><?php echo $service->name; ?> - Ksh. <?php echo $service->price; ?></option>
                  <?php } ?>
                </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Notes:</label>
                <div class="col-sm-9">
                  <input type="text" id="notes" name="notes" class="form-control" placeholder="Enter some notes about the lab test"/>
                </div>
              </div>
              <div class="mb10">
                <button type="button" class="btn btn-white btn-xs" onclick="add();ClearFields();">Add lab tests</button>
              </div>
              <div class="table-responsive mb30">
                <table class="table table-primary mb30">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Lab Service</th>
                        <th>Notes</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="service-content">

                    </tbody>
                </table>
              </div><!-- table-responsive -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Request</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    

    <!-- Medication an Treatment -->
    <div id="treatment" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add Treatment and Prescribe Medicine</h4>
          </div>
          <div class="modal-body">
            <form class="form" id="addMedicineForm">
              <div class="form-group">
                <label class="col-sm-2 control-label">Treatment:</label>
                <div class="col-sm-10">
                  <input type="text" id = "treatment_name" name="treatment_name" class="form-control" placeholder="Enter the treatment or diagnosis"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Medicine:</label>
                <div class="col-sm-7">
                  <select class="form-control" id = "medicine">
                    <?php foreach ($medicines->result() as $medicine) : ?>
                      <option value="<?=$medicine->name?>"><?=$medicine->name?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-sm-3">
                  <input type="text" id = "dosage" name="dosage" class="form-control" placeholder="Enter Dosage"/>
                </div>
              </div>
              <div class="mb10">
                <button type="button" class="btn btn-white btn-xs" onclick="addMedicine();ClearMed();">Add more medicine</button>
              </div>
              <div class="table-responsive mb30">
                <table class="table table-primary mb30">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <th>Times</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="treatment-content">

                    </tbody>
                </table>
              </div><!-- table-responsive -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Request</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> Consultation</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Patients</a></li>
          <li class="active">Consultation </li>
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
            <button type="button" class="btn btn-success <?php $status = false; if(@$treatment->treatment_status == NULL) { echo "disabled"; $status = true; } ?>" data-toggle="modal" data-target="#labRequest"> Lab Request</button>
            <button type="button" class="btn btn-warning <?php $status = false; if(@$treatment->treatment_status == NULL) { echo "disabled"; $status = true; } ?>" data-toggle="modal" data-target="#treatment"> Medication/ Treatment</button>
            <a href="<?php echo base_url();?>appointments/addAppointment/<?php echo $details->patient_id;?>" class="btn btn-success" role="button">Appointment</a>
          </div>
            <div class="clearfix"></div>
        </div>
            <form class="form" id="addForm">
          </br>
          <div class="form-group">
            <div class="col-sm-6">
                <label class="col-sm-12 control-label">Presenting Complaints:</label>
              <input type="hidden" name="id" value="<?php echo $details->patient_id; ?>"/>
              <input type="hidden" name="treatment_id" value="<?php echo @$treatment->id; ?>"/>
              <textarea id="wysiwyg" placeholder="" class="form-control" rows="6" name="symptoms" required><?php if($status != 1){ echo $presenting->description; }?></textarea>
            </div>
            <div class="col-sm-6">
                <label class="col-sm-12 control-label">History of Presenting Complaints:</label>
              <textarea id="wysiwyg" placeholder="" class="form-control" rows="6" name="history"><?php if($status != 1){ echo @$history->description; }?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-6">
                <label class="col-sm-12 control-label">General Examinations:</label>
              <textarea id="wysiwyg" placeholder="" class="form-control" rows="6" name="general"><?php if($status != 1){ echo @$general->description; }?></textarea>
            </div>
            <div class="col-sm-6">
                <label class="col-sm-12 control-label">Systemic Examinations:</label>
              <textarea id="wysiwyg" placeholder="" class="form-control" rows="6" name="systemic"><?php if($status != 1){ echo @$systemic->description; }?></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary pull-right" style="margin:0 10px 5px 0;">Save and Continue</button>
        </form>
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
                <th class="col-md-6">Diagnosis</th>
                <th>Doctor</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($summary->result() as $sum){?>
              <tr>
                <td>
                    <div class="text-primary"><strong><?php echo $sum->diagnosis; ?></strong></div>
                    <small><?php if($sum->medicine == "") echo "None"; else echo $sum->medicine; ?></small>
                </td>
                <td><?php echo $sum->user_name; ?></td>
                <td><?php echo format_date_time($sum->datetime); ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          </div><!-- table-responsive -->
      </div>
      
    </div><!-- contentpanel -->