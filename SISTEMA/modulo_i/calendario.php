<html>
        <head>
                <title>Calendario</title>
        </head>
        <link href="../style/ctc.css" rel="stylesheet" type="text/css">
        <script language="javascript" src="../scripts/calendario.js"></script>
        <body>
                <script>
                        if(!window.opener)window.opener=window.parent;
                        if(window.opener && window.opener.codethatcalendar)
                        {       document.write("<div class='clsBody'>")
                                window.opener.codethatcalendar.create(document);
                                document.write("</div>")
                        }
                </script>
        </body>
</html>
