<?php

class Database
{

    const SELECTSINGLE = 1;
    const SELECTALL = 2;
    const EXECUTE = 3;

    private $pdo;

    public function __construct()
    {

        $this->pdo = new PDO("mysql:host=sql302.epizy.com;dbname=epiz_32207441_XXX", "epiz_32207441", "NEYjZhD27cTbu");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    //Add queryDB() here
    public function queryDB($sql, $mode, $values = array())
    {

        $stmt = $this->pdo->prepare($sql);

        foreach ($values as $valueToBind) {
            $stmt->bindValue($valueToBind[0], $valueToBind[1]);
        }

        $stmt->execute();

        if ($mode != Database::SELECTSINGLE && $mode != Database::SELECTALL && $mode != Database::EXECUTE) {
            throw new Exception('Invalid Mode');
        } else if ($mode == Database::SELECTSINGLE) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else if ($mode == Database::SELECTALL) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
