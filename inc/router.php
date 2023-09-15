<?php

add_action('rest_api_init', function ($params) {
    register_rest_route('bosfb/v1', '/new', array(
        'methods' => 'POST',
        'callback' => 'bos_new_feedback',
    ));
});

function bos_new_feedback($params){

    $cmt = $params->get_params();

    if (empty($cmt["message"]) || empty($cmt["contact_addr"])) {
        wp_send_json([
            "status" => "error",
            "message" => "Fill all fields plz "
        ], 500);
        exit;
    }

    $term_name =  isset($cmt["project_name"]) ? strtolower(strip_tags(trim($_POST["project_name"]))) : "uncategorized";
    $parent_term = term_exists($term_name, 'bos_fb_tax');
    $message = isset($cmt["message"]) ? (strip_tags(trim($cmt["message"]))) : "";
    $contact_addr = isset($cmt["contact_addr"]) ? (strip_tags(trim($cmt["contact_addr"]))) : false;
    $wallet_addr = isset($cmt["wallet_addr"]) ? (strip_tags(trim($cmt["wallet_addr"]))) : false;

    //create new term if not exist 
    if (!is_array($parent_term)) {
        $parent_term_id = $parent_term['term_id']; // get numeric term id

        wp_insert_term(
            $term_name,   // the term 
            'bos_fb_tax', // the taxonomy
            array(
                'parent'      => $parent_term_id,
            )
        );
    }


    //insert feedback + term 
    $pid = wp_insert_post([
        'post_title'    => wp_trim_words($message, 100, "...") . " - " . $contact_addr,
        'post_content'  => $message,
        'post_status'   => 'publish',
        'post_author'   => 1, // Replace with the author ID
        'post_type'     => 'bos_fb', // Replace with your custom post type slug
    ]);

    if (!is_wp_error($pid)) {
        wp_set_post_terms($pid, $term_name, 'bos_fb_tax'); // Replace with your custom category and taxonomy
        update_post_meta($pid, "bos_contact_addr", $contact_addr);
        update_post_meta($pid, "bos_wallet_addr", $wallet_addr);

        wp_send_json([
            "status" => "success",
            "message" => "Feedback sent"
        ]);
    } else {
        wp_send_json([
            "status" => "error",
            "message" => "Something wrong during sent feedback"
        ], 500);
    }
    wp_send_json([
        "status" => "error",
        "message" => "clgt",
    ], 500);
    die;
}
