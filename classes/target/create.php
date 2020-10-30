<?php
namespace Target;

use Database\ORM as Data;
use Screen\Response;

/**
 * @package Create target for area offices
 * @author Trunie Built <amadiify.com> 
 */
class Create extends \Request
{
    private $fetch_sent = null;
    private $current_target = null;
    public $viewData = null;
    public $target_name = null;

    public function __construct($use_const=true)
    {
        if ($use_const)
        {
            if (!$this->post->isEmpty())
            {
                // search for target, score, date, offices
                if ($this->has('search'))
                {
                    return $this->getSearch();
                }

                // update target
                if ($this->has('update'))
                {
                    return $this->updateTarget();
                }

                // process new target
                return $this->createTarget();
            }
            elseif ($this->get->has('publish', 'unpublish'))
            {
                return $this->publisher();
            }

            // delete target
            return $this->deleteTarget();
        }
        else
        {
            if ($this->post->has('update-target'))
            {
                $this->updateTargetForAreaOffice();
            }
        }
    }

    // publisher
    private function publisher()
    {
        switch ($this->has('publish'))
        {
            // publish target
            case true:
                // get target id
                $id = $this->get('publish');

                // update table
                $update = Data::table('create_targets')->update(['published' => 1], 'targetid = :id', $id);

                // check if row was affected.
                if (Data::getRows($update) > 0)
                {
                    // publish for area offices
                    Data::table('targets_submitted')->update(['visible' => 1], 'targetid = :id', $id);

                    // send successful response.
                    Response::success('Target Published Successfully.');
                }

                // this would get printed if publish command failed.
                Response::danger('Could not publish target. Please try again later.');
            break;

            // unpublish target
            case false:
                // get target id
                $id = $this->get('unpublish');
                // update table
                $update = Data::table('create_targets')->update(['published' => 0], 'targetid = :id', $id);

                // check if row was affected.
                if (Data::getRows($update) > 0)
                {
                    // publish for area offices
                    Data::table('targets_submitted')->update(['visible' => 0], 'targetid = :id', $id);

                    // send successful response.
                    Response::success('Target Unpublished Successfully.');
                }

                // this would get printed if publish command failed.
                Response::danger('Could not unpublish target. Please try again later.');
            break;
        }
    }

    // create target
    public function createTarget()
    {
        $this->set('created_by', $_SESSION['user_id']);
        $this->set('area_offices', function($val){
            return ltrim($val, ',');
        });

        $outcomes = $this->outcome;
        $outcome_period = $this->outcome_period;

        // remove them
        $this->remove('outcome_period', 'outcome');
        
        $insert = Data::table('create_targets')->insert($this->data());

        if (Data::getRows($insert) > 0)
        {
            $ins_id = $insert->insert_id;
            // add outcome
            if (count($outcomes) > 0)
            {
                foreach ($outcomes as $index => $outcome)
                {
                    $insert = ['targetid' => $ins_id,
                    'outcome' => $outcome,
                    'outcome_period' => (isset($outcome_period[$index]) ? $outcome_period[$index] : null)
                    ];
                    // insert outcome
                    Data::table('performance_outcome')->insert($insert);
                }
            }
            Response::success('Target created, would be published '.date('jS F Y', strtotime($this->date_start)).'. You can manually publish also.');
        }

        Response::danger('Operation failed, please try again.');
    }


    // update target
    public function updateTarget()
    {
        $this->set('area_offices', function($val){
            return ltrim($val, ',');
        });
        $this->remove('update');
        $id = intval(strip_tags($this->get->get('edit')));


        $outcomes = $this->post->outcome;
        $outcome_period = $this->post->outcome_period;

        // remove them
        $this->post->remove('outcome_period', 'outcome');
        
        if (is_int($id))
        {
            $update = Data::table('create_targets')->update($this->post->data(), 'targetid = :id', $id);

            // remove all outcomes
            Data::table('performance_outcome')->del('targetid = :id', $id);

            // updated 
            $updated = 0;

            // now add again
            if ($outcomes > 0)
            {
                foreach ($outcomes as $index => $outcome)
                {
                    $insert = ['targetid' => $id,
                    'outcome' => $outcome,
                    'outcome_period' => (isset($outcome_period[$index]) ? $outcome_period[$index] : null)
                    ];
                    // insert outcome
                    $add = Data::table('performance_outcome')->insert($insert);
                    if (Data::getRows($add) > 0)
                    {
                        $updated++;
                    }
                }
            }

            if (Data::getRows($update) > 0 || $updated > 0)
            {
                Response::success('Target updated successfully');
            }

            Response::danger('Update failed. No changes made.');
        }
        
    }

    // return all targets created
    public function allTargets($callback)
    {
        // get all the list of area offices.
        $offices = Data::table('area_office')->get();

        $rows = [];

        if ($offices->num_rows > 0)
        {
            $i = 1;

            while ($row = Data::fetch($offices))
            {
                $id = $row->id;
                $targets = 0;
                $totalScore = 0;
                $fulfilled = 0;

                // check all targets assigned to this area office.
                $create = Data::table('create_targets')->get("area_offices like '%$id%'");
                if ($create->num_rows > 0)
                {
                    while($c = Data::fetch($create))
                    {
                        // check to explode
                        $explode = array_flip(explode(',', $c->area_offices));

                        if (isset($explode[$id]))
                        {
                            $targets++;
                            // get targetid
                            $targetid = $c->targetid;
                            // check submits
                            $submits = Data::table('targets_submitted')->get('targetid = :id and area_officeid = :aid', $targetid, $id);

                            if ($submits->num_rows > 0)
                            {
                                $fulfilled += $submits->num_rows;
                                // total score
                                while ($s = Data::fetch($submits))
                                {
                                    $totalScore += $s->score_earned;
                                }
                            }
                        }
                    }
                }

                $build = (object)[];
                $build->c = $i;
                $build->area_office = $row->area_office_name;
                $build->no_targets = $targets;
                $build->fulfilled = $fulfilled;
                $build->total_score = $totalScore;

                // send output
                $rows[] = '<tr data-href="?office='.$id.'">'.(implode("\n", call_user_func($callback, $build))).'</tr>';

                $i++;
            }
        }

        return implode("\n", $rows);
    }

    // created
    public function targetCreated($callback, $addhref=false, $key='view')
    {
        
        if (is_null($this->fetch_sent))
        {
            $all = Data::table('create_targets')->get();
        }
        else
        {
            $all = $this->fetch_sent;
        }

        // response
        $response = [];

        if ($all->num_rows > 0)
        {
            $sn = 1;

            while($row = Data::fetch($all))
            {
                // get outcome and outcome_period
                $row->outcome = null;
                $row->outcome_period = null;
                $row->sn = $sn;

                // check for outcomes
                $outcomes = Data::table('performance_outcome')->get('targetid = :id', $row->targetid);

                $href = $addhref ? 'data-href="?'.$key.'='.$row->targetid.'"' : '';

                if (Data::getRows($outcomes) > 0)
                {
                    $g_outcomes = [];

                    while ( $out = Data::fetch($outcomes))
                    {
                        $g_outcomes[] = '<tr><td>'.$out->outcome.'</td><td>'.$out->outcome_period.'</td></tr>';
                    }

                    $row->outcome = implode("\n", $g_outcomes);
                }

                $response[] = '<tr '.$href.'>'.(implode("\n", call_user_func($callback, $row))).'</tr>';
                $sn++;
            }
        }

        return implode("\n", $response);
    }

    // has kpi
    public function hasKpi(&$title='', $fetch = false)
    {
        if ($this->get->has('kpi'))
        {
            $id = $this->kpi;

            // fetch data
            if ($fetch)
            {
                // get 
                $targets = Data::table('create_targets');
                $targets->get('targetid = :id', $id);
                // get title
                $title = $targets->target_name;
            }
            
            // check if we have submits
            $targets = Data::table('create_targets');
            $targets->get('targetid = :id', $id);

            if ($targets->target_submits > 0)
            {
                return true;
            }
        }

        return false;
    }

    // run score card
    public function scoreCard($callback)
    {
        // get target id
        $id = $this->kpi;

        // get target
        $targets = Data::table('create_targets');
        $targets->get('targetid = :id', $id);

        // get submits 
        $submits = explode(',', $targets->submits_by);

        // ROWS
        $rows = [];

        // Serial
        $sn = 1;

        // run data
        foreach ($submits as $index => $areaid)
        {
            // create a blank object
            $object = (object)[];
            $object->sn = $sn;
            // get area office
            $office = Data::table('area_office');
            $office->get('id = :id', $areaid);
            $object->area_office = $office->area_office_name;
            $object->outcome = null;

            // get target submitted
            $submitted = Data::table('targets_submitted');
            $submitted->get('targetid = :id and area_officeid = :aid', $id, $areaid);
            $object->score_earned = $submitted->score_earned;
            $object->dateSubmitted = $submitted->dateSubmitted;

            // check for outcomes
            $outcomes = Data::table('performance_outcome')->get('targetid = :id', $id);

            if (Data::getRows($outcomes) > 0)
            {
                $g_outcomes = [];

                while ( $out = Data::fetch($outcomes))
                {
                    // get outcome id
                    $outcome = Data::table('area_office_performance');
                    $outcome->get('outcomeid = :id', $out->outcomeid);

                    $g_outcomes[] = '<tr>
                    <td>'.$out->outcome.'</td>
                    <td>'.$out->outcome_period.'</td>
                    <td>'.$outcome->target_achieved.'</td>
                    <td>'.$outcome->scored.'</td>
                    </tr>';
                }

                $object->outcome = implode("\n", $g_outcomes);
            }

            // push row
            $rows[] = '<tr data-href="?info='.$submitted->tsid.'">'.(implode("\n", call_user_func($callback, $object))).'</tr>';
            // 
            $sn++;
        }

        return implode("\n", $rows);
    }

    // get search
    public function getSearch()
    {
        $search = strip_tags($this->get('search'));
        
        $table = Data::table('create_targets');

        // check if target
        $target = $table->get('target_name like \'%'.$search.'%\' or score like \'%'.$search.'%\' or date like \'%'.$search.'%\'');

        if ($target->num_rows > 0)
        {
            $this->fetch_sent = $target;
            return true;
        }

        // check area office
        $area = Data::table('area_office');
        $hasOffice = $area->get("area_office_name like :office", $search);

        if ($hasOffice->num_rows > 0)
        {
            // get id
            $get = $table->get('area_offices like \'%'.$area->id.'%\'');

            if ($get->num_rows > 0)
            {
                $this->fetch_sent = $get;
                return true;
            }
        }

        Response::danger('Search Query failed. \''.$search.'\' wasn\'t found.');
    }

    // edit target
    public function editTarget(&$target_name=null, &$outcome=null, &$outcome_period = null, &$alloutcomes = [], &$score=null, &$offices = '', &$button=null, &$start_date=null, &$end_date=null)
    {
        $button = 'Create Target';

        if ($this->get->has('edit'))
        {
            $button = 'Update Target';
            $target = $this->current_target;

            $target_name = $target->target_name;
            $score = $target->score;
            $offices = $target->area_offices;
            $start_date = $target->date_start;
            $end_date = $target->date_end;

            // get outcome
            $outcomes = Data::table('performance_outcome')->get('targetid = :id', $this->edit);

            if (Data::getRows($outcomes) > 0)
            {
                $alloutcomes = [];
                
                while ($out = Data::fetch($outcomes))
                {
                    $alloutcomes[] = $out;
                }

                if (count($alloutcomes) > 0)
                {
                    // extract first entry
                    $first = array_shift($alloutcomes);
                    // set outcome
                    $outcome = $first->outcome;
                    $outcome_period = $first->outcome_period;
                }
            }

            return '<input type="hidden" name="update" data-action="update"/>';
        }
    }

    // get state
    public function getState()
    {
        $title = ucwords('Create a new key performance indicator');

        if ($this->get->has('edit'))
        {
            $run = Data::table('create_targets');
            $fetch = $run->get('targetid = :id', $this->get('edit'));
            $title = 'Update : '. ucfirst($run->target_name);
            $this->current_target = $run;
        }

        return $title;
    }

    // delete target
    public function deleteTarget()
    {
        
        if ($this->get->has('del'))
        {
            $id = $this->get->del;

            $del = '
            <div class="ask-question">
              <div class="ask-question-text"> <h1> Are you sure you want to delete target ? </h1> </div>
              <div class="ask-question-btn"> <a href="?confirm=yes&id='.$id.'">Yes</a> <a href="?confirm=no"> No </a>
            </div>';
            echo $del;
        }
        elseif ($this->get->has('del-outcome'))
        {
            $id = $this->get('del-outcome');
            $delete = Data::table('performance_outcome')->del('outcomeid = :id', $id);

            if (Data::getRows($delete) > 0)
            {
                Response::success('Outcome deleted successfully');
            }

            Response::danger('Failed! Please try again later.');
        }
        elseif ($this->get->has('confirm'))
        {
            if ($this->get->confirm == 'yes')
            {
                $id = $this->get->id;
                $delete = Data::table('create_targets')->del('targetid = :id', $id);

                if (Data::getRows($delete) > 0)
                {
                    Data::table('targets_submitted')->del('targetid = :id', $id);
                    Response::success('Target deleted successfully!');
                }

                Response::danger("Operation canceled.");
            }
        }
    }

    // has view
    public function hasView()
    {
        if ($this->get->has('view'))
        {
            if (is_null($this->viewData))
            {
                $view = intval(strip_tags($this->view));
                // check view
                $data = Data::table('create_targets');
                // check
                $check = $data->get('targetid = :id', $view);

                if ($check->num_rows > 0)
                {
                    $this->viewData = $data;
                    $this->target_name = $data->target_name;
                    return true;
                }
            }
            else
            {
                return true;
            }

            Response::danger("Invalid Target ID. Preview failed");
        }

        return false;
    }

    // view area report
    public function area_report($callback)
    {
        $id = $this->view;
        $offices = explode(',', $this->viewData->area_offices);

        $area = Data::table('area_office');

        $row = [];

        foreach ($offices as $i => $cid)
        {
            $object = (object)[];
            // get area_office name
            $area->get('id = :id', $cid);
            $object->area_office_name = $area->area_office_name;

            // get target_submitted
            $target = Data::table('targets_submitted');
            $exec = $target->get('targetid = :tid and area_officeid = :id', $this->viewData->targetid, $cid);

            if ($exec->num_rows > 0)
            {
                $user = Data::table('staff_reg');
                $user->get('id = :id', $target->submittedby);

                $object->target = $target->target;
                $object->score_earned = $target->score_earned;
                $object->dateSubmitted = $target->dateSubmitted;
                $object->username = $user->username;
                $object->tsid = $target->tsid;
            }
            else
            {
                $object->target = 0;
                $object->score_earned = 0;
                $object->dateSubmitted = null;
                $object->username = null;
            }

            $row[] = '<tr>'.implode("\n", call_user_func($callback, $object)).'</tr>';
        }

        return implode("\n", $row);
    }

    // has info
    public function hasInfo($id=null)
    {
        if ($this->get->has('info') || $id !== null)
        {
            if (is_null($this->viewData))
            {
                $info = !is_null($id) ? $id : intval(strip_tags($this->info));
                // check view
                $data = Data::table('targets_submitted');
                // check
                $check = $data->get('tsid = :id', $info);

                if ($check->num_rows > 0)
                {
                    $this->viewData = $data;
                    return true;
                }
            }
            else
            {
                return true;
            }

            Response::danger("Invalid Target ID. Preview failed");
        }

        return false;
    }

    // can show
    public function canShow($id)
    {
        // check view
        $data = Data::table('targets_submitted');
        // check
        $check = $data->get('targetid = :id and area_officeid = :oif', $id, $this->get->officeid);

        if ($check->num_rows > 0)
        {
            // get target
            $this->viewData = Data::fetch($check);
            return true;
        }

        return false;
    }

    public function hasOffice()
    {
        if ($this->get->has('office'))
        {   
            if (is_null($this->viewData))
            {
                $id = intval(strip_tags($this->office));
                $this->viewData = Data::table('create_targets')->get("area_offices like '%$id%'");
            }

            return true;
        }

        return false;
    }

    public function getOffice()
    {
        $id = intval(strip_tags($this->office));
        $office = Data::table('area_office');
        $office->get('id = :id', $id);

        return (object)[
            'office' => $office->area_office_name,
            'listTarget' => function($callback) use ($id){
                $data = $this->viewData;
                $rows = [];
                
                if ($data->num_rows > 0)
                {
                    $c = 1;

                    while ($row = Data::fetch($data))
                    {
                        $offices = array_flip(explode(',', $row->area_offices));
                        if (isset($offices[$id]))
                        {
                            $target = $row->target_name;
                            $expected = $row->expected_target;
                            $date = $row->date;
                            $fulfilled = 0;
                            // get score earned
                            $earned = 0;
                            $e = Data::table('targets_submitted');
                            $run = $e->get('targetid = :id and area_officeid = :aid', $row->targetid, $id);

                            $other = '';

                            if ($run->num_rows > 0)
                            {
                                $earned = $e->score_earned;
                                $other = ' data-href="?info='.$e->tsid.'"';
                                $fulfilled = $e->target;
                            }

                            $object = (object)[];
                            $object->c = $c;
                            $object->target_name = $target;
                            $object->expected = $expected;
                            $object->fulfilled = $fulfilled;
                            $object->score = $earned;
                            $object->date = $date;
                            $object->interval = $row->target_interval;

                            $rows[] = '<tr'.$other.'>'.implode("\n", call_user_func($callback, $object)). '</tr>';

                            $c++;
                        }
                    }
                }

                return implode("\n", $rows);
            }
        ];
    }

    // show report
    public function showReport(&$title='', $show=false, &$year = null)
    {
        if ($this->get->has('show-report'))
        {
            if ($show)
            {

                $targetid = intval(strip_tags($this->get('show-report')));

                // get target name
                $targ = Data::table('create_targets');
                $targ->get('targetid = :id', $targetid);
                
                $title = $targ->target_name;
                $year = intval(date('Y'));

                if ($this->get->has('year'))
                {
                    $year = intval($this->get('year'));
                }

                if ($year <= 0) { $year = intval(date('Y')); }
            }
            return true;
        }

        return false;
    }

    // get info
    public function getInfo()
    {
        $data = $this->viewData;
        $object = (object)[];

        // get target name
        $targ = Data::table('create_targets');
        $targ->get('targetid = :id', $data->targetid);

        $object->target_name = $targ->target_name;
        $object->tsid = $data->tsid;
        $object->expected_target = $targ->expected_target;
        $object->target_interval = $targ->target_interval;
        $object->score = $targ->score;
        $object->score_earned = $data->score_earned;
        $object->target = $data->target;
        $object->comment = $data->comment;
        $object->dateSubmitted = $data->dateSubmitted;
        

        // get user
        $user = Data::table('staff_reg');
        $user->get('id = :id', $data->submittedby);

        $object->submittedby = ucwords($user->first_name . ' '. $user->middle_name . ' ' . $user->last_name);

        // manage attachment
        $object->attachment = 'None';

        if (strlen($data->attachment) > 0)
        {
            $object->attachment = '<a href="?view='.$data->tsid.'&download='.$data->attachment.'"><i class="fa fa-download"></i> Download Attachment</a>';
        }

        return $object;
    }

    // view target
    public function viewTarget(&$target_name = '', &$view=[])
    {
        // get target id
        $id = $this->get('view');
        // get target info
        $table = Data::table('create_targets');
        $info = $table->get("targetid = :id", $id);
        
        // convert to an object
        $view = (object) [];

        if ($info->num_rows > 0)
        {
            // show target.
            $target_name = $table->target_name;

            $view->listTarget = function($callback) use (&$id, &$table){

                $tr = [];

                $info = Data::table('targets_submitted')->get('targetid = :id', $id);

                $c = 1;

                while ($row = Data::fetch($info))
                {
                    // object
                    $object = (object)[];

                    // get area office
                    $office = Data::table('area_office');
                    $office->get('id = :id', $row->area_officeid);

                    $name = $office->area_office_name;

                    // get name
                    $object->c = $c;
                    $object->area_office = $name;
                    $object->expected = $table->expected_target;
                    $object->fulfilled = $row->target;
                    $object->score = $row->score_earned;
                    $object->date = $row->dateSubmitted;
                    $object->outcome = '';

                    // check for outcomes
                    $outcomes = Data::table('performance_outcome')->get('targetid = :id', $id);

                    if (Data::getRows($outcomes) > 0)
                    {
                        $g_outcomes = [];

                        while ( $out = Data::fetch($outcomes))
                        {
                            // get outcome id
                            $outcome = Data::table('area_office_performance');
                            $outcome = Data::fetch($outcome->get('outcomeid = :id', $out->outcomeid));

                            $poutcome = Data::table('performance_outcome_for_office')->get('outcomeid=:id and officeid=:oid', $out->outcomeid, $row->area_officeid);

                            if ($poutcome->num_rows > 0)
                            {
                                $poutcome = Data::fetch($poutcome);
                                $out->outcome_period = $poutcome->outcome_period;
                            }
                            
                            $g_outcomes[] = '<tr>
                            <td>'.$out->outcome.'</td>
                            <td>'.$out->outcome_period.'</td>
                            <td>'.$outcome->target_achieved.'</td>
                            <td>'.$outcome->scored.'</td>
                            </tr>';
                        }

                        $object->outcome = implode("\n", $g_outcomes);
                    }

                    $tr[] = '<tr>'.implode("\n", call_user_func($callback, $object)).'</tr>';
                    $c++;
                }

                return implode("\n", $tr);
                
            };
        }
        else
        {
            $target_name = 'Go Back';
            $view->listTarget = function(){};
        }
        
    }

    // get outcomes
    public function getOutcomes($callback, $id=null)
    {
        // get id
        $targetid = $this->get->get('show-report');
        $officeid = $this->get->officeid;

        if (!is_null($id))
        {
            $targetid = $id;
        }

        // apply rows
        $rows = [];

        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

        // last year
        $lastYear = intval($year)-1;

        // current year
        $currentYear = intval($year);

        $sn = 1;

        // get performance
        $performance = Data::table('performance_outcome');
        $per = $performance->get('targetid = :tid', $targetid);

        while ($out = Data::fetch($per))
        {
            // create object
            $object = (object)[];
            $object->sn = $sn;
            $object->annual = [$lastYear => 0, $currentYear => 0];
            $object->achieved = [$lastYear => 0, $currentYear => 0];
            $object->percentage = [$lastYear => 0, $currentYear => 0];
            $object->remark = [$lastYear => 'Very Good', $currentYear => 'Excellent'];
            $object->outcome = $out->outcome;

            // check performance_outcome_for_office
            $p_office = Data::table('performance_outcome_for_office');
            $ce = $p_office->get('outcomeid = :id and officeid = :od', $out->outcomeid, $officeid);

            $outcomeperiod = intval($out->outcome_period);

            if (Data::getRows($ce) > 0)
            {
                $ce = Data::fetch($ce);
                $outcomeperiod = intval($ce->outcome_period);
            }

            // get target submitted
            $getTarget = Data::table('targets_submitted');
            $getTarget = $getTarget->get("targetid = :id and area_officeid = :oid and dateSubmitted like '%$currentYear%'", $targetid, $officeid);

            while ($target = Data::fetch($getTarget))
            {
                $date = new \DateTime($target->dateSubmitted);
                $year = $date->format('Y');

                // get area performance
                $aoffice = Data::table('area_office_performance');
                $afetch = $aoffice->get('tsid=:td and outcomeid = :oid', $target->tsid, $out->outcomeid);

                if (Data::getRows($afetch) > 0)
                {
                    while ($a = Data::fetch($afetch))
                    {

                        // handle for last year
                        if ($year == $lastYear)
                        {
                            // last year
                            $object->annual[$lastYear] = $outcomeperiod * 12;
                            $object->achieved[$lastYear] += intval($a->target_achieved);
                            $object->percentage[$lastYear] += intval($a->scored);
                        }
                        elseif ($year == $currentYear)
                        {
                            // current year
                            $expected = $outcomeperiod * 12;
                            $object->annual[$currentYear] = $expected;
                            $object->achieved[$currentYear] += intval($a->target_achieved);
                            $object->percentage[$currentYear] += intval($a->scored);
                        }
                    }


                    if ($object->annual[$currentYear] > 0)
                    {
                        $percentage = ($object->achieved[$currentYear] * 100) / $object->annual[$currentYear];
                        $percentage = round($percentage);
                        if ($percentage > 100) { $percentage = 100; }
                        $object->percentage[$currentYear] = $percentage;
                    }


                    if ($object->annual[$lastYear] > 0)
                    {
                        $percentage = ($object->achieved[$lastYear] * 100) / $object->annual[$lastYear];
                        $percentage = round($percentage);
                        if ($percentage > 100) { $percentage = 100; }
                        $object->percentage[$lastYear] = $percentage;
                    }
                }
            }

            // manage remark
            if ($object->achieved[$currentYear] >  $object->annual[$currentYear])
            {
                $object->remark[$currentYear] = 'Excellent';
            }
            elseif ($object->achieved[$currentYear] <  $object->annual[$currentYear])
            {
                $object->remark[$currentYear] = 'Poor';
            }
            elseif ($object->achieved[$currentYear] != 0)
            {
                $object->remark[$currentYear] = 'Very Good';   
            }
            else
            {
                $object->remark[$currentYear] = 'Drop in performance';
            }


            if (is_null($id))
            {
                $rows[] = '<tr>'.(implode("\n", call_user_func($callback, $object))).'</tr>';
            }
            else
            {
                $rows[] = call_user_func($callback, $object);
            }

            $sn++;
        }

        

        return is_null($id) ? implode("\n", $rows) : $rows;

    }

    // watch recurrents
    public static function watchRecurrents()
    {
        if (isset($_SESSION['user_id']))
        {
            // logged in, so we check.
            $table = Data::table('create_targets');

            // check
            $check = $table->get('date_start != \'\'');

            if ($check->num_rows > 0)
            {
                $current = date('d');

                while ($row = Data::fetch($check))
                {
                    if (intval($current) <= intval($row->date_end))
                    {
                        // date start
                        $date_start = $row->date_start;

                        if ($row->published == 0)
                        {   
                            // get diff
                            $diff = intval($date_start) - intval($current);
                            $sign = $diff > 1 ? '+' : '-';
                            $days = $diff;

                            $autoPublish = false;

                            if ($sign == '-')
                            {
                                $autoPublish = true;
                            }
                            else
                            {
                                if ($diff == 0)
                                {
                                    $autoPublish = true;
                                }
                            }

                            if ($autoPublish)
                            {
                                // auto publish here
                                $table->update(['published' => 1], 'targetid=:id', $row->targetid);
                            }
                        }
                        else
                        {
                            // wait.
                        }
                    }

                }
            }
        }
    }

    // all area office for target
    public function allOffices(&$target=null, &$offices=[], &$id=0, &$alloutcomes=[])
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            // find target and return name
            $table = Data::table('create_targets');
            $get = $table->get('targetid=:id', $id);

            if ($get->num_rows > 0)
            {
                $get = Data::fetch($get);
                $target = $get->target_name;
                // get offices
                $offices = [];
                $area_offices = explode(',', $get->area_offices);
              
                foreach ($area_offices as $index => $officeid)
                {
                    $officeid = intval(trim($officeid));
                    if ($officeid > 0)
                    {
                        $atable = Data::table('area_office');
                        $getd = Data::fetch($atable->get('id=:id',$officeid));
                        if ($getd != false)
                        {
                            $offices[$officeid] = $getd->area_office_name;
                        }
                    }
                }
            }

            // get outcome
            $outcomes = Data::table('performance_outcome')->get('targetid = :id', $id);

            if (Data::getRows($outcomes) > 0)
            {
                $alloutcomes = [];
                
                while ($out = Data::fetch($outcomes))
                {
                    $alloutcomes[] = $out;
                }

                // if (count($alloutcomes) > 0)
                // {
                //     // extract first entry
                //     $first = array_shift($alloutcomes);
                //     // set outcome
                //     $outcome = $first->outcome;
                //     $outcome_period = $first->outcome_period;
                // }
            }
        }
        else
        {
            header('location: performance_indicator.php');
        }
    }

    // get performance outcome for area office
    public function getPerformanceOutcomes()
    {
        $id = $this->get->id;
        $table = Data::table('performance_outcome');
        $get = $table->get('targetid=:id', $id);
        $out = [];

        if ($get->num_rows > 0)
        {
            $i = 0;

            while ($row = Data::fetch($get))
            {
                $out['default']['outcome'][] = $row->outcome;
                $out['default']['outcome_period'][] = $row->outcome_period;

                // get outcome_period
                $table = Data::table('performance_outcome_for_office');
                $data = $table->get('outcomeid=:id', $row->outcomeid);

                if ($data->num_rows > 0)
                {
                    while ($dat = Data::fetch($data))
                    {
                        $row->outcome_period = $dat->outcome_period;

                        $out[$dat->officeid]['outcome'][] = $row->outcome;
                        $out[$dat->officeid]['outcome_period'][] = $row->outcome_period;
                    }
                }
            }
        }

        return $out;
    }

    public function updateTargetForAreaOffice()
    {
        $this->remove('update-target');

        $data = $this->data();
        $targetid = $this->get->id;
        $office = $data['area_offices'];

        $success = 0;
        $s = '';

        $office = ltrim($office, ',');

        if (strlen($office) > 0)
        {
            $offices = explode(',', $office);

            foreach ($offices as $i => $office)
            {
                $outcomes = $data['outcome'];
                $outcome_period = $data['outcome_period'];

                foreach ($outcomes as $x => $outcome)
                {
                    // get outcome id
                    $table = Data::table('performance_outcome');
                    $get = $table->get('targetid=:id and outcome = :outcome', $targetid, $outcome);
                    
                    if ($get->num_rows > 0)
                    {
                        $get = Data::fetch($get);

                        // check and insert
                        $check = Data::table('performance_outcome_for_office');
                        $getcheck = $check->get('outcomeid = :id and officeid = :ofid', $get->outcomeid, $office);
                        if ($getcheck->num_rows > 0)
                        {
                            // update
                            $check->update(['outcome_period' => $outcome_period[$x]], 'officeid=:ofid and outcomeid = :id', $office, $get->outcomeid);
                            $success++;
                        }
                        else
                        {
                            // insert
                            $check->insert(['officeid' => $office, 'outcomeid' => $get->outcomeid, 'outcome_period' => $outcome_period[$x]]);
                            $success++;
                        }
                    }
                }
            }

            $office = '('.count($offices).')';
            $s = count($offices) > 1 ? 's' : '';
        }

        if ($success > 0)
        {
            Response::success('Target updated successfully for '. $office . ' Area Office'.$s.'.');
        }

        Response::error('Update failed. You can try again or contact administrator');

    }
}