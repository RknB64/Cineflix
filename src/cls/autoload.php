<?php

function autoloadFunction(String $className): void
{
  // Liste des dossiers dans src où chercher la classe (pas besoin de chercher dans static, vue...)
  $directories = ["cls", "modele", "controleur"];

  foreach ($directories as $dir) {

    $path = RACINE . DIRECTORY_SEPARATOR . $dir;

    // cherche la classe dans le dossier et sous-dossier
    $file = searchDir($path, $className);

    // charge la classe si trouvé
    if ($file) {
      require_once $file;
    }
  }
}

// cherche récursivement une classe dans un dossier et ses sous-dossier
function searchDir(string $dir, string $className): ?string
{
    $file = $dir . DIRECTORY_SEPARATOR . $className . '.php';

    if (file_exists($file)) {
        return $file;
    }

    $subDirs = glob($dir . '/*', GLOB_ONLYDIR);

    foreach ($subDirs as $sDir) {

        $foundFile = searchDir($sDir, $className);

        if ($foundFile) {
            return $foundFile;
        }
    }

    return null;
}

spl_autoload_register("autoloadFunction");
