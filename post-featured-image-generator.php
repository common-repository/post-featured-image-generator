<?php
/**
Plugin Name: Post Featured Image Generator
Plugin URI: 
Description: Parse post content and generate featured image
Author: Alex Muravyov
Version: 1.0.0
Author URI: http://stdclass.info
*/

defined('FIG_PATH') || define('FIG_PATH', __DIR__);
set_include_path(implode(PATH_SEPARATOR, array(
    FIG_PATH,
    FIG_PATH.'/library', 
    get_include_path(),
)));

defined('SWL') || require_once 'SWL/SWL.php';

require_once 'SWL/Plugin/Plugin.php';
require_once 'SWL/Action/Action.php';
require_once 'SWL/Action/Ajax.php';
require_once 'SWL/Menu/Admin/Menu.php';

require_once 'FIG/Page/Admin/Tabs.php';
require_once 'FIG/Page/Admin/Settings.php';
require_once 'FIG/Page/Admin/Batch.php';

class FeaturedImageGenerator extends SWL_Plugin {
    
    protected $version = '1.0.0';
    
    protected $name = 'Featured Image Generator';
    
    public function registerActions() {
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'createMenu'), 'admin_menu'));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action(array($this, 'createFeatured'), 'save_post'));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action_Ajax(array($this, 'deleteMeta'), 'set-post-thumbnail', 'admin', 1));
        SWL_Action_Manager::getInstance()->addAction(new SWL_Action_Ajax(array($this, 'batch'), 'fig_batch'));
    }
   
    public function createMenu() {        
        $settingsPage = new FIG_Page_Admin_Tabs();
        $settingsPage->addTab(new FIG_Page_Admin_Settings(), 'settings');
        $settingsPage->addTab(new FIG_Page_Admin_Batch(), 'batch');
        $menu = array(
            array(
                'title' => 'Featured Image Generator',
                'slug' => 'fig',
                'parent' => 'options-general.php',
                'renderer' => $settingsPage,
            )
        );
        $menu = new SWL_Menu_Admin($menu);
        $menu->init();        
    } 
    
    public function batch() {
        $offset = $_POST['offset'];
        $limit  = $_POST['limit'];
        $rule   = $_POST['rule'];
        switch($rule) {
            case 'new':
                $data = $this->getNewPosts($offset, $limit);
                 break;
            case 'fig':
                $data = $this->getFigPosts($offset, $limit);
                break;     
            case 'manual':
                $data = $this->getManualPosts($offset, $limit);
                break;             
        }
        $total = $data['total'];
        $posts = $data['posts'];
        foreach ($posts as $id) {
            $this->createFeatured($id, $rule);
        }
        echo json_encode(array('total' => $total, 'parsed' => $offset+count($posts)));
        exit;
    }
    
    protected function getNewPosts($offset, $limit) {
        $args = array(
                        'post_type' => get_option('fig_settings_types', array('post')),
                        'posts_per_page' => -1,
                        'meta_query' => array(array('key' => '_thumbnail_id', 'compare' => 'NOT EXISTS'))
                     );
        $posts = new WP_Query($args);
        $total = $posts->post_count; 
        $args = array(
                        'post_type' => get_option('fig_settings_types', array('post')),
                        'meta_query' => array(array('key' => '_thumbnail_id', 'compare' => 'NOT EXISTS')),
                        'offset' => $offset,
                        'posts_per_page' => $limit
                     );
        $query = new WP_Query($args); 
        $posts = array();
        while($query->have_posts()) {
            $query->the_post();
            $posts[] = get_the_ID();
        } 
        return array('total' => $total, 'posts' => $posts);
    }
    
    protected function getFigPosts($offset, $limit) {
        $args = array(
                        'post_type' => get_option('fig_settings_types', array('post')),
                        'posts_per_page' => -1,
                        'meta_query' => array(array('key' => '_thumbnail_id', 'compare' => 'EXISTS'), array('key' => 'fig_thumbnail', 'compare' => 'EXISTS'))
                     );
        $posts = new WP_Query($args);
        $total = $posts->post_count; 
        $args = array(
                        'post_type' => get_option('fig_settings_types', array('post')),
                        'meta_query' => array(array('key' => '_thumbnail_id', 'compare' => 'EXISTS'), array('key' => 'fig_thumbnail', 'compare' => 'EXISTS')),
                        'offset' => $offset,
                        'posts_per_page' => $limit
                     );
        $query = new WP_Query($args); 
        $posts = array();
        while($query->have_posts()) {
            $query->the_post();
            $posts[] = get_the_ID();
        } 
        return array('total' => $total, 'posts' => $posts);      
    }
    
    protected function getManualPosts($offset, $limit) {
        $args = array(
                        'post_type' => get_option('fig_settings_types', array('post')),
                        'posts_per_page' => -1,
                        'meta_query' => array(array('key' => '_thumbnail_id', 'compare' => 'EXISTS'), array('key' => 'fig_thumbnail', 'compare' => 'NOT EXISTS'))
                     );
        $posts = new WP_Query($args);
        $total = $posts->post_count; 
        $args = array(
                        'post_type' => get_option('fig_settings_types', array('post')),
                        'meta_query' => array(array('key' => '_thumbnail_id', 'compare' => 'EXISTS'), array('key' => 'fig_thumbnail', 'compare' => 'NOT EXISTS')),
                        'offset' => $offset,
                        'posts_per_page' => $limit
                     );
        $query = new WP_Query($args); 
        $posts = array();
        while($query->have_posts()) {
            $query->the_post();
            $posts[] = get_the_ID();
        } 
        return array('total' => $total, 'posts' => $posts);       
    }    
    
    public function createFeatured($postId, $rule = 'new') {
	if (wp_is_post_revision($postId)) return;
        $types = get_option('fig_settings_types', array('post'));
        if (!in_array(get_post_type($postId), $types)) return;
        switch ($rule) {
            case 'new':
                if (has_post_thumbnail($postId)) return;
                break;
            case 'fig':
                if (has_post_thumbnail($postId) && get_post_meta($postId, 'fig_thumbnail', true)=='') return;
                break;
            case 'manual':
                if (has_post_thumbnail($postId) && get_post_meta($postId, 'fig_thumbnail', true)!='') return;
                break;
        }         
	$post = get_post($postId);
        $content = $post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        $images = array();
        if (get_option('fig_image_enabled', 1)) {
            $images = array_merge($images, $this->getSimpleImages($content));
        }
        if (get_option('fig_video_enabled', 1)) {
            $images = array_merge($images, $this->getImagesFromVideoServices($content));
        } 
        //get images meta
        foreach ($images as &$image) {
            $image = $this->getImageMeta($image);
        }
        //filter according to min size settings
        $imageMinWidth  = get_option('fig_image_min_width', 0);
        $imageMinHeight = get_option('fig_image_min_height', 0);
        $videoMinWidth  = get_option('fig_video_min_width', 0);
        $videoMinHeight = get_option('fig_video_min_height', 0);
        foreach ($images as $id => $img) {
            $minWidth = 0;
            $minHeight = 0;
            switch ($img['type']) {
                case 'image':
                    $minWidth = $imageMinWidth;
                    $minHeight = $imageMinHeight;                    
                    break;
                case 'video':
                    $minWidth = $videoMinWidth;
                    $minHeight = $videoMinHeight;                     
                    break;
            }
            if (($minWidth && $minWidth>$img['width']) || 
                ($minHeight && $minHeight>$img['height'])) {
                unset($images[$id]);
            }
        }
        //sort according to priority
        if (get_option('fig_priority_content', 'ignore')!='ignore') {
            $vids = array();
            $imgs = array();
            foreach ($images as $value) {
                switch ($value['type']) {
                    case 'image':
                        $imgs[] = $value;
                        break;
                    case 'video':
                        $vids[] = $value;
                        break;                    
                }
            }
            $data = array('images' => $imgs, 'videos' => $vids);
        } else {
            $data = array($images);
        }
        if (get_option('fig_priority_size', 'ignore')!='ignore') {
            foreach ($data as &$block) {
                switch (get_option('fig_priority_size', 'ignore')) {
                    case 'max_width':
                        $block = $this->sort($block, 'width', 'up');
                        break;
                    case 'max_height':
                        $block = $this->sort($block, 'height', 'up');
                        break;   
                    case 'min_width':
                        $block = $this->sort($block, 'width', 'down');
                        break;
                    case 'min_height':
                        $block = $this->sort($block, 'height', 'down');
                        break;                    
                }
            }    
        } else {
            foreach ($data as &$block) {
                $block = $this->sort($block, 'position');
            }              
        }
        
        if (get_option('fig_priority_content', 'ignore')!='ignore') {
            switch (get_option('fig_priority_content', 'ignore')) {
                case 'iv':
                    $images = array_merge($data['images'], $data['videos']);
                    break;
                case 'vi':
                    $images = array_merge($data['videos'], $data['images']);
                    break;                
            }
        } else {
           $images = array_shift($data); 
        }
        $image = array_shift($images); //get first image
        if ($image) {
            $imageId = $this->saveImageToWP($image['path']);
            if ($imageId) {
                //set post featured image
                set_post_thumbnail($postId, $imageId);
                delete_post_meta($postId, 'fig_thumbnail');
                add_post_meta($postId, 'fig_thumbnail', 1, true);
            }
        }
        
    }
    
    protected function sort($data, $index, $direction = 'down') {
        for ($i=0;$i<count($data);$i++) {
            for ($j=0;$j<count($data);$j++) {
                switch ($direction) {
                    case 'down':
                        if ($data[$i][$index] < $data[$j][$index]) {
                            $tmp = $data[$i];
                            $data[$i] = $data[$j];
                            $data[$j] = $tmp;
                        }
                        break;
                    case 'up':
                        if ($data[$i][$index] > $data[$j][$index]) {
                            $tmp = $data[$i];
                            $data[$i] = $data[$j];
                            $data[$j] = $tmp;
                        }                        
                        break;
                }
            }
        }
        return $data;
    }
    
    protected function getImageMeta($image) {
        $stat = getimagesize($image['path']);
        $image['width'] = $stat[0];
        $image['height'] = $stat[1];
        $image['mime'] = $stat['mime'];
        return $image;
    }
    
    protected function saveImageToWP($imageUrl) {
        if (($image = $this->getImageByUrl($imageUrl))) {
            return $image->ID;
        }
        $uploadDir      = wp_upload_dir();
        $filename       = basename($imageUrl);
        $filename       = wp_unique_filename($uploadDir['path'], $filename);
        $tmpFilename    = download_url($imageUrl);
        $filePath       = $uploadDir['path'].'/'.$filename;
        rename($tmpFilename, $filePath);
        $filetype = wp_check_filetype($filename);
        $attachment = array(
            'guid' => $uploadDir['url'] . '/' . $filename, 
            'post_mime_type' => $filetype['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $id = wp_insert_attachment($attachment, $filePath);
        wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $filePath));
        return $id;
    }
    
    protected function getImageByUrl($url) {
        global $wpdb;
        $urls = array();
        $urls[] = $url;
        $parts = explode('-', $url);
        if (count($parts)>1) {
            $last = array_pop($parts);
            if (stripos($last, '.')!==false) {
                $ext = explode('.', $last);
                $urls[] = implode('-', $parts).'.'.array_pop($ext);
            }
        }
        $image = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->posts} WHERE guid IN(".implode(', ', array_fill(0, count($urls), '%s')).")", $urls));
        return $image;
    }
    
    protected function getSimpleImages($content) {
        $images = array();
        $pattern = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
        $matches = array();
        preg_match_all($pattern, $content, $matches);
        $data = isset($matches[2])?$matches[2]:array();
        foreach ($data as $path) {
            $image = $this->getImageByUrl($path);
            if ($image) $path = $image->guid;
            $images[] = array('path' => $path, 'position' => stripos($content, $path), 'type' => 'image');
        }
        return $images;
    } 
    
    protected function getImagesFromVideoServices($content) {
        $images = array();
        $images = array_merge($images, $this->getYoutubeImages($content));
        $images = array_merge($images, $this->getVimeoImages($content));
        return $images;
    } 
    
    protected function getYoutubeImages($content) {
        $images = array();
        $pattern = "%(?:https?://)?(?:www\.)?(?:youtu\.be/| youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})[a-zA-Z0-9\< \>\"]%x";
        $matches = array();
        preg_match_all($pattern, $content, $matches);
        $ids = isset($matches[1])?$matches[1]:array();        
        foreach ($ids as $id) {
            $images[] = array('path' => 'http://img.youtube.com/vi/'.$id.'/0.jpg', 'position' => stripos($content, $id), 'type' => 'video');
        }    
        return $images;
    }

    protected function getVimeoImages($content) {
        return array();
    } 
    
    public function deleteMeta() {
        $postId = intval($_POST['post_id']);
	if (!current_user_can('edit_post',$postId)) return;
	$thumbnailId = intval($_POST['thumbnail_id']);  
        if ($thumbnailId==-1) {
            delete_post_meta($postId, 'fig_thumbnail');
        }
    }
    
}

$featuredImageGenerator = new FeaturedImageGenerator();
$featuredImageGenerator->init();