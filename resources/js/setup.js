import ky from "ky";

/** @inheritDoc */
window.ky = ky.extend({
  headers: {
    "x-requested-with": "XMLHttpRequest",
    "x-csrf-token": document.head.querySelector("meta[name=\"csrf-token\"]").content,
  },
});
