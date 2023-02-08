<?php
class MovieModel{
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
        try {
            //Consulta SQL
            $vSQL="SELECT * FROM movie where id=$id;";
            //Establecer conexión
            $this->enlace->connect();
            //Ejecutar la consulta
            $vResultado=$this->enlace->executeSQL($vSQL);
            
            $response = $vResultado[0];
            $generoM = new GenreModel();
            //Obtener la lista de generos de la pelicula
            $rGeneros = $generoM->getGenreMovie($id);
            //Propiedad que se va a agregar al objeto
            $vResultado->genres = $rGeneros;

            $actor = new ActorModel();
            //Obtener la lista de generos de la pelicula
            $rActor = $actor->getActorMovie($id);
            //Propiedad que se va a agregar al objeto
            $vResultado->actors = $rActor;
            //$response[0]->genres=$rGeneros;
            //Retornar el resultado
            return $vResultado;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*Crear */
    public function update($objeto){
        try {
            $this->enlace->connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*Actualizar */
    public function create($objeto){
        try {
            $this->enlace->connect();
            $sql = "INSERT INTO movie (title,year,time,lang) VALUES ('$objeto->title',$objeto->year,$objeto->time,'$objeto->lang');";
            
            //obtiene el ultimo registro
            $idmovie=$this->enlace->executeSQL_DML_last($sql);
            //cierra la conexion
            //generos
            //Crear lo elementos a insertar
            foreach($objeto->genres as $actor){
                $dataGenres[]=array($idmovie, $actor[0], "$actor[1]");
            }

            //insertar
            foreach($dataGenres as $row){
                $this->enlace->connect();
                //$values = implode(",",$row);
                //$sqlinsert = "INSERT INTO movie_genre(movie_id,genre_id) VALUES($values);";
                $sqlinsert = "INSERT INTO movie_cast(movie_id,genre_id) VALUES($row[0]$row[1],"$row[2]");";
                //executeSQL_DML_last retorna lo que se envio
                $resultado=$this->enlace->executeSQL_DML_last($sqlinsert);
            }
            return $this->get($idmovie);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // obtener las peliculas que pertenecen al id de genero del parametro indicado
    public function getByGenre($id)
    {
        # code...
        try {
            $vSql = "SELECT mm.id, mm.title, mm.year, mm.time, mm.lang FROM moviedb.movie mm inner join movie_genre mg on mg.genre_id = $id;";
            $this->enlace->connect();
            $vResultado=$this->enlace->executeSQL($vSql);
            //Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}