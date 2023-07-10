<?php

use App\Libraries\FileFolder;

function createZip(&$zipArchive, &$file_folder, $path)
{

   $type = $file_folder->getField("type");
   if ($type == "FILE") {
      $stream = $file_folder->storage->readStream();
      if (is_resource($stream)) {
         $file_contents = stream_get_contents($stream);
         fclose($stream);
         $zipArchive->addFromString($path . $file_folder->getField("name"), $file_contents);
      }
   } else {
      $folder_name = $file_folder->getField("name");
      $zipArchive->addEmptyDir($path . $folder_name);
      //grab the direct chidren of this folder
      $children = $file_folder->getChildren();
      $new_path = $path . $folder_name . '/';
      foreach ($children as $child) {
         $new_file_folder = new FileFolder($child["id"]);
         if ($new_file_folder->getLastError()) {
            continue;
        }
         createZip($zipArchive, $new_file_folder, $new_path);
      }
   }
}
