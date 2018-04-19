    <?php
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

      function format_date($datetime)
      {
        $date = date('jS F Y', (strtotime($datetime)));
        return $date;
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
      <h2><i class="fa fa-envelope"></i> Lab Requests</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Bracket</a></li>
          <li class="active">Lab</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel panel-email">

        <div class="row">
            
            <div class="col-sm-12">
                
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                                <ul class="nav nav-tabs nav-justified">
                                  <li class="active"><a href="#new" data-toggle="tab"><strong>New Lab Requests</strong></a></li>
                                  <li><a href="#all" data-toggle="tab"><strong>All Lab Requests and Results</strong></a></li>
                                  <li><a href="#cancelled" data-toggle="tab"><strong>Cancelled Lab Requests</strong></a></li>
                                </ul>
                        

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active" id="new">
                            <h5 class="subtitle mb5">New Lab Requests</h5>
                            <p class="text-muted">View and attend to new lab requests</p>
                              <div class="table-responsive">
                                <table class="table table-email">
                                  <tbody>
                                    <?php foreach ($new_requests->result() as $new){?>
                                    <tr class="<?php if($new->request_status == 0){ echo "unread"; } else echo ""; ?>">
                                      <td>
                                      </td>
                                      <td>
                                        
                                      </td>
                                      <td>
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="media-meta pull-right"><?php echo format_date($new->date_created); ?></span>
                                                <a href="<?php echo base_url(); ?>laboratory/detailedRequest/<?php echo $new->lab_request_id; ?>/<?php echo $new->patient_id; ?>"><?php echo $new->name; ?> - <?php if ($new->gender == 0) echo "Female"; else echo "Male"?>, <?php echo get_age($new->dob); ?></a>
                                                <small class="text-muted"></small>
                                                <p class="email-summary"><strong><?php echo $new->user; ?></strong> <?php $i = 0; foreach($labRequests->result() as $labRequest) if($labRequest->request_id == $new->lab_request_id) { if($i > 0) echo ", "; echo $labRequest->name; $i ++; }?> <a href="<?php echo base_url(); ?>laboratory/labResults/<?php echo $new->lab_request_id; ?>"><span class="btn btn-primary btn-xs pull-right">Take Lab Test</span></a></p>
                                            </div>
                                        </div>
                                      </td>
                                      <td>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                            </div><!-- table-responsive -->
                          </div>
                          <div class="tab-pane" id="all">
                            <h5 class="subtitle mb5">All Lab Requests and Results</h5>
                            <p class="text-muted">View and attend to all lab requests</p>
                              <div class="table-responsive">
                                <table class="table table-email">
                                  <tbody>
                                    <?php foreach ($all_requests->result() as $request){?>
                                    <tr class="<?php $button_status = "false"; if($request->request_status == 0){ echo "unread"; $button_status = "true"; } else echo ""; ?>">
                                      <td>
                                      </td>
                                      <td>
                                      </td>
                                      <td>
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="media-meta pull-right"><?php echo format_date($request->date_created); ?></span>
                                                <a href="<?php echo base_url(); ?>laboratory/detailedRequest/<?php echo $request->lab_request_id; ?>/<?php echo $request->patient_id; ?>"><?php echo $request->name; ?> - <?php if ($request->gender == 0) echo "Female"; else echo "Male"?>, <?php echo get_age($request->dob); ?></a>
                                                <small class="text-muted"></small>
                                                <p class="email-summary"><strong><?php echo $request->user; ?></strong> <?php $i = 0; foreach($labRequests->result() as $alllabRequest) if($alllabRequest->treatment_id == $request->patient_treatment_id) { if($i > 0) echo ", "; echo $alllabRequest->name; $i ++; }?> <?php if($button_status == "true"){?> <a href="<?php echo base_url(); ?>laboratory/labResults/<?php echo $request->lab_request_id; ?>"><span class="btn btn-primary btn-xs pull-right">Take Lab Test</span></a> <?php } ?></p>
                                            </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                            </div><!-- table-responsive -->
                          </div>
                          <div class="tab-pane" id="cancelled">
                            <h5 class="subtitle mb5">Cancelled Lab Requests</h5>
                            <p class="text-muted">View all cancelled lab requests</p>
                              <div class="table-responsive">
                                <table class="table table-email">
                                  <tbody>
                                    <?php foreach ($cancelled_requests->result() as $cancelled){?>
                                    <tr class="<?php if($cancelled->request_status == 0){ echo "unread"; } else echo ""; ?>">
                                      <td>
                                      </td>
                                      <td>
                                        
                                      </td>
                                      <td>
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="media-meta pull-right"><?php echo format_date($cancelled->date_created); ?></span>
                                                <a href="<?php echo base_url(); ?>laboratory/detailedRequest/<?php echo $cancelled->lab_request_id; ?>/<?php echo $cancelled->patient_id; ?>"><?php echo $cancelled->name; ?> - <?php if ($cancelled->gender == 0) echo "Female"; else echo "Male"?>, <?php echo get_age($cancelled->dob); ?></a>
                                                <small class="text-muted"></small>
                                                <p class="email-summary"><strong><?php echo $cancelled->user; ?></strong> Ut enim ad minim veniam, quis nostrud exercitation... </p>
                                            </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                            </div><!-- table-responsive -->
                          </div>
                        </div><!-- Close of Tab Panes -->

                        
                    </div><!-- panel-body -->
                </div><!-- panel -->
                
            </div><!-- col-sm-9 -->
            
        </div><!-- row -->
    
    </div>
  
