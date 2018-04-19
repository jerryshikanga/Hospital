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
                  results: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in the lab results, if none input N/A!"
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
            url: '<?php echo base_url(); ?>laboratory/addLabResult',
            type: 'post',
            data: $('#addForm :input'),
            dataType: 'html',   
            success: function(html) {
            $('#addForm')[0].reset();
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
          });
        });
      });
    
    </script>
    <?php
    @$request = $lab_result->result()[0];
    ?>
        
    <div class="pageheader">
      <h2><i class="fa fa-pencil"></i> Lab Results  </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Bracket</a></li>
          <li><a href="general-forms.html">Forms</a></li>
          <li class="active">Form Layouts</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <p class= "text-danger"><?php if($lab_result->result() == null) echo "No Lab Requests Found"; else{?></p>
              <h4 class="panel-title">Lab Results Form</h4>
              <p>Fill in the results from the lab tests</p>
            </div>
            <form class="form" id="addForm">
              <input type="hidden" id="request_id" name="request_id" class="form-control" value="<?php echo $request->request_id; ?>"/>
              <input type="hidden" id="treatment_id" name="treatment_id" class="form-control" value="<?php echo $request->patient_treatment_id; ?>"/>
              <div class="panel-body">
                <?php foreach ($lab_result->result() as $results){?>
                  <div class="form-group">
                    <div class="col-md-5">
                      <input type="hidden" id="request_details_id" name="request_details_id[]" class="form-control" value="<?php echo $results->id; ?>"/>
                      <label class="col-sm-12 control-label"><span class="text-warning"><strong>Requested Service &nbsp; : &nbsp; </strong></span> <span class="text-success"><?php echo $results->service_name; ?> - <?php echo $results->service_description; ?></span></label>
                      <label class="col-sm-12 control-label"><span class="text-warning"><strong>Service Costs &nbsp; : &nbsp; </strong></span> <span class="text-success">Ksh. <?php echo $results->service_price; ?></span></label>
                    </div>
                    <div class="col-sm-7">
                      <textarea class="form-control" rows="2" id="results" name="results[]" placeholder="Input Lab Results, if none type N/A"></textarea>
                    </div>
                  </div>
                  <?php }?>
              </div><!-- panel-body -->
              <div class="panel-footer">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary pull-right">Send Results</button>
                </div>
              </div>
            </form>
            <?php } ?>
          </div><!-- panel -->
        </div>
      </div><!-- row -->
    </div>

