<?php
//class Genre
class movie
{
    //Obtener en el API
    public function get($id)
    {
        //Obtener elemento
        $movie = new MovieModel();
        //Obtener una pelicula
        $response = $movie->get($id);

        //Si hay respuesta
        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }
    // obtener las peliculas que pertenecen al id de genero del parametro 
    // indicado
    public function getByGenre($id)
    {

        $movie = new MovieModel();

        $response = $movie->getByGenre($id);

        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }
    // crear un nuevo registro
    public function create()
    {

        $inputJSON =  file_get_contents("php://input");
        $obj = json_decode($inputJSON);
        $movie = new MovieModel();

        $response = $movie->create($obj);

        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }
}
