 header("Content type: application/json");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Hey what's up, Hello?</title>
        <meta name="description" content="IDEK.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/core.css">
        <script src="http://www.cs.unc.edu/Courses/comp426-f14/jquery-1.11.1.js"></script>
        <script src="map.js"></script>
    </head>

    <body>
        <div id="top">
            <div id="title">Ballin</div>
        </div>

        <div id="container">
            <div id="table">
            </div>

            <div id="chat">
                <div id="rest">
                    <select id="methodselect" name="method">
                        <option value="GET">See player</option>
                        <option value="POST">Add/change player</option>
                        <option value="DELETE">Delete player</option>
                    </select>
                    <div id="parameters">
                        Player id: <input style="50em" type="text" name="bid" id="bid"><br>
                        <form id="restform" name="restform">
                            Background: <input style="50em" type="text" name="background"><br>
                            Width: <input style="50em" type="text" name="width"><br>
                            Length: <input style="50em" type="text" name="length"><br>
                        </form>
                    </div>
                    <div><button id="submit">Go</button></div>
                </div>
            </div>
        </div>
    </body>
</html>
www.cs.unc.edu
/*! * jQuery JavaScript Library v1.11.1 * http://jquery.com/ * * Includes Sizzle.js * http://sizzlejs.com/ * * Copyright 2005, 2014 jQuery Foundation, Inc. and other contributors * Released under the MIT license * http://jquery.org/license * * Date: 2014-05-01T17:42Z */ (function( global, factory )…
cs.unc.edu
Seen by Sarah Rust

