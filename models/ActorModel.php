<?php
class ActorModel{
    public $enlace;
    public function __construct()
    {
        $this->enlace=new MySqlConnect();
    }
    /*Listar */
    public function all(){

    }
    /*Obtener */
    public function get($id){
        
    }
    /*Obtener los actores de una pelicula */
    public function getActorMovie($idMovie){
        try {
            //Consulta SQL
            $vSQL="SELECT * FROM actor g, movie_cast mg where g.id=mg.actor_id and mg.movie_id=$idMovie;";
            //Establecer conexión
            $this->enlace->connect();
            //Ejecutar la consulta
            $vResultado=$this->enlace->executeSQL($vSQL);
            //Retornar el resultado
            return $vResultado;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*Crear */
    public function create($objeto){
        
    }
    /*Actualizar */
    public function update($objeto){
        
    }
}