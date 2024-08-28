<?php
class Questions
{
    private $connection;
    //Definimos la matriz para las preguntas.
    private $questions = [];

    public function __construct($connection, $questions = [])
    {
        $this->connection = $connection;
        $this->questions = $questions;
    }

    //Función de actualizar preguntas.
    public function updateQuestions()
    {
        //Para cada pregunta que tengamos dentro de la matriz hacemos un update a la base de datos (si se modifica).
        foreach ($this->questions as $id => $question) {

            //Consulta para la actualización.
            $stmt = $this->connection->prepare("UPDATE questions SET question = ? WHERE question_id = ?");
            $stmt->bind_param("si", $question, $id);
            $stmt->execute();
            $stmt->close();
        }
        //Cuando se realiza la actualización de preguntas le manda una alerta al admin que se hizo dicha actualización.
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

    //Función para obtener preguntas.
    public function getQuestions()
    {
        //Consulta en la base de datos para obtener todas las preguntas de la tabla questions.
        $result = $this->connection->query("
        SELECT * FROM questions;
        ");

        //Definimos un array donde almacenaremos las preguntas.
        $questionData = array();

        if ($result->num_rows > 0) {

            //Iteramos sobre cada resultado de la consulta.
            while ($questionData = $result->fetch_assoc()){

                //Almacenamos cada pregunta dentro de la matriz.
                $questionArray[] = $questionData;
            }

            $questionData = $result->fetch_assoc();
        }
        return $questionArray;
        
    }


}

