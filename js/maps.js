 function zoeknu(page){
    var inputpostcode = document.getElementById('query').value;
// console.log(inputpostcode);
    var data_file = 'https:api.tomtom.com/search/2/geocode/'+ inputpostcode +'.json?countrySet=NL&key=UmIr4J6GcPaKCeFWVgvyC0mF8Ga81ikV';
    // console.log(data_file);

    fetch(data_file)
  .then(
    function(response) {
      if (response.status !== 200) {
        console.log('Looks like there was a problem. Status Code: ' +
          response.status);
        return;
      }
      response.json().then(function(data) {
        if(page == 'index'){
            index(data);
        }else{
            signin(data);
        }
        

      });
    }
  )
  .catch(function(err) {
    console.log('Fetch Error :-S', err);
  });
  function signin(data){
    var lats = document.getElementById("lats").value = data.results[0].position.lat;
    var lons = document.getElementById("lons").value = data.results[0].position.lon;
            console.log(data.results[0].position.lat);
            console.log(data.results[0].position.lon);
}
  function index(data){
    var lat = document.getElementById("lat").innerHTML = data.results[0].position.lat;
    var lon = document.getElementById("lon").innerHTML = data.results[0].position.lon;
            console.log(data.results[0].position.lat);
            console.log(data.results[0].position.lon);
}

};