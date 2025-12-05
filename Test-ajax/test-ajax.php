<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <div id="demo">
        <h2>Let AJAX change this text</h2>
        <button type="button" onclick="loadDoc('text-ajax.txt',myFunction1)">Change Content</button>
    </div> -->
    <div>
        <input type="text" autofocus class="input-box">
        <p>
            Suggestion: <span class="search-result"></span>
        </p>

    </div>

    <script>
        // function loadDoc() {
        //     const xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function() {
        //         document.querySelector("button").innerText = "Loading";

        //         if (this.readyState == 4 && this.status == 200) {
        //             document.querySelector("#demo").innerHTML = this.responseText;
        //         } else if (this.readyState == 4 && this.statusText !== "OK") {
        //             document.querySelector("#demo").innerHTML = "Error fetching from the server";
        //         }

        //         document.querySelector("button").innerText = "Change Content";
        //     };

        //     xhttp.open("GET", "text-ajax.txt", true);
        //     xhttp.send();
        //     // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //     // xhttp.send("fname=Henry&lastname=Jacob");
        // }

        // loadDoc("test-ajax.txt", myFunction1);

        // function loadDoc(url, cfunction) {
        //     const xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function() {
        //         if (this.readyState == 4 && this.status == 200) {
        //             cfunction(this);
        //         }
        //     }

        //     xhttp.open("GET", url, true);
        //     xhttp.send();
        // }

        // const myFunction1 = function(xhttp) {
        //     console.log(xhttp);
        //     console.log(xhttp.getAllResponseHeaders());
        //     console.log(xhttp.status);

        // }
    </script>
    <script>
        document.querySelector(".input-box").addEventListener("keyup", function() {
            loadDoc(this.value, "process-test-ajax.php?q=" + this.value, renderSearch);
        });

        const loadDoc = function(searchTerm, url, cFunction) {
            // Check if input box is empty &
            // Prevents seaching
            if (searchTerm.length == 0) {
                document.querySelector(".input-box").innerHTML = "";
                return;
            } else {
                const xhttp = new XMLHttpRequest();

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        cFunction(this);
                    }
                }

                xhttp.open("GET", url, true);
                xhttp.send();
            }
        }

        const renderSearch = function(xhttp) {
            document.querySelector(".search-result").innerHTML = xhttp.responseText;
        }
    </script>
</body>

</html>