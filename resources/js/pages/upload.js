const LocationPicker = window.locationPicker;

const elements = [
  document.querySelector("input[name='longitude']"),
  document.querySelector("input[name='latitude']"),
];

const pickerOpts = {
  lat: 47.6800801565498,
  lng: 16.578642218956027,
};

const lp = new LocationPicker(document.getElementById("map"), pickerOpts, {
  zoom: 17,
});

window.google.maps.event.addListener(lp.map, "idle", () => {
  const { lng, lat } = lp.getMarkerPosition();
  elements[0].value = lng;
  elements[1].value = lat;
});

if (!elements[0].value) {
  elements[0].value = pickerOpts.lng;
  elements[1].value = pickerOpts.lat;
}
