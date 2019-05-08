<?php

class Alert
{
	public static function message($type, $message, $style = 'alert')
	{
		$msg = is_array($message) ? $message[$type] : $message;

		return self::messageType($type, $msg, $style);
	}

	private static function messageType($type, &$message, $style = 'alert', $button = 'Ok')
	{
		$html = null;

		$type = $type == 'failed' ? 'error' : $type;

		switch ($style)
		{
			case 'alert':
				$html = '<div class="alert alert-'.$type.'" role="alert">
						  '.$message.'
						</div>';
			break;

			case 'modal':
				$type = ucfirst($type);
				$html = '<div class="modal show" id="exampleModal" style="display: block" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">'.$type.'</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        '.$message.'
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn dismiss btn-success btn-lg">'.$button.'</button>
				      </div>
				    </div>
				  </div>
				</div> <script>
					var dis = document.querySelectorAll(\'.btn.dismiss\');
					[].forEach.call(dis, (e)=>{
					    e.addEventListener(\'click\', ()=>{
					       var exp = document.querySelector(\'#exampleModal\');
					       exp.classList.remove(\'show\');
					       exp.classList.add(\'fade\');
					       exp.style.display = \'none\';
					    }); 
					});
				</script>';
			break;
		}

		return $html;
	}
}