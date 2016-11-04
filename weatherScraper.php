<?php

   $displayWeather ="";
   $city = "";
   $error="";

  if(array_key_exists('city', $_GET)){

       // if (strstr($_GET["city"],' ')) {                      //......strstr Check the white space ...////
      $city =str_replace(' ','',$_GET["city"]);    //........str_replace the white space ... //
     //}

     
      $file_headers = @get_headers('http://www.weather-forecast.com/locations/'.$city.'/forecasts/latest');
      if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $error = "City could be found..";
      }
      else {
       

      $foreCastPage = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");



      $firstPage = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">',$foreCastPage);

        if(sizeof($firstPage) > 1){

              $secoundPage = explode('</span></span></span>',$firstPage[1]);

                      if(sizeof($secoundPage) > 1){

                         $displayWeather = $secoundPage[0];

                      }else{

                        $error = "City could be found..";
                      }

                 }else{

                       $error = "City colud be found..";
             }

      }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <style type="text/css">
      
                html,body {
                    background: url(background.jpg) no-repeat center center fixed;
                    -webkit-background-size: cover; /* For WebKit*/
                    -moz-background-size: cover;    /* Mozilla*/
                    -o-background-size: cover;      /* Opera*/
                    background-size: cover;         /* Generic*/
                }

                .container{
                  text-align: center;
                  margin-top:80px;
                  width: 450px;
                }

                #weatherDetail {
                  margin-top: 20px;
                }

    </style>

  </head>
  <body>
    

      <div class="container">
        <h1>What's the weather ?</h1>
        <form>
           
            <div class="form-group">
              <label for="exampleInputEmail1">Enter the name of city</label>
              <input type="text" class="form-control" id="weather" aria-describedby="weatherHelp" placeholder="City" name="city"        value= "<?php  if(array_key_exists('city', $_GET)){

                                       echo $_GET['city'] ;
                               }
                                  
                                   ?> ">
              <small id="weatherHelp" class="form-text text-muted">Example : London ,Paris....</small>
            </div>
             <button type="submit" class="btn btn-primary">Submit</button>

            
           <div id ="weatherDetail">
            
              <?php 

                     if($displayWeather){

                          echo '<div  class="alert alert-success" role="alert">'.$displayWeather.'</div>'; 
                          
                      }else if($error) {

                          echo '<div  class="alert alert-danger" role="alert">'.$error.'</div>';
                        }
                  
              ?>   

            </div> 


            
       </form>
     </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
  </body>
</html>