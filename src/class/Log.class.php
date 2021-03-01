<?php

echo '<div class="text-light">CHEMIN CLASS OK</div>';

class Log {

    private $folder; # Dossier où sont enregistrés les fichiers logs (ex: /Applications/MAMP/www/monsite/logs)
    private $ready; # Le Log est prêt quand le dossier de dépôt des logs existe
    
    # archivage des logs
    const FOLDER_ROOT  = 'VOID';  # Aucun archivage
    const FOLDER_MONTH = 'MONTH'; # Archivage mensuel
    const FOLDER_YEAR  = 'YEAR';  # Archivage annuel
    
    /**
     * Constructeur
     * Vérifie que le dossier dépôt éxiste
     *
     * $path Chemin vers le dossier de dépôt
    **/
    public function __construct($path){
        $this->ready = false;
        
        # Si le dépôt n'éxiste pas
        if( !is_dir($path) ){
            trigger_error( $path . " n'existe pas", E_USER_WARNING );
            return false;
        }
        
        $this->folder = realpath($path);
        $this->ready = true;
        
        return true;
    }
    
    /**
     * Retourne le chemin vers un fichier de log déterminé à partir des paramètres $type_message, $file_name et $subfolder.
	 * (ex: /Applications/MAMP/www/monsite/logs/erreurs/201202/201202_erreur_connexion.log)
     * Elle créé le chemin si il n'éxiste pas.
	 *
	 * $type_message Dossier dans lequel sera enregistré le fichier de log
     *  $file_name Nom du fichier de log
     *  $subfolder Granularité : FOLDER_ROOT, FOLDER_MONTH ou FOLDER_YEAR
	 *  Chemin vers le fichier de log
    **/
    public function path($type_message, $file_name, $subfolder = self::FOLDER_YEAR){
		# On vérifie que le Log est prêt (et donc que le dossier de dépôt existe
        if( !$this->ready ){
            trigger_error("Log n'est pas prêt", E_USER_WARNING);
            return false;
        }
		
		# Contrôle des arguments
        if( !isset($type_message) || empty($file_name) ){
            trigger_error("Paramètres incorrects", E_USER_WARNING);
            return false;
        }
        
        # Création dossier du type (ex: /Applications/MAMP/www/monsite/logs/erreurs/)
        if( empty($type_message) ){
            $type_path_message = $this->folder.'/';
        } else {
            $type_path_message = $this->folder.'/'.$type_message.'/';
            if( !is_dir($type_path_message) ){
                mkdir($type_path_message);
            }
        }
        
        # Création du dossier granularity (ex: /Applications/MAMP/www/monsite/logs/erreurs/201202/)
        if( $subfolder == self::FOLDER_ROOT ){
            $log_file = $type_path_message.$file_name.'.log';
        }
        elseif( $subfolder == self::FOLDER_MONTH ){
            $month    = date('Ym');
            $folder_month    = $type_path_message.$month;
            if( !is_dir($folder_month) ){
                mkdir($folder_month);
            }
            $log_file = $folder_month.'/'.$month.'_'.$file_name.'.log';
        }
        elseif( $subfolder == self::FOLDER_YEAR ){
            $year    = date('Y');
            $folder_year    = $type_path_message.$year;
            if( !is_dir($folder_year) ){
                mkdir($folder_year);
            }
            $log_file = $folder_year.'/'.$year.'_'.$file_name.'.log';
        }
        else{
            trigger_error("Granularité '$subfolder' non prise en charge", E_USER_WARNING);
            return false;
        }
        
        return $log_file;
    }
    
    /**
	 * Enregistre $message dans le fichier log déterminé à partir des paramètres $type_message, $file_name et $subfolder
     *
     *  $type_message Dossier dans lequel sera enregistré le fichier de log
     *  $file_name Nom du fichier de log
     *  $message Texte à ajouter au fichier de log
     *  $subfolder Granularité : FOLDER_ROOT, FOLDER_MONTH ou FOLDER_YEAR
    **/
    public function log($type_message, $file_name, $message, $subfolder = self::FOLDER_YEAR){
		# Contrôle des arguments
        if( !isset($type_message) || empty($file_name) || empty($message) ){
            trigger_error("Paramètres incorrects", E_USER_WARNING);
            return false;
        }
        
        $log_file = $this->path($type_message, $file_name, $subfolder);
		
		if( $log_file === false ){
			trigger_error("Impossible d'enregistrer le log", E_USER_WARNING);
			return false;
		}
        
		# Ajout de la date et de l'heure au début de la ligne
        $message = date('d/m/Y H:i:s').' '.$message;
		
		# Ajout du retour chariot de fin de ligne si il n'y en a pas
		if( !preg_match('#\n$#',$message) ){
			$message .= "\n";
		}
        
        $this->write($log_file, $message);
    }
    
    /**
     * Écrit (append) $message dans $log_file
     *
     *  $log_file Chemin vers le fichier de log
     *  $message Chaîne de caractères à ajouter au fichier
    **/
    private function write($log_file, $message){
        if( !$this->ready ){return false;}
        
        if( empty($log_file) ){
            trigger_error("<code>$log_file</code> est vide", E_USER_WARNING);
            return false;
        }
        
        $file = fopen($log_file,'a+');
        fputs($file, $message);
        fclose($file);
    }

}
?>