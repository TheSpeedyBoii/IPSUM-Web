<?php
class Questions
{
    private $connection;
    private $questions = [];

    public function __construct($connection, $questions = [])
    {
        $this->connection = $connection;
        $this->questions = $questions;
    }

    public function updateQuestions()
    {
        foreach ($this->questions as $id => $question) {
            $stmt = $this->connection->prepare("UPDATE questions SET question = ? WHERE question_id = ?");
            $stmt->bind_param("si", $question, $id);
            $stmt->execute();
            $stmt->close();
        }
        echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Preguntas actualizadas con éxito!',
                        text: 'Las preguntas fueron modificadas correctamente.',
                        confirmButtonColor: '#D63030',
                        confirmButtonText: 'OK',
                        timer: 6000
                    }).then(() => {
                        location.assign('../view/admin_panel.php');
                    });
                });
                </script>";
                exit();
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

