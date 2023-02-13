@extends('layouts.admin')
@section('title')
Orders
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> Add New Orders   </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


      <form action="{{ route('admin.order.store') }}" method="post" enctype='multipart/form-data'>
        <div class="row">
        @csrf




        <div class="form-group col-md-6">
            <label for="courses">DRIVER Name <span class="text-danger">*</span></label>
            <select class="form-control" name="driver" id="driver">
                <option disabled>Select Driver</option>
                @foreach($drivers as $driver)
                    <option value="{{$driver->id}}">{{$driver->name}}</option>
                @endforeach
            </select>
        </div>

            <div class="col-md-6">
            <div class="form-group">
            <label> Tracking Number </label>
            <input name="tracking_number" id="number" class="form-control" value="{{ $randomNumber }}"  readonly  >
            @error('tracking_number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label> Mobile Number for Customer </label>
                <input name="mobile" id="mobile" class="form-control" >
                @error('mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                </div>
            <div class="col-md-6">
                <div class="form-group">
            <div id="map" style="height: 200px; width:500px;">

            </div>
                </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
            <input type="text" placeholder="Search here for place in map.." name="search" id="search-box" class="form-control">
            </div>
        </div>


            <div class="form-group">
            <input type="hidden" id="latitude" name="latitude" class="form-control">
            </div>

            <div class="form-group">
            <input type="hidden" id="longitude" name="longitude" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" id="place-name" name="place" class="form-control" readonly>
                </div>


      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> submit</button>
        <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-danger">cancel</a>

      </div>
    </div>

  </div>
            </form>



            </div>




        </div>
      </div>






@endsection


@section('script')
<script>


var map;
var marker;
var lat = document.getElementById("latitude");
var lng = document.getElementById("longitude");
var placeName = document.getElementById("place-name");
var geocoder = new google.maps.Geocoder();

$(document).ready(function(){
  initMap();
});

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 8
  });

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      map.setCenter(pos);
      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: pos
      });
    }, function() {
      handleLocationError(true, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, map.getCenter());
  }

  google.maps.event.addListener(map, "click", function(event) {
    marker.setPosition(event.latLng);
    lat.value = event.latLng.lat();
    lng.value = event.latLng.lng();

    geocoder.geocode({'location': event.latLng}, function(results, status) {
      if (status === 'OK') {
        if (results[0]) {
          placeName.value = results[0].formatted_address;
        } else {
          window.alert('No results found');
        }
      } else {
        window.alert('Geocoder failed due to: ' + status);
      }
    });

    var infoWindow = new google.maps.InfoWindow({
      content: 'Latitude: ' + lat.value + '<br>' + 'Longitude: ' + lng.value
    });
    infoWindow.open(map, marker);
  });

  // Create the search box input field
  var input = document.getElementById('search-box');
  var searchBox = new google.maps.places.Autocomplete(input);

  // Add listener for the place changed event
  searchBox.addListener('place_changed', function() {
    var place = searchBox.getPlace();
    if (place.geometry) {
      // Set the position of the marker to the selected place
      marker.setPosition(place.geometry.location);
      map.setCenter(place.geometry.location);
      // Update the latitude and longitude input fields
      lat.value = place.geometry.location.lat();
      lng.value = place.geometry.location.lng();
      // Update the place name input field
      placeName.value = place.formatted_address;

      var infoWindow = new google.maps.InfoWindow({
        content: 'Latitude: ' + lat.value + '<br>' + 'Longitude: ' + lng.value
      });
      infoWindow.open(map, marker);
    }
  });
}
function handleLocationError(browserHasGeolocation, pos) {
    window.alert(browserHasGeolocation ?
                  'Error: The Geolocation service failed.' :
                  'Error: Your browser doesn\'t support geolocation.');
}
</script>
@endsection






