<?php
namespace Zotlabs\Module;

require_once('include/security.php');
require_once('include/bbcode.php');
require_once('include/items.php');



class Filer extends \Zotlabs\Web\Controller {

	function get() {
	
		if(! local_channel()) {
			killme();
		}
	
		$term = unxmlify(trim($_GET['term']));
		$item_id = ((\App::$argc > 1) ? intval(\App::$argv[1]) : 0);
	
		logger('filer: tag ' . $term . ' item ' . $item_id);
	
		if($item_id && strlen($term)){
			// file item
			store_item_tag(local_channel(),$item_id,TERM_OBJ_POST,TERM_FILE,$term,'');
	
			// protect the entire conversation from periodic expiration
	
			$r = q("select parent from item where id = %d and uid = %d limit 1",
				intval($item_id),
				intval(local_channel())
			);
			if($r) {
				$x = q("update item set item_retained = 1, changed = '%s' where id = %d and uid = %d",
					dbesc(datetime_convert()),
					intval($r[0]['parent']),
					intval(local_channel())
				);
			}
		} 
		else {
			$filetags = array();
			$r = q("select distinct(term) from term where uid = %d and ttype = %d order by term asc",
				intval(local_channel()),
				intval(TERM_FILE)
			);
			if(count($r)) {
				foreach($r as $rr)
					$filetags[] = $rr['term'];
			}
			$tpl = get_markup_template("filer_dialog.tpl");
			$o = replace_macros($tpl, array(
				'$field' => array('term', t('Enter a folder name'), '', '', $filetags, 'placeholder="' . t('or select an existing folder (doubleclick)') . '"'),
				'$submit' => t('Save'),
				'$title' => t('Save to Folder'),
				'$cancel' => t('Cancel')
			));
			
			echo $o;
		}
		killme();
	}
	
}
