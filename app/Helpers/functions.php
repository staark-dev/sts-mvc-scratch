<?php
/*
Credit goes to Dominic Barnes - http://stackoverflow.com/users/188702/dominic-barnes
http://stackoverflow.com/questions/2594211/php-simple-dynamic-breadcrumb
2020-08-26 RAS update to track crumbs for propery link formation and to swap %20 for space
*/
// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // This will build our "base URL" ... Also accounts for HTTPS :)
    $base = ('http') . '://' . $_SERVER['HTTP_HOST'] . '/';

    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = Array("<li class=\"breadcrumb-item\"><a class=\"link-body-emphasis\" href=\"$base\">".
        "<i class=\"bi bi-house-door-fill\"></i>".
        "<span class=\"visually-hidden\">Home</span>".
    "</a></li>");

    // Initialize crumbs to track path for proper link
    $crumbs = '';

    // Find out the index for the last value in our path array
    $last = array_key_last($path);

    // Build the rest of the breadcrumbs
    foreach ($path AS $x => $crumb) {
        if(in_array($crumb, [$_SERVER['HTTP_HOST'], 'auth', 'api', 'login_signup'])) {
            continue;
        }
        
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(Array('.php', '_', '%20'), Array(' ', ' ', ' '), $crumb));

        if(count($path) > 2 && is_numeric($crumb))
            $lastTitle = ucwords(str_replace(Array('.php', '_', '%20'), Array(' ', ' ', ' '), $path[$x - 1]));

        // If we are not on the last index, then display an <a> tag
        if ($x != $last) {
            $breadcrumbs[] = "<li class='breadcrumb-item'>".
                "<a  class=\"link-body-emphasis fw-semibold text-decoration-none\" href=\"$base$crumbs$crumb\">$title</a>";
            "</li>&nbps;";
    	    $crumbs .= $crumb.'/';
        }
        // Otherwise, just display the title (minus)
        else {
            if(is_numeric($crumb)) {
                $breadcrumbs[] = "<li class='breadcrumb-item active' aria-current=\"page\">User Profile</li>";
            } else
                $breadcrumbs[] = "<li class='breadcrumb-item active' aria-current=\"page\">$title</li>";
        }
    }

    // Build our temporary array (pieces of bread) into one big string :)
    echo implode($separator, $breadcrumbs);
}