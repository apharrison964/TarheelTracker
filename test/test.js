var url_base = "http://wwwp.cs.unc.edu/Courses/comp426-f15/users/apharri3/Codiad/workspace/final/serverSide";
//////////In Test Mode//////////

$(document).ready(function () {
    /*var url = window.location.protocol + "://" + window.location.host + "/" + window.location.pathname;*/
    $( '#submit' ).click(function(e) {
        var type = $('#methodselect option:selected').val();

        var pid = "";
        if ($('#playerID').val()) {
            pid = "/" + $('#playerID').val();
        }

        var data = $('#restform').serialize();

        $.ajax(
            url_base + "/PlayerRun.php" + pid,
            {
                type: type,
                datatype: "json",
                data: data,
                success: function(msg, status, jqXHR) {
                    alert(msg['firstName']);
                    $('#table').css('firstName', 'url(\'' + msg['firstName'] + '\')');
                },
                error: function(jqXHR, status, error) {
                    alert(jqXHR.responseText);
                }
            }
        );
    });
