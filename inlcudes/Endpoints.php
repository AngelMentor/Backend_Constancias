<?php 
class Endpoints{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function ObtenerUsuarios(){
        $sql = "SELECT 
        user_id,
        CONCAT(MAX(CASE WHEN meta_key = 'first_name' THEN meta_value END) , ' ',
        MAX(CASE WHEN meta_key = 'last_name' THEN meta_value END)) AS Nombre
        
    FROM 
        xniklfg_usermeta
    GROUP BY 
        user_id;
    ";
        $result = $this->conn->query($sql);

        $usuarios = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }
        return $usuarios;
    }

    }

?>