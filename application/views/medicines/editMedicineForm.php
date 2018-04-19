    <script type="text/javascript">
      $(document).ready(function() {
        $('#editMedicineForm').bootstrapValidator({
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
                              message: "You're required to fill in name!"
                          }
                      }
                  },
                  price : {
                      validators:{
                        notEmpty:{
                          message: "You are required to fill price"
                        },
                        greaterThan : {
                          value : 10,
                          message : "Price cannot be negative"
                        }
                      }
                  },
                  manufacturer : {
                    validators : {
                      notEmpty : {
                        message : "You are required to fill in the manufacturer"
                      }
                    }
                  },
                  category : {
                    validators : {
                      notEmpty : {
                        message : "You should pick a category"
                      }
                    }
                  }
              }
          }).on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.ajax({
            url: '<?php echo base_url(); ?>medicines/editMedicine/<?=$medicine->medicine_id?>',
            type: 'post',
            data: $('#editMedicineForm :input'),
            dataType: 'json',   
            success: function(response) {
              $('#editMedicineForm')[0].reset();
              $('#editMedicineModal').modal('hide');
              bootbox.alert(response.message, function()
              {
                window.location.reload();
              });
            }
          });
        });
      });
    </script>



            <form class="form" id="editMedicineForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter Full Medicine Name e.g Panadol Extra Paracetamol" value="<?=$medicine->name?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Price:</label>
                <div class="col-sm-7">
                  <input type="text" name="price" class="form-control" placeholder="Enter medicine price e.g. Ksh 550" value="<?=$medicine->price?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Manufacturer:</label>
                <div class="col-sm-7">
                  <input type="text" name="manufacturer" class="form-control" placeholder="Enter Full Manufacturer Name" value="<?=$medicine->manufacturer?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description:</label>
                <div class="col-sm-7">
                  <input type="text" name="description" class="form-control" placeholder="Enter a short description" value="<?=$medicine->description?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Select Medicine Category:</label>
                <div class="col-sm-7">
                  <select class='form-control' name='category'>
                    <?php foreach ($categories->result() as $category) : ?>
                        <option value="<?=$category->category_id?>" <?php if ($medicine->category==$category->category_id) {
                          echo "selected";
                        }?>><?=$category->name?></option>
                    <?php endforeach?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Edit Medicine</button>
              </div>
            </form>