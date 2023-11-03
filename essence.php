<?php
    class PrixEssence
    {
        /*
        Some other stuff
        */
        
        public function persist(\DateTimeInterface $now, callable $persister)
        {
            $this->updatedAt = $now;

            $persister((array) $this);
        }
    }

    class PrixEssenceRepository
    {
        public function __construct(
            private \DateTimeInterface $now,
            private $driver
        ){}

        public function save(PrixEssence $prixEssence)
        {
            $driver = $this->driver;

            $prixEssence->persist(
                $this->now,
                function ($data) use ($driver) {
                    $driver->doSave($data);
                }
            );
        }
    }


    class Database
    {
        public function doSave(string $sqlQuery, \PDO $connexion)
        {
            $stmt = $connexion->createStatement($sqlQuery);
            $stmt->execute();
        }
    }

    //Créer un adapteur entre PrixEssenceRepository et Database
    class DatabaseAdapter
    {
        private Database $database;
        private PrixEssenceRepository $per;
    
        public function __construct(
            Database $database,
            PrixEssenceRepository $per
        ){
            $this->database = $database;
            $this->per      = $per;
        }
    
        public function doSave($sqlQuery = "", \PDO $connexion = NULL)
        {
            //Query ...    
            $sqlQuery = "INSERT INTO mytable (type_carburant) VALUES (:GPL, :GPL2)";
            //$this->per
    
            // Exécutez la requête en utilisant la classe Database
            $this->database->doSave($sqlQuery, $connexion);
        }
    }
    


?>