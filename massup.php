<!DOCTYPE html>
<html>
<head>
    <title>Multiple File Upload</title>
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple="multiple" />
        <input type="submit" name="upload" value="Upload" />
    </form>

    <?php
    if (isset($_POST['upload'])) {
        // Count total files
        $countFiles = count($_FILES['files']['name']);

        // Loop through each file
        for ($i = 0; $i < $countFiles; $i++) {
            if ($_FILES['files']['error'][$i] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['files']['tmp_name'][$i];
                $fileName = $_FILES['files']['name'][$i];
                $fileSize = $_FILES['files']['size'][$i];
                $fileType = $_FILES['files']['type'][$i];

                // Specify the directory where you want to save the uploaded files
                $uploadDir = '';

                // You can generate a unique file name to prevent overwriting existing files
                $uniqueFileName = $fileName;

                // Construct the final path for the file
                $uploadPath = $uploadDir . $uniqueFileName;

                // Move the uploaded file to the desired destination
                if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                    echo "File {$fileName} uploaded successfully.<br>";
                } else {
                    echo "Error uploading {$fileName}.<br>";
                }
            } else {
                echo "Error uploading file. Error code: {$_FILES['files']['error'][$i]}<br>";
            }
        }
    }
    ?>
</body>
</html>
