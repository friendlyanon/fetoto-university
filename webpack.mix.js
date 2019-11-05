"use strict";
const path = require("path");
const fs = require("fs");

const mix = require("laravel-mix");
require("laravel-mix-polyfill");

const targets = (
  require("./package").browserslist || ["defaults"]
).join(", ");

const loaderPath = path.join("resources", "js", "loader.js");
const pagesPath = path.join("resources", "js", "pages");

fs.writeFileSync(loaderPath, `/* This file is auto-generated */
if ("moduleToLoad" in window) {
  switch (window.moduleToLoad) {`);

for (const dirent of fs.readdirSync(pagesPath, { encoding: "utf8", withFileTypes: true })) {
  const { name } = dirent;
  if (dirent.isFile() && name.endsWith(".js")) {
    const slice = name.slice(0, -3);
    fs.appendFileSync(loaderPath, `
    case "${slice}":
      import(/* webpackChunkName: "js/${slice}" */ "./pages/${slice}");
      break;`);
  }
}

fs.appendFileSync(loaderPath, `
  }
}
`);

mix.polyfill({ targets })
  .js("resources/js/app.js", "public/js")
  .extract(["ky", "viewerjs"]);
