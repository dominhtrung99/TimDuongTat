<?php
/*Template Name: Add road Ajax Page*/ ?>
<?php
function addRoad($title = "", $note = "", $author = 1, $geoJson = ""){
    $my_post = array(
			'post_type'     => 'road',
			'post_title'    => $title,
			'post_content'  => $note,
			'post_status'   => 'publish',
			'post_author'   => $author
		);
        // Insert the post into the database
        $post_id = wp_insert_post( $my_post );
    
        if($post_id != "") {
            //update meta key
           // update_post_meta($post_id, 'wpcf-time', $time);
            update_post_meta($post_id, 'wpcf-geojson', $geoJson);
			update_post_meta($post_id, 'wpcf-confirm', 0);
            update_post_meta($post_id, 'wpcf-issafe', [1,2]);
            
            return $post_id;
        }
        else{
            return 0;
        }		
		wp_reset_postdata();	
}


if($_POST['action'] == 'addRoadAjax') {
    $title      =   strip_tags($_POST['roadTitle']);
    $note       =   strip_tags($_POST['roadNote']);
   // $time       =   strip_tags($_POST['roadTime']);

    if ( is_user_logged_in() ) {
       global $userdata;
       $authorId    =   $userdata->ID;
    } else {
        echo  json_encode(['status' => 0, 'message' => 'Lỗi chưa đăng nhập!']);
        die;
    }            
    $geoJson   =   strip_tags($_POST['geoJson']);          
    
    $postId =   addRoad($title, $note, $authorId, $geoJson);  
    
    if (!empty($_FILES["fileUpload"])) {
        $myFile = $_FILES["fileUpload"];
        if ($myFile["error"] !== UPLOAD_ERR_OK) {
            echo  json_encode(['status' => 0, 'message' => 'Lỗi lưu không thành công!']);
            die;
        }
        if ($myFile["size"] > 0) {
            if ( !function_exists('media_handle_upload') ) {
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }            
            $attachment_id = media_handle_upload( 'fileUpload', $postId);
            set_post_thumbnail( $postId, $attachment_id );            
            //$name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);           
        }
    }

    if($postId == 0) {
        echo  json_encode(['status' => 0, 'message' => 'Lỗi lưu không thành công!']);
        die;
    } else {
        echo  json_encode(['status' => 1, 'message' => 'Thêm thành công! Đường tắt của bạn sẽ được kiểm duyệt!']);
        die;
    }
} else {
    echo json_encode(['status' => 0, 'message' => 'Thiếu thông tin']);
    die;
}
echo json_encode(['status' => 0, 'message' => 'Lỗi']);
