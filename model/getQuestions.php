<?php
class Questions
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getQuestions()
    {
        $result = $this->connection->query("
        SELECT * FROM questions;
        ");

        $questionData = array();

        if ($result->num_rows > 0) {
            while ($questionData = $result->fetch_assoc()){
                $questionArray[] = $questionData;
            }
            $questionData = $result->fetch_assoc();
        }
        return $questionArray;
        
    }

}

