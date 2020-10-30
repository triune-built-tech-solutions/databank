<?php
namespace Builder;

use Database\ORM as Data;
use Screen\Response;

/**
 * @package Form Builder for area offices
 * @author Trunie Built <amadiify.com> 
 */

class Engine extends \Request
{
	public $title = 'Form Built';
	public $edit = false;
	public $view = false;
	public $goback = '<a href="?back" class="text-danger"><i class="fa fa-arrow-left"></i></a> &nbsp;';
	public $data = null;
	// entry names
	public $entryNames = null;
	public $reportConfig = [];

	// watch constructor
	public function __construct()
	{
		if (!$this->post->isEmpty())
		{
			if ($this->post->has('form_data'))
			{
				$this->saveBuilderData($this->post);
			}

			if ($this->post->has('create-report'))
			{
				$this->createFormReport($this->post); 
			}

			if ($this->post->has('entryid') && $this->get->has('id'))
			{
				$this->saveFormData($this->post);
			}
		}

		if (!$this->get->isEmpty())
		{
			if ($this->get->has('mode'))
			{
				$mode = explode('/', $this->get->mode);

				if (count($mode) == 2)
				{
					$this->switchMode($mode);
				}
			}
			elseif ($this->get->has('action'))
			{
				$action = explode('/', $this->get->action);

				if (count($action) == 2)
				{
					$this->switchAction($action);
				}
			}
			
			$this->deleteBuilder();
		}
	}

	// save form data
	public function saveFormData($post)
	{
		$data = $post->data();
		$json = json_encode($data);
		$data = [
			'entryid' => $post->entryid,
			'area_officeid' => \Target\Office::$location,
			'json_data' => $json,
			'submitted_by' => $_SESSION['user_id']
		];

		// insert data
		$insert = Data::table('form_builder_submitted')->insert($data);

		if (Data::getRows($insert)>0)
		{
			Response::success('Form Record Saved Successfully!');
		}

		Response::error('Save failed, please try again');
	}

	// save builder data
	public function saveBuilderData($post)
	{
		// get area offices
		$offices = preg_replace('/^[,]/','',$post->area_offices);
		// insert
		$data = [
			'json_data' => $post->form_data,
			'area_officeid' => $offices,
			'created_by' => $_SESSION['user_id'],
			'form_name' => $post->form_name,
			'remarks' => $post->remarks
		];
		$insert = Data::table('form_builder_entries')->insert($data);

		if (Data::getRows($insert) > 0)
		{
			$total = explode(',', $offices);
			$s = count($total) > 1 ? 's' : '';

			Response::success('Form built and assigned to ('.count($total).') Area Office'.$s.' but not published yet.');
		}

		Response::danger('Operation failed, please try again.');
	}

	// fetch data
	public function fetchRows()
	{
		// rows
		$formRows = [];

		$forms = Data::table('form_builder_entries')->get();
    	if (Data::getRows($forms) > 0)
    	{
    		$sn = 1;

    		while ( $form = Data::fetch($forms))
    		{
    			// get user
			    $user = Data::table('staff_reg');
			    $user->get('id = :id', $form->created_by);

    			$row = [];
    			$published = ($form->published == 1 ? 'Yes &nbsp; <a href="?mode=unpublish/'.$form->entryid.'" class="btn-outline danger">unpublish</a>' : 'No &nbsp; <a href="?mode=publish/'.$form->entryid.'" class="btn-outline success">publish</a>');

    			$row[] = '<tr>';
    			$row[] = '<td>'.$sn.'</td>';
    			$row[] = '<td>'.ucfirst($form->form_name).'</td>';
    			$row[] = '<td>'.count(explode(',', $form->area_officeid)).' &nbsp; <a href="?action=edit/'.$form->entryid.'" class="btn-outline success">edit</a></td>';
				$row[] = '<td>'.$published.'</td>';
    			$row[] = '<td>'.$form->submits.'</td>';
    			$row[] = '<td>'.$form->date_created.'</td>';
    			$row[] = '<td><a href="?action=view/'.$form->entryid.'" title="view form" class="text-primary"><i class="fa fa-eye"></i></a> | <a href="?del='.$form->entryid.'" title="delete form" class="text-danger"><i class="fa fa-trash"></i></a></td>';
    			$row[] = '</tr>';

    			$formRows[] = implode("\n", $row);
    			$sn++;
    		}
    	}

    	return implode("\n", $formRows);
	}

	// switch mode
	public function switchMode($data)
	{
		list($mode, $id) = $data;

		$table = 'form_builder_entries';
		$pri = 'entryid';
		$message = 'Data';
		$fid = null;

		if ($this->get->has('config'))
		{
			list($table, $pri, $fid) = explode('/', $this->get->config);
			$message = 'Report';
		}

		// set table
		$table = Data::table($table);

		// check for existance
		$check = $table->get($pri.'=:id',$id);

		if ($check->num_rows > 0)
		{
			switch (strtolower(trim($mode)))
			{
				case 'publish':
					
					if (!is_null($fid))
					{
						$table->update(['published'=>0], 'entryid=:id',$fid);
					}

					$update = $table->update(['published'=>1],$pri.'=:id',$id);

					if (Data::getRows($update)>0)
					{
						Response::success('Form '.$message.' published successfully.');
					}
				break;

				case 'unpublish':
					$update = $table->update(['published'=>0],$pri.'=:id',$id);
					if (Data::getRows($update)>0)
					{
						Response::success('Form '.$message.' unpublished successfully.');
					}
				break;

				default:
					Response::danger('Operation failed. Invalid Request Option');
			}
		}
		else
		{
			Response::danger('Operation failed. Invalid ID');
		}
	}

	// switch action
	public function switchAction($data)
	{
		list($action, $id) = $data;
	
		// set table
		$table = Data::table('form_builder_entries');

		// / check for existance
		$check = $table->get('entryid=:id',$id);

		if ($check->num_rows > 0)
		{
			$check = Data::fetch($check);
			$this->title = $this->goback . ucwords($check->form_name);
			$this->data = $check;

			switch (strtolower(trim($action)))
			{
				case 'edit':
					if ($this->post->has('update'))
					{
						$data = $this->post;

						// get area offices
						$offices = preg_replace('/^[,]/','',$data->area_offices);

						$this->data->form_name = $data->form_name;
						$this->data->area_offices = $offices;

						// update
						$update = $table->update([
							'form_name' => $data->form_name,
							'area_officeid' => $offices],
							'entryid=:id', $id);

						if (Data::getRows($update)>0)
						{
							Response::success('Form Data updated successfully.');
						}
					}
					$this->edit = true;
				break;

				case 'view':
					$this->view = true;
				break;
			}
		}
		else
		{
			Response::danger('Operation failed. Invalid ID');
		}
	}

	// delete builder
    public function deleteBuilder()
    {
        
        if ($this->get->has('del'))
        {
            $id = $this->get->del;
            $config = '';

            if ($this->get->has('config'))
            {
            	$config = '&config='.$this->get->config;
            }

            $del = '
            <div class="ask-question">
              <div class="ask-question-text"> <h1> Are you sure you want to delete form ? </h1> </div>
              <div class="ask-question-btn"> <a href="?confirm=yes&id='.$id.$config.'">Yes</a> <a href="?confirm=no"> No </a>
            </div>';
            echo $del;
        }
        elseif ($this->get->has('confirm'))
        {
            if ($this->get->confirm == 'yes')
            {
                $id = $this->get->id;
                $table = 'form_builder_entries';
                $pri = 'entryid';
                $title = 'Form';

                if ($this->get->has('config'))
                {
                	list($table, $pri) = explode("/", $this->get->config);
                	$title = 'Form Report';
                }

                $delete = Data::table($table)->del($pri.' = :id', $id);

                if (Data::getRows($delete) > 0)
                {
                    Response::success($title.' deleted successfully!');
                }

                Response::danger("Operation canceled.");
            }
        }
    }

    // read builder
    public function readBuilder($data=null)
    {
    	$json = json_decode((!is_null($data) ? $data : $this->data->json_data));

    	$formdata = [];

    	// read all element
    	foreach ($json as $index => $form)
    	{
    		$parent = isset($form->parent) ? $form->parent : null;
    		if (!is_null($parent))
    		{
    			unset($form->parent);
    		}
    		$build = '<section class="form-group">'."\n";
    		// read element
    		$build .= $this->readElement($form) . "\n";
    		// read parent
    		$build .= $this->readElementParent($parent) . "\n";
    		$build .= '</section>';

    		$formdata[] = $build;

    	}

    	return implode("\n", $formdata);
    }

    // get attribute
    public function getAttribute($data)
    {
    	$attribute = [];

    	if (isset($data->attributes))
    	{
    		foreach ($data->attributes as $index => $attr)
    		{
    			$attribute[] = $attr->name.'="'.$attr->value.'"';
    		}
    	}

    	return implode(" ", $attribute);
    }

    // read element
    public function readElement($data)
    {
    	// read attributes
    	$attribute = $this->getAttribute($data);
    	$text = isset($data->text) ? $data->text : null;
    	$closing = function() use ($data)
    	{
    		$ele = $data->element;
    		if ($ele != 'input')
    		{
    			return '</'.$ele.'>';
    		}

    		return null;
    	};

    	$tag = '<'.$data->element.' '.$attribute.'>'.$text.$closing();

    	return $tag;
    }

    // read element parent
    public function readElementParent($data)
    {
    	// read all
    	$parent = [];

    	foreach ($data as $index => $obj)
    	{
    		$ele = $obj->name;
    		$attr = $this->getAttribute($obj);
    		$element = $this->readElement($obj->element);
    		$build = '<'.$ele.' '.$attr.'>'.$element.'</'.$ele.'>';
    		$parent[] = $build;
    	}

    	return implode("\n", $parent);
    }

    // check forms for target
    public function formsForTarget()
    {
    	$location = \Target\Office::$location;
    	$entries = Data::table('form_builder_entries');
    	$check = $entries->get("area_officeid like '%$location%' and published = 1");

    	$forms = [];

    	if ($check->num_rows > 0)
    	{	
    		while ($c = Data::fetch($check))
    		{
    			$offices = array_flip(explode(",", $c->area_officeid));

    			if (isset($offices[$location]))
                {
                    $forms[] = $c;
                }
    		}
    	}

    	return $forms;
    }

    // form for target
    public function formForTarget()
    {
    	$entries = Data::table('form_builder_entries');
    	$check = Data::fetch($entries->get('entryid=:id',$_GET['id']));
    	return $check;
    }

    // get entry list
    public function entryList()
    {
    	$list = [];
    	$names = [];

    	$all = Data::table('form_builder_entries')->get('order by entryid desc');

    	if ($all->num_rows > 0)
    	{
    		while ($c = Data::fetch($all))
    		{
    			$json = json_decode($c->json_data);
    			$data = $this->getNames($json);

    			$names['entry'.$c->entryid] = $data;

    			$list[] = '<option value="'.$c->entryid.'">'.ucwords($c->form_name).'</option>';
    		}
    	}

    	$names = json_encode($names);
    	$this->entryNames = $names;

    	return implode("\n", $list);
    }

    // get names
    public function getNames($data)
    {
    	$names = [];

    	// run loop
    	foreach ($data as $index => $obj)
    	{
    		foreach ($obj->parent as $i => $list)
    		{
    			
    			$tag = $list->element->element;

    			if ($tag != 'button')
    			{
	    			// get element
	    			foreach ($list->element as $z => $ele)
	    			{
	    				if ($z == 'attributes')
	    				{
	    					foreach ($ele as $x => $attr)
			    			{
			    				if ($attr->name == 'name')
			    				{
			    					$names[] = $attr->value;
			    				}
			    			}
	    				}
	    			}
    			}

    		}
    	}

    	return $names;
    }

    // get Entries Data
    public function getEntriesData($data, $c=null)
    {
    	if ($c == null)
    	{
	    	$table = Data::table('form_builder_submitted')->get('submitted_by=:id and entryid=:eid',$_SESSION['user_id'], $_GET['id']);

	    	$row = [];

	    	if ($table->num_rows > 0)
	    	{
	    		$i = 0;

	    		while ($c = Data::fetch($table))
	    		{
	    			$entry = json_decode($c->json_data);

	    			$val = [];

	    			foreach ($data as $a => $header)
	    			{
	    				$val[$header] = $entry->{$header};
	    			}

	    			$row[$i]['entry'] = $val;
	    			$row[$i]['row'] = $c;

	    			$i++;
	    		}
	    	}
	    }
	    else
	    {
	    	$row = [];

	    	if ($c !== null)
	    	{
	    		$entry = json_decode($c->json_data);

    			$val = [];

    			foreach ($data as $a => $header)
    			{
    				$val[$header] = $entry->{$header};
    			}

    			$row['entry'] = $val;
    			$row['row'] = $c;
	    	}
	    }

    	return $row;
    }

    // added by
    public function addedBy($id)
    {
    	$ins = Data::table('staff_reg')->get('id=:id',$id);
    	$staff = Data::fetch($ins, true, true);
    	$ins->max = null;
    	return $staff->username;
    }

    // get report title
    public function reportTitle()
    {
    	$list = [];

    	$all = Data::table('report_builder_config')->get('configid = 1');
    	$all = Data::fetch($all);
    	$this->reportConfig = $all;

    	// get default value
    	$default_values = explode(',', $all->default_values);

    	// read value
    	foreach ($default_values as $index => $val)
    	{
    		$val = trim($val);
    		$list[] = '<option value="'.$val.'">'.$val.'</option>';
    	}

    	return implode("\n", $list);
    }

    // get report controls
    public function reportControls()
    {
    	$list = [];

    	// get controls
    	$controls = explode(',', $this->reportConfig->controls); 

    	// read value
    	foreach ($controls as $index => $val)
    	{
    		$val = trim($val);
    		$list[] = '<option value="'.$val.'">'.$val.'</option>';
    	}

    	return implode("\n", $list);
    }

    // create form report
    public function createFormReport($data)
    {
    	$id = $data->entryid;
    	$title = implode(',', $data->report_title);
    	$controls = implode(',', $data->report_control);

    	$insert = ['entryid' => $id,
    	'table_th' => $title,
    	'table_controls' => $controls,
    	'added_by' => $_SESSION['user_id']];

    	$table = Data::table('report_builder_data')->insert($insert);

    	if (Data::getRows($table)>0)
    	{
    		Response::success('Form Report Created Successfully.');
    	}

    	Response::success('Fail to create form report. Please try again.');
    }

    // get form reports
    public function getFormReport()
    {
    	$list = [];
    	$reports = Data::table('report_builder_data')->get();

    	if ($reports->num_rows > 0)
    	{
    		while ($c = Data::fetch($reports))
    		{
    			$tr = ['<tr>'];

    			$form = Data::table('form_builder_entries')->get('entryid=:id',$c->entryid);
    			$form = Data::fetch($form);
    			$config = '&config=report_builder_data/dataid/'.$c->entryid;

    			$published = ($c->published == 1 ? 'Yes &nbsp; <a href="?mode=unpublish/'.$c->dataid.$config.'" class="btn-outline danger">unpublish</a>' : 'No &nbsp; <a href="?mode=publish/'.$c->dataid.$config.'" class="btn-outline success">publish</a>');

    			$tr[] = '<td>'.$form->form_name.'</td>';
    			$tr[] = '<td>'.$c->table_th.'</td>';
    			$tr[] = '<td>'.$c->table_controls.'</td>';
    			$tr[] = '<td>'.$published.'</td>';
    			$tr[] = '<td><a href="?del='.$c->dataid.$config.'" title="delete report" class="text-danger"><i class="fa fa-trash"></i></a></td>';
    			$tr[] = '</tr>';

    			$list[] = implode("\n", $tr);
    		}
    	}

    	return implode("\n", $list);
    }

    // check if form entry has a report 
    public function hasReport($formid)
    {
    	$table = Data::table('report_builder_data');
    	$check = $table->get('entryid=:id and published = 1', $formid);

    	if ($check->num_rows > 0)
    	{
    		return true;
    	}

    	return false;
    }

    // generate report
    public function generateReport()
    {
    	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    	$object = (object)[];
    	$object->title = 'Report';
    	$object->headers = null;
    	$object->body = null;

    	if (is_int($id))
    	{
    		$report = Data::table('report_builder_data');
    		$getReport = Data::fetch($report->get('entryid=:id and published=1',$id));


    		$entry = Data::table('form_builder_entries');
    		$getEntry = Data::fetch($entry->get('entryid=:id',$id));


    		// set title
    		$object->title = $getEntry->form_name;

    		// get headers
    		$headers = explode(',', $getReport->table_th);
    		$th = [];
    		// set th
    		foreach ($headers as $index => $t)
    		{
    			$t = ucwords(str_replace('_', ' ', $t));

    			$th[] = '<th>'.$t.'</th>'.PHP_EOL;
    		}

    		if (strlen($getReport->table_controls) > 1)
    		{
    			$th[] = '<th></th>';
    		}

    		$object->headers = implode("\n", $th);

    		$body = [];

    		$submits = Data::table('form_builder_submitted')->get('entryid=:id and area_officeid=:aid', $id, \Target\Office::$location);

    		// check size
    		$sn = 1;

    		if ($submits->num_rows > 0)
    		{
    			$row = [];

    			$names = $this->getNames(json_decode($getEntry->json_data));


    			while ($s = Data::fetch($submits))
    			{
    				$row[] = '<tr>';

    				$date = $s->date_created;
    				$data = $this->getEntriesData($names, $s);

    				$entry = $data['entry'];

    				$names = array_flip($names);

    				$user = Data::fetch(Data::table('staff_reg')->get('id=:ied', $s->submitted_by), true, true);

    				// get office type
    				$type = Data::fetch(Data::table('office_type')->get('id=:eid',$user->office_type), true, true);

    				// get location
    				$location = Data::fetch(Data::table('area_office')->get('id=:eid',$user->office_location), true, true);

    				
    				foreach ($headers as $h => $header)
    				{
    					switch ($header)
    					{
    						case 'SN':
    							$row[] = '<td>'.$sn.'</td>';
    						break;

    						case 'added_by':
    							$row[] = '<td>'.$this->addedBy($s->submitted_by).'</td>';
    						break;

    						case 'month':
    							$row[] = '<td>'.date('F',strtotime($date)).'</td>';
    						break;

    						case 'year':
    							$row[] = '<td>'.date('Y',strtotime($date)).'</td>';
    						break;

    						case 'office_type':
    							$row[] = '<td>'.ucwords($type->type).'</td>';
    						break;

    						case 'location':
    							$row[] = '<td>'.ucwords($location->area_office_name).'</td>'; break;

    						case 'time':
    							$row[] = '<td>'.date('g:i:s a',strtotime($date)).'</td>';
    						break;

    						default:
    							if (isset($names[$header]))
    							{
    								$row[] = '<td>'.$entry[$header].'</td>';
    							}
    					}
    				}

    				if (strlen($getReport->table_controls) > 1)
		    		{
		    			$row[] = '<td></td>';
		    		}
    				

    				$row[] = '</tr>';
    				$sn++;
    			}

    			$body = $row;
    		}

    		// set body
    		$object->body = implode("\n", $body);
    	}

    	return $object;
    }
}