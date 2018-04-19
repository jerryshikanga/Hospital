<?php 
      @$detailed = $detailed_request->result()[0];
      
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

    
    <div class="contentpanel">

      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-sm-12">
            <h5 class="subtitle mb5">Patient Details</h5>
            <p class="mb5"><strong>Patient's Name : </strong><span style="display:inline-block; width: 20%;"><?php echo $detailed->patient_name; ?></span><strong>Patient's Age: </strong><?php echo get_age($detailed->dob); ?></p>
            <p class="mb5"><strong>Requested By : </strong> <span style="display:inline-block; width: 21%;"><?php foreach($users->result() as $user) { echo $user->doctor; break; } ?></span><strong>Requested Date: </strong><?php echo format_date($detailed->date_created); ?></p>
          </div>
        </div>
      </div>
      <div class="panel panel-default panel-alt">
        <div class="panel-body">
          <div class="row editable-list-item mb30">
            <div class="col-sm-12">
              <h5 class="subtitle mb5"><p class="text-warning">Current Lab Requests</p></h5>
            </div>
            <?php foreach ($detailed_request->result() as $details){?>
              <div class="col-sm-6">
                <div class="media">
                  <div class="media-body event-body">
                    <p class="text-primary">Lab Service : <?php echo $details->service_name;?>
                    <small class="text-muted"><i class="fa fa-user-md"></i> <strong>Requested by : </strong> <?php foreach($users->result() as $user) { echo $user->requester; break; } ?></small>
                    <small class="text-muted"><i class="fa fa-file-text-o"></i> <strong>Notes : </strong><?php echo $details->notes;?></small>
                    <p class="text-success">Results : <?php echo $details->lab_results;?>
                  </div>
                </div><!-- media -->
              </div><!-- col-sm-6 -->
            <?php }?>
          </div>
          <div class="col-sm-12">
              <h5 class="subtitle mb5"><p class="text-warning">Previous Lab Requests</p></h5>
              <p class= "text-danger"><?php if($previous->result() == null) echo "No Previous Lab Requests Found"; ?></p>
            </div>
            <?php foreach ($previous->result() as $prev){?>
              <div class="col-sm-4">
                <div class="media">
                  <div class="media-body event-body">
                    <p class="text-primary">Lab Service : <?php echo $prev->service_name;?>
                    <small class="text-muted"><i class="fa fa-calendar"></i> <strong>Date : </strong><?php echo format_date($prev->date_results); ?></small>
                    <small class="text-muted"><i class="fa fa-user"></i> <strong>Attended by : </strong> <?php foreach($users->result() as $user) foreach ($detailed_request->result() as $det){ if($det->id == $user->id) echo $user->labtech; break;}?></small>
                    <small class="text-muted"><i class="fa fa-file-text-o"></i> <strong>Notes : </strong><?php echo $prev->notes;?></small>

                    <p class="text-success">Results : <?php echo $prev->lab_results;?>
                  </div>
                </div><!-- media -->
              </div><!-- col-sm-6 -->
            <?php }?>
        </div>
      </div>
    </div><!-- contentpanel -->            

            