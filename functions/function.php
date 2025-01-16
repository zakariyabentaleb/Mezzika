<?php
function uploadImage($name, $tmp_name, $size, $error)
{
    if ($error === 0) {
        if ($size > 10200000) {
            return 1;
        } else {
            $img_ext = pathinfo($name, PATHINFO_EXTENSION);
            $img_ext_lc = strtolower($img_ext);

            $allowed_ext = array("jpg", "jpeg", "png", "webp", "avif", "jfif");

            if (in_array($img_ext_lc, $allowed_ext)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ext_lc;
                $img_upload_path ='../public/img/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                return $new_img_name;
            } else {
                return 2;
            }
        }
    } else {
        return null;
    }
}
?>