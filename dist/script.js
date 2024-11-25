/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/*!******************!*\
  !*** ./index.ts ***!
  \******************/


var styles = {
  Styl1: 'dist/style/style1.css',
  Styl2: 'dist/style/style2.css',
  Styl3: 'dist/style/style3.css',
  Styl4: 'dist/style/style4.css'
};
var currentStyle = 'Styl1';
var dynamicStyleLink = document.createElement('link');
dynamicStyleLink.rel = 'stylesheet';
dynamicStyleLink.href = styles[currentStyle];
document.head.appendChild(dynamicStyleLink);
var styleLinksContainer = document.createElement('nav');
document.body.prepend(styleLinksContainer);
function generateStyleLinks() {
  styleLinksContainer.innerHTML = '';
  for (var styleName in styles) {
    var link = document.createElement('a');
    link.textContent = styleName;
    link.href = '#';
    link.dataset.style = styleName;
    link.addEventListener('click', function (event) {
      event.preventDefault();
      var styleKey = event.target.dataset.style;
      if (styleKey) {
        changeStyle(styleKey);
      }
    });
    styleLinksContainer.appendChild(link);
  }
}
function changeStyle(styleName) {
  if (!styles[styleName]) return;
  currentStyle = styleName;
  dynamicStyleLink.href = styles[styleName];
  console.log("Styl zmieniony na: ".concat(styleName));
}
document.addEventListener('DOMContentLoaded', generateStyleLinks);
/******/ })()
;