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
            url: '<?php echo base_url(); ?>pharmacy/addMedicine',
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
            url: '<?php echo base_url(); ?>pharmacy/editMedicine/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#edit-medicine-content').html(html);
               
            }
          });
      }

      function rm(nm,id){
        bootbox.confirm("Are you sure you want to delete medicine called " + nm + "?", function(result) {
            if(result) {
            
          $.ajax({
          url: '<?php echo base_url(); ?>pharmacy/deleteMedicine/' + id,
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
    <div id="editMedicine" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Medicine Info Details</h4>
          </div>
          <div class="modal-body" id="edit-medicine-content">
            
          </div>
        </div>
      </div>
    </div>

    <div id="addStore" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add a Medicine</h4>
          </div>
          <div class="modal-body">
            <form class="form" id="addForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Medicine Name :</label>
                <div class="col-sm-9">
                  <input type="text" name="name" class="form-control" placeholder="Enter the Name of the Medicine e.g Panadol 10gms"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Price :</label>
                <div class="col-sm-9">
                  <input type="text" name="price" class="form-control" placeholder="Enter the Price of the Medicine e.g 200"/>
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
                  <input type="text" name="manufacturer" class="form-control" placeholder="Enter the Manufacturer of the medicine e.g glykosmith"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description :</label>
                <div class="col-sm-9">
                  <input type="text" name="description" class="form-control" placeholder="Enter description of the Medicine e.g tablets"/>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Service</button>
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
          <li><a href="<?php echo base_url(); ?>patients">Pharmacy</a></li>
          <li class="active">Medicines</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Medicines List</h5>
            <p class="mb20">Edit, View existing and Add New Medicines</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStore"><span class="fa fa-plus"></span> Add Medicine</button>
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
                    <td><span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMedicine" onclick="edit('<?php echo $medicine->medicine_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
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