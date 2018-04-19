<?php 
      $detailed = $detailed_complaints->result()[0];
      $users = $treatment_users;
      $treatment = $detailed_diagnosis->result()[0];
      $lab = $lab_details->result()[0];

      
      function format_date($datetime)
        {
          $date = date('jS F Y H:i:s', (strtotime($datetime)));
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
            <p class="mb5"><strong>Treated By :</strong> <span style="display:inline-block; width: 23%;"><?php foreach($users->result() as $user) { echo $user->doctor; break; } ?></span><strong>Last Visit: </strong><?php echo format_date($detailed->datetime); ?></p>
          </div>
        </div>
      </div>
      <div class="panel panel-default panel-alt">
        <div class="panel-body">
          <div class="row editable-list-item mb30">
            <div class="col-sm-12">
              <h5 class="subtitle mb5"><p class="text-warning">Last Treatment Details</p></h5>
            </div>
              <!-- Symptoms Details Request -->
            <div class="col-sm-4">
                <div class="media">
                  <div class="media-body event-body">
                    <p class="text-primary">Presenting Complaints : <span class="text-muted"> <?php echo $detailed->presenting; ?> </span> </p>
                    <p class="text-primary">History of Presenting Complaints : <span class="text-muted"> <?php if($detailed->history == "") echo "No Details"; else echo $detailed->history; ?> </span> </p>
                    <p class="text-primary">General Examinations : <span class="text-muted"> <?php if($detailed->general == "") echo "No Details"; else echo $detailed->general; ?> </span> </p>
                    <p class="text-primary">Systemic Examinations : <span class="text-muted"> <?php if($detailed->systemic == "") echo "No Details"; else echo $detailed->systemic; ?> </span> </p>
                    
                  </div>
                </div><!-- media -->
              </div><!-- col-sm-6 -->
              <!-- Lab Request -->
              <div class="col-sm-4">
                <div class="media">
                  <div class="media-body event-body">
                    <p class="text-primary">Diagnosis : <span class="text-muted"> <?php echo $treatment->diagnosis; ?> </span>
                    <p class="text-primary">Prescribed Medicine : <span class="text-muted"> <?php $i = 0; foreach($prescriptions->result() as $prescribe) if($prescribe->prescription_treatment_id == $detailed->treatment_id) { if($i > 0) echo " , "; echo ($prescribe->medicine." (". $prescribe->dosage .")"); $i ++; }?> </span>
                    <small class="text-success"><i class="fa fa-file-text-o"></i> <strong>Date : </strong> <?php echo $treatment->prescription_notes; ?></small>
                   <small class="text-success"><i class="fa fa-file-text-o"></i> <strong>Notes : </strong> <?php echo $treatment->prescription_notes; ?></small>
                  </div>
                </div><!-- media -->
              </div><!-- col-sm-6 -->

              <!-- Lab Request -->
              <div class="col-sm-4">
                <div class="media">
                  <div class="media-body event-body">
                    <p class="text-primary">Lab Request : <span class="text-muted"> <?php $i = 0; foreach($lab_details->result() as $results) if($results->patient_treatment_id == $detailed->treatment_id) { if($i > 0) echo " , "; echo ($lab->lab_service); $i ++; }?> </span>
                    <p class="text-primary">Lab Results : <span class="text-muted"> <?php $i = 0; foreach($lab_details->result() as $results) if($results->patient_treatment_id == $detailed->treatment_id) { if($i > 0) echo " , "; echo ($lab->lab_results); $i ++; }?> </spam>

                    <small class="text-success"><i class="fa fa-user-md"></i> <strong>Lab Technician : </strong> </small>
                    <small class="text-success"><i class="fa fa-file-text-o"></i> <strong>Notes : </strong> <span class="text-muted"><?php $i = 0; foreach($lab_details->result() as $results) if($results->patient_treatment_id == $detailed->treatment_id) { if($i > 0) echo " , "; echo ($lab->lab_notes); $i ++; }?></small>
                    <small class="text-success"><i class="fa fa-calendar"></i> <strong>Date : </small>
                  </div>
                </div><!-- media -->
              </div><!-- col-sm-6 -->

          </div>
          
        </div>
      </div>
    </div><!-- contentpanel -->            

            