<?php
// Classe du nouveau driver pour la sauvegarde au format JSON
    /**Créer un nouveau driver pour sauvegarder les données de l'objet PrixEssence dans un fichier
     * au format JSON sans modifier la clase PrixEssenceRepository. Le chemin du fichier à écrire 
     * devra pouvoir être paramétrable.
     * Tips : 	1/ utiliser json_encode()
     *          2/ utiliser file_put_contents()
     */

    class JsonPrixEssenceSave {
        private $filePath;

        public function __construct(
            $filePath
            ) {
            $this->filePath = $filePath;
        }

        public function doSave(PrixEssence $prixEssence) {
            $data = json_encode([
                'nom'   => $prixEssence->carburant_nom,
                'prix'  => $prixEssence->prix_nom
                /*.......*/
            ]);

            file_put_contents($this->filePath, $data);
        }
    }


    $prixEssence = new PrixEssence('Essence 95', 1.50);
    $filePath = '/file_essence.json'; 

    $jsonDriver = new JsonPrixEssenceSave($filePath);
    $jsonDriver->doSave($prixEssence);

?>