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
                              message: "You're required to fill in Lab Service Name!"
                          }
                      }
                  }, 
                  price: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in price for the Lab Service!"
                                }
                            }
                        },
                  description: {
                            validators: {
                                notEmpty: {
                                    message: "You're required to fill in description for the Lab Service!"
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
            url: '<?php echo base_url(); ?>laboratory/addService',
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
            url: '<?php echo base_url(); ?>laboratory/editService/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#edit-service-content').html(html);
               
            }
          });
      }

      function activate(nm,id){
        bootbox.confirm("Are you sure you want to activate a service called " + nm + "?", function(result) {
            if(result) {
            
          $.ajax({
          url: '<?php echo base_url(); ?>laboratory/activateService/' + id,
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

      function deactivate(nm,id){
        bootbox.confirm("Are you sure you want to deactivate a service called " + nm + "?", function(result) {
            if(result) {
            
          $.ajax({
          url: '<?php echo base_url(); ?>laboratory/deactivateService/' + id,
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
    <div id="editCompany" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Company Info Details</h4>
          </div>
          <div class="modal-body" id="edit-service-content">
            
          </div>
        </div>
      </div>
    </div>

    <div id="addStore" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add a Lab Service</h4>
          </div>
          <div class="modal-body">
            <form class="form" id="addForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Service Name:</label>
                <div class="col-sm-9">
                  <input type="text" name="name" class="form-control" placeholder="Enter Lab Service name"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Service Price:</label>
                <div class="col-sm-9">
                  <input type="text" name="price" class="form-control" placeholder="Enter Lab Service Price"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description:</label>
                <div class="col-sm-9">
                  <textarea class="form-control" name="description" rows="3" placeholder="Enter description of the lab service"></textarea>
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
      <h2><i class="fa fa-users"></i> List of Lab Services</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="active">Lab Services</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Lab Services List</h5>
            <p class="mb20">Edit, View existing and Add New Lab Services</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStore"><span class="fa fa-plus"></span> Add Service</button>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Service Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($services->result() as $service){?>
                  <tr>
                    <td><?php echo $service->id; ?></td>
                    <td><?php echo $service->name; ?></td>
                    <td><?php echo $service->price; ?></td>
                    <td><?php echo $service->description; ?></td>
                    <td><?php if($service->deleted_status == 1) echo "Inactive"; else echo "Active"; ?></td>
                    <td><span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCompany" onclick="edit('<?php echo $service->id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
                      <?php if($service->deleted_status == 1){?>
                      <a href="javascript:void(0);" onclick="activate('<?php echo $service->name; ?>','<?php echo $service->id; ?>');"><span class="btn btn-info btn-sm"><span class="glyphicon glyphicon-trash"></span>&nbsp;Activate</span></a>
                      <?php }
                            else { ?>
                      <a href="javascript:void(0);" onclick="deactivate('<?php echo $service->name; ?>','<?php echo $service->id; ?>');"><span class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span>&nbsp;Deactivate</span></a>
                      <?php } ?>
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