<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
<style type="text/css">

#lat, #lon { text-align:right }
#map { width:100%;height:300px;padding:0;margin:0; }
.lokasiess { cursor:pointer }
.lokasiess:hover {text-decoration:underline }
#results {display: none;}
</style>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
function showResult() {
  document.getElementById("results").style.display = "block";
}

// New York
var startlat = <?php echo json_encode($lat) ?>;
var startlon = <?php echo json_encode($lng) ?>;

var options = {
 center: [startlat, startlon],
 zoom: 16
}

document.getElementById('lat').value = startlat;
document.getElementById('lon').value = startlon;

var map = L.map('map', options);
var nzoom = 12;

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OSM'}).addTo(map);

var myMarker = L.marker([startlat, startlon], {title: "Coordinates", alt: "Coordinates", draggable: true}).addTo(map).on('dragend', function() {
 var lat = myMarker.getLatLng().lat.toFixed(8);
 var lon = myMarker.getLatLng().lng.toFixed(8);
 var czoom = map.getZoom();
 if(czoom < 18) { nzoom = czoom + 2; }
 if(nzoom > 18) { nzoom = 18; }
 if(czoom != 18) { map.setView([lat,lon], nzoom); } else { map.setView([lat,lon]); }
 document.getElementById('lat').value = lat;
 document.getElementById('lon').value = lon;
 myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
});

function chooseaddr(lat1, lng1, display_name)
{
 myMarker.closePopup();
 map.setView([lat1, lng1],18);
 myMarker.setLatLng([lat1, lng1]);
 lat = lat1.toFixed(8);
 lon = lng1.toFixed(8);
 document.getElementById('lat').value = lat;
 document.getElementById('lon').value = lon;
 document.getElementById('address').value = display_name;
 myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
}

$(document).on('click', '#cek', function(e){
	e.preventDefault();
	var lat = $(this).data('lat');
	var lon = $(this).data('lon');
	var display_name = $(this).data('display_name');

	myMarker.closePopup();
 	map.setView([lat, lon],18);
 	myMarker.setLatLng([lat, lon]);
 	// lat = lat1.toFixed(8);
 	// lon = lng1.toFixed(8);

	$('#lat').val(lat);
	$('#lon').val(lon);
	$('#address').val(display_name);
})

function myFunction(arr)
{
 var out = "";
 var i;

 if(arr.length > 0)
 {
  for(i = 0; i < arr.length; i++)
  {
   // out += "<div class='lokasiess' id='cek' title='Show Location and Coordinates' onclick='chooselokasi(" + arr[i].lat + ", " + arr[i].lon +  ", " + arr[i].display_name + ");return false;'>" + arr[i].display_name + "</div>";
   out += "<div class='lokasiess' id='cek' data-lat='" + arr[i].lat + "' data-lon='" + arr[i].lon + "' data-display_name='" + arr[i].display_name + "' title='Show Location and Coordinates'>" + arr[i].display_name + "</div>";
  }
  document.getElementById('results').innerHTML = out;
  console.log(arr);
 }
 else
 {
  document.getElementById('results').innerHTML = "Sorry, no results...";
 }

}

function addr_search()
{
 var inp = document.getElementById("addr");
 var xmlhttp = new XMLHttpRequest();
 var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
 xmlhttp.onreadystatechange = function()
 {
   if (this.readyState == 4 && this.status == 200)
   {
    var myArr = JSON.parse(this.responseText);
    myFunction(myArr);
   }
 };
 xmlhttp.open("GET", url, true);
 xmlhttp.send();
}

</script>
