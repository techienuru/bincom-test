loadAjax("./process/get_states.php", renderStates);
loadAjax("./process/get_lga_by_states.php", renderLGA);

function loadAjax(url, cFunction, paramQuery) {
  const xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };

  xhttp.open("GET", url, true);
  xhttp.send();
}

function renderStates(xhttp) {
  document.querySelector("#state").innerHTML = xhttp.responseText;
}

function renderLGA(xhttp) {
  const selectedState = document.querySelector("");
  const lgaBox = document.querySelector("#lga");

  if (selectedState.value === "")
    return (lgaBox.innerHTML =
      "<option value=''>Please select a state</option>");

  lgaBox.innerHTML = xhttp.responseText;
}

document.querySelector("#state").addEventListener("change", renderLGA);
