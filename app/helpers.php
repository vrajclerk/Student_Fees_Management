// app/helpers.php
<?php
if (!function_exists('get_formatted_date')) {
    function get_formatted_date($date1)
    {
        return \Carbon\Carbon::parse($date1)->format('d-m-Y');
    }
}
?>