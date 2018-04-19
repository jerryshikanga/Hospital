   
    <?php
      function format_date($datetime)
        {
          $date = date('jS F Y', (strtotime($datetime)));
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

    <style type="text/css">
      table { 
        counter-reset: line-number; 
      }
      td:first-child:before {
        content: counter(line-number) ".";
        counter-increment: line-number;
        padding-right: 0.3em; 
      }
    </style>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Patients Treatment</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>patients">Patients</a></li>
          <li class="active">Patients Treatment List</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Patients Treatment List</h5>
            <p class="mb20">Search and View previous treatments</p>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Datetime</th>
                    <th>Patient Name</th>
                    <th>Patient Age</th>
                    <th>Doctor</th>
                    <th>Diagnosis</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($treatment_details->result() as $treatment){?>
                  <tr>
                    <td></td>
                    <td><?php echo $treatment->datetime; ?></td>
                    <td><?php echo $treatment->name; ?></td>
                    <td><?php echo get_age($treatment->dob); ?></td>
                    <td><?php echo $treatment->user; ?></td>
                    <td><?php echo $treatment->diagnosis; ?></td>
                    <td><a href="<?php echo base_url();?>patients/detailedPatientList/<?php echo $treatment->id;?>" class="btn btn-info btn-sm" role="button"><span class="glyphicon glyphicon-pencil"></span>&nbsp;View</span></a>
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