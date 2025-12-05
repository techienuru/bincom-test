// Render States
loadAjax("./process/get_states.php", function (xhttp) {
  document.querySelector("#state").innerHTML = xhttp.responseText;
});

function loadAjax(url, cFunction) {
  const xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };

  xhttp.open("GET", url, true);
  xhttp.send();
}

function renderLGA() {
  const stateSelectElem = document.querySelector("#state");
  const lgaBox = document.querySelector("#lga");

  if (stateSelectElem.value === "")
    return (lgaBox.innerHTML =
      "<option value=''>Please select a state</option>");

  const stateId = stateSelectElem.value;
  const url = `./process/get_lga_by_states.php?state_id=${stateId}`;

  loadAjax(url, function (xhttp) {
    lgaBox.innerHTML = xhttp.responseText;
  });
}
// If state is changed, render LGA
document.querySelector("#state").addEventListener("change", renderLGA);

function renderWard() {
  const lgaSelectElem = document.querySelector("#lga");
  const wardBox = document.querySelector("#ward");

  if (lgaSelectElem.value === "")
    return (wardBox.innerHTML =
      "<option value=''>Please select a LGA</option>");

  const lgaId = lgaSelectElem.value;
  const url = `./process/get_ward_by_lga.php?lga_id=${lgaId}`;

  loadAjax(url, function (xhttp) {
    wardBox.innerHTML = xhttp.responseText;
  });
}
// If LGA is changed, render Ward
document.querySelector("#lga").addEventListener("change", renderWard);

// Render Polling Unit
function renderPU() {
  const wardSelectElem = document.querySelector("#ward");
  const puBox = document.querySelector("#pu");

  //   If user changes the select option back to the first one
  if (wardSelectElem.value === "")
    return (puBox.innerHTML = "<option value=''>Please select a Ward</option>");

  const wardId = wardSelectElem.value;
  const url = `./process/get_p_u_by_ward.php?ward_id=${wardId}`;

  loadAjax(url, function (xhttp) {
    puBox.innerHTML = xhttp.responseText;
  });
}
// If ward is changed, render Polling Unit
document.querySelector("#ward").addEventListener("change", renderPU);

// Render Party
loadAjax("./process/get_party.php", function (xhttp) {
  document.querySelector("#party").innerHTML = xhttp.responseText;
});
