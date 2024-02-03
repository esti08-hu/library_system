<?php
function cleanInput($input)
{

    $search = array(
        '@<script[^>]*?>.*?</script>@si',
        '@<[\/\!]*?[^<>]*?@si',
        '@<style[^>]*?>.*?</style>@siu',
        '@<![\s\S]*?--[ \t\n\r]*>@'
    );

    $output = preg_replace($search, '', $input);
    return $output;
}
?>

<?php
function sanitize($input)
{
    $dbhost = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "library_db";
    $link = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);
    if (is_array($input)) {
        foreach ($input as $var => $val) {
            $output[$var] = sanitize($val);
        }
    } else {
        $input = stripcslashes($input);
        $input = cleanInput($input);
        $output = mysqli_real_escape_string($link, $input);
    }
    return $output; 
}

?>