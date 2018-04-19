    <script type="text/javascript">
      $(document).ready(function() {
        $("#active_").change(function() {
          if(this.checked) {
              $('#active').val(1);
          }
        else
          $('#active').val(0);
        });

        $('#addMedicineForm').bootstrapValidator({
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
            url: '<?php echo base_url(); ?>medicines/addMedicine',
            type: 'post',
            data: $('#addMedicineForm :input'),
            dataType: 'json',   
            success: function(response) {
              console.log(response);
              $('#addMedicineForm')[0].reset();
              $('#addMedicineModal').modal('hide');
              bootbox.alert(response.message, function()
              {
                window.location.reload();
              });
            }
          });
        });

        $('#addMedicineButton').click(function(){
          $.ajax({
            url : "<?php echo base_url(); ?>medicines/add_medicine_form",
            type : "post",
            dataType : "html",
            success : function(html){
              $("#add-medicine-modal-content").html(html);
            }
          });
        });

        $('#addMedicineCategoryForm').bootstrapValidator({
              message: 'This value is not valid',
              feedbackIcons: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  categoryName: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in name!"
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
            url: '<?php echo base_url(); ?>medicines/addMedicineCategory',
            type: 'post',
            data: $('#addMedicineCategoryForm :input'),
            dataType: 'json',   
            success: function(response) {
              console.log(response);
              $('#addMedicineCategoryForm')[0].reset();
              $('#addMedicineCategoryModal').modal('hide');
              bootbox.alert(response.message, function()
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
            url: '<?php echo base_url(); ?>medicines/edit_medicine_modal/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#edit-medicine-modal-content').html(html);
               
            }
          });
      }

      function rm(nm,id){
        bootbox.confirm("Are you sure you want to delete Medicine called " + nm + "?", function(result) {
            if(result) {
            
          $.ajax({
          url: '<?php echo base_url(); ?>medicine/deleteMedicine/' + id,
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

      function format_date($datetime)
      {
        $date = date('jS F Y', (strtotime($datetime)));
        return $date;
      }
      ?>

    <div id="editMedicineModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Medicine Info Details</h4>
          </div>
          <div class="modal-body" id="edit-medicine-modal-content">
              
          </div>
        </div>
      </div>
    </div>

    <div id="addMedicineCategoryModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add Medicine Category</h4>
          </div>
          <div class="modal-body" id="add-medicine-category-modal-content">
            <form class="form" id="addMedicineCategoryForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="categoryName" class="form-control" placeholder="Enter Category Name e.g Pain killers"/>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Category</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="addMedicineModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" id="addMedicineButton" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add a Drug</h4>
          </div>
          <div class="modal-body" id="add-medicine-modal-content">
            <form class="form" id="addMedicineForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter Full Medicine Name e.g Panadol Extra Paracetamol"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Price:</label>
                <div class="col-sm-7">
                  <input type="text" name="price" class="form-control" placeholder="Enter medicine price e.g. Ksh 550" data-fv-integer="true"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Manufacturer:</label>
                <div class="col-sm-7">
                  <input type="text" name="manufacturer" class="form-control" placeholder="Enter Full Manufacturer Name"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description:</label>
                <div class="col-sm-7">
                  <input type="text" name="description" class="form-control" placeholder="Enter a short description"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Select Medicine Category:</label>
                <div class="col-sm-7">
                  <select class='form-control' name='category'>
                    <?php foreach ($categories->result() as $category) : ?>
                        <option value="<?=$category->category_id?>"><?=$category->name?></option>
                    <?php endforeach?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Medicine</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Medicines</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="active">Medicines</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Medicine List</h5>
            <p class="mb20">Add, View and Edit Medicines</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" id="addMedicineCategoryButton" data-toggle="modal" data-target="#addMedicineCategoryModal"><span class="fa fa-plus"></span> Add Category</button>
            <button type="button" class="btn btn-success" id="addMedicineButton" data-toggle="modal" data-target="#addMedicineModal"><span class="fa fa-plus"></span> Add Medicine</button>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Medicine Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Manufacturer</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($medicines->result() as $medicine){?>
                  <tr>
                    <td><?php echo $medicine->medicine_id; ?></td>
                    <td><?php echo $medicine->name; ?></td>
                    <td><?php echo $medicine->category; ?></td>
                    <td><?php echo $medicine->price; ?></td>
                    <td><?php echo $medicine->manufacturer; ?></td>
                    <td><?php echo $medicine->description; ?></td>
                    <td><span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMedicineModal" onclick="edit('<?php echo $medicine->medicine_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
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