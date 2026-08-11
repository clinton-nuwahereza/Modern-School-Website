<?php
add_filter('advanced_import_welcome_message', 'author_personal_blog_modify_welcome_message');
function author_personal_blog_modify_welcome_message(){
   $message = '';
   return $message;
}