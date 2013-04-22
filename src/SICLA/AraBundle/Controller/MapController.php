<?php

namespace SICLA\AraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Helper\MapHelper;

class MapController extends Controller {

	public function view_mapAction() {

		
		return $this->render('SICLAAraBundle:Form:map.html.twig');
	}

}

?>
