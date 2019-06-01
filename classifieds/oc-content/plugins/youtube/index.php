<?php

/*
  Plugin Name: Embed Youtube videos
  Plugin URI: http://www.osclass.org/
  Description: This plugin extends the item to embed youtube videos.
  Version: 2.0.0
  Author: OSClass
  Author URI: http://www.osclass.org/
  Short Name: youtube
  Plugin update URI: youtube
 */

define('YOUTUBE_PATH', dirname(__FILE__) . '/');
define('YOUTUBE_TABLE', DB_TABLE_PREFIX . 't_item_youtube');

// use old functions if version is previous to 2.3
if (version_compare(OSCLASS_VERSION, '2.3', '<')) {
    require_once( YOUTUBE_PATH . 'youtube-old.php' );
}

if (!function_exists('youtube_call_after_install')) {

    function youtube_call_after_install() {
        $conn = DBConnectionClass::newInstance();
        $c_db = $conn->getOsclassDb();
        $comm = new DBCommandClass($c_db);

        $path = osc_plugin_resource('youtube/struct.sql');
        $sql = file_get_contents($path);
        $comm->importSQL($sql);

        osc_set_preference('youtube_version', '200', 'youtube', 'STRING');
        osc_reset_preferences();
    }

}

if (!function_exists('youtube_call_after_uninstall')) {

    function youtube_call_after_uninstall() {
        $conn = DBConnectionClass::newInstance();
        $c_db = $conn->getOsclassDb();
        $comm = new DBCommandClass($c_db);

        $comm->query(sprintf('DROP TABLE %s', YOUTUBE_TABLE));
        osc_delete_preference('youtube_version', 'youtube');
    }

}

function youtube_update() {
    // convert version
    $version = osc_get_preference('youtube_version', 'youtube');
    if ($version == '') {
        $version = 12;
    }
    if ($version < 200) {
        $conn = DBConnectionClass::newInstance();
        $data = $conn->getOsclassDb();
        $dbCommand = new DBCommandClass($data);
        $dbCommand->query(sprintf('ALTER TABLE %s ADD COLUMN s_id VARCHAR(15) NOT NULL DEFAULT \'-no-id-\' AFTER s_youtube', YOUTUBE_TABLE));
        // update s_id
        $dbCommand->select();
        $dbCommand->from(YOUTUBE_TABLE);
        $rs = $dbCommand->get();
        if ($rs !== false) {
            $result = $rs->result();
            foreach($result as $video) {
                $video_code = youtube_get_code_from_url($video['s_youtube']);
                $dbCommand->update(
                    YOUTUBE_TABLE,
                    array('s_id' => $video_code),
                    array('fk_i_item_id' => $video['fk_i_item_id'])
                );
            }
        }
        osc_set_preference('youtube_version', '200', 'youtube', 'STRING');
        osc_reset_preferences();
    }

}

function youtube_form($catID = null) {
    $detail = array('s_youtube' => '');

    require_once( YOUTUBE_PATH . 'item_form.php' );
}

if (!function_exists('youtube_form_post')) {

    function youtube_form_post($item) {
        $catID = $item['fk_i_category_id'];
        $itemID = $item['pk_i_id'];
        $youtube_video = Params::getParam('s_youtube');
        $youtube_id      = youtube_get_code_from_url($youtube_video);
        $youtube_video = convert_youtube_url($youtube_video);
        if (empty($youtube_video))
            return false;

        $conn = DBConnectionClass::newInstance();
        $c_db = $conn->getOsclassDb();
        $comm = new DBCommandClass($c_db);

        $values = array(
            'fk_i_item_id' => $itemID,
            's_youtube' => $youtube_video,
            's_id' => $youtube_id
            );
        $comm->insert(YOUTUBE_TABLE, $values);
    }

}

function youtube_get_row($itemID) {
    $conn = DBConnectionClass::newInstance();
    $c_db = $conn->getOsclassDb();
    $comm = new DBCommandClass($c_db);

    $comm->select();
    $comm->from(YOUTUBE_TABLE);
    $comm->where('fk_i_item_id', $itemID);
    $rs = $comm->get();

    if ($rs === false) {
        return false;
    }

    if ($rs->numRows() != 1) {
        return false;
    }

    return $detail = $rs->row();
}

if (!function_exists('youtube_item_detail')) {

    function youtube_item_detail() {
        $detail = youtube_get_row(osc_item_id());
        if ($detail) {
            require_once( YOUTUBE_PATH . 'item_detail.php' );
        }
    }

}

if (!function_exists('youtube_item_edit')) {

    function youtube_item_edit($catID = null, $itemID = null) {
        $detail = array('s_youtube' => '');
        $row = youtube_get_row($itemID);
        if ($row) {
            $detail = $row;
        }

        require_once( YOUTUBE_PATH . 'item_form.php' );
    }

}

if (!function_exists('youtube_item_edit_post')) {

    function youtube_item_edit_post($item) {
        $catID = $item['fk_i_category_id'];
        $itemID = $item['pk_i_id'];
        $youtube_video = addslashes(Params::getParam('s_youtube'));
        $youtube_id      = youtube_get_code_from_url($youtube_video);
        $youtube_video = convert_youtube_url($youtube_video);

        $conn = DBConnectionClass::newInstance();
        $c_db = $conn->getOsclassDb();
        $comm = new DBCommandClass($c_db);

        $values = array(
            'fk_i_item_id' => $itemID,
            's_youtube' => $youtube_video,
            's_id' => $youtube_id
            );
        $comm->replace(YOUTUBE_TABLE, $values);
    }

}

if (!function_exists('youtube_delete_item')) {

    function youtube_delete_item($itemID) {
        $conn = DBConnectionClass::newInstance();
        $c_db = $conn->getOsclassDb();
        $comm = new DBCommandClass($c_db);

        $where = array(
            'fk_i_item_id' => $itemID
            );
        $comm->delete(YOUTUBE_TABLE, $where);
    }

}

function convert_youtube_url($url) {
    $youtube_url = '';
    if (preg_match('|.*?youtube.*?v[\?/=](.{11})|', $url)) {
        $youtube_url = preg_replace('|.*?youtube.*?v[\?/=](.{11}).*|', 'http://www.youtube.com/v/$01?fs=1', $url);
        return $youtube_url;
    }

    if (preg_match('|.*?youtu\.be\/(.{11})|', $url)) {
        $youtube_url = preg_replace('|.*?youtu\.be\/(.{11}).*|', 'http://www.youtube.com/v/$01?fs=1', $url);
        return $youtube_url;
    }

    return '';
}

function youtube_get_code_from_url($url) {
    $id = $values = null;
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } else {
        // not an youtube video
    }
    return $values;
}

// create the youtube table when the plugin is installed
osc_register_plugin(osc_plugin_path(__FILE__), 'youtube_call_after_install');
// drop youtube table when the plugin is uninstalled
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'youtube_call_after_uninstall');
// update
osc_add_hook('init', 'youtube_update');

// show field in item post layout
osc_add_hook('item_form', 'youtube_form');
// insert youtube string
osc_add_hook('posted_item', 'youtube_form_post');

// show video in item detail layout
osc_add_hook('item_detail', 'youtube_item_detail');

// show field in item edit layout
osc_add_hook('item_edit', 'youtube_item_edit');
// update youtube string after edit POST
osc_add_hook('edited_item', 'youtube_item_edit_post');

// delete youtube video of the deleted item
osc_add_hook('delete_item', 'youtube_delete_item');

/* file end: ./youtube/index.php */
