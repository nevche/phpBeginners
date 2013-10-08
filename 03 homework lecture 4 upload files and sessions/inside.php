<?php
include('./includes/header.php');


if (isset($_SESSION['loggedIn']) == TRUE) {
    echo 'You are no Logged In. Congratulations:P';

    echo '<div>You could also 
            <a href="logout.php">Log Out</a> 
            if you\'d like...:(';

    echo '<br /><br />
        These are your files here. Be happy and keep them safe.<br />
        You could also upload a few more... it will be fun!:)';

    //proveriavame dali sestiata e pochnala
    //username-a na choveka e imeto i na negovata papka
    //sled tova checkvame dali usera veche ima papka ili ne, i posle 
    //listvame directoriata mu.
    if (isset($_SESSION['userFolder'])) {
        $userFolder = $_SESSION['userFolder'];

        echo '<br /><br /><br />'
        . 'PRETTY FILE LIST (yes.. you.. <span style="color:green;">' . $userFolder . '</span>)</div>'
        . '<div><hr width="300px" align="left"></div>';

        if (!file_exists($userFolder)) {
            mkdir($userFolder, 0755, true);
        }

        //check if file has been uploaded and if the name repeats
        if (isset($_POST) && isset($_FILES['fileUpload'])) {
            $tmpFileUp = $_FILES['fileUpload']['name'];
            $tmpFileUpType = $_FILES['fileUpload']['type'];


            if (($tmpFileUpType == 'image/jpeg') || ($tmpFileUpType == 'image/png') || ($tmpFileUpType == 'text/plain') || ($tmpFileUpType == 'application/pdf') || ($tmpFileUpType == 'application/octet-stream')) {

                //image/jpeg img/png text/plain application/pdf application/octet-stream
                
                //da vidim dali sushtestvuva veche, a?:)
                if (file_exists($userFolder . DIRECTORY_SEPARATOR . $tmpFileUp)) {
                    echo '<span style="color:red;">File Exists Already.. 
                    Uploading with a different name</span>';

                    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $userFolder . DIRECTORY_SEPARATOR . $tmpFileUp . ' (' . time() . ')');
                    echo '<span style="color:orange;"><br />Good Job Upload :)</span>';

                    // kachvame faila
                } else if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $userFolder . DIRECTORY_SEPARATOR . $tmpFileUp)) {

                    echo '<span style="color:orange;">Good Job Upload :)</span>';
                } else {
                    echo '<span style="color:red;">Error Uploading</span>';
                }
            } else {
                echo '<span style="color:red;">Error Upload: Wrong file type. Only .jpg, png, psd, pdf, txt, doc.</span>';
            }
        }



        // list folders
        echo '<table>';
        $files = (scandir($userFolder));
        foreach ($files as $value) {
            // get rid of the dots
            if (($value !== '.') && ($value !== '..')) {
                // tribva da pokajeem size i takovata...

                echo '<tr><td><a href="' . $userFolder . DIRECTORY_SEPARATOR . $value . '" target="blank"><pre>' . print_r($value, true)
                . '</a></pre></td><td width="10px"> </td><td><pre>'
                . number_format(filesize($userFolder . DIRECTORY_SEPARATOR . $value) / 1024, 2)
                . ' KB</pre></td><td width="10px"> </td><td><pre>'

                //filetype da se vidi e neshto drugo... iavno..        
                // . filetype($userFolder . DIRECTORY_SEPARATOR . $value)
                // . '</pre></td><td width="10px"> </td><td><pre>'
                . date('d.M.Y', filemtime($userFolder . DIRECTORY_SEPARATOR . $value)) . '</pre></td>'

                //mnogo mi se iska da iztriem tozi fail, ama s POST ili SESSION
                //a ne s GET.. zashtoto taka moje da se trie kakvoto si iska chovek...
                //ama iavno drug put:(

                . '</td></tr>';
            }
        }
    }
    ?>
    </table>
    <div><hr width="300px" align="left"></div>

    <form method="POST" enctype="multipart/form-data">
        <div><input type="file" name="fileUpload">
            <input type="submit" value="Upload">
        </div>
    </form>



    <?php
} else {
    header('Loation: index.php');
    exit;
}
?>
<?php include('./includes/footer.php'); ?>