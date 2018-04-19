	
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
                              message: "You're required to fill in the Name of the medicine!"
                          }
                      }
                  }, 
                  price: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in the Price of the medicine!"
                                }
                            }
                        },
                  manufacturer: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in the Manufacturer of the medicine!"
                                }
                            }
                        },
                  description: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in the Description of the medicine!"
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
	    url: '<?php echo base_url(); ?>pharmacy/editMedicine',
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
	$medicine = $medicines->result()[0];
	?>

              <div class="form-group">
                <label class="col-sm-3 control-label">Medicine Name :</label>
                <div class="col-sm-9">
                  <input type="hidden" name="item_id" value="<?php echo $medicine->medicine_id; ?>" />
                  <input type="text" name="name" class="form-control"  value="<?php echo $medicine->name; ?>" placeholder="Enter the Name of the Medicine e.g Panadol 10gms" readonly/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Price :</label>
                <div class="col-sm-9">
                  <input type="text" name="price" class="form-control" value="<?php echo $medicine->price; ?>" placeholder="Enter the Price of the Medicine e.g 200"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Select a Category : <sup>*</sup></label>
                <div class="col-sm-9">
                  <select class="form-control" id="role" name="category">
                    <?php foreach ($categories->result() as $category){?>
                        <option value="<?php echo $category->category_id; ?>"><?php echo $category->name; ?></option>
                    <?php } ?>
                  </select>
                  
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Manufacturer :</label>
                <div class="col-sm-9">
                  <input type="text" name="manufacturer" class="form-control" value="<?php echo $medicine->manufacturer; ?>" placeholder="Enter the Manufacturer of the medicine e.g glykosmith"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description :</label>
                <div class="col-sm-9">
                  <input type="text" name="description" class="form-control" value="<?php echo $medicine->description; ?>" placeholder="Enter description of the Medicine e.g tablets"/>
                </div>
              </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
	</form>