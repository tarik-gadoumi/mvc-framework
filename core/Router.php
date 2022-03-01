<?php

namespace app\core;
class Router extends Controller 
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request,Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {   //c'est  get qui va placer  mes path  et cb  dans $routes[];
        $this->routes['get'][$path] = $callback;
        // echo '<pre>';
        // echo var_dump($this->routes);
        // echo '</pre>';

    }
    public function post($path, $callback)
    {  
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        /**après  avoir mis  en place :
        1 la class Application qui : 
                A--appel[class Request ,class Router , class Request dans Router]
                B--met en place une variable static ($ROOT_DIR) accessiblie via l'opérateur
                   de résolution de portée(sera  utilisé dans le Router lorsque la cb est un string)
        2 la class Request qui :
                A-- met en place getPath et method
        3 la class Router qui :
                A--consome la class  Request
                B--met en place la Func get qui s'occupe de remplir la  tableau  $routes [['Method']=>[path=>Callback]]       
                C--met en place la Func Resolve qui :
                        -consome=>*getPath*method => pour récupérer la callback propre a chaque route+method (ça c'est fou !)
                        -verification(x3) =>
                                            1°si cb n'existe pas ,
                                            2°si cb et un string(ptin ici c est beau),
                                            3°si cb est une function
                        -petite note à propos de la verification n°2 :
                            si la cb est un string appel la func renderView($callback => considérer par la suite comme $view)
                            le but que la cb soit un string c est de pouvoir rediriger vers une page dans 
                            nom  sera $macallback.php =>sachant que macallback est une variablie
                            pourquoi donc tout ça ?
                             hihi là c'est cool: dit toi que parceque le header+footer  doit etre partager entre toutes les pages
                             on crée un file views/layouts/main.php -> ce main contiendra le header et le footer et  le body prend 
                             ici la valeur d'un string {{content}} qui  sera remplacé  dans le futur par soit views/contact.php 
                             soit view/home.php tout ceci  ce passe  dans la function renderView
                            la sexy function renderView => renderView($callback)
                                                        =>return str_replace(Avalue(aka oldValue),whithWat(aka newValue),where)
                            pas mal  de chose a dire sur l'implementation  de  renderViewOnly(whithWhat) et layoutContent(where)
                        
                        
        **/
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            Application::$app->response->setStatusCode(404);
              
            return $this->renderView("_404");

        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if(is_array($callback)){
            $callback[0]= new $callback[0]();
        }
        return call_user_func($callback,$this->request);

    }

    public function renderView($view,$params=[]) 
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view,$params);
        //include_once __DIR__ . "/../views/$view.php";
        return str_replace("{{content}}", $viewContent, $layoutContent);
        // include_once Application::$ROOT_DIR . "/views/$view.php";
    }

    // public function renderContent($viewContent) 
    // {
    //     $layoutContent = $this->layoutContent();
    //     return str_replace("{{content}}", $viewContent ,$layoutContent);
    // }
    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();

    }

    protected function renderOnlyView($view,$params)
    {
        foreach($params as  $key=>$value){
            $$key = $value ;
        }
        //var_dump($name);
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}