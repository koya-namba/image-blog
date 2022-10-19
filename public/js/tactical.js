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
// canvas
var canvas = document.getElementById('canvassample');
var ctx = canvas.getContext('2d'); // ペンorスタンプ

var toolinfo = document.getElementById('tool');
var changeToolBtn = document.getElementById('changeToolBtn'); // color

var colorinfo = document.getElementById('color');
var changeRedBtn = document.getElementById('changeRedBtn');
var changeBlueBtn = document.getElementById('changeBlueBtn');
var changeBlackBtn = document.getElementById('changeBlackBtn'); // リセット，進む，戻るボタン

var resetBtn = document.getElementById('resetBtn');
var backBtn = document.getElementById('backBtn');
var nextBtn = document.getElementById('nextBtn'); // 画像変換ボタン

var changeImgBtn = document.getElementById('changeImgBtn'); // 画像リンク

var img = document.getElementById("newImg");
var downloadLink = document.getElementById('download'); // 変数を定義

var moveflg = 0;
var Xpoint;
var Ypoint;
var temp;
var myStorage = localStorage; // ペンのサイズ定義

var defSize = 3; // ペンのカラー定義

var defColor = "#000"; // ペンorスタンプ

var is_pen = 1; // canvasを用いて，コートを初期化

var initCanvas = function initCanvas() {
  // 緑で塗りつぶす
  ctx.fillStyle = "mediumseagreen";
  ctx.fillRect(0, 0, canvas.width, canvas.height); // コートの線

  ctx.strokeStyle = 'white'; //#808080';

  ctx.lineWidth = 3; // 即時実行関数を使う
  // コート左側のline

  (function () {
    ctx.beginPath();
    ctx.moveTo(50, 50);
    ctx.lineTo(50, canvas.height - 50);
    ctx.closePath();
    ctx.stroke();
  })(); // コート右側のline


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width - 50, 50);
    ctx.lineTo(canvas.width - 50, canvas.height - 50);
    ctx.closePath();
    ctx.stroke();
  })(); // コート下のline


  (function () {
    ctx.beginPath();
    ctx.moveTo(50, canvas.height - 50);
    ctx.lineTo(canvas.width - 50, canvas.height - 50);
    ctx.closePath();
    ctx.stroke();
  })(); // コート上のline


  (function () {
    ctx.beginPath();
    ctx.moveTo(50, 50);
    ctx.lineTo(canvas.width - 50, 50);
    ctx.closePath();
    ctx.stroke();
  })(); // コート左の25yard line


  (function () {
    ctx.beginPath();
    ctx.moveTo(279, 50);
    ctx.lineTo(279, canvas.height - 50);
    ctx.closePath();
    ctx.stroke();
  })(); // コート中央のline


  (function () {
    ctx.beginPath();
    ctx.moveTo(507, 50);
    ctx.lineTo(507, canvas.height - 50);
    ctx.closePath();
    ctx.stroke();
  })(); // コート右の75yard line


  (function () {
    ctx.beginPath();
    ctx.moveTo(735, 50);
    ctx.lineTo(735, canvas.height - 50);
    ctx.closePath();
    ctx.stroke();
  })(); //ペナルティスポット(右)


  (function () {
    ctx.beginPath();
    ctx.arc(114, canvas.height / 2, 5, 0, 2 * Math.PI, true);
    ctx.fillStyle = 'white';
    ctx.fill();
    ctx.stroke();
  })(); //ペナルティスポット(左)


  (function () {
    ctx.beginPath();
    ctx.arc(canvas.width - 114, canvas.height / 2, 5, 0, 2 * Math.PI, true);
    ctx.fillStyle = 'white';
    ctx.fill();
    ctx.stroke();
  })(); //コート左側のサークルライン


  (function () {
    ctx.beginPath();
    ctx.arc(50, canvas.height / 2, 146.3, 3 * Math.PI / 2, Math.PI / 2, false);
    ctx.stroke();
  })(); //コート左側のサークルライン(外側)


  (function () {
    ctx.beginPath();
    ctx.setLineDash([10, 7.5]);
    ctx.arc(50, canvas.height / 2, 196.3, 3 * Math.PI / 2, Math.PI / 2, false);
    ctx.stroke();
  })(); //コート右側のサークルライン


  (function () {
    ctx.beginPath();
    ctx.setLineDash([]);
    ctx.arc(canvas.width - 50, canvas.height / 2, 146.3, -3 * Math.PI / 2, -Math.PI / 2, false);
    ctx.stroke();
  })(); //コート右側のサークルライン(外側)


  (function () {
    ctx.beginPath();
    ctx.setLineDash([10, 7.5]);
    ctx.arc(canvas.width - 50, canvas.height / 2, 196.3, -3 * Math.PI / 2, -Math.PI / 2, false);
    ctx.stroke();
  })(); // 左コート下部のゴールライン


  (function () {
    ctx.beginPath();
    ctx.setLineDash([]);
    ctx.moveTo(50, canvas.height / 2 + 25);
    ctx.lineTo(20, canvas.height / 2 + 25);
    ctx.closePath();
    ctx.stroke();
  })(); // 左コート上部のゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(50, canvas.height / 2 - 25);
    ctx.lineTo(20, canvas.height / 2 - 25);
    ctx.closePath();
    ctx.stroke();
  })(); // 左コートのゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(20, canvas.height / 2 - 25);
    ctx.lineTo(20, canvas.height / 2 + 25);
    ctx.closePath();
    ctx.stroke();
  })(); // 右コート下部のゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width - 50, canvas.height / 2 + 25);
    ctx.lineTo(canvas.width - 20, canvas.height / 2 + 25);
    ctx.closePath();
    ctx.stroke();
  })(); // 右コート上部のゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width - 50, canvas.height / 2 - 25);
    ctx.lineTo(canvas.width - 20, canvas.height / 2 - 25);
    ctx.closePath();
    ctx.stroke();
  })(); // 右コートのゴールライン


  (function () {
    ctx.beginPath();
    ctx.moveTo(canvas.width - 20, canvas.height / 2 - 25);
    ctx.lineTo(canvas.width - 20, canvas.height / 2 + 25);
    ctx.closePath();
    ctx.stroke();
  })();
}; // ローカルストレージを初期化


var initLocalStorage = function initLocalStorage() {
  myStorage.setItem("__log", JSON.stringify([]));
}; // ローカルストレージを準備


var setLocalStoreage = function setLocalStoreage() {
  var png = canvas.toDataURL();
  var logs = JSON.parse(myStorage.getItem("__log"));
  setTimeout(function () {
    logs.unshift({
      png: png
    });
    myStorage.setItem("__log", JSON.stringify(logs));
    temp = [];
  }, 0);
}; // ペンに変更


var changePenMode = function changePenMode() {
  // スタンプ機能を解除
  canvas.removeEventListener('click', stamped); // PC対応

  canvas.addEventListener('mousedown', startPoint, false);
  canvas.addEventListener('mousemove', movePoint, false);
  canvas.addEventListener('mouseup', endPoint, false); // スマホ対応

  canvas.addEventListener('touchstart', startPoint, false);
  canvas.addEventListener('touchmove', movePoint, false);
  canvas.addEventListener('touchend', endPoint, false);
}; // スタンプに変更


var changeStampMode = function changeStampMode() {
  // マウス・タッチイベントを解除
  canvas.removeEventListener('mousedown', startPoint);
  canvas.removeEventListener('mousemove', movePoint);
  canvas.removeEventListener('mouseup', endPoint);
  canvas.removeEventListener('touchstart', startPoint);
  canvas.removeEventListener('touchmove', movePoint);
  canvas.removeEventListener('touchend', endPoint); //プレイヤーを配置

  canvas.addEventListener('click', stamped);
}; // スタンプ描画


var stamped = function stamped(e) {
  ctx.beginPath();
  ctx.arc(e.clientX - (5 + canvas.getBoundingClientRect().left), e.clientY - canvas.getBoundingClientRect().top, 5, 0, Math.PI * 2);
  ctx.strokeStyle = defColor;
  ctx.stroke();
  setLocalStoreage();
}; // ペンの描き始め


var startPoint = function startPoint(e) {
  e.preventDefault();
  ctx.beginPath(); // ペンがずれてたらここを修正

  Xpoint = e.layerX - 5 - (5 + canvas.getBoundingClientRect().left);
  Ypoint = e.layerY - canvas.getBoundingClientRect().top;
  ctx.moveTo(Xpoint, Ypoint);
}; // ペンの移動


var movePoint = function movePoint(e) {
  if (e.buttons === 1 || e.witch === 1 || e.type == 'touchmove') {
    Xpoint = e.layerX - 5 - (5 + canvas.getBoundingClientRect().left);
    Ypoint = e.layerY - 5 - canvas.getBoundingClientRect().top;
    moveflg = 1;
    ctx.lineTo(Xpoint - 5, Ypoint - 5);
    ctx.lineCap = "round";
    ctx.lineWidth = defSize * 2;
    ctx.strokeStyle = defColor;
    ctx.stroke();
  }
}; // ペンは離す時


var endPoint = function endPoint(e) {
  if (moveflg === 0) {
    ctx.lineTo(Xpoint - 6 - (5 + canvas.getBoundingClientRect().left), Ypoint - 6 - canvas.getBoundingClientRect().top);
    ctx.lineCap = "round";
    ctx.lineWidth = defSize * 2;
    ctx.strokeStyle = defColor;
    ctx.stroke();
  }

  moveflg = 0;
  setLocalStoreage();
}; // prev, nextボタンの時に用いる関数


var draw = function draw(src) {
  var img = new Image();
  img.src = src;

  img.onload = function () {
    ctx.drawImage(img, 0, 0);
  };
}; // canvasをきれいにして，img, downloadのソースを削除


var resetCanvas = function resetCanvas() {
  ctx.clearRect(0, 0, ctx.canvas.clientWidth, ctx.canvas.clientHeight);
  initCanvas();
  img.src = null;
  img.removeAttribute('src');
  downloadLink.removeAttribute('href');
  downloadLink.removeAttribute('download');
}; // ストレージの初期化


window.onload = initLocalStorage(); // canvasを初期化

initCanvas(); // 最初はペンモード
// PC対応

canvas.addEventListener('mousedown', startPoint, false);
canvas.addEventListener('mousemove', movePoint, false);
canvas.addEventListener('mouseup', endPoint, false); // スマホ対応

canvas.addEventListener('touchstart', startPoint, false);
canvas.addEventListener('touchmove', movePoint, false);
canvas.addEventListener('touchend', endPoint, false); // モード変更

changeToolBtn.addEventListener('click', function () {
  // ペンならスタンプに変更
  if (is_pen) {
    toolinfo.innerText = 'スタンプ';
    changeToolBtn.innerText = 'ペンに変更';
    changeStampMode();
    is_pen = 0;
  } else {
    toolinfo.innerText = 'ペン';
    changeToolBtn.innerText = 'スタンプに変更';
    changePenMode();
    is_pen = 1;
  }
}); // 色を赤に変更

changeRedBtn.addEventListener('click', function () {
  defColor = '#F00';
  colorinfo.innerText = "赤";
}); // 色を青に変更

changeBlueBtn.addEventListener('click', function () {
  defColor = '#00F';
  colorinfo.innerText = "青";
}); // 色を黒に変更

changeBlackBtn.addEventListener('click', function () {
  defColor = '#000';
  colorinfo.innerText = "黒";
}); // canvasに関わるものを初期化

resetBtn.addEventListener('click', function () {
  if (confirm('Canvasを初期化しますか？')) {
    initLocalStorage();
    temp = [];
    resetCanvas();
  }
}); // canvasに書いてあるものを画像データに変換し，img, downloadにソースを載せる

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
});

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