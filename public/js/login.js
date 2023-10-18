document.querySelector("#loginForm").onsubmit = function() {
  console.log("evento tomado");

  window.location.replace("/absences");

  return false;
}
