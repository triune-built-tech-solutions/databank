<?php
namespace Target;

use Database\ORM as Data;
use Screen\Response;

class Office extends \Request
{
    public static $notification = 0;
    public static $location = 0;
    private $self_run = null;
    private $viewData = null;

    public function __construct()
    {
        if ($this->post->has('targetid') && !$this->post->has('area_offices'))
        {
            return $this->submitTarget();
        }

        if($this->post->has('area_offices'))
        {
            return $this->submitManualTarget();
        }

        if ($this->post->has('search'))
        {
            return $this->getSearch();
        }
    }

    // submit manual target
    public function submitManualTarget()
    {
        $json = json_encode($this->post->data());

        $areaOffice = $this->get('area_offices');
        $year = $this->get('year');
        $month = $this->get('month');
        $targetid = $this->get('targetid');
        
        // remove data
        $this->remove('area_offices', 'year', 'month');
        // copy data
        $data = $this->data();
        // convert areaoffice string to array
        $areaOfficeArray = explode(',', $areaOffice);
        
        foreach ($areaOfficeArray as $areaofficeid)
        {
            $this->fillDrum('POST', $data);
            $this->submitTarget($areaofficeid, $year, $month, true);
        }   

        $offices = count($areaOfficeArray);

        Response::success('Manual KPI submitted successfully for ('.$offices.') area office'.($offices > 1 ? 's' : '').'!');

        $manual = Data::table('manual_kpi_entries');

        if ($this->get->has('edit'))
        {
            $id = $this->get->get('edit');
            $manual->update(['manual_entry' => $json], 'entryid = :id', $id);
        }
        else
        {
            $data = [
                'targetid' => $targetid,
                'manual_entry' => $json,
                'month' => $month,
                'year' => $year,
                'dateadded' => date('Y-m-d g:i:s')
            ];
            // check
            $check = $manual->get('targetid = :tid and month = :month and year = :year', $targetid, $month, $year);
            if ($check->num_rows == 0)
            {
                $manual->insert($data);
            }
        }
    }

    // check if target has been submit to this area office
    public static function Notification($location)
    {
        // check if new notification exists
        $table = Data::table('create_targets');
        $check = $table->get();
        
        // save location
        self::$location = $location;

        $new = 0;

        if ($check->num_rows > 0)
        {
            while ($row = Data::fetch($check))
            {
                $offices = array_flip(explode(",", $row->area_offices));

                if (self::canShow($row))
                {
                    $new++;
                }
            }
        }

        self::$notification = $new;

        return $new;
    }

    // get targets for location
    public static function Targets()
    {
        $location = self::$location;

        $table = Data::table('create_targets');
        $check = $table->get("area_offices like '%$location%'");

        $targets = [];

        if ($check->num_rows > 0)
        {
            while($row = Data::fetch($check))
            {
                $offices = array_flip(explode(",", $row->area_offices));
                
                if (isset($offices[$location]) && $row->published == 1)
                {
                    $targets[] = $row;
                }
            }
        }

        return $targets;
    } 


    // get all targets
    public static function getAllTargets()
    {
        $table = Data::table('create_targets');
        $check = $table->get("order by targetid desc");

        $targets = [];

        if ($check->num_rows > 0)
        {
            while($row = Data::fetch($check))
            {
                $targets[] = $row;
            }
        }

        return $targets;
    } 

    // submit target
    private function submitTarget($areaOfficeid = 0, $year = null, $month = null, $bulkQuery = false)
    {
        $score = $this->get('score');
        $expected = $this->get('expected');
        $areaOfficeid = $areaOfficeid == 0 ? self::$location : $areaOfficeid;
        $year = $year == null ? date('Y') : $year;
        $currentMonth = $month != null ? $month : date('m');

        $currentMonth = intval($currentMonth);
        $month = strtolower(date('F', mktime(0,0,0,$currentMonth,1,$year)));

        if ($currentMonth < 10)
        {
            $currentMonth = '0'.$currentMonth;
        }

        // build like
        $like = $year . '-' . $currentMonth;

        // get outcome ids
        $outcomesid = $this->post->outcomeid;
        $outcomes = $this->post->outcome;

        // remove score and expected
        $this->remove('score', 'expected', 'outcomeid', 'outcome');

        // check if attachment has been sent.
        if (isset($_FILES['attachment']))
        {
            $file = $_FILES['attachment'];
            $fname = $file['name'];
            $tmp = $file['tmp_name'];
            $error = $file['error'];

            $hashname = md5($fname) .'_'. $fname;

            if ($error == 0)
            {
                $destination = '../admin/uploads/' . $hashname;
                move_uploaded_file($tmp, $destination);
                $this->set('attachment', $hashname);
            }
        }

        // update target submits, submits by
        $create = Data::table('create_targets');
        $create->get('targetid = :id', $this->targetid);

        $submits = $create->target_submits;
        if ($submits <= 0)
        {
            $submits = 1;
        }
        else
        {
            $submits += 1;
        }

        // submits by
        $submits_by = explode(',', $create->submits_by);
        $flip = array_flip($submits_by);
        if (!isset($flip[$areaOfficeid]))
        {
            $submits_by[] = $areaOfficeid;
        }

        $s = implode(',', $submits_by);
        $s = preg_replace('/^[,]{1}/', '', $s);

        $this->set('area_officeid', $areaOfficeid);
        $this->set('submittedby', $_SESSION['user_id']);

        // update target_submission
        $submission = Data::table('target_submission');
        // check if previously added, else add new
        $checkifsubmitted = $submission->get('targetid = :tid and officeid = :oid and year = :year', $this->targetid, $areaOfficeid, $year);
        

        // update table
        $create->update(['target_submits' => $submits, 'submits_by' => $s], 'targetid = :id', $this->targetid);

        // insert data if not added for this month
        $insert = Data::table('targets_submitted');
        $checkTargets = $insert->get("targetid = :tid and area_officeid = :aid and dateSubmitted like '%$like%'", $this->targetid, $areaOfficeid);

        $method = 'insert';
        $continue = false;
        $this->set('dateSubmitted', $like . '-' . date('d g:i:s'));

        if ($checkTargets->num_rows == 0)
        {
            $query = $insert->insert($this->data());

            if (Data::getRows($query) > 0)
            {
                $ins_id = $query->insert_id;
                $continue = true;
            }
        }
        else
        {   
            $method = 'update';
            $dataRow = Data::fetch($checkTargets);
            $ins_id = $dataRow->tsid;
            $continue = true;
        }
        

        if ($continue)
        {
            // add outcome
            if (count($outcomesid) > 0)
            {
                $totalScored = 0;    

                foreach ($outcomesid as $index => $id)
                {
                    $office = Data::table('performance_outcome');
                    $office->get('outcomeid = :id', $id);

                    // calculate score
                    $acheived = intval($outcomes[$index]);
                    // scored
                    $scored = 0;
                    // expected
                    $expected = intval($office->outcome_period);

                    $_office = Data::table('performance_outcome_for_office');
                    $_office_get = $_office->get('officeid = :oid and outcomeid = :od', $areaOfficeid, $id);

                    if ($_office_get->num_rows > 0)
                    {
                        $_office->get('officeid = :oid and outcomeid = :od', $areaOfficeid, $id);
                        $expected = intval($_office->outcome_period);
                    }

                    if ($acheived == $expected)
                    {
                        $scored = 100;
                    }
                    else
                    {
                        $scored = ceil(($acheived * 100) / $expected);
                    }

                    if ($method == 'insert')
                    {
                        // add now.
                        $add = ['tsid' => $ins_id,
                        'targetid' => intval($this->targetid),
                        'outcomeid' => $id,
                        'target_achieved' => $acheived,
                        'scored' => $scored];

                        // push to area_office_performance
                        $ins = Data::table('area_office_performance')->insert($add);
                        if (Data::getRows($ins) > 0)
                        {
                            // add scored
                            $totalScored += $scored;
                        }
                    }
                    else
                    {
                        // update row
                        $update = [
                            'target_achieved' => $acheived,
                            'scored' => $scored
                        ];

                        // update area_office_performance
                        $updateQuery = Data::table('area_office_performance')->update($update, 'tsid = :ts', $ins_id);
                        if (Data::getRows($updateQuery) > 0)
                        {
                            $totalScored += $scored;
                        }
                    }
                }

                // update targets_submitted
                $insert->update(['score_earned' => $totalScored], 'tsid = :id', $ins_id);

                if ($checkifsubmitted->num_rows == 0)
                {   
                    $addrow = ['targetid' => $this->targetid, 'officeid' => $areaOfficeid, $month => $ins_id, 'year' => $year];
                    $submission->insert($addrow);   
                }
                else
                {
                    $submission->get('targetid = :tid and officeid = :oid and year = :year', $this->targetid, $areaOfficeid, $year);
                    $submission->update([$month => $ins_id], 'submissionid=:sid', $submission->submissionid);
                }
                
            }

            if (!$bulkQuery)
            {
                Response::success('Target submitted successfully. ('.$totalScored.') point earned!');
            }
        }

        if (!$bulkQuery)
        {
            Response::danger('Operation failed! Please try again later.');
        }
        
    }

    // return all targets
    public function allTargets($callback)
    {
        
        if ($this->self_run !== null)
        {
            $all = $this->self_run;
        }
        else
        {
            $all = Data::table('targets_submitted')->get('area_officeid = :id and visible = :v', self::$location, 1);
        }

        if ($all->num_rows > 0)
        {
            $rows = [];

            while($row = Data::fetch($all))
            {
                // get target
                $target = Data::table('create_targets');
                $target->get('targetid = :id', $row->targetid);

                if (is_callable($callback))
                {
                    // check for outcomes
                    $outcomes = Data::table('performance_outcome')->get('targetid = :id', $row->targetid);

                    if (Data::getRows($outcomes) > 0)
                    {

                        $g_outcomes = [];

                        while ( $out = Data::fetch($outcomes))
                        {
                            // get outcome id
                            $outcome = Data::table('area_office_performance');
                            $outcome = $outcome->get('outcomeid = :id', $out->outcomeid);
                            $outcome = Data::fetch($outcome);

                            // check performance_outcome_for_office
                            $per = Data::table('performance_outcome_for_office');
                            $p = $per->get('outcomeid = :oid', $out->outcomeid);

                            $period = $out->outcome_period;

                            if ($p->num_rows > 0)
                            {
                                $p = Data::fetch($p);
                                $period = $p->outcome_period;
                            }

                            $g_outcomes[] = '<tr>
                            <td>'.$out->outcome.'</td>
                            <td>'.$period.'</td>
                            <td>'.$outcome->target_achieved.'</td>
                            <td>'.$outcome->scored.'%</td>
                            </tr>';
                        }

                        $row->outcome = implode("\n", $g_outcomes);
                    }

                    $call = call_user_func($callback, $row, $target);
                    $rows[] = '<tr>'.implode("\n", $call).'</tr>';
                }
            }

            if (count($rows) > 0)
            {
                return implode("\n", $rows);
            }
        }
    }

    // get search
    private function getSearch()
    {
        $search = $this->search;

        // run search
        $run = Data::table('create_targets');
        $submits = Data::table('targets_submitted');

        $exec = $run->get("target_name like '%$search%' limit 0,1");
        

        if ($exec->num_rows > 0)
        {
            $id = $run->targetid;

            // now run and check submits
            $check = $submits->get('targetid = :id', $id);
            if ($check->num_rows > 0)
            {
                $this->self_run = $check;
                return true;
            }
        }
        else
        {
            $exec = $submits->get("dateSubmitted like '%$search%'");

            if ($exec->num_rows > 0)
            {
                $this->self_run = $exec;
                return true;
            }
        }

        Response::danger("Search Query failed. '$search' not found!");
    }

    // target exists
    public static function targetExists()
    {
        $continue = false;

        $targ = Data::table('create_targets');
        $published = $targ->get('published = :id order by targetid desc', 1);

        if ($published->num_rows > 0)
        {
            $continue = true;
        }

        return $continue;
    }
    // has view request
    public function hasView()
    {
        if ($this->get->has('view'))
        {
            if (is_null($this->viewData))
            {
                $view = intval(strip_tags($this->view));
                // check view
                $data = Data::table('targets_submitted');
                // check
                $check = $data->get('tsid = :id', $view);

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

    // get view
    public function getView()
    {
        $data = $this->viewData;
        $object = (object)[];

        // get target name
        $targ = Data::table('create_targets');
        $targ->get('targetid = :id', $data->targetid);

        $object->tsid = $data->tsid;
        $object->target_name = $targ->target_name;
        $object->expected_target = $targ->expected_target;
        $object->score = $targ->score;
        $object->target_interval = $targ->target_interval;
        $object->score_earned = $data->score_earned;
        $object->target = $data->target;
        $object->comment = $data->comment;
        $object->dateSubmitted = $data->dateSubmitted;
        

        // get user
        $user = Data::table('staff_reg');
        $user->get('id = :id', $data->submittedby);

        $object->submittedby = $user->username;

        // manage attachment
        $object->attachment = 'None';

        if (strlen($data->attachment) > 0)
        {
            $object->attachment = '<a href="?view='.$data->tsid.'&download='.$data->attachment.'"><i class="fa fa-download"></i> Download Attachment</a>';
        }

        return $object;
    }

    // can show
    public static function canShow($row)
    {
        if ($row->published == 1)
        {
            // get date start
            $start = intval($row->date_start);

            // continue
            // check if published
            $month = strtolower(date('F'));
            $table = Data::table('target_submission');
            $id = self::$location;

            // check if published for this month
            $check = $table->get('targetid = :id and officeid = :officeid', $row->targetid, $id);

            $continue = false;

            if ($check->num_rows == 0)
            {   
                $continue = true;
            }
            else
            {
                $check = Data::fetch($check);

                if ($check->{$month} == null)
                {
                    $continue = true;
                }
            }

            if ($continue)
            {
                $currentDay = intval(date('d'));
                $dayend = intval($row->date_end);

                if ($currentDay >= $start && $currentDay <= $dayend)
                {
                    return true;
                }
            }

        }

        return false;
    }
}
