	
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
            symptoms: {
                validators: {
                    notEmpty: {
                        message: 'Symptoms are required and cannot be empty'
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
	    url: '<?php echo base_url(); ?>patients/editSymptoms',
	    type: 'post',
	    data: $('#editForm :input'),
	    dataType: 'html',
	    success: function(html) {
            $('#editForm')[0].reset();
            $('#editMedicine').modal('hide');
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
    });
  });
});

</script>

	<form id="editForm" method="post" class="form-horizontal">
	<?php 
	$symptom = $symptoms->result()[0];
	?>
		<div class="form-group">
			<div class="col-md-12">
				<label class="col-lg-3 control-label">Symptoms : <sup>*</sup></label>
				<div class="col-lg-9">
					<input type="hidden" name="item_id" value="<?php echo $symptom->id; ?>" />
	             	<textarea id="wysiwyg" placeholder="Enter Patient's Symptoms here. Seperating each symptom with a comma e.g headache, dizzyness..." class="form-control" rows="5" name="symptoms" required><?php echo $symptom->symptoms; ?></textarea>
				</div>
			</div>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	</form>