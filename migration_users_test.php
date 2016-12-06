<?php 
/*Test is all users were imported from CSV
 * replace yout-file.csv with your csv file name
 */


define('WP_USE_THEMES', false);
require('wp-blog-header.php');


$row =  $users_number = 0;
$exist = $notexist = 0;
if (($handle = fopen("your-file.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 3000, ",")) !== FALSE) {
        $email = $data[2];
        //validate email
        if(strpos($email, '@')){
            echo $email;
            if(!get_user_by_email($email)){
                echo " - <span style=\"color: red;\">user not found.</span><br />\n";
                $notexist++;
            }else{
                echo " - user found.<br />\n";
                $exist++;
            }
            $users_number++;
        }
        $row++;
    }
    fclose($handle);
}
echo "<p>Processed $row rows and $users_number users.</p>";
echo "<p>$exist users found, $notexist users not found in database.</p>";