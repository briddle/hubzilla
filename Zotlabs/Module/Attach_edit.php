<?php
namespace Zotlabs\Module;
/**
 * @file Zotlabs/Module/Attach_edit.php
 *
 */

use App;
use Zotlabs\Web\Controller;
use Zotlabs\Lib\Libsync;
use Zotlabs\Access\AccessList;

class Attach_edit extends Controller {

	function post() {

		if (!local_channel() && !remote_channel()) {
			return;
		}

		$attach_id = ((x($_POST, 'attach_id')) ? intval($_POST['attach_id']) : null);
		$nick = ((x($_POST, 'nick')) ? notags($_POST['nick']) : '');
		$delete = ((x($_POST, 'delete')) ? intval($_POST['delete']) : 0);
		$newfolder  = ((x($_POST, 'newfolder_' . $attach_id))  ? notags($_POST['newfolder_' . $attach_id])  : '');
		$newfilename = ((x($_POST, 'newfilename_' . $attach_id)) ? notags($_POST['newfilename_' . $attach_id]) : '');
		$recurse = ((x($_POST, 'recurse_' . $attach_id)) ? intval($_POST['recurse_' . $attach_id]) : 0);
		$notify = ((x($_POST, 'notify_edit_' . $attach_id)) ? intval($_POST['notify_edit_' . $attach_id]) : 0);
		$copy = ((x($_POST, 'copy_' . $attach_id)) ? intval($_POST['copy_' . $attach_id]) : 0);
		$categories = ((x($_POST, 'categories_' . $attach_id)) ? notags($_POST['categories_' . $attach_id]) : '');

		if (! $attach_id) {
			notice(t('File not found.') . EOL);
			return;
		}

		$channel = channelx_by_nick($nick);

		if (! $channel) {
			notice(t('Channel not found.') . EOL);
			return;
		}

		$nick = $channel['channel_address'];
		$channel_id = $channel['channel_id'];
		$observer = App::get_observer();
		$observer_hash = (($observer) ? $observer['xchan_hash'] : '');


		$r = q("SELECT uid, hash, creator, folder, filename, is_photo FROM attach WHERE id = %d AND uid = %d",
			intval($attach_id),
			intval($channel_id)
		);

		if (! $r) {
			notice(t('File not found.') . EOL);
			return;
		}

		$resource = $r[0]['hash'];
		$creator = $r[0]['creator'];
		$folder = $r[0]['folder'];
		$filename = $r[0]['filename'];
		$is_photo = intval($r[0]['is_photo']);
		$admin_delete = false;

		$is_owner = ((local_channel() == $channel_id) ? true : false);
		$is_creator = (($creator == $observer_hash) ? true : false);

		$perms = get_all_perms($channel_id, $observer_hash);

		if (! ($perms['view_storage'] || is_site_admin())){
			notice( t('Permission denied.') . EOL);
			return;
		}

		if (! $perms['write_storage']) {
			if (is_site_admin()) {
				$admin_delete = true;
			}
			else {
				notice( t('Permission denied.') . EOL);
				return;
			}
		}

		if(!$is_owner && !$admin_delete) {
			if(! $is_creator) {
				notice( t('Permission denied.') . EOL);
				return;
			}
		}

		if ($delete) {
			attach_delete($channel_id, $resource, $is_photo);

			if (! $admin_delete) {
				$sync = attach_export_data($channel, $resource, true);
				if ($sync) {
					Libsync::build_sync_packet($channel_id, ['file' => [$sync]]);
				}
			}

			json_return_and_die([ 'success' => true ]);
		}

		if ($copy) {
			$x = attach_copy($channel_id, $resource, $newfolder, $newfilename);
			if ($x['success'])
				$resource = $x['resource_id'];
		}
		elseif ($folder !== $newfolder || $filename !== $newfilename) {
			$x = attach_move($channel_id, $resource, $newfolder, $newfilename);
		}

		if ($categories) {
			q("DELETE FROM term WHERE uid = %d AND oid = %d AND otype = %d",
				intval($channel_id),
				intval($attach_id),
				intval(TERM_OBJ_FILE)
			);
			$cat = explode(',', $categories);
			if ($cat) {
				foreach($cat as $term) {
					$term = trim(escape_tags($term));
					if ($term) {
						$term_link = z_root() . '/cloud/' . $nick . '/?cat=' . $term;
						store_item_tag($channel_id, $attach_id, TERM_OBJ_FILE, TERM_CATEGORY, $term, $term_link);
					}
				}
			}
		}
		else {
			q("DELETE FROM term WHERE uid = %d AND oid = %d AND otype = %d",
				intval($channel_id),
				intval($attach_id),
				intval(TERM_OBJ_FILE)
			);
		}


		if($is_owner) {
			$acl = new AccessList($channel);
			$acl->set_from_array($_REQUEST);
			$x = $acl->get();

			attach_change_permissions($channel_id, $resource, $x['allow_cid'], $x['allow_gid'], $x['deny_cid'], $x['deny_gid'], $recurse, true);

			if ($notify) {
				attach_store_item($channel, $observer, $resource);
			}
		}

		$sync = attach_export_data($channel, $resource, false);

		if ($sync) {
			Libsync::build_sync_packet($channel_id, ['file' => [$sync]]);
		}

		$url = get_cloud_url($channel_id, $nick, $resource);
		goaway(dirname($url));

	}

}
