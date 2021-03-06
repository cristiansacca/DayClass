<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

function backup_tables($host, $user, $pass, $name, $tables = '*')
{
   $return = '';
   $link = new mysqli($host, $user, $pass, $name);
   // mysql_select_db($name,$link);

   //get all of the tables
   if ($tables == '*') {
      $tables = array();
      $result = $link->query('SHOW TABLES');
      while ($row = mysqli_fetch_row($result)) {
         $tables[] = $row[0];
      }
   } else {
      $tables = is_array($tables) ? $tables : explode(',', $tables);
   }

   //cycle through
   foreach ($tables as $table) {
      $result = $link->query('SELECT * FROM ' . $table);
      $num_fields = mysqli_num_fields($result);


      //$return.= 'DROP TABLE '.$table.';';
      $row2 = mysqli_fetch_row($link->query('SHOW CREATE TABLE ' . $table));
      $return .= "\n\n" . $row2[1] . ";\n\n";

      for ($i = 0; $i < $num_fields; $i++) {
         while ($row = mysqli_fetch_row($result)) {
            $return .= 'INSERT INTO ' . $table . ' VALUES(';
            for ($j = 0; $j < $num_fields; $j++) {
               $row[$j] = addslashes($row[$j]);
               $row[$j] = preg_replace("/\n/", "\\n", $row[$j]);
               if ($row[$j] != "") {
                  $return .= '"' . $row[$j] . '"';
               } else {
                  $return .= 'NULL';
               }
               if ($j < ($num_fields - 1)) {
                  $return .= ',';
               }
            }
            $return .= ");\n";
         }
      }
      $return .= "\n\n\n";
   }
   $fecha = date("Y-m-d-His");
   //save file
   $handle = fopen('backupDB/db-dayclass-' . $fecha . '.sql', 'w+');
   fwrite($handle, $return);
   fclose($handle);
}

try {

   if (!isset($_GET['download'])) {
      $files = glob('backupDB/*'); //obtenemos todos los nombres de los ficheros

      foreach ($files as $file) {
         if (is_file($file))
            unlink($file); //elimino el fichero
      }

      echo backup_tables("localhost", "root", "", "dayclass");
      $fecha = date("Y-m-d-His");
      header("Content-disposition: attachment; filename = db-dayclass-" . $fecha . ".sql");
      header("Content-type: MIME");
      header("Location: \DayClass\Administrador\ConfiguracionSistema\BackupRecuperacion\backup.php?resultado=1");
   } else {
      $files = glob('backupDB/*');
      if (count($files) !== 0) {
         foreach ($files as $file) {
            if (is_file($file))
               header("Content-disposition: attachment; filename = $file");
            header("Content-type: MIME");
            readfile($file);
         }
      } else {
         header("Location: \DayClass\Administrador\ConfiguracionSistema\BackupRecuperacion\backup.php?resultado=0");
      }
   }
} catch (Exception $e) {
   header("Location: \DayClass\Administrador\ConfiguracionSistema\BackupRecuperacion\backup.php?resultado=2");
}

?>