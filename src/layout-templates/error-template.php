<!doctype html>

<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!-- title injected by \SlimMvcTools\HtmlErrorRenderer->renderHtmlBody(string $title = '', string $html = '') -->
        <title>Da Numba 1 Movie Catalog App &ndash; {{{TITLE}}}</title>
        
        <style>
            .container {
                width: 98%;
            }
        </style>
    </head>
    
    <body>
        
        <div class="navbar-fixed">
                        
            <nav>
                <div class="nav-wrapper">
                    
                    <a href="#" class="brand-logo">
                        Da Numba 1 Movie Catalog App
                    </a>
                    
                </div>
            </nav>
            
        </div> <!-- <div class="navbar-fixed"> -->
        
        <div class="container">

            <div class="row" style="margin-top: 1em;">
                <div class="s12">
                    <!-- title injected by \SlimMvcTools\HtmlErrorRenderer->renderHtmlBody(string $title = '', string $html = '') -->
                    <h1>{{{ERROR_HEADING}}}</h1>
                </div>
            </div>

            <div class="row" style="margin-top: 1em;">
                <div class="s12">
                    <a href="#" onclick="window.history.go(-1)">Go Back</a>
                    <br>
                    <!-- error message body injected by \SlimMvcTools\HtmlErrorRenderer->renderHtmlBody(string $title = '', string $html = '') -->
                    <div>{{{ERROR_DETAILS}}}</div>
                </div>
            </div>

            <div class="s12">
                <footer>
                    <hr/>
                    <p>Copyright &copy; <span id="year"></span>. Da Numba 1 Movie Catalog App.</p>
                </footer>
            </div>
            
        </div>

        <!--JavaScript at end of body for optimized loading-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
        <script>
            document.getElementById("year").innerHTML = new Date().getFullYear();
        </script>
        
    </body>
</html>
