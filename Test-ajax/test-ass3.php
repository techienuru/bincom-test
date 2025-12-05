<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <div>
            <label for="party">Party: </label>
            <select name="party" id="party">
                <!-- Appears dynamically from AJAX -->
            </select>
        </div>
    </main>
    <script>
        function loadAjax(url, cFunction) {
            const xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    cFunction(this);
                }
            }

            xhttp.open("GET", url, true);
            xhttp.send();
        }

        const renderParties = function(xhttp) {
            document.querySelector("#party").innerHTML = xhttp.responseText;
        }

        loadAjax("get_parties.php", renderParties);
    </script>
</body>

</html>