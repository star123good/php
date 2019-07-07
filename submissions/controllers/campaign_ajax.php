<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
    

    if($ajax_action != ""){
        // ajax
        switch($ajax_action){
            case "delete_image":
                // Delete images via AJAX
                $ajax_photo = $_GET['ajax_photo'];
                // $id         = Params::getParam('id');
                // $item       = Params::getParam('item');
                // $code       = Params::getParam('code');
                // $secret     = Params::getParam('secret');
                $json = array();

                if($ajax_photo!='') {
                    $files = (isset($_SESSION['ajax_files'])) ? $_SESSION['ajax_files'] : array();
                    // var_dump($files);
                    $success = false;
                    $success = @unlink(CONTENT_PATH.'uploads/temp/'.$ajax_photo);

                    foreach($files as $uuid => $file) {
                        if($file==$ajax_photo) {
                            // $filename = $files[$uuid];
                            unset($files[$uuid]);
                            $_SESSION['ajax_files'] = $files;
                            // echo CONTENT_PATH.'uploads/temp/'.$filename;
                            // $success = @unlink(CONTENT_PATH.'uploads/temp/'.$filename);
                            break;
                        }
                    }

                    echo json_encode(array('success' => $success, 'msg' => $success?('The selected photo has been successfully deleted'):("The selected photo couldn't be deleted")));
                    return false;
                }

                // if( Session::newInstance()->_get('userId') != '' ){
                //     $userId = Session::newInstance()->_get('userId');
                //     $user = User::newInstance()->findByPrimaryKey($userId);
                // }else{
                //     $userId = null;
                //     $user = null;
                // }

                // // Check for required fields
                // if ( !( is_numeric($id) && is_numeric($item) && preg_match('/^([a-z0-9]+)$/i', $code) ) ) {
                //     $json['success'] = false;
                //     $json['msg'] = _m("The selected photo couldn't be deleted, the url doesn't exist");
                //     echo json_encode($json);
                //     return false;
                // }

                // $aItem = Item::newInstance()->findByPrimaryKey($item);

                // // Check if the item exists
                // if(count($aItem) == 0) {
                //     $json['success'] = false;
                //     $json['msg'] = _m("The listing doesn't exist");
                //     echo json_encode($json);
                //     return false;
                // }

                // if(!osc_is_admin_user_logged_in()) {
                //     // Check if the item belong to the user
                //     if($userId != null && $userId != $aItem['fk_i_user_id']) {
                //         $json['success'] = false;
                //         $json['msg'] = _m("The listing doesn't belong to you");
                //         echo json_encode($json);
                //         return false;
                //     }

                //     // Check if the secret passphrase match with the item
                //     if($userId == null && $aItem['fk_i_user_id']==null && $secret != $aItem['s_secret']) {
                //         $json['success'] = false;
                //         $json['msg'] = _m("The listing doesn't belong to you");
                //         echo json_encode($json);
                //         return false;
                //     }
                // }

                // // Does id & code combination exist?
                // $result = ItemResource::newInstance()->existResource($id, $code);

                // if ($result > 0) {
                //     $resource = ItemResource::newInstance()->findByPrimaryKey($id);

                //     if($resource['fk_i_item_id']==$item) {
                //         // Delete: file, db table entry
                //         if(defined(OC_ADMIN)) {
                //             osc_deleteResource($id, true);
                //             Log::newInstance()->insertLog('ajax', 'deleteimage', $id, $id, 'admin', osc_logged_admin_id());
                //         } else {
                //             osc_deleteResource($id, false);
                //             Log::newInstance()->insertLog('ajax', 'deleteimage', $id, $id, 'user', osc_logged_user_id());
                //         }
                //         ItemResource::newInstance()->delete(array('pk_i_id' => $id, 'fk_i_item_id' => $item, 's_name' => $code) );

                //         $json['msg'] =  _m('The selected photo has been successfully deleted');
                //         $json['success'] = 'true';
                //     } else {
                //         $json['msg'] = _m("The selected photo does not belong to you");
                //         $json['success'] = 'false';
                //     }
                // } else {
                //     $json['msg'] = _m("The selected photo couldn't be deleted");
                //     $json['success'] = 'false';
                // }

                // echo json_encode($json);
                // return true;
                break;

            case "ajax_upload":
                // Include the uploader class
                require_once("campaign_ajax_upload.php");
                $uploader = new AjaxUploader();
                $original = pathinfo($uploader->getOriginalName());
                $filename = uniqid("qqfile_").".".$original['extension'];
                $result = $uploader->handleUpload(CONTENT_PATH.'uploads/temp/'.$filename);
                

                // auto rotate
                try {
                    // $img = ImageProcessing::fromFile(CONTENT_PATH . 'uploads/temp/' . $filename);
                    // $img->autoRotate();
                    // $img->saveToFile(CONTENT_PATH . 'uploads/temp/auto_' . $filename, $original['extension']);
                    // $img->saveToFile(CONTENT_PATH . 'uploads/temp/' . $filename, $original['extension']);

                    // $result['uploadName'] = 'auto_' . $filename;
                    $result['uploadName'] = $filename;
                    echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                } catch (Exception $e) {
                    echo "";
                }
                break;

            case "delete_ajax_upload":
                $files = (isset($_SESSION['ajax_files'])) ? $_SESSION['ajax_files'] : array();
                $success = false;
                $filename = '';
                if(isset($files[$_POST['qquuid']]) && $files[$_POST['qquuid']]!='') {
                    $filename = $files[$_POST['qquuid']];
                    unset($files[$_POST['qquuid']]);
                    $_SESSION['ajax_files'] = $files;
                    $success = @unlink(CONTENT_PATH.'uploads/temp/'.$filename);
                };
                echo json_encode(array('success' => $success, 'uploadName' => $filename));
                break;
        }
    }

?>