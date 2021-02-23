<?php
class logger {
    private $depot;
    private $ready;

    const GRAN_VOID = 'VOID';
    const GRAN_MONTH = 'MONTH';
    const GRAN_YEAR = 'YEAR';

    public function __construct($path) {
        $this->ready = false;
        if ( !is_dir($path) ) {
            trigger_error( "Le chemin " . $path . " n'existe pas", E_USER_WARNING);
            return false;
        }

        $this->depot = realpath( $path );
        $this->ready = true;
        return true;
    }

    public function path( $type, $name, $granularity = self::GRAN_YEAR) {
        if ( !$this->ready ) {
            trigger_error( "Logger n'est pas prêt", E_USER_WARNING);
            return false;
        }
        if ( !isset($type) || empty($name) ) {
            trigger_error("Paramètres incorrects", E_USER_WARNING);
            return false;
        }
        if ( empty($type) ) {
            $type_path = $this->depot . '/';
        } else {
            $type_path = $this->depot . '/' . $type . '/';
            if ( !is_dir($type_path) ) {
                mkdir($type_path);
            }
        }
        if ( $granularity == self::GRAN_VOID ) {
            $logfile = $type_path . $name . '.log';
        } elseif ( $granularity == self::GRAN_MONTH ) {
            $mois_courant = date('Ym');
            $type_path_mois = $type_path . $mois_courant;
            if ( !is_dir($type_path_mois) ) {
                mkdir($type_path_mois);
            }
            $logfile = $type_path_mois . '/' . $mois_courant . '_' . $name . '.log';
        } elseif ( $granularity == self::GRAN_YEAR ) {
            $current_year = date('Y');
            $type_path_year = $type_path . $current_year;
            if ( !is_dir($type_path_year) ) {
                mkdir($type_path_year);
            }
            $logfile = $type_path_year . '/' . $current_year . '_' . $name . '.log';
        } else {
            trigger_error("Granularité" . $granularity . "non pris en charge", E_USER_WARNING);
            return false;
        }
        return $logfile;
    }

    public function log( $type, $name, $row, $granularity = self::GRAN_YEAR ) {
        if ( !isset($type) || empty($name) ||empty($row) ) {
            trigger_error( "Paramètres incorrects", E_USER_WARNING);
            return false;
        }
        $logfile = $this->path( $type, $name, $granularity);
        if ( $logfile === false ) {
            trigger_error( "Impossible d'enregistrer le log", E_USER_WARNING);
            return false;
        }
        $row = date('d/m/Y H:i:s') . ' ' . $row;
        if ( !preg_match('#/n$#', $row) ) {
            $row .= "\n";
        }

        $this->write($logfile, $row);
    }

    private function write($logfile, $row) {
        if ( !$this->ready ) {
            return false;
        }
        if ( empty($logfile) ) {
            trigger_error( $logfile . " est vide", E_USER_WARNING);
            return false;
        }
        $fichier = fopen( $logfile, 'a+' );
        fputs( $fichier, $row );
        fclose( $fichier );
    }
}

?>