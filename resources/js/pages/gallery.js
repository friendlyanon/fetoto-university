import Viewer from "viewerjs";
import "viewerjs/dist/viewer.min.css";
import options from "../gallery/viewer-options";

const viewer = new Viewer(document.querySelector(".viewer-root"), options);

if ("galleryMap" in window) {
  new window.locationPicker(document.getElementById("map"), {
    lat: Number(window.galleryMap.latitude),
    lng: Number(window.galleryMap.longitude),
  }, {
    zoom: 15,
  });
}
