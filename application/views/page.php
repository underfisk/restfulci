<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>RestfulCI</title>
  <link rel="icon" type="image/png" href="https://codeigniter.com/assets/images/ci-icon.png">
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <style>
.codebox {
        border:1px solid black;
        white-space: pre-line;
        padding:10px;
        font-size:0.9em;
        display: inline-block;
        margin: auto;
        
}
    .codebox code {
        /* Styles in here affect the text of the codebox */
        font-size:0.9em;
        /* You could also put all sorts of styling here, like different font, color, underline, etc. for the code. */
    }
  </style>
</head>
<body>
  <nav class="black"  role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">
      <img src="https://codeigniter.com/assets/images/ci-logo-white.png"/> RestfulCI
    </a>
      <ul class="right hide-on-med-and-down">
        <li><a target="_blank" href="https://github.com/underfisk/restfulci">Github</a></li>
        <li><a target="_blank" href="https://codeigniter.com/user_guide/">CI Docs</a></li>
      </ul>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <div class="row center">
        <h5 class="header col s12 light">A boilerplate for your Restful API without changing you're CI core</h5>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-dark-text"><i class="material-icons">code</i></h2>
            <h5 class="center">Easy integration</h5>

            <p class="light">
              We did most of the heavy lifting for you to provide a solid interface where you can provide informaion safely without exposing sensive data.
              Behind the scenes, we simply extend from CodeIgniter core and adapt it to be near of a Restful framework.
            </p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-green-text"><i class="material-icons">polymer</i></h2>
            <h5 class="center">Content Type Support</h5>

            <p class="light">
              This boilerplate support's <i>JSON, XML and Text</i> which automaticly are cared of in Runtime. A good thing is that when you send a response, we automaticly convert your
              data to a desired format or it simply verifies the format and outputs it with the correct headers.
            </p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-black-text"><i class="material-icons">trending_up</i></h2>
            <h5 class="center">Open Source</h5>

            <p class="light">
              The source code is published on my github, and you are free to extend and contribute if you wish under MIT License.
            </p>
          </div>
        </div>
      </div>

    </div>
    <br><br>

        <div class="col s12 m4">
          <div class="icon-block">
            <h5 class="center">How does controllers works?</h5>

            <p class="light">
              Create a new controller normally but instead of extend from CI_Controller you'll extend from REST_Controller.
              The difference between both if that if you extend only from CI_Controller, our boilerplate configurations and protections are
              not going to be applied
              </p>
              <center><code class="codebox">
                class YourController extends REST_Controller
                {
                function __construct(){
                    parent::__construct(); //make sure you call our contructor
                  }
                }  
              </code></center>

              <br><br>
          </div>
              </div>
              <div class="col s12 m4">
          <div class="icon-block">
            <h5 class="center">Where is the configuration file?</h5>

            <p class="light">
              You can find the configuration file at <i>applications/config/restful_config.php</i> but we support multiple config files
              meaning that you can have one for production and another for development (If you have multiple you have to specify
              in the constructor of your controller the name of the config file)
              </p>
              <center><code class="codebox">
                  parent::__construct('file_name')
              </code></center>

              <br><br>
          </div>
              </div>
              <div class="col s12 m4">
          <div class="icon-block">
            <h5 class="center">Response Verbose</h5>

            <p class="light">
                If you have php intellisense, our functions are very well documentated but you can simply
                go on <i> application/helpers/rest_helper.php</i> and see that we have alot of methods usefull for
                a http response.
                (I do not recommend using directly render without making sure the format is right so use Ok, InternalServerError or Forbidden instead)
              </p>

              <br><br>
          </div>
              </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h5 class="center">Restful Routing</h5>

            <p class="light">
                CodeIgniter does this dirty work for you, if you simply want to specify the HTTP Request Method to a route you can simply
                go on routes and do like this
              </p>
              <center><code class="codebox">
                  //no args
                  $route['whatever']['PUT'] = 'controllername/functioname';
                  //with args as get
                  $route['whatever/(:any)']['GET'] = 'controllername/functioname/$1';
                  //like an entity
                  $route['entiny/(:num)/resource/(:any)']['GET'] = 'controllersname/functionname/$1/$2';
              </code></center>

              <br><br>
          </div>
              </div>
  </div>
  

  <footer class="page-footer red">
    <div class="footer-copyright">
      <div class="container">
      <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
 <!-- Compiled and minified JavaScript -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

  </body>
</html>
