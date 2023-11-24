document.getElementById('absences').addEventListener('click', function() {
  window.location.href='/absences'
});

console.log("TEST");

function filter(text){
  window.location.href = `/absences/filter/${text}`
}
