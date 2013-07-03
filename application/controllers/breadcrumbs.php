<?php
class Breadcrumbs_Controller extends Base_Controller {

	public function action_createBreadcrumbs($elementsArray) {
        if(!Auth::user())
            return Redirect::to('login');

		$html ='';
		foreach ($elementsArray as $elements) {
			if (!empty($elements['url']))
				$html .= '<a href="' . $elements['url'] . '">' . $elements['name'] . '</a> &rarr; ';
			else
				$html .= $elements['name'];

		}
		return $html;
	}

}