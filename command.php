<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Décompression et suppression de dossiers</title>
</head>
<body>

<h2>Décompresser un fichier ZIP</h2>
<form method="POST" action="">
<?php echo csrf_field(); ?>
    <label for="zipFile">Nom du fichier ZIP à décompresser :</label>
    <?php echo base_path('/'); ?>/<input type="text" id="zipFile" name="zipFile" placeholder="Ex : vendor.zip" required>
    <button type="submit" name="unzip">Décompresser</button>
</form>

<h2>Supprimer un dossier</h2>
<form method="POST" action="">
<?php echo csrf_field(); ?>
    <label for="folderToDelete">Nom du dossier à supprimer :</label>
    <?php echo base_path('/'); ?>/<input type="text" id="folderToDelete" name="folderToDelete" placeholder="Ex : vendor" required>
    <button type="submit" name="delete">Supprimer</button>
</form>

<?php
// Fonction pour décompresser le fichier ZIP
if (isset($_POST['unzip'])) {
    $zipFile = base_path($_POST['zipFile']);

    if (file_exists($zipFile)) {
        $zip = new ZipArchive;
        $res = $zip->open($zipFile);
        if ($res === TRUE) {
            $zip->extractTo(base_path('/'));
            $zip->close();
            echo "<p>Décompression réussie de $zipFile !</p>";
        } else {
            echo "<p>Échec de la décompression de $zipFile.</p>";
        }
    } else {
        echo "<p>Le fichier $zipFile n'existe pas.</p>";
    }
}

// Fonction pour supprimer un dossier
if (isset($_POST['delete'])) {
    $folderToDelete = base_path($_POST['folderToDelete']);

    // Fonction récursive pour supprimer un dossier et son contenu
    function deleteDirectory($dir) {
        if (!is_dir($dir)) return false;
        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item == '.' || $item == '..') continue;
            $path = $dir . '/' . $item;
            if (is_dir($path)) {
                deleteDirectory($path);
            } else {
                unlink($path);
            }
        }
        return rmdir($dir);
    }

    if (is_dir($folderToDelete)) {
        if (deleteDirectory($folderToDelete)) {
            echo "<p>Le dossier $folderToDelete a été supprimé avec succès !</p>";
        } else {
            echo "<p>Échec de la suppression du dossier $folderToDelete.</p>";
        }
    } else {
        echo "<p>Le dossier $folderToDelete n'existe pas.</p>";
    }
}
?>

</body>
</html>
