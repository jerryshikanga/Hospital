	
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
            price: {
                validators: {
                    notEmpty: {
                        message: 'Price is required and cannot be empty'
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
	    url: '<?php echo base_url(); ?>laboratory/editService',
	    type: 'post',
	    data: $('#editForm :input'),
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

</script>

	<form id="editForm" method="post" class="form-horizontal">
	<?php 
	$service = $services->result()[0];
	?>

		<div class="form-group">
      <label class="col-sm-3 control-label">Service Name:</label>
      <div class="col-sm-9">
        <input type="hidden" name="item_id" value="<?php echo $service->id; ?>" />
        <input type="text" name="name" class="form-control" placeholder="Enter Lab Service name" value="<?php echo $service->name; ?>" readonly/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Service Price:</label>
      <div class="col-sm-9">
        <input type="text" name="price" class="form-control" placeholder="Enter Lab Service Price" value="<?php echo $service->price; ?>"/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Description:</label>
      <div class="col-sm-9">
        <textarea class="form-control" name="description" rows="3" placeholder="Enter description of the lab service"><?php echo $service->description; ?></textarea>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
	</form>