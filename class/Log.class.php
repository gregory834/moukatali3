<?php

echo '<div class="text-light">CHEMIN CLASS OK</div>';

class log {

    private $folder;
    private $ready;

    const FOLDER_ROOT = 'ROOT';
    const FOLDER_MONTH = 'MONTH';
    const FOLDER_YEAR = 'YEAR';

    public function __construct( $path ) {

        $this->ready = false;

        if ( !is_dir($path) ) {
            trigger_error( `Le dossier ` . $path . ` n'esxiste pas`, E_USER_WARNING);
            return false;
        }

        $this->folder = realpath($path);
        $this->ready = true;

        return true;
    }

    public function path( $type_error, $file_name, $subfolder = self::FOLDER_YEAR ) {

        if ( $this->ready === false ) {
            /*trigger_error( `L'objet n'est pas prêt`, E_USER_WARNING);*/
            return false;
        }

        if ( !isset($type_error) || !isset($file_name) ) {
            trigger_error( `Paramètres incorrects`, E_USER_WARNING);
            return false;
        }

        if ( empty($type_error) ) {
            $type_path_error = $this->folder . '/';
        } else {
            $type_path_error = $this->folder . '/' . $type_error . '/';
            if ( !is_dir($type_path_error) ) {
                mkdir( $type_path_error );
            }
        }

        switch( $subfolder ) {
            case 'ROOT':
                $log_file = $type_path_error . $file_name . '.log';
                return $log_file;
                break;
            case 'MONTH':
                $month = date('Ym');
                $folder_month = $type_path_error . $month;
                if ( !is_dir($folder_month) ) {
                    mkdir( $folder_month );
                }
                $log_file = $folder_month . '/' . $month . '_' . $file_name . '.log';
                return $log_file;
                break;
            case 'YEAR':
                $year = date('Y');
                $folder_year = $type_path_error . $year;
                if ( !is_dir($folder_year) ) {
                    mkdir( $folder_year );
                }
                $log_file = $folder_year . '/' . $year . '_' . $file_name . '.log';
                return $log_file;
                break;
            default:
                trigger_error( $subfolder . `n'est pas pris en charge`, E_USER_WARNING);
                return false;
        }

    }

    public function log( $type_error, $file_name, $message, $subfolder = self::FOLDER_YEAR ) {

        if ( !isset($type_error) || empty($file_name) || empty($message) ) {
            trigger_error ( 'Paramètres incorrects', E_USER_WARNING);
            return false;
        }

        $log_file = $this->path( $type_error, $file_name, $subfolder );

        if ( $log_file = false ) {
            trigger_error( `Impossible d'enregistrer le log`, E_USER_WARNING);
            return false;
        }

        $message = date('d/m/y H:i:s') . ' ' . $message;

        /*if ( !preg_match('#/n$#', $message) ) {
            $message .= '\n';
        }*/

        $this->write( $log_file, $message);

    }

    private function write($log_file, $message ) {

        if ( $this->ready = false ) {
            return false;
        }

        if ( empty($log_file) ) {
            trigger_error( $log_file . ' est vide', E_USER_WARNING);
            return false;
        }

        $file = fopen( $logfile, 'a+');
        fputs( $file, $message );
        fclose( $file );
    }
}

?>