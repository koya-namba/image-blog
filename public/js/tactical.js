/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/tactical.js":
/*!**********************************!*\
  !*** ./resources/js/tactical.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// (5 + canvas.getBoundingClientRect().left)
// canvas.getBoundingClientRect().top;
// htmlのidから読み込み
var canvas = document.getElementById('canvassample');
var ctx = canvas.getContext('2d');
var changeRedBtn = document.getElementById('changeRedBtn');
var changeBlueBtn = document.getElementById('changeBlueBtn');
var changeBlackBtn = document.getElementById('changeBlackBtn');
var resetBtn = document.getElementById('resetBtn');
var backBtn = document.getElementById('backBtn');
var nextBtn = document.getElementById('nextBtn');
var changeImgBtn = document.getElementById('changeImgBtn');
var img = document.getElementById("newImg");
var downloadLink = document.getElementById('download'); // canvasを用いて，コートを初期化

function init() {
  // 白で塗りつぶす
  ctx.fillStyle = "white";
  ctx.fillRect(0, 0, canvas.width, canvas.height); // コートの線

  ctx.strokeStyle = '#808080';
  ctx.lineWidth = 3; // 即時実行関数を使う
  // コート左側のline

  (function () {
    ctx.beginPath();
    ctx.moveTo(10, 10);
    ctx.lineTo(10, canvas.height - 10);
    ctx.closePath();
    ctx.stroke();
  })(); // コート右側のline


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width - 10, 10);
    ctx.lineTo(canvas.width - 10, canvas.height - 10);
    ctx.closePath();
    ctx.stroke();
  })(); // コート上のline


  (function () {
    ctx.beginPath();
    ctx.moveTo(10, canvas.height - 10);
    ctx.lineTo(canvas.width - 10, canvas.height - 10);
    ctx.closePath();
    ctx.stroke();
  })(); // コート下のline


  (function () {
    ctx.beginPath();
    ctx.moveTo(10, 10);
    ctx.lineTo(canvas.width - 10, 10);
    ctx.closePath();
    ctx.stroke();
  })(); // コート中央のline


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width / 2, 10);
    ctx.lineTo(canvas.width / 2, canvas.height - 10);
    ctx.closePath();
    ctx.stroke();
  })(); // コート中央の円


  (function () {
    ctx.beginPath();
    ctx.arc(canvas.width / 2, canvas.height / 2, 100, 0, Math.PI * 2, true);
    ctx.stroke();
  })(); // 左コート上部のゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(10, canvas.height / 2 + 100);
    ctx.lineTo(100, canvas.height / 2 + 100);
    ctx.closePath();
    ctx.stroke();
  })(); // 左コート下部のゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(10, canvas.height / 2 - 100);
    ctx.lineTo(100, canvas.height / 2 - 100);
    ctx.closePath();
    ctx.stroke();
  })(); // 左コートのゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(100, canvas.height / 2 - 100);
    ctx.lineTo(100, canvas.height / 2 + 100);
    ctx.closePath();
    ctx.stroke();
  })(); // 右コート上部のゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width - 10, canvas.height / 2 + 100);
    ctx.lineTo(canvas.width - 100, canvas.height / 2 + 100);
    ctx.closePath();
    ctx.stroke();
  })(); // 右コート下部のゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width - 10, canvas.height / 2 - 100);
    ctx.lineTo(canvas.width - 100, canvas.height / 2 - 100);
    ctx.closePath();
    ctx.stroke();
  })(); // 右コートのゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width - 100, canvas.height / 2 - 100);
    ctx.lineTo(canvas.width - 100, canvas.height / 2 + 100);
    ctx.closePath();
    ctx.stroke();
  })();
} // ローカルストレージを初期化


function initLocalStorage() {
  myStorage.setItem("__log", JSON.stringify([]));
} // ローカルストレージを準備


function setLocalStoreage() {
  var png = canvas.toDataURL();
  var logs = JSON.parse(myStorage.getItem("__log"));
  setTimeout(function () {
    logs.unshift({
      png: png
    });
    myStorage.setItem("__log", JSON.stringify(logs));
    temp = [];
  }, 0);
} // 変数を定義


var moveflg = 0;
var Xpoint;
var Ypoint;
var temp;
var myStorage = localStorage; // ペンのサイズ定義

var defSize = 3; // ペンのカラー定義

var defColor = "#000"; // ストレージの初期化

window.onload = initLocalStorage(); // canvasを初期化

init(); // ペンの色を赤に変更

changeRedBtn.addEventListener('click', function () {
  defColor = '#F00';
}); // ペンの色を青に変更

changeBlueBtn.addEventListener('click', function () {
  defColor = '#00F';
}); // ペンの色を黒に変更

changeBlackBtn.addEventListener('click', function () {
  defColor = '#000';
}); // PC対応

canvas.addEventListener('mousedown', startPoint, false);
canvas.addEventListener('mousemove', movePoint, false);
canvas.addEventListener('mouseup', endPoint, false); // スマホ対応

canvas.addEventListener('touchstart', startPoint, false);
canvas.addEventListener('touchmove', movePoint, false);
canvas.addEventListener('touchend', endPoint, false); // ペンの描き始め

function startPoint(e) {
  e.preventDefault();
  ctx.beginPath(); // ペンがずれてたらここを修正

  Xpoint = e.layerX - (5 + canvas.getBoundingClientRect().left);
  Ypoint = e.layerY - canvas.getBoundingClientRect().top;
  ctx.moveTo(Xpoint, Ypoint);
} // ペンの移動


function movePoint(e) {
  if (e.buttons === 1 || e.witch === 1 || e.type == 'touchmove') {
    Xpoint = e.layerX - (5 + canvas.getBoundingClientRect().left);
    Ypoint = e.layerY - canvas.getBoundingClientRect().top;
    moveflg = 1;
    ctx.lineTo(Xpoint, Ypoint);
    ctx.lineCap = "round";
    ctx.lineWidth = defSize * 2;
    ctx.strokeStyle = defColor;
    ctx.stroke();
  }
} // ペンは離す時


function endPoint(e) {
  if (moveflg === 0) {
    ctx.lineTo(Xpoint - (6 + canvas.getBoundingClientRect().left), Ypoint - (1 + canvas.getBoundingClientRect().top));
    ctx.lineCap = "round";
    ctx.lineWidth = defSize * 2;
    ctx.strokeStyle = defColor;
    ctx.stroke();
  }

  moveflg = 0;
  setLocalStoreage();
} // canvasに関わるものを初期化


resetBtn.addEventListener('click', function () {
  if (confirm('Canvasを初期化しますか？')) {
    initLocalStorage();
    temp = [];
    resetCanvas();
  }
}); // canvasをきれいにして，img, downloadのソースを削除

function resetCanvas() {
  ctx.clearRect(0, 0, ctx.canvas.clientWidth, ctx.canvas.clientHeight);
  init();
  img.src = null;
  img.removeAttribute('src');
  downloadLink.removeAttribute('href');
  downloadLink.removeAttribute('download');
} // canvasに書いてあるものを画像データに変換し，img, downloadにソースを載せる


changeImgBtn.addEventListener('click', function () {
  var png = canvas.toDataURL();
  img.src = png;
  downloadLink.href = png;
  downloadLink.download = 'test.png';
}); // 戻るボタンの関数

backBtn.addEventListener("click", function () {
  var logs = JSON.parse(myStorage.getItem("__log"));

  if (logs.length > 0) {
    temp.unshift(logs.shift());
    setTimeout(function () {
      myStorage.setItem("__log", JSON.stringify(logs));
      resetCanvas();
      draw(logs[0]['png']);
    }, 0);
  }
}); // 進むボタンの関数

nextBtn.addEventListener('click', function () {
  var logs = JSON.parse(myStorage.getItem("__log"));

  if (temp.length > 0) {
    logs.unshift(temp.shift());
    setTimeout(function () {
      myStorage.setItem("__log", JSON.stringify(logs));
      resetCanvas();
      draw(logs[0]['png']);
    }, 0);
  }
}); // prev, nextボタンの時に用いる関数

function draw(src) {
  var img = new Image();
  img.src = src;

  img.onload = function () {
    ctx.drawImage(img, 0, 0);
  };
}

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/tactical.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/image-blog/resources/js/tactical.js */"./resources/js/tactical.js");


/***/ })

/******/ });