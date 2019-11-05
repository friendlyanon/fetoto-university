"use strict";
const mix = require("laravel-mix");
require("laravel-mix-polyfill");

const targets = (
  require("./package").browserslist || ["defaults"]
).join(", ");

mix.polyfill({ targets })
  .sass("resources/sass/auth.scss", "public/css")
  .sass("resources/sass/app.scss", "public/css")
  .sass("resources/sass/home.scss", "public/css")
  .sass("resources/sass/gallery.scss", "public/css")
  .sass("resources/sass/upload.scss", "public/css");
