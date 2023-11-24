document.getElementById('absences').addEventListener('click', function() {
  window.location.href='/absences'
});

function filter(text){
  window.location.href = `/absences/filter/${text}`
}
