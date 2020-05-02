<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comment-content">
    <?php if (have_comments()): ?>
    <h3 class="mb-5">
        <?php printf(__('Comments', 'highstarter')); ?>
    </h3>

    <?php the_comments_navigation();?>

    <ul class="comment-list">
    <?php
    wp_list_comments(array(
        'style' => 'ul',
        'class' => 'comment-list',
        'short_ping' => true,
        'avatar_size' => 70,
    ));
    ?>
    </ul><!-- .comment-list -->

    <?php the_comments_navigation();?>

    <?php endif;

    comment_form(array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title mb-5">',
        'title_reply_after' => '</h3>',
        'title_reply' => __('Leave a Comment', 'highstarter'),
        'class_submit' => 'btn btn-primary',
        'label_submit' => __('Submit Query', 'highstarter'),
        'comment_field' => '<p class="comment-form-comment">' .
        '<label for="comment">' . __('Message', 'highstarter') . '</label>' .
        '<textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true"></textarea>' .
        '</p>',
    ));
?>
</div><!-- .comments-area -->