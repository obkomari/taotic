/*
PAGELAYER
http://pagelayer.com/
(c) Pagelayer Team
*/

/*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */

html {
  line-height: 1.15; /* 1 */
  -webkit-text-size-adjust: 100%; /* 2 */
}

body {
  margin: 0;
}

main {
  display: block;
}

h1 {
  font-size: 2em;
  margin: 0.67em 0;
}

hr {
  box-sizing: content-box; /* 1 */
  height: 0; /* 1 */
  overflow: visible; /* 2 */
}

pre {
  font-family: monospace, monospace; /* 1 */
  font-size: 1em; /* 2 */
}

a {
  background-color: transparent;
}

abbr[title] {
  border-bottom: none; /* 1 */
  text-decoration: underline; /* 2 */
  text-decoration: underline dotted; /* 2 */
}

b,
strong {
  font-weight: bolder;
}

code,
kbd,
samp {
  font-family: monospace, monospace; /* 1 */
  font-size: 1em; /* 2 */
}

small {
  font-size: 80%;
}

sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

img {
  border-style: none;
}

button,
input,
optgroup,
select,
textarea {
  font-family: inherit; /* 1 */
  font-size: 100%; /* 1 */
  line-height: 1.15; /* 1 */
  margin: 0; /* 2 */
}

button,
input { /* 1 */
  overflow: visible;
}

button,
select { /* 1 */
  text-transform: none;
}

button,
[type="button"],
[type="reset"],
[type="submit"] {
  -webkit-appearance: button;
}

button::-moz-focus-inner,
[type="button"]::-moz-focus-inner,
[type="reset"]::-moz-focus-inner,
[type="submit"]::-moz-focus-inner {
  border-style: none;
  padding: 0;
}

button:-moz-focusring,
[type="button"]:-moz-focusring,
[type="reset"]:-moz-focusring,
[type="submit"]:-moz-focusring {
  outline: 1px dotted ButtonText;
}

fieldset {
  padding: 0.35em 0.75em 0.625em;
}

legend {
  box-sizing: border-box; /* 1 */
  color: inherit; /* 2 */
  display: table; /* 1 */
  max-width: 100%; /* 1 */
  padding: 0; /* 3 */
  white-space: normal; /* 1 */
}

progress {
  vertical-align: baseline;
}

textarea {
  overflow: auto;
}

[type="checkbox"],
[type="radio"] {
  box-sizing: border-box; /* 1 */
  padding: 0; /* 2 */
}

[type="number"]::-webkit-inner-spin-button,
[type="number"]::-webkit-outer-spin-button {
  height: auto;
}

[type="search"] {
  -webkit-appearance: textfield; /* 1 */
  outline-offset: -2px; /* 2 */
}

[type="search"]::-webkit-search-decoration {
  -webkit-appearance: none;
}

::-webkit-file-upload-button {
  -webkit-appearance: button; /* 1 */
  font: inherit; /* 2 */
}

details {
  display: block;
}

summary {
  display: list-item;
}


template {
  display: none;
}

[hidden] {
  display: none;
}

/* END normalize.css */

/* An overwrite to show the row irrespective in the editor */

body {
font-family: Roboto, 'Open Sans', Arial, Helvetica, sans-serif;
font-size:12px;
}

.pagelayer-normalize{
height:100%;
width:100%;
padding:0px;
margin:0px;
border:0px;
}

/* Pagelayer Top Bar */
.pagelayer-bottombar-holder{
background: #4f4f4f;
position:relative;
padding: 5px;
}

.pagelayer-bottombar{
padding: auto;
}

.pagelayer-bottombar-rightbuttons button{
font-size: 13px;
font-weight: bold;
cursor: pointer;
border-radius: 2px;
padding: 4px 8px;
margin: auto 5px;
outline:none;
}

.pagelayer-bottombar-rightbuttons .pli{
color:#fff;
cursor: pointer;
}

.pagelayer-success-btn{
border: #398439 1px solid;
color: #fff;
background: #449d44;
}

.pagelayer-success-btn:hover{
background: #3a733a;
border-color: #3a733a;
}

.pagelayer-primary-btn{
border: #2e6da4 1px solid;
color: #fff;
background: #337ab7;
}

.pagelayer-primary-btn:hover{
background: #286090;
border-color: #204d74;
}

.pagelayer-close-button{
border: #ef4d4d 1px solid;
color: #fff;
background: #ef4d4d;
}

.pagelayer-close-button:hover{
background: #c13030;
border-color: #c13030;
}

.pagelayer-bottombar-rightbuttons i{
padding: 4px;
margin: auto 3px;
}

.pagelayer-mode-wrapper i{
padding: 8px;
margin: auto 5px;
}

.pagelayer-mode-wrapper{
display:inline-block;
text-align:center;
}

.pagelayer-mode-wrapper i{
padding: 8px;
margin: auto 5px;
}

.pagelayer-mode-buttons-wrapper{
position:absolute;
bottom:100%;
color:#fff;
background-color: #3e8ef7;
display:none;
z-index:1;
}

.pagelayer-leftbar-toggle-h{
width:0px;
}

.pagelayer-leftbar-table{
position:relative;
}

.pagelayer-leftbar-hidden{
width:0px;
}

.pagelayer-leftbar-hidden table{
display:none;
}

.pagelayer-leftbar-toggle{
position: absolute;
width:12px;
background: #E3E3E3;
cursor: pointer;
text-align:center;
line-height:300%;
top: 50%;
left: 100%;
transform: translateY(-50%);
}

.pagelayer-rightbar .pagelayer-leftbar-toggle{
left: -12px;
}

.pagelayer-rightbar:not(.pagelayer-leftbar-hidden) .pagelayer-leftbar-toggle,
.pagelayer-leftbar-hidden:not(.pagelayer-rightbar) .pagelayer-leftbar-toggle{
direction: rtl;
}

.pagelayer-leftbar-toggle:hover{
background-color: #3e8ef7;
color: #ffffff;
}

.pagelayer-leftbar-holder{
overflow: hidden;
position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
border-right: 1px solid #c9d0d9;
}

/*.pagelayer-body-table{
max-height: 100vh !important;
}*/

.pagelayer-iframe{
}

.pagelayer-iframe-holder{
max-height: 100vh !important;
height: 100%;
overflow: auto;
text-align:center;
}

.pagelayer-iframe-holder.pagelayer-iframe-holder-with-bar{
max-height: calc(100vh - 45px) !important;
height: calc(100vh - 45px) !important;
}

.pagelayer-iframe-top-bar{
height:45px;
background-color: #3e8ef7;
display:none;
color: #fff;
}

.pagelayer-body{
transition:0.5s;
}

.pagelayer-pro-req{
font-size: 10px;
padding: 2px 4px;
display: inline-block;
background-color: #e63131;
color: #fff;
margin-left: 4px;
border-radius: 2px;
cursor: pointer;
}

.pagelayer-pro-req > .pagelayer-tlite{
background: #fff;
color: #000;
width: 220px !important;
white-space: inherit !important;
top: 22px !important;
left: 0px !important;
}

.pagelayer-screen-desktop{

}

.pagelayer-screen-tablet{
height:900px;
margin:20px auto;
border: solid #444;
border-width: 30px 10px;
border-radius: 10px;
}

.pagelayer-screen-mobile{
height:540px;
margin:20px auto;
border: solid #444;
border-width: 30px 10px;
border-radius: 10px;
}

/* Element Properties Dialog classes */
[class^="pagelayer-elp"]{
font-family: Roboto, 'Open Sans', Arial, Helvetica, sans-serif !important;
color: #313439;
background-color: transparent;
}

#pagelayer-elpd {
display:none;
color:#444;
border: 1px solid #d3d3d3;
}

.pagelayer-dark #pagelayer-elpd {
border: 1px solid #252529;
}

#pagelayer-elpd .slimScrollDiv{
height: calc(100% - 50px) !important;
}

.pagelayer-elpd-header {
border: none;
color:#fff;
}

.pagelayer-elpd-title {
text-align: center;
padding:0px;
cursor: move;
color: #fff;
font-weight: 600;
width:76%;
}

.pagelayer-elpd-close {
padding-right:10px;
cursor: pointer;
margin: 0px;
position: absolute;
right: 5px;
color: #fff;
top: 50%;
transform: translateY(-50%);
}

.pagelayer-elpd-body{
border: none;
}

.pagelayer-elpd-section-rows{
background-color: #FFF;
border-top: 1px solid #d3d3d3;
}

.pagelayer-dark .pagelayer-elpd-section-rows{
background-color: #1c1c1f;
border-top: 1px solid #1c1c1f;
}

.pagelayer-elpd-section-name{
margin-top: 10px;
padding: 11px 10px;
background-color: #FFF;
font-size: 13px;
font-weight: bold;
color: #555;
cursor: pointer;
transition: all 0.3s;
}

.pagelayer-dark .pagelayer-elpd-section-name{
background-color: #252529;
font-family: Roboto;
font-size: 12px;
font-weight: 400;
color: #ffffff;
}

.pagelayer-elpd-section-name:hover,
.pagelayer-elpd-section-open{
color:#1a7fb0;
}

.pagelayer-dark .pagelayer-elpd-section-open{
background-color: #0d47a1;
}

.pagelayer-dark .pagelayer-elpd-section-name:hover{
color:#ffffff;
}

.pagelayer-elpd-section-name:not(.pagelayer-elpd-section-open) .pli:before,
.pagelayer-navigator-toggle .pagalayer-arrow:before{
content: "\f0da";
font-family: pagelayer;
}
.pagelayer-elpd-section-name.pagelayer-elpd-section-open .pli:before,
.pagelayer-navigator-open > .pagelayer-navigator-toggle .pagalayer-arrow:before{
content: "\f0d7";
font-family: pagelayer;
}

.pagelayer-elpd-section-name .pli{
width:15px;
float:right;
font-style: normal;
}

/* Pagelayer editor panel tabs*/

.pagelayer-elpd-tab,
.pagelayer-history-tab,
.pagelayer-widget-tab{
display: inline-block;
font-size: 13px;
cursor: pointer;
padding: 10px 6px;
margin: 0px 5px 0px 0px;
}

.pagelayer-elpd-tab:hover,
.pagelayer-history-tab:hover,
.pagelayer-widget-tab:hover{
color: #3e8ef7;	
}

.pagelayer-dark .pagelayer-elpd-tab,
.pagelayer-dark .pagelayer-history-tab,
.pagelayer-dark .pagelayer-widget-tab{
font-family: Roboto !important;
color:#777777;
font-size: 14px;
font-weight: 400;
}

.pagelayer-elpd-settings-body{
display: none;
}

.pagelayer-elpd-settings-body.active{
display: block;
}

.pagelayer-elpd-style-body{
display: none;
}

.pagelayer-elpd-style-body.active{
display: block;
}

.pagelayer-history-section{
display:none;
}

.pagelayer-history-body{
margin:10px 0px;	
padding:10px;
background-color:#ffffff;
}

.pagelayer-history-section.active{
display:block;	
}

.pagelayer-history-section.active[pagelayer-show-tab="actions"]{
display:flex;
flex-direction:column-reverse;	
}

[pagelayer-elpd-active-tab="1"],
[pagelayer-history-active-tab="1"] {
color: #3e8ef7;
border-bottom: 2px solid #3e8ef7;
}

.pagelayer-dark [pagelayer-elpd-active-tab="1"],
.pagelayer-dark [pagelayer-history-active-tab="1"]{
color: #ffffff;
}

.pagelayer-elpd-tabs,
.pagelayer-history-tabs,
.pagelayer-widget-tabs {
background-color: #fff;
border-bottom: 1px solid #d3d3d3;
}

.pagelayer-dark .pagelayer-elpd-tabs,
.pagelayer-dark .pagelayer-history-tabs,
.pagelayer-dark .pagelayer-widget-tabs{
background-color: #1c1c1f;
border-bottom: 1px solid #1c1c1f;
}


.pagelayer-elpd-tabs{
display: flex;
align-items: center;
}

.pagelayer-widget-tabs{
display: flex;
text-align: center;
margin-left: -17px;
}

.pagelayer-widget-tab{
flex:1;
}

.pagelayer-elpd-options{
text-align:right;
display:inline-block;
margin-right:10px;
}

.pagelayer-elpd-options i{
padding:4px 5px;
cursor:pointer;
}

.pagelayer-dark .pagelayer-elpd-options i{
color:#777777;
}

.pagelayer-dark .pagelayer-elpd-options i:hover{
color: #ffffff;
}

.pagelayer-form-item {
border-bottom: 1px dashed #e6e6e6;
padding: 10px 8px 10px 6px; 
margin-bottom: 0px;
position: relative;
}

[pagelayer-access-item]{
position: absolute;
z-index: -100;
top: 0px;
visibility: hidden;
}

.pagelayer-access-item-visible{
position: relative !important;
z-index: unset !important;
visibility: visible !important;
}

.pagelayer-dark .pagelayer-form-item{
border-bottom: 1px dashed #686870;
}

.pagelayer-form-item:hover .pagelayer-elp-default[data_show=true]{
display:initial;
}

.pagelayer-elp-label-div, .pagelayer-elp-link-label-div{
padding:4px 0px 4px 0px;
position:relative;
}

.pagelayer-elp-label-div[type=select]{
width:50%;
}

.pagelayer-elp-label, .pagelayer-elp-link-label{
display: inline-block;
color: #555;
font-size: 12px;
line-height: 150%;
}

.pagelayer-dark .pagelayer-elp-label,
.pagelayer-dark .pagelayer-elp-link-label,
.pagelayer-dark .pagelayer-post-category, 
.pagelayer-dark .pagelayer-elp-postCategory,
.pagelayer-dark .pagelayer-elp-postdate::-webkit-datetime-edit-second-field{
color:#bdbdbd;
}

.pagelayer-elp-heading{
font-size: 13px;
font-weight:600;
line-height: 150%;
}

.pagelayer-elp-screen{
display: inline-block;
text-align: center;
z-index: 1;
vertical-align: middle;
position: relative;
}

.pagelayer-elp-screen .pli{
padding: 0;
cursor: pointer;
box-shadow: 0 0 0.5rem #babbbc;
height: 30px;
width: 30px;
border-radius: 50%;
line-height: 30px;
transition-duration: 0.1s;
}

.pagelayer-dark .pagelayer-elp-screen .pli{
color:#bdbdbd;
}


.pagelayer-elp-screen .pli-desktop:not(.pagelayer-prop-screen),
.pagelayer-elp-screen .pli-tablet:not(.pagelayer-prop-screen),
.pagelayer-elp-screen .pli-mobile:not(.pagelayer-prop-screen){
position: absolute;
transform: none;
left: 0;
display:none;
opacity:0;
background:#aaaaaa;
color:#ffffff;
}

.pagelayer-dark .pagelayer-elp-screen .pli-desktop:not(.pagelayer-prop-screen),
.pagelayer-dark .pagelayer-elp-screen .pli-tablet:not(.pagelayer-prop-screen),
.pagelayer-dark .pagelayer-elp-screen .pli-mobile:not(.pagelayer-prop-screen){
background:#0d47a1;
}

.pagelayer-elp-screen .pli-desktop.open{
transform: rotate(-90deg) translate(30px, -27px) rotate(90deg);
transition-delay: 0s;
top:-5px;
left: 40px;
opacity:1;
display:block;
}

.pagelayer-elp-screen .pli-tablet.open{
transform: rotate(-90deg) translate(0px, -6px) rotate(90deg);
transition-delay: 0.1s;
top:0px;
left: 40px;
opacity:1;
display:block;
}

.pagelayer-elp-screen .pli-mobile.open{
transform: rotate(-90deg) translate(-30px, -27px) rotate(90deg);
transition-delay: 0.2s;
top:5px;
left: 40px;
opacity:1;
display:block;
}

.pagelayer-elp-screen .pagelayer-prop-screen{
box-shadow: none;
z-index: 2;
font-size: 12px;
height: 20px;
width: 20px;
line-height: 20px;
}

.pagelayer-elp-screen .pli:not(.pagelayer-prop-screen):hover{
background-color: #3E8EF7;
}

.pagelayer-dark .pagelayer-elp-screen .pli:not(.pagelayer-prop-screen):hover{
background-color: #1066fd;
}

.pagelayer-elp-screen .pagelayer-prop-screen:hover,
.pagelayer-typo-default:hover i,
.pagelayer-elp-default:hover i{
color: #3E8EF7;
}

.pagelayer-elp-units{
display: inline-block;
float:right;
padding-top:4px;
}

.pagelayer-elp-units span{
padding:1px 4px;
font-size:12px;
cursor: pointer;
}

.pagelayer-dark .pagelayer-elp-units span{
color:#bdbdbd;
}

.pagelayer-elp-units span[selected] {
color: #3e8ef7;
}

/* Default button css start */
.pagelayer-elp-default{
display:none;
width: 20px;
height: 20px;
cursor: pointer;
margin-left: 4px;
position: absolute;
top: 9px;
}

.pagelayer-elp-default:focus{
outline:none;
}

.pagelayer-elp-default i{
font-size: 10px;
color: black;
}

/* Default button css ends */

.pagelayer-elp-desc, .pagelayer-elp-permalink-a, .pagelayer-elp-link-desc{
color:#757575;
font-size: 12px;
line-height: 20px;
font-style: italic;
margin-top: 5px;
display:block;
word-break: break-word;
}

.pagelayer-elpd-body input,
.pagelayer-elpd-body textarea,
.pagelayer-elpd-body select,
.pagelayer-elpd-body option,
.pagelayer-elp-multiselect{
font-size: 13px !important;
color: #666;
border-radius: unset;
border:1px solid #CCC;
line-height: 26px;
width: 100%;
}

.pagelayer-elp-textarea{
border-radius: 3px !important;
resize:vertical;
}

.pagelayer-dark .pagelayer-elpd-body input,
.pagelayer-dark .pagelayer-elpd-body textarea,
.pagelayer-dark .pagelayer-elpd-body select,
.pagelayer-dark .pagelayer-elpd-body option,
.pagelayer-dark .pagelayer-add-cat-btn input,
.pagelayer-dark .pagelayer-elp-multiselect{
  border:1px solid #6e6d6d;
}

.pagelayer-dark .pagelayer-elpd-body input,
.pagelayer-dark .pagelayer-elpd-body textarea,
.pagelayer-dark .pagelayer-elpd-body select,
.pagelayer-dark .pagelayer-elpd-body option,
.pagelayer-dark .pagelayer-add-cat-btn input,
.pagelayer-dark .pagelayer-elp-multiselect{
color:#bdbdbd;
}

.pagelayer-elpd-body input:focus,
.pagelayer-elpd-body textarea:focus,
.pagelayer-elpd-body select:focus{
border-color: #00A0D2;
box-shadow: 0 0 1px #00A0D2 inset;
}

.pagelayer-elp-button{
text-transform: unset;
border: 1px solid #00A0D2;
font-weight: unset;
font-size: 12px;
margin:5px;
min-height: unset;
background-color: #00A0D2;
color: #fff;
transition: all 0.3s;
border-radius: unset;
border-radius: 2px;
padding: 10px 15px;
cursor:pointer;
}

.pagelayer-elp-button:hover{
background-color: #00A0D2bf;
border-color: #00A0D2;
}

.pagelayer-elp-image-div,
.pagelayer-elp-retina-image-div,
.pagelayer-elp-retina-mobile-image-div{
padding:7px;
width:90%;
margin:5px auto;
height:150px;
position:relative;
border: 1px solid #2EA5DF;
}

/* image drop zone css start */
.pagelayer-elp-drop-zone{
position:absolute;
text-align:center;
width:100%;
height:100%;
top:0;
left:0;
z-index:3;
background-color: #2ea5dff0;
display:none;
}

.pagelayer-elp-drop-zone *{
pointer-events: none;
}

.pagelayer-elp-drop-zone > div{
position: relative;
top: 50%;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
text-align:center;
}

.pagelayer-elp-drop-zone div *{
color:white;
}

.pagelayer-elp-drop-zone div i{
font-size:20px;
}

.pagelayer-elp-drop-zone div h4{
margin: 12px;
}

.pagelayer-elp-img-up-progress {
width: 50%;
margin-left: auto;
margin-right: auto;
background-color: transparent;
border: 2px solid white;
border-radius: 20px;
padding: 4px;
}

.pagelayer-elp-img-up-bar {
width: 3%;
height: 5px;
background-color: white;
line-height: 5px;
text-align: center;
border-radius: 20px;
}
/* image drop zone css start */

.pagelayer-elp-modal,
.pagelayer-elp-access{
cursor: pointer;
padding: 10px;
display: block;
margin: 0 auto;
position: absolute;
font-size:1.5rem;
top: 0px;
right: 12px;
color: #333;
vertical-align: middle;
}

.pagelayer-elp-access .pli-caret-right{
font-size: 18px;
line-height: 1.5;
}

.pagelayer-elp-access .pli-caret-right:hover{
color: #3e8ef7;
}

.pagelayer-elp-access .pli-caret-open:before{
content: "\f0d7" !important;
}

.pagelayer-pro-notice,
.pagelayer-confirm-box-holder {
position: fixed;
top: 0px;
z-index: 10000;
width: 100%;
display: none;
left: 0px;
height: 100vh;
}

.pagelayer-pro-div,
.pagelayer-confirm-box{
margin: 25vh auto;
max-width: 500px;
padding: 20px;
background-color: #fff;
box-shadow: 0 0 15px -5px;
}

.pagelayer-pro-x{
float:right;
font-size: 13px;
cursor: pointer;
}

.pagelayer-pro-head{
text-align: center;
}

.pagelayer-pro-message,
.pagelayer-confirmation-msg{
margin: 25px auto;
font-size: 15px;
padding: 2px 25px;
text-align: center;
line-height: 1.8;
}

.button-pagelayer{
padding: 12px 25px !important;
font-size: 15px !important;
font-weight: bold;
background: #7444fd !important;
color: #fff !important;
border: 1px solid #7444fd !important;
transition: all .3s linear;
cursor: pointer;
text-decoration: none;
display: inline-block;
}

.button-pagelayer:hover{
background: #fff !important;
color: #7444fd !important;
}

.pagelayer-elp-access-holder{
position: absolute;
border: 1px solid #ccc;
top: 42px;
background: #fff;
z-index: 100;
right: 8px;
width: 95%;
box-shadow: 0 0 15px -5px;
display: none;
}

.pagelayer-elp-image{
height: 100%;
-webkit-background-size: cover;
background-size: cover;
background-position: 50%;
cursor:pointer;
}

.pagelayer-elp-image-delete,
.pagelayer-elp-retina-delete,
.pagelayer-elp-retina-mobile-delete,
.pagelayer-elp-image-retina{
cursor: pointer;
position: absolute;
top: 4px;
right: 4px;
background-color: #2EA5DF; 
padding: 5px 9px; 
max-width: 28px;
max-height: 28px;
-webkit-box-sizing: content-box;
-moz-box-sizing: content-box;
box-sizing: content-box;
border-radius: 2px;
}

.pagelayer-elp-image-retina{
right:50px;
}

.pagelayer-elp-image-delete .pli,
.pagelayer-elp-retina-delete .pli,
.pagelayer-elp-retina-mobile-delete .pli,
.pagelayer-elp-image-retina .pli{
color: #fff;
}

.pagelayer-hidden{
display:none !important;
}

.pagelayer-elp-radio-div{
display:flex;
}

.pagelayer-elp-radio:first-child{
border-radius: 4px 0px 0px 4px;
-moz-outline-radius: 7px 0px 0px 7px;
}

.pagelayer-elp-radio:last-child{
border-radius: 0px 4px 4px 0px;
-moz-outline-radius: 0px 7px 7px 0px;
}

.pagelayer-elp-radio{
display: inline-block;
vertical-align: middle;
padding: 6px;
cursor: pointer; 
font-size:12px;
color: #666 !important;
text-decoration: none;
background: #eee;
flex:1;
text-align:center;
}

.pagelayer-elp-radio:hover{
background-color: #4CB5E8 !important;
color:#fff !important;
transition: all 0.3s;
}

.pagelayer-dark .pagelayer-elp-radio{
background-color: #fafafa;
}

.pagelayer-dark .pagelayer-elp-radio:hover,
.pagelayer-dark .pagelayer-elp-radio-active{
background-color:#0d47a1 !important;
}

.pagelayer-elp-radio-active{
background-color: #1A9CDB !important;
color:#ffffff !important;
}

.pagelayer-elp-typo-edit-div,
.pagelayer-elp-color-div-holder{
cursor: pointer;
width: 70px;
height: 30px;
border-radius: 3px;
margin: 0 auto;
position: absolute;
top: 5px;
right: 11px;
border: solid 1px #999;
color: #333;
display: flex;
}

.pagelayer-elp-typo-edit-div{
width: 34px;
}

.pagelayer-elp-color-div{
cursor: pointer;
padding: 3px;
width: 28px;
height: 23px; 
display: block; 	  	
border-radius: 2px; 	  	
margin: 0 auto; 	
position: absolute; 	
top: 5px;
right: 7px;
border: solid 1px #999;
color: #333;
vertical-align: middle;
}

.pagelayer-elp-color-div-holder .pagelayer-elp-color-div{
position: relative;
border: 0px;
height: calc(100% - 6px);
top: 0;
left: 0;
}

.pagelayer-elp-color-preview{
height: 100%;
background-size: cover !important;
border-radius: 2px;
flex: 1;
}

.pagelayer-elp-color-global{
width: 50%;
border-right: 1px solid #999;
display: flex;
align-items: center;
justify-content: center;
}

.pagelayer-elp-global-icon:hover,
.pagelayer-elp-color-global:hover{
color: #137dc5;
}

.pagelayer-elp-typo-edit-div .pli-pencil{
display: flex;
align-items: center;
justify-content: center;
flex: 1;
}

.pagelayer-elp-global-icon:before,
.pagelayer-elp-color-global:before{
content: "\e9c9";
font-family: 'pagelayer', "Font Awesome 5 Free" !important;
}

.pagelayer-white-border{
outline: 1px solid #dfdfdf;
}

.pagelayer-global-selected,
.pagelayer-global-font-list-item:hover,
.pagelayer-global-color-list-item:hover{
background: #f9f9f9;
}

.pagelayer-global-selected:after{
content: "\ea10";
font-family: 'pagelayer', "Font Awesome 5 Free" !important;
color: #137dc5;
}

.pagelayer-global-font-list,
.pagelayer-global-color-list{
position: absolute;
background: #fff;
padding: 10px 0;
z-index: 9999;
border-radius: 4px;
right: 0;
top: 35px;
width: 250px;
display: none;
max-height: 350px;
overflow-y: auto;
font-size: 12px;
box-shadow: 0px 0px 13px rgb(0 0 0 / 30%);
}

.pagelayer-global-font-list-item,
.pagelayer-global-color-list-item{
display: flex;
padding: 10px 20px;
cursor: pointer;
}

.pagelayer-global-font-list-item .pagelayer-global-font-title,
.pagelayer-global-color-list-item .pagelayer-global-color-title{
flex: 1;
}

.pagelayer-global-color-list-item .pagelayer-global-color-pre{
position: relative;
border: 1px solid #f1f1f1;
margin-right: 7px;
padding: 1px;
background-clip: content-box;
}

.pagelayer-global-color-list-item .pagelayer-global-color-pre:before{
content: '';
padding: 0px 10px;
background-color: #ff000000;
background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAALElEQVQYGWO8d+/efwYkoKioiMRjYGBC4WHhUK6A8T8QIJt8//59ZC493AAAQssKpBK4F5AAAAAASUVORK5CYII=);
-webkit-background-size: 12px 12px;
background-size: 6px 6px;
position: relative;
z-index: -1;
}

.pagelayer-global-setting-color{
position: relative;
box-shadow: 0 1px 2px #d2cfcf;
padding: 10px 4px;
margin-bottom: 5px;
margin-top: -10px;
cursor: default;
}

.pagelayer-global-setting-color b{
margin-left: 11px;
}

.pagelayer-global-setting-color .pli{
right: 15px;
position: absolute;
cursor: pointer;
}

.pagelayer-elp-typo-icons .pli-service{
cursor: pointer;
}

.pagelayer-elp-global-typo .pli:hover,
.pagelayer-global-setting-color .pli:hover{
color: #137dc5;
}

.pagelayer-active-global{
color: #137dc5;
}

.pagelayer-blank-preview{
background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAACgBAMAAAB54XoeAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAC1QTFRFAAAAAQEBBQUFDAwM9PT0+vr6/////v7+BAQE+/v7AgIC/f39AwMDDQ0N8/Pzb6ggJQAAAZ5JREFUeJztlr1twzAQhU+tK7ELDDdBNsgO2SAznAr3JAJXWSJp49YLuPAW2cJbhEdSQZBCEMRHgMVj5U80HnkSfz4Ra06eXjSoTvr6HKGGU94o8vBpqPr2LjLUcAr8ikNEnLx6jT93VZxneBn1Zg9uOlxsxO0suTkXfJywTsG5Ok5x9hK0NKM6bhEosh+nq+HJD+c6TmvG2r8RtrMb9g4aOKY3CA0ElyyHcbAHIXNw5Q9bWeLG2aUH80ItU97K8ihlhmmIUFb+dpZvOceNE7fOnz/UsNztHAMEzSwf6idEqTOLHv0R8THc7/o72Qzrl8vMwAVdmreDFhloLxQcCC65QSC45AYfBV0yfGGjtx78cLjrVaHHF/yAhV8B8EsKfo3CL/pRHFZFnIBlCa5z9EP6If1wBdMPe5QleMkNAumHuZ9+SD9cYPphjzpHP6Qf0g9XMP2wR1mCl9wgkH6Y++mH9MMFph/2qHP0Q/oh/XAF0w97lCV4yQ0C6Ye5n35IP1xg+mGPOkc/pB/SD1cw/bBHWYKX3CCQfpj76Yfr+QfwnsxmcLvdhQAAAABJRU5ErkJggg==') !important;
background-size: cover !important;
opacity: 70%;
}

.picker_arrow {
display:none;
}

.picker_wrapper {
top: 13px !important;
right: -15px !important;
font-family: Roboto !important;
font-size: 12px;
border-radius: 4px;
background:#f7f7f7;
}

.picker_done button{
border: #318088 1px solid;
color: #fff;
background: #248a4c;
border-radius: 2px;
font-size: 14px;
line-height: 1.5;
}

.picker_editor input{
font-family: Roboto !important;
font-size: 12px;
}

.pagelayer-elp-color-span{
padding: 2px 0;
height: 28px;
line-height: 28px;
float: left;
font-size: 10px;
}

.pagelayer-elp-color-div .picker_wrapper{
margin-top: 22px !important;
border: 1px solid rgba(0,0,0,0.2) !important;
background: #fff !important;
box-shadow: 0 3px 5px rgba(0,0,0,0.2) !important;
}

.pagelayer-dark .pagelayer-elp-color-div .picker_wrapper{
border: 1px solid #0277bd !important;
background: #252529 !important;
box-shadow: 0 0.5rem 1rem #00000026 !important;
}

.picker_wrapper{
z-index:12 !important;
}

.pagelayer-dark .picker_done button {
border: none;
font-family: roboto;
color: #777;
background-color: #ffffff;
}

.pagelayer-dark .picker_editor input{
color: #bdbdbd;
background-color: #1c1c1f;
}

.pagelayer-elp-remove-color{
background-color:#616161;
position: absolute;
top: 0;
right: 0;
z-index:1;
box-shadow: 0 0 3px #333;
padding: 3px;
border-top-right-radius: 2px;
}

.pagelayer-elp-remove-color .pli:before{
color: #fff;
font-size: 7px;
}

.pagelayer-elp-icon-div{
cursor: pointer;
padding: 6px;
border: solid 1px #d1d1d1;
background: #fffffc;
color: #333;
vertical-align: middle;
width: 126px;
height: 18px;
display: block;
border-radius: 4px;
margin: 0 auto;
position: absolute;
top: 7px;
right: 10px;
}

.pagelayer-dark .pagelayer-elp-icon-div{
background-color: #1c1c1f;
color: #bdbdbd;
border: 1px solid #6e6d6d;
}

.pagelayer-elp-icon-preview{
position: relative;
display: block;
margin-right: 5px;
float: left;
width: 75%;
height: auto;
border: none;
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
}

.pagelayer-elp-icon-preview i{
padding-right: 5px;
font-size: 19px;
color: #666;
vertical-align: middle;
}

.pagelayer-dark .pagelayer-elp-icon-preview i,
.pagelayer-dark .pagelayer-elp-icon-name{
color:#bdbdbd;
}

.pagelayer-elp-icon-name{
font-size: 13px;
}

.pagelayer-elp-icon-open,
.pagelayer-elp-icon-close{
float: right;
font-size: 10px;
padding: 0px;
line-height: 20px;
}

.pagelayer-dark .pagelayer-elp-icon-open,
.pagelayer-dark .pagelayer-elp-icon-close{
color:#bdbdbd;
}

.pagelayer-elp-icon-close{
padding-right: 5px;
font-size: 12px;
}

.pagelayer-elp-icon-remove{
position: absolute;
right: 20px;
font-size: 11px;
top: 10px;
z-index: 10;
}

.pagelayer-elp-icon-selector,
.pagelayer-elp-link-list{
position: absolute;
z-index: 1000;
border: 1px solid rgba(0,0,0,0.2) !important;
background: #fff !important;
box-shadow: 0 3px 5px rgba(0,0,0,0.2) !important;
-webkit-border-radius: 2px !important;
text-shadow: none !important;
padding: 5px;
height: auto;
box-sizing: border-box;
display: none;
width: 80%;
border-radius: 2px;
margin: 0 0 0 auto;
top: 40px;
right: 10px;
}

.pagelayer-dark .pagelayer-elp-icon-selector{
background: #252529 !important;
border: 1px solid #ffffff73 !important;
}

.pagelayer-elp-search-icon{
margin-bottom: 5px !important;
padding: 2px 6px;
line-height: 20px !important;
border-radius: 3px !important;
}

.pagelayer-elp-icon-list{
width: 100%;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
padding: 0;
max-height: 183px;
overflow-y: auto;
}

.pagelayer-elp-icon-list::-webkit-scrollbar {
-webkit-appearance: none;
}

.pagelayer-elp-icon-list::-webkit-scrollbar:vertical {
width: 10px;
}

.pagelayer-elp-icon-list::-webkit-scrollbar-thumb {
border-radius: 8px;
border: 2px solid white;
background-color: rgba(0, 0, 0, .5);
}

.pagelayer-elp-icon-list::-webkit-scrollbar-track { 
background-color: #fff; 
border-radius: 8px; 
} 

.pagelayer-elp-icon-span{
display: block;
margin: 2px;
cursor: pointer;
box-sizing: border-box;
border: 1px solid #dbdbdb;
transition: all 0.3s;
font-size: 13px;
padding: 3px;
}

.pagelayer-dark .pagelayer-elp-icon-span,
.pagelayer-dark .pagelayer-elp-icon-span i{
color:#bdbdbd;
}

.pagelayer-elp-icon-span:hover{
border-color: #00A0D2;
background-color: #3e8ef7;
color: #ffffff;
box-shadow: 0px 1px 1px #3e8ef7bf;
}

.pagelayer-elp-icon-span i{
font-size: 15px;
line-height: 1em;
padding: 3px;
color: #555;
transition: all 0.3s;
vertical-align: middle;
}

.pagelayer-elp-icon-span:hover i{
color: #ffffff;
}

.pagelayer-elp-icon-type{
display:flex;
flex-grow:1;
text-align:center;
}

.pagelayer-elp-icon-type p{
flex-grow: 1;
padding: 5px 0;
margin: 0 0 3px;
cursor: pointer;
font-size: 12px;
background: #999;
color: #ffffff;
border: 1px solid #777;
}

.pagelayer-elp-icon-type p.active{
background-color:#666666;
}

.pagelayer-dark .pagelayer-elp-icon-type p.active{
background: #0277bd;
}

.pagelayer-elp-icon-sets{
line-height: 27px;
height: 27px;
border-radius: 4px;
margin: 5px 0;
}

.pagelayer-video{
width: 100% !important;
/* background: #ccc; */
position: relative;
/* top: -40px;
float: right;
border-radius: 0px 4px 4px 0px; */
}

.pagelayer-video i{
top: 10px;
position: relative;
left: 8px;
}

.pagelayer-elp-slider-div{
display: flex;
padding: 7px 0 0;
}

input.pagelayer-elp-slider{
-webkit-appearance: none;
width: 70%;
height: 10px;
border-radius: 5px;
background-color: #d3d3d3 !important;
outline: none;
opacity: 0.7;
-webkit-transition: .2s;
transition: opacity .2s;
font-size: 0px !important;
padding: 0;
}

.pagelayer-elp-slider:focus{
border-color: transparent;
box-shadow: 0 0 1px transparent;
}

.pagelayer-elp-slider:hover{
opacity: 1;
}

.pagelayer-elp-slider::-webkit-slider-thumb{
-webkit-appearance: none;
appearance: none;
width: 15px;
height: 15px;
border-radius: 50%;
background: #4CAF50;
cursor: pointer;
}

.pagelayer-dark .pagelayer-elp-slider::-webkit-slider-thumb{
background: #3e8ef7;
}

.pagelayer-elp-slider::-moz-range-thumb{
width: 15px;
height: 15px;
border-radius: 50%;
background: #00A0D2;
cursor: pointer;
}

.pagelayer-elp-slider-value{
width: 23% !important;
margin-left: 7%;
margin-top: -12px;
border-radius: 3px !important;
padding: 2px 2px 2px 6px;
border: 0px solid #fff !important;
border-bottom: 1px solid #ccc !important;
}

.pagelayer-elp-datetime-div{
position: relative;
}

.pagelayer-elp-postdate-div{
display: flex; 
border: 1px solid lightgrey; 
border-radius:3px;
}

.pagelayer-elp-datetime{
width: 99%;
}

.pagelayer-elp-postdate{
border: none !important; 
outline: none;	
}

.pagelayer-elp-postdate::-webkit-calendar-picker-indicator {
cursor: pointer;
}

.pagelayer-elp-fa-calendar{
position: absolute;
height: 40px;
width: 40px;
background: #000;
right: 0;
top: 0;
}

.pagelayer-elp-checkbox-div{
top: 13px;
right:7px;
position: absolute;
}

input[type="checkbox"].pagelayer-elp-checkbox{
font-size: 30px;
-webkit-appearance: none;
-moz-appearance: none;
	appearance: none;
width: 3.5em;
height: 1.7em;
background: #ddd;
border-radius: 3em;
position: relative;
cursor: pointer;
outline: none;
-webkit-transition: all .2s ease-in-out;
transition: all .2s ease-in-out;
}

input[type="checkbox"].pagelayer-elp-checkbox:checked{
background-color: #1A9CDB;
border-color: #1A9CDB;
}

.pagelayer-dark input[type="checkbox"].pagelayer-elp-checkbox:checked{
background-color: #0d47a1;
}

input[type="checkbox"].pagelayer-elp-checkbox:after{
position: absolute;
content: "";
width: 1.5em;
height: 1.5em;
border-radius: 50%;
background: #fff;
-webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
	box-shadow: 0 0 .25em rgba(0,0,0,.3);
-webkit-transform: scale(.7);
	transform: scale(.7);
left: 0;
-webkit-transition: all .2s ease-in-out;
transition: all .2s ease-in-out;
}

input[type="checkbox"].pagelayer-elp-checkbox:checked:after{
left: calc(100% - 1.5em);
}

.pagelayer-elp-input-icon,
.pagelayer-elp-pos-rel{
position: relative;
}

.pagelayer-elp-link-no-addons > .pagelayer-elp-link{
width:100% !important;
}

.pagelayer-elp-link-no-addons > .pagelayer-elp-link-icon{
display:none !important;
}

.pagelayer-elp-input-icon input{
width: 85%;
}

.pagelayer-elp-input-icon i.pli{
padding:1px 10px;
position:relative;
top:0px;
border: 1px solid #d1d1d1;
border-left:0px;
cursor: pointer;
background:#FFF;
line-height:26px !important;
font-size: 13px;
}

.pagelayer-dark .pagelayer-elp-input-icon i.pli{
background: #e0e0e0;
}

.pagelayer-elp-padding-div i.pli{
padding:8px 11px;
border: 1px solid #d1d1d1;
border-left:0px !important;
cursor: pointer;
background: #FFF;
vertical-align:top;
font-size: 12px;
border-top-right-radius: 3px;
border-bottom-right-radius: 3px;
}

.pagelayer-elp-padding-linked{
background: #1a7fb0 !important;
color: #fff !important;
border: 1px solid #1a7fb0 !important;
}

.pagelayer-elp-padding:first-child{
border-top-left-radius: 3px;
border-bottom-left-radius: 3px;
}

.pagelayer-dark .pagelayer-elp-padding-linked{
background: #e0e0e0 !important;
}

.pagelayer-elp-dimension-div i.pli{
padding:8px 11px;
border: 1px solid #d1d1d1;
border-left:0px !important;
cursor: pointer;
background: #FFF;
vertical-align:top;
font-size: 12px;
border-top-right-radius: 3px;
border-bottom-right-radius: 3px;
}

.pagelayer-elp-dimension-linked{
background: #1a7fb0 !important;
color: #fff !important;
border: 1px solid #1a7fb0 !important;
}

.pagelayer-elp-dimension:first-child{
border-top-left-radius: 3px;
border-bottom-left-radius: 3px;
}

/* Pagelayer Multi Select Property */
.pagelayer-elp-multiselect{
min-height: 25px;
width:95%;
}

.pagelayer-elp-multiselect-ul{
list-style:none;
padding:0;
margin:0;
display:none;
border: 1px solid #CCC;
border-radius: 0 0 5px 5px;
border-top:none;
position:absolute;
background:rgb(255, 255, 255);
z-index:1;
width:99%;
}

.pagelayer-dark .pagelayer-elp-multiselect-ul{
background: #1c1c1f;
border: 1px solid #6e6d6d;
border-top: none;
box-shadow: 0 0.5rem 1rem #00000026;
}

.pagelayer-elp-multiselect-option{
font-size:13px;
padding:4px 8px;
cursor:pointer;
}

.pagelayer-dark .pagelayer-elp-multiselect-option{
color: #777;
}

.pagelayer-elp-multiselect-option[selected="selected"]{
background: #f2f2f2;
}

.pagelayer-elp-multiselect-remove{
color: #f2f2f2;
padding-left: 2px;
cursor: pointer;
}

.pagelayer-dark .pagelayer-elp-multiselect-option[selected="selected"]{
background: #0277bd;
color: #fff;
}

.pagelayer-elp-multiselect-selected{
padding: 3px 5px;
border-radius: 5px;
margin: 2px;
background: #44a9db;
line-height: 13px;
font-size: 13px;
color: #fff;
}

.pagelayer-dark .pagelayer-elp-multiselect-selected{
color: #777;
background: #ffffff;
}

.pagelayer-elp-multiselect{
display: flex;
flex-wrap: wrap;
padding: 5px;
border-radius: 3px;
}

/* Pagelayer Multi Select Property end*/

.pagelayer-elp-multi_image{
padding: 3px;
width: 60%;
margin: 5px auto;
border: 1px solid #d5dadf;
position: relative;
text-align: center;
background: #4CBCDF;
color: #fff;
font-size: 13px;
cursor: pointer;
}

.pagelayer-elp-multi_image{
height: 100%;
-webkit-background-size: cover;
background-size: cover;
background-position: 50%;
}

.pagelayer-elp-multi_image-thumbs{
margin-top:10px;
}

.pagelayer-elp-multi_image-thumb{
display: inline-block;
width: 44px;
height: 44px;
background-size: cover;
background-position: 50% 50%;
margin: 0 7px 0 0;
border: 2px solid #d5dadf;
}

.pagelayer-grid-columns-1 .pagelayer-grid-item{
width: 100%;
}

.pagelayer-grid-columns-2 .pagelayer-grid-item{
width: 50%;
}

.pagelayer-grid-columns-3 .pagelayer-grid-item{
width: 33%;
}

.pagelayer-grid-columns-4 .pagelayer-grid-item{
width: 25%;
}

.pagelayer-grid-columns-5 .pagelayer-grid-item{
width: 20%;
}

.pagelayer-grid-columns-6 .pagelayer-grid-item{
width: 16%;
}

.pagelayer-grid-columns-7 .pagelayer-grid-item{
width: 14%;
}

.pagelayer-grid-columns-8 .pagelayer-grid-item{
width: 12%;
}

.pagelayer-grid-columns-9 .pagelayer-grid-item{
width: 11%;
}

.pagelayer-grid-columns-10 .pagelayer-grid-item{
width: 10%;
}

.pagelayer-grid-item{
float: left;
}

.pagelayer-elp-audio-div,
.pagelayer-elp-media-div{
position: relative;
}

.pagelayer-elp-audio,
.pagelayer-elp-media{
width: calc(100% - 40px);
}

.pagelayer-elp-audio-insert,
.pagelayer-elp-media-select{
position: absolute;
top: 0;
right: 0;
background-color: #000;
height: 100%;
width: 40px;
-webkit-box-sizing: content-box;
-moz-box-sizing: content-box;
box-sizing: content-box;
}

.pagelayer-elp-shadow-div,
.pagelayer-elp-typo-div,
.pagelayer-elp-filter-div{
padding: 0px 10px;
box-shadow: 0px 0px 13px rgba(0,0,0,.3);
position: relative;
margin-top: 8px;
border: 1px solid #ddd;
display: none;
position: absolute;
background-color: #fff;
width: 86%;
z-index: 12;
}

.pagelayer-typo-default{
display:none;
width: 20px;
height: 20px;
cursor: pointer;
margin-left: 4px;
}

.pagelayer-global-on .pagelayer-elp-typo:not([pagelayer-set-global]):hover .pagelayer-typo-default{
display: inline-block;
}

.pagelayer-dark .pagelayer-elp-shadow-div,
.pagelayer-dark .pagelayer-elp-typo-div,
.pagelayer-dark .pagelayer-elp-filter-div{
background-color:#252529;
}


.pagelayer-prop-edit{
padding: 7px;
border: 1px solid #3e8ca4;
width: 20px;
position: absolute;
top: 7px;
right: 11px;
text-align: center;
cursor: pointer;
border-radius: 3px;
}

.pagelayer-prop-edit i{
font-size: 14px;
color: #484848;
}

.pagelayer-dark .pagelayer-prop-edit i{
color:#bdbdbd;
}

.pagelayer-prop-show{
display: block;
}

.pagelayer-elp-shadow-color{
padding: 15px 0px !important;
}

.pagelayer-elp-shadow-color .pagelayer-elp-color-div{
top:7px;
}

.pagelayer-elp-typo,
.pagelayer-elp-prop-grp{
margin: 0px;
padding: 10px 0;
position: relative;
border-bottom: 1px dashed #ccc;
}

.pagelayer-elp-typo-fonts{
padding: 10px 0;
}

.pagelayer-elp-gradient-div .pagelayer-elp-prop-grp{
padding: 5px 0;
}

.pagelayer-elp-gradient-color{
padding: 15px 0px !important;
}

.pagelayer-elp-prop-grp .pagelayer-elp-color-div{
right: 0;
}

.pagelayer-elp-typo-fonts .pagelayer-elp-label,
.pagelayer-elp-typo .pagelayer-elp-label,
.pagelayer-elp-typo .pagelayer-elp-typo-input,
.pagelayer-elp-shadow-div .pagelayer-elp-shadow-input,
.pagelayer-elp-shadow-div .pagelayer-elp-label,
.pagelayer-elp-prop-grp>label, .pagelayer-elp-prop-grp>input{
width: 50%;
}

.pagelayer-elp-filter-div .pagelayer-elp-label{
width:40%;
text-transform: capitalize;
}

.pagelayer-elp-filter-div .pagelayer-elp-filter-val{
float:right;
width:10%;
font-size:13px;
text-align: right;
}

.pagelayer-elp-filter-input{
background-position: center center !important;
background-size: cover !important;
}

.pagelayer-elp-filter-blur .pagelayer-elp-filter-input{
background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAAAKCAIAAAC2Wq7lAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAABq9JREFUeJyVlmtvHGcZhnfOszs7u+s9ENtrI9eqHbWJKSSIlBz4QD/mFxQpUvlSviTKb4nyC4qI/0HkCCgijapQQJBDUe04uPEh69re887OeXa43l2wjNsK+toejd/Dc7if+7nfUTMnhiRJGxsbS0tLk3/TNL1+/fra2hrzvPO8c+fOzZs3eZlsuHv37u3btydL5XL5xo0bv/rwwzeXl9Ikff16b+3Bg3v3fvPs6bMwiqbPTF/92ZX33//FpUvvFoulfq/7ycOHH/36o4d//MRxBpZlrays/PKDD35y6d36XN31gid//9tvf/+7x59+2mg0dF1fXlq6cuXylWvXzp07Z1mFXrfz4MHaxx//YfPFJsZnpqdXfnD+xxcvnHv7fC6fazVbX6x/8fTpsxebm439fU2RL1648NPLl996620rb3W73a1/bj198qTf7w+HQ1mWK5XqwsLC4uIbc3PzZGGYpnoSFNI7hdHJ+cnzePLUkpSRcCBl+M2MmMiMt6X8iCOSzIIcR3E6GmVGYrBDVbSJH1lRVE1jb5ImSRJHYRDFIYYUVcWmooi/NMPxxHN9TdWTUYJFlaEpo1Ey9ithM0wiY5TESYJ5JnVVsy0rCAMiGKWjGMsRxiN84F04HdtniLNh6HpD3cV4pE7yPAXHdx0AJSsydoAjEYOcE/AAJwInYk3TFUmJRUj8BmEYEAd14xSR6brBIALf87udnuP0Qz9UJNk09FwuB1N0zQBkTkErUPA8V1Uk3dBY5bhh6rgOwngwcMjQ9704jgEym8vaUUHxXFCnHr7rEtbQdclfkSRN1UamqcgCGvY7w2Gn3QY2w/hvpvzP8Y3YaZqmKEo2m6V6QeA3j5ps6/UHVCyXs6q1ipRK5UpFMwzHcZuHRy7+3SGh66o+NTWVy+aKpSIjDMJWu+UMnTiISF5RlalyGWRVTS8UberW7fb2Gw3o7flelMRWLletVuM4sW2bzFzPPTo88L3hYIBxn5DsQkFVVDvOg6rn+c1WS9XUoQMsrgLfMikuqCTPKI4H/T5wD5wh7FOXl5dPpkoPZ/7TI8yXSiUkZqIazERRtLm5ebwK5Kx+f34eOArFAqX7/PN/sEYvhUHgDoeLiwv1+kwmIxMWiR8eHv75r3+hG8DLGQyKUyWEAmJTq0ql0h/0Xmxs0gppOgr8APq8sbBQn63Td1SPIn/1VaPdbkEB2if0Pdsu6JrOvGgjVe11up7r8g5RAUXT1XKplNgFyKtrGgoSBPRRZiTaM6JzsZOKSDOQKwrDbg+GOmO+y+r6+vpJFM6ePUvaxxjdv39/dXX1mCbIKiAer966dQthfvnyJe8k/OjRo9XVewHM1xTKuLi4ePXqtWKhQBsBEHB/+erVZ5/9icY2dL1aq62snH/vvZ+riuIF/u727s7Oq3bnS/BCROx8ng1z9Xo2myNJ+gISbW/vuq4DNci8YNsz0zPWzKysSHgE4k67gyiQHt1ocz6fL+RtpIoeBqz2mIMoGq2IzaxpGYomKRJZoTXoTuQQVyhUD5RPCufXxeXU6td7h0nIIgTCsh4/fry9s7O7vaPq2vSZM3VIMjMDymw6OjwcOA6RPX/+nILYBfvijy5C/nfe+aGZNTutdhxGGxvrW1tbFBnI5ufnZ2frXAe1ahV67uy9braahwcHjf0GG/JWntU3l5bn6rOarnGh+J4HF/YPGv3+oFCwOVgqTnHNWfm8Zuh7O7ugtvd6j7zptVqtlsvm6XpVVwGFvsNFr99z+gPXE3r03TTl24agnCbwTeKYhleiwPeLIGUY+qThCRo+kw+hkwMt44d+LitqZuWsJIooLPVAjziezZrgpQpRsCu1KlrT6XSoFaU+ah6hCHE5LpWn2MbT0HTuG2jv+m6r2ez1+3RfrfY9lAKbpakSXg729yFjt9MlAHhB37GHypkml1WC7KOvQ8dpddqD3iCMwtOgfCMd/g9QRGdK8r9Pi9tnNLm/meTuU4SkISVQfzxgKfCNnbEuIaW6afDmieEyzU6eKJGhm7xABzkViuaLdS/MR5mxwIML9xo/7EEsh8gpIwjxgDvDFIhTDFzgjoWh5xqmkaRxmqGPVNM0Y24iWVznrDoDB0wxoPK/NB6Zb7lcjsfxd8rJbccaLGUmZmTesUnSkw8YMS+WBGbEmo4H6bFH3Nniw0boP1o4/npJyI1bQHzfjIGGAjIfInQ/oScjUBWWU1IyIKAi8YcEKSIqnEZjGyPxoYJZ7hGuv3gUTeJEnpMoGX8riY8n4skqemRIqixAoAxQBtCHvvcv+qJRH7fzah8AAAAASUVORK5CYII=') !important;
}

.pagelayer-elp-filter-contrast input{
background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAAAKCAMAAAAU2ikOAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAklQTFRFAAAAAgICAwMDBAQEBgYGCAgICwsLAQEBISEhJSUlKioqLy8vNDQ0WFhYXl5eZWVla2trcXFxmpqaoKCgpqamra2ts7OzJiYm1dXV2dnZ3t7e4uLi5ubm2tra+/v7/Pz8/f39/v7+////BQUFBwcHGhoaHh4eIyMjJycnLCwsTk5OVFRUWlpaYWFhaGhoj4+PlpaWnZ2do6Ojqqqqzc3N0tLS19fX3Nzc4ODg9/f3+vr6FBQUGBgYHBwcICAgRUVFS0tLUVFRV1dXhYWFjIyMkpKSmZmZn5+fxMTEysrKz8/P1NTU9PT09vb2+fn5Dw8PEhISFhYWPDw8QUFBSEhIe3t7goKCiIiIu7u7wcHBx8fHzMzM0dHR7+/v8vLy9fX1CgoKDQ0NEBAQFxcXOTk5Pj4+SkpKd3d3fn5+i4uLsrKyuLi4vr6+ycnJ6urq7e3t8PDw8/PzBQYHBQUGBAQFAwMEAgMDFRUVGRkZHR0dIiIiR0dHTU1NYGBglZWVm5uboqKixsbG1tbW29vbBgcIBAUGAwQFExMTGxsbHx8fREREUFBQVlZWhISEkZGRmJiYvb29w8PDzs7O09PT+Pj4AAABDAwMDg4OERERNTU1Ozs7RkZGTExMdHR0enp6gICAjo6OJCQktLS0urq6wMDAy8vL6+vr7u7uAQECLS0tMjIyODg4Q0NDaWlpcHBwdnZ2fX19q6ursbGxt7e35eXl6enpCQkJKysrMDAwX19fbGxsc3NzeXl5oaGhqKiorq6u39/f4+Pj5+fnrIREkAAAAeZJREFUeJxd0Pk/FHEcx/Hv7OLblrvD1S675cjKolJLOVJSIVKtctOKStaQIyKZEuWqJEI50h0lkXT5yzLvT4N2fpnnYx6Pz+vxmQ9jK4+gUjs4OgmMM2GDZuMmZ8jF1c3dQyXLc/OWrdu8ZHn7+Ppth7Q6/wA9yWAwQBxieLig2rGTywgMCg7ZBYUaw3aHQ6aIyKg9Gll790XvPwBpzTG6AJKcWRP7V+QqNRB78FCcBopPSDzsCiUdOZp8DB9Tjp846QNpU9PSY0j2Qa4sidepjMzAIOh01plQI3T2nMUUgeHs8xdycimTl19gXg0a1sQEzinKUS4sKo4tgZwvWuNLIY9LZUnlGLl85WpKBQ1fq7RV/b8hiYnVNddr+eolobr6hhshUGOTMewmZDE1t9zCXGtO7u02KhSY03V2VSaJ4p27TDkl/Xdxe8m9DsjaWXr/AVTWVd7dg5HevoqHjyhjq0p7bPffTJIksRrqZ8pBnww8rauHBoeyng1DI6PPLS/GZI1PTLa+hNqmXuWnkuTgmBKUROg1VxZ1XLlkO/Tm7Tvre+jDx+mZLuzw6fNsbx/t9WWu0kbSr99QkpCqFXg/BdUOX50G8M1rfmFwCPrmtvh9CSM/fv4an6DM7z/LUyR/vZ5u+BdDtnhZvafUoAAAAABJRU5ErkJggg==') !important;	
}

.pagelayer-elp-filter-brightness input{
background-image: linear-gradient(90deg,#000,#fff);
}

.pagelayer-elp-filter-grayscale input{
background-image: linear-gradient(90deg, rgba(203,20,106,1) 0%, rgba(88,88,88,1) 56%);
}

.pagelayer-elp-filter-hue input{
background-image: linear-gradient(90deg,red,orange,#ff0,#adff2f,#32cd32,#00bfff,blue,#9400d3 95%);
}

.pagelayer-elp-filter-saturate input{
background-image: linear-gradient(90deg,gray,red);
}

.pagelayer-elp-filter-opacity input{
background-image: linear-gradient(90deg,#fff,#000);
}

.

.pagelayer-elp-typo-fonts .pagelayer-elp-label,
.pagelayer-elp-typo .pagelayer-elp-label{
font-weight: 600;
font-size: 11px;
color: #555;
}

.pagelayer-elp-global-typo{
box-shadow: 0 2px 2px -1px #d2cfce;
margin: -10px -10px 0 -10px;
padding: 8px 10px;
display: flex;
}

[pagelayer-screen-mode="desktop"] [pagelayer-show-device]:not([pagelayer-show-device="desktop"]),
[pagelayer-screen-mode="tablet"] [pagelayer-show-device]:not([pagelayer-show-device="tablet"]),
[pagelayer-screen-mode="mobile"] [pagelayer-show-device]:not([pagelayer-show-device="mobile"]){
display:none;
}

.pagelayer-elp-global-typo .pagelayer-elp-typo-icons{
text-align: right;
width: 50%;
}

.pagelayer-elp-global-typo .pagelayer-global-font-list{
width: 100%;	
}

.pagelayer-elp-typo-icons .pagelayer-elp-global-icon{
margin-right: 10px;
cursor: pointer;
}

.pagelayer-dark .pagelayer-elp-typo .pagelayer-elp-label{
color:#bdbdbd;
}

.pagelayer-elp-typo select.pagelayer-elp-typo-input,
.pagelayer-elp-typo-input,
.pagelayer-elp-shadow-input{
padding: 3px;
border-radius: 4px !important;
line-height: 23px !important;
}

.pagelayer-dark .pagelayer-elp-typo select.pagelayer-elp-typo-input{
background-color: #252529;
}

.pagelayer-elp-grad-color{
position:relative;
}

/* Left side menu Input related */
.pagelayer-elp-text,
.pagelayer-elp-spinner,
.pagelayer-elp-tinymce-textarea,
.pagelayer-elp-tinymce {
border-radius: 2px !important;
}

.pagelayer-post-type{
text-transform: capitalize;
}

.pagelayer-elp-text{
padding-left:5px;
}

.pagelayer-elp-select-div,
.pagelayer-elp-spinner-div{
width: 50%;
right: 10px;
position: absolute;
top: 7px;
}

.pagelayer-elp-spinner-div{
width:85px;
}

.pagelayer-elp-spinner{
padding: 2px 0 2px 6px;
border-radius: 4px !important;
}

.pagelayer-elp-select {
font-size: 16px;
font-weight: 700;
color: #444;
line-height: 1.3;
padding: 2px 2px 2px 6px;
width: 100%;
max-width: 100%;
margin: 0;
border: 1px solid #aaa;
border-radius: 3px !important;
box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
-moz-appearance: none;
-webkit-appearance: none;
appearance: none;
background-image: linear-gradient(45deg, transparent 50%, #1A9CDB 50%), linear-gradient(135deg, #1A9CDB 50%, transparent 50%);
background-position: right .9em top 50%, right .55em top 50%;
background-size: 5px 5px, 5px 5px;
background-repeat: no-repeat;
}
.pagelayer-elp-select::-ms-expand {
display: none;
}
.pagelayer-elp-select:hover {
	border-color: #888;
}
.pagelayer-elp-select:focus {
border-color: #aaa;
box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
box-shadow: 0 0 0 3px -moz-mac-focusring;
color: #222;
outline: none;
}
.pagelayer-elp-select option{
font-weight:normal;
}

.pagelayer-dark .pagelayer-elp-select-div .pagelayer-elp-select,
.pagelayer-dark .pagelayer-elp-typo-input .pagelayer-elp-select,
.pagelayer-dark .pagelayer-parent-category .pagelayer-add-cat{
background-color: #252529;
color:#bdbdbd;
}

.pagelayer-elpd-body input:focus,
.pagelayer-elpd-body textarea:focus,
.pagelayer-elpd-body select:focus {
border-color: #3e8ef7;
box-shadow: unset;
}

.pagelayer-elp-group-item{
border: 1px solid #777;
font-size: 13px;
margin-bottom: 10px;
}

.pagelayer-elp-group-item .pagelayer-form-item{
padding: 10px 0px 10px 0px;
}

.pagelayer-elp-group-item .pagelayer-elp-select-div,
.pagelayer-elp-group-item .pagelayer-elp-spinner-div,
.pagelayer-elp-group-item .pagelayer-elp-color-div{
right:0px;
}

.pagelayer-elp-group-item-head{
display:flex;
background: #F8F8F8;
}

.pagelayer-dark .pagelayer-elp-group-item-head{
background:#252529;
}

.pagelayer-elp-group-item-head span{
cursor: pointer;
padding: 9px;
display:inline-block;
}

.pagelayer-dark .pagelayer-elp-group-item-head span{
color:#bdbdbd;
}

.pagelayer-elp-group-item-head .pagelayer-elp-group-item-drag:hover {
cursor:all-scroll;
}

.pagelayer-elp-group-item-title{
flex-grow: 100;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}

.pagelayer-elp-group-item-del{
float: right;
}

.pagelayer-elp-group-item-body{
display: none;
padding: 7px 10px;
}

.pagelayer-elp-group-item-clone{
padding-right:0px !important;	
}

.pagelayer-elp-padding{
width:21% !important;
}

.pagelayer-elp-dimension{
width:42% !important;
}

/* END Element Properties Dialog classes */

/* Widget Parameters */

.pagelayer-widgets-form input,
.pagelayer-widgets-form select,
.pagelayer-widgets-form textarea {
border: 1px solid #ddd;
box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
background-color: #fff;
color: #32373c;
outline: 0;
transition: 50ms border-color ease-in-out;
font-size: 15px !important;
line-height: 150% !important;
}

.pagelayer-widgets-form select{
padding:5px;
}

.pagelayer-widgets-form input[type="checkbox"]{
width: auto;
}

.pagelayer-widgets-form{
line-height:150%;
border-top: none;
padding: 8px;
}

.pagelayer-dark .pagelayer-widgets-form label{
color:#bdbdbd;
}

.pagelayer-dark .pagelayer-widgets-form input,
.pagelayer-dark .pagelayer-widgets-form select,
.pagelayer-dark .pagelayer-widgets-form textarea {
color:#bdbdbd;
background-color:#1c1c1f;
border:1px solid #6e6d6d;
}

/* End Widget Parameters */

.trumbowyg-box{
margin-top:0px !important;
}

.trumbowyg-editor{
min-height: 250px !important;
padding: 10px !important;
}

/* Pagelayer Left bar */

.pagelayer-topbar-holder{
background-color: #4CB5E8;
position:relative;
animation: colorchange 30s infinite alternate;
-webkit-animation: colorchange 30s infinite alternate;
}

@keyframes colorchange{
0%   {background: #3e0772;}
25%  {background: #209ce2;}
50%  {background: #00838c;}
75%  {background: #088dce;}
100% {background: #3d5afe;}
}

.pagelayer-topbar-mover{
cursor: all-scroll;
}

.pagelayer-logo{
font-size:18px;
font-weight: bold;
display: block;
text-align:center;
vertical-align:middle;
color:#fff;
width:76%;
}

.pagelayer-logo-text{
font-weight: bold;
margin-left: 5px;
line-height: normal;
vertical-align: super;
}

.pagelayer-settings-icon{
padding-right:10px;
cursor: pointer;
position: absolute;
right: 5px;
top: 50%;
transform: translateY(-50%);
}

.pagelayer-options-icon{
padding-left:10px;
cursor: pointer;
position: absolute;
left: 5px;
top: 50%;
transform: translateY(-50%);
font-size: 18px !important;
color: #ffffff;
}

.pagelayer-leftbar{
width:270px !important;
padding-top:0;
background-color: #E3E3E3;
overflow: hidden;
background: -moz-linear-gradient(224deg, rgba(222,222,222,1) 0%, rgba(191,202,214,1) 100%);  /* ff3.6+ */
background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(191,202,214,1)), color-stop(100%, rgba(222,222,222,1))); /* safari4+,chrome */
background: -webkit-linear-gradient(224deg, rgba(222,222,222,1) 0%, rgba(191,202,214,1) 100%); /* safari5.1+,chrome10+ */
background: -o-linear-gradient(224deg, rgba(222,222,222,1) 0%, rgba(191,202,214,1) 100%); /* opera 11.10+ */
background: -ms-linear-gradient(224deg, rgba(222,222,222,1) 0%, rgba(191,202,214,1) 100%); /* ie10+ */
background: linear-gradient(226deg, rgba(222,222,222,1) 0%, rgba(191,202,214,1) 100%); /* w3c */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#BFCAD6', endColorstr='#DEDEDE',GradientType=1 ); /* ie6-9 */
}

.pagelayer-dark .pagelayer-leftbar{
background: unset !important;
background-color: #1c1c1f !important;
}

.pagelayer-leftbar-search{
text-align:center;
margin: 20px 40px 10px 25px;
position:relative;
}

.pagelayer-search-field{
width:100%;
line-height:120%;
padding: 5px 20px 5px 30px;
border-radius: 5px;
border: none;
font-size: 14px;
height:30px;
}

.pagelayer-widget-search .pli,
.pagelayer-leftbar-search .pli{
position: absolute;
top: 0;
height: 30px;
padding: 0 7px;
color: #666;
line-height: 30px;
}

.pagelayer-widget-search .pagelayer-sf-empty,
.pagelayer-leftbar-search .pagelayer-sf-empty{
right:0;
left:auto;
font-weight:bolder;
cursor:pointer;
}

.pagelayer-shortcodes{
margin-left:17px;
}

.pagelayer-widget-group,
.pagelayer-leftbar-group{
width: 100%;
background-repeat: no-repeat;
background-position: center;
font-size: 11px !important;
color: #442E2E;
clear: both;
text-align: center;
font-family: Roboto, 'Open Sans', Arial, sans-serif !important;
margin-bottom: 2px;
}

.pagelayer-widget-group h5,
.pagelayer-leftbar-group h5{
font-size: 11px;
line-height: 20px;
text-transform: uppercase;
color: #777;
padding: 5px 0 3px;
margin: 5px;
}

.pagelayer-global-widget-pro{
text-align: center;
margin-right: 10px;
padding-top: 20px;
font-size: 14px;
}

.pagelayer-shortcode-holder,
.pagelayer-shortcode-drag{
width: 100px !important;
height:67px !important;
margin-bottom:12px; 
margin-left:12px;
background-color: #FFFFFF;
border-radius: 4px;
float: left;
transition: all 0.1s;
}

.pagelayer-dark .pagelayer-shortcode-drag,
.pagelayer-dark .pagelayer-shortcode-drag:hover{
background-color:#252529;
box-shadow:0 0.5rem 1rem #00000026;
}

.pagelayer-shortcode-holder:hover,
.pagelayer-shortcode-drag:hover{
transform: scale(1.06);
}

.pagelayer-sc{
padding: 4px !important;
margin: 4px auto 0 auto !important;
cursor: move;
}

.pagelayer-shortcode-inner{
height: 25px;
padding: 0px !important;
}

.pagelayer-shortcode-text{
display: -webkit-box;
-webkit-box-orient: vertical;
-webkit-line-clamp: 3;
font-family: Roboto, 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 11px !important;
font-style: normal;
line-height: 125%;
margin: 0;
overflow: hidden;
cursor: move;
text-overflow: ellipsis;
text-align: center;
width: 100%;
margin-top: 3px;
color: #777;
transition: all 0.3s;
padding:1px;
}

.pagelayer-leftbar-search-empty{
display: none;
padding: 40px;
text-align: center;
color: #777;
font-family: 'Roboto';
}

.pagelayer-leftbar-search-empty p{
margin: 8px;
}

.pagelayer-leftbar-search-empty .fa-sad-tear{
font-size: 24px;
}

.pagelayer-dark .pagelayer-shortcode-text{
color: #bdbdbd;
}

.pagelayer-shortcode-drag:hover .pagelayer-shortcode:before,
.pagelayer-shortcode-drag:hover .pagelayer-shortcode-text{
color: #00A0D2;
}

.pagelayer-dark .pagelayer-shortcode-drag:hover .pagelayer-shortcode:before,
.pagelayer-dark .pagelayer-shortcode-drag:hover .pagelayer-shortcode-text{
color: #3d5afe;
}

/* Trumbowyg color widget style */
.trumbowyg-dropdown-foreColor,
.trumbowyg-dropdown-backColor {
width: 100% !important;
max-width: 250px !important;
padding: 7px 5px;
left:0 !important;
}

.trumbowyg-dropdown-foreColor svg,
.trumbowyg-dropdown-backColor svg {
display: none !important;
}

.trumbowyg-dropdown-foreColor button[type="button"],
.trumbowyg-dropdown-backColor button[type="button"] {
display: block;
position: relative;
float: left;
text-indent: -9999px;
height: 20px;
width: 20px;
max-height:27px;
max-width:27px;
border: 1px solid #333;
padding: 0;
margin: 2px;
}

.trumbowyg-dropdown-foreColor button[type="button"]:hover::after,
.trumbowyg-dropdown-backColor button[type="button"]:hover::after,
.trumbowyg-dropdown-foreColor button[type="button"]:focus::after,
.trumbowyg-dropdown-backColor button[type="button"]:focus::after{
content: " ";
display: block;
position: absolute;
top: -5px;
left: -5px;
height: 27px;
width: 27px;
max-width:27px;
background: inherit;
border: 1px solid #FFF;
box-shadow: #000 0 0 2px;
z-index: 10;
}

.trumbowyg-dropdown-fontsize,
.trumbowyg-dropdown-lineheight,
.trumbowyg-dropdown-fontfamily{
height: 200px;
overflow: auto;
}

/* Trumbowyg color widget style end */

/* Pagelayer history style*/

.pagelayer-revision-holder,
.pagelayer-history-holder{
border: 1px solid #b7b5b5fa;
margin-bottom: 10px;
padding: 10px;
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
font-size: 12px;
color:#505050;
}

.pagelayer-leftbar-tab,
.pagelayer-history,
.pagelayer-history-hidden{
display:none;
}

.pagelayer-revision-holder:hover,
.pagelayer-history-holder:hover,
.pagelayer-history-holder.current_active_item{
background-color:#efefef;	
}

.pagelayer-revision-img-holder{
border-radius: 50%;
overflow: hidden;
margin-right:10px;
}

.pagelayer-revision-detail-holder,
.pagelayer-history-detail-holder{
flex:1;
}

.pagelayer-revision-holder .pagelayer-revision-delete,
.pagelayer-history-holder .pagelayer-history-check{
display:none;
}

.pagelayer-revision-holder:hover .pagelayer-revision-delete,
.pagelayer-history-holder.current_active_item .pagelayer-history-check{
display:block;
}

.pagelayer-revision-delete:hover{
cursor:pointer;	
}

.pagelayer-revision-img-holder img{
max-width: 100%;
width: 20px;
height: 20px;
}

.pagelayer-history-holder span{
margin-right:5px;
}

/* Pagelayer history end*/

/* Pagelayer General options*/
.pagelayer-general-options{
color: #777;
background-color: #FFFFFF;
font-size: 14px;
}

.pagelayer-general-options .pagelayer-option-holder{
padding: 10px;
border-radius: 4px;
transition: all 0.1s;
margin-bottom:4px;
cursor: pointer;
}

.pagelayer-general-options .pagelayer-option-holder i{
margin: 0 10px;
}

.pagelayer-general-options .pagelayer-option-holder:hover{
color:#1a7fb0;
background: #ebebeb;
}

.pagelayer-general-options .pagelayer-option-holder:active{
transform: scale(0.97);
cursor: progress;
}

.pagelayer-general-options .pagelayer-options-sections{
padding: 10px;
}

.pagelayer-general-options .pagelayer-options-sections:not(:last-child){
border-bottom: 1px solid #ebebeb;
}

.pagelayer-general-options h5{
font-size: 11px;
text-transform: uppercase;
color: #777;
margin: 15px 5px;
}

/* Pagelayer General options end*/

/* Pagelayer settings*/

.pagelayer-post-settings-holder{
border:1px solid #d3d3d3;
font-size: 14px;
line-height: 150%;
}

.pagelayer-post-settings-acc{
background-color:#fff;
}

.pagelayer-post-settings-apply{
font-size: 14px;
font-weight: bold;
cursor: pointer;
border-radius: 2px;
padding: 4px 8px;
margin: auto 5px;
}

.pagelayer-post-settings-apply[disabled]{
opacity:0.5;
}

.pagelayer-post-settings-acc{
margin-top:7px;
}

.pagelayer-post-settings-fields{
padding:10px;
display:none;
}

.pagelayer-post-settings-lable{
border:1px solid #d3d3d3;
padding:10px;
cursor:pointer;
}

.pagelayer-toggle{
float:right;	
}

.pagelayer-toggle:not(.pagelayer-open):before{
content: "\f0da";
}

.pagelayer-toggle.pagelayer-open:before{
content: "\f0d7";
}

.pagelayer-post-settings-fields label{
display:block;
margin:7px 0;
}

/* Pagelayer settings end*/

/*Tooltip TLITE CSS : https://github.com/chrisdavies/tlite */
.pagelayer-tlite {
background: #111;
color: white;
font-family: sans-serif;
font-size: 0.8rem;
font-weight: normal;
text-decoration: none;
text-align: left;
padding: 0.6em 0.75rem;
border-radius: 4px;
position: absolute;
opacity: 0;
visibility: hidden;
transition: opacity 0.4s;
white-space: nowrap;
box-shadow: 0 0.5rem 1rem -0.5rem black;
z-index: 1000;
-webkit-backface-visibility: hidden;
}

.pagelayer-tlite-table td,
.pagelayer-tlite-table th {
position: relative;
}

.pagelayer-tlite-visible {
visibility: visible;
opacity: 0.9;
}

.pagelayer-tlite::before {
content: ' ';
display: block;
background: inherit;
width: 10px;
height: 10px;
position: absolute;
transform: rotate(45deg);
}

.pagelayer-tlite-n::before {
top: -3px;
left: 50%;
margin-left: -5px;
}

.pagelayer-tlite-nw::before {
top: -3px;
left: 10px;
}

.pagelayer-tlite-ne::before {
top: -3px;
right: 10px;
}

.pagelayer-tlite-s::before {
bottom: -3px;
left: 50%;
margin-left: -5px;
}

.pagelayer-tlite-se::before {
bottom: -3px;
right: 10px;
}

.pagelayer-tlite-sw::before {
bottom: -3px;
left: 10px;
}

.pagelayer-tlite-w::before {
left: -3px;
top: 50%;
margin-top: -5px;
}

.pagelayer-tlite-e::before {
right: -3px;
top: 50%;
margin-top: -5px;
}
/*Tooltip end*/

/* Add section modal*/
.pagelayer-add-section-modal-container{
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: #00000069;
z-index:9999;
display:none;
font-family: Roboto, 'Open Sans', Arial, Helvetica, sans-serif;
}

.pagelayer-add-section-modal-close{
font-size: 30px;
float: right;
cursor:pointer;
line-height: 100%;
}

.pagelayer-add-section-modal-holder{
position: relative;
font-size: 18px;
height: 100vh;
}

.pagelayer-add-section-modal{
background-color: #ffffff;
width: 100%;
margin: auto;
position: relative;
}

/* Add modal for editor*/
.pagelayer-editor-modal{
position:fixed;
display:none;
justify-content:center;
align-items:center;
top:0;
left:0;
width:100%;
height:100%;
z-index:9999;
background-color:rgba(0, 0, 0, 0.3);
}

.pagelayer-editor-modal *{
box-sizing:border-box;
padding:0;
margin:0;
}

.pagelayer-editor-modal-wrap{
background-color: #FFF;
border-radius:2px;
width: 40%;
box-shadow: 0 10px 10px rgb(0 0 0 / 25%);
}

.pagelayer-editor-modal-header{
display:flex;
justify-content:space-between;
align-items: center;
padding: 20px 30px;
border-bottom: 1px solid #ccc;
}

.pagelayer-editor-modal-header i{
font-size: 1.3em;
cursor:pointer;
}

.pagelayer-editor-modal-header i:hover{
color: #3e8ef7;
}

.pagelayer-editor-modal-body{
padding: 0 25px;
}

.pagelayer-edt-modal-block{
margin: 10px;
}

.pagelayer-edt-modal-block ul{
padding:0;
margin-bottom:10px;
}

.pagelayer-edt-modal-block li{
list-style-type:none;
display:flex;
flex-direction:row;
justify-content:space-between;
font-size:1.1em;
padding: 10px 0;
border-bottom: 1px solid #ccc;
color: #282828;
}

.pagelayer-keyboard-shortcut-keys{
font-weight: bold;
}

.pagelayer-keyboard-shortcut-keys > span{
margin: 0 4px;
background-color: #e8e8e8;
padding: 5px 7px;
border-radius: 3px;
}

/* width */
.pagelayer-add-section-modal::-webkit-scrollbar {
width: 7px;
}

/* Track */
.pagelayer-add-section-modal::-webkit-scrollbar-track {
background: #f1f1f1;
border-radius:5px;
}
 
/* Handle */
.pagelayer-add-section-modal::-webkit-scrollbar-thumb {
background: #c1c1c1;
border-radius:5px;
}

/* Handle on hover */
.pagelayer-add-section-modal::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

.pagelayer-add-section-modal-header{
padding: 15px;
position: sticky;
background: #5e5e5e;
top: 0;
z-index: 999;
color: #fff;
}

.pagelayer-add-section-modal-header>div{
display: inline-block;
}

.pagelayer-section-type-div{
width: 85%;
text-align: center;
}

.pagelayer-add-section-modal-row{
display: flex;
flex-direction: row;
}

.pagelayer-add-section-modal-left{
min-width: 250px;
width: 250px;
background-color: #ccc;
}

.pagelayer-section-search-div{
text-align:center;
margin: 20px;
position:relative;
}

.pagelayer-section-search{
width:100%;
line-height:120%;
padding: 5px 20px 5px 30px;
border-radius: 5px;
border: none;
font-size: 14px;
height:30px;
}

.pagelayer-section-search-div .pli{
position: absolute;
top: 0;
height: 30px;
padding: 0 7px;
color: #666;
line-height: 30px;
}

.pagelayer-section-search-div .pagelayer-sf-empty{
right:0;
left:auto;
font-weight:bolder;
cursor:pointer;
}

.pagelayer-section-tags-holder{
padding: 0px 10px;
height: calc(100vh - 150px);
overflow: auto;
}

.pagelayer-section-tags{
background: #1A9CDB;
cursor: pointer;
padding: 5px;
color: #fff;
font-size: 13px;
display: inline-block;
margin: 3px;
}

.pagelayer-section-tags[on="1"]{
background: #326fa6;
}

.pagelayer-section-modal-body-holder{
overflow:auto;
height: calc(100vh - 50px);
width: calc(100vw - 250px);
background: #efefef;
}

.pagelayer-add-section-modal-body{
margin: 0;
background: #efefef;
height: 100%;
display: flex;
flex-wrap: wrap;
}

.pagelayer-add-section-modal-footer{
padding: 15px;
border-top: 1px solid #e5e5e5;
}

.pagelayer-section-is-visible{
height: 50px;
flex-basis: 100%;
}

.pagelayer-section-holder{
vertical-align: top;
background: #efefef;
flex: 1;
}

.pagelayer-section-item{
min-height: 50px;
margin:15px;
z-index: 9;
transition-duration: 0.2s;
background-color:#fff;
border: 3px solid #fff;
border-radius: 4px;
cursor: pointer;
position: relative;
}

.pagelayer-section-item:hover{
z-index: 99;
transform: scale(1.01);
border: 3px solid #1A9CDB;
}

.pagelayer-section-item img{
width:100%;
}

.pagelayer-section-item[pagelayer-section-type=page]{
max-height: 350px;
overflow: auto;
}

.pagelayer-section-pro-req{
position: absolute;
top: 15px;
right: 0px;
font-size: 14px;
padding: 10px;
background-color: #e63131;
color: #fff;
margin-left: 4px;
border-radius: 2px;
cursor: pointer;
}

.pagelayer-section-pro-txt{
position: absolute;
top: 45%;
left: 0px;
font-size: 14px;
padding: 10px;
color: #fff;
line-height: 120%;
background: #111;
opacity: 0;
transition: all 0.3s;
}

.pagelayer-section-item:hover > .pagelayer-section-pro-txt{
opacity: 0.8;
}

.pagelayer-section-pro-txt a{
color: #1A9CDB;
}

.pagelayer-add-section-modal-overlay{
position: absolute;
top:0;
bottom:0;
height:100%;
width:100%;
z-index:999999;
align-items: center;
justify-content: center;
text-align:center;
display:flex;
background-color:#f7f7f7fa;
}

.pagelayer-section-wait .fa-spin{
font-size:50px;
}

/* Add section modal end */

/* Navigator start */
.pagelayer-leftbar-prop-body{
margin:10px 0px;	
background-color:#ffffff;
border: 1px solid #d3d3d3;
font-size:12px;
}

.pagelayer-ele-name{
padding: 10px;
border-bottom:1px solid #d3d3d3;
color: #000000;
}

.pagelayer-ele-name:hover{
background-color:#f5f5f5;
cursor:pointer;
}

.pagelayer-navigetor-ele > .pagelayer-navigetor-ele{
display:none;
}

.pagelayer-navigator-open > .pagelayer-navigetor-ele{
display:block;
}

.pagelayer-ele-name .fa:before{
margin-right:8px;
font-family:pagelayer,fontawesome;
font-size:14px !important;
}

.pagelayer-navi-active{
background-color: #d5e4f7
}

.pagelayer-navigator-options{
float: right;
}

.pagelayer-navigator-options .pli{
padding: 0 4px;
}
/* Navigator end */

/* Left bar move start */
.pagelayer-leftbar-moving{
position:absolute;
height:80vh;
z-index:999;
box-shadow:0 0 5px #e1e1e1;
}

.pagelayer-overflow-hidden{
overflow:hidden !important;
}

.pagelayer-leftbar-move{
width:30px;
height:100%;
background-color:#00BCD4;
position:absolute;
opacity: 0.33;
}

.pagelayer-moveto-left{
left:0;
right:auto;
}

.pagelayer-moveto-right{
right:0;
left:auto;
}

.pagelayer-close-bar{
background-color: #000;
color: #ffffff;
height:15px;
}

.pagelayer-leftbar-table:not(.pagelayer-leftbar-moving) .pagelayer-close-bar{
display:none;
}

.pagelayer-leftbar-minimize{
height:auto;
}

.pagelayer-close-bar-icons{
float:right;
}

.pagelayer-close-bar-icons i{
padding:5px 10px;
font-size: 10px;
}

.pagelayer-close-bar-icons i:hover{
background-color: #E3E3E3;
color: #000;
}

.pagelayer-leftbar-moving.pagelayer-leftbar-minimize .pagelayer-leftbar-holder,
.pagelayer-leftbar-moving.pagelayer-leftbar-minimize .pagelayer-bottombar-row{
display:none;
}

/* Left bar move end*/

/* Pre-Loading animaiton classes */
#pagelayer-loader-wrapper {
background-color:white;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
height: 100%;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
position: fixed;
left: 0;
top: 0;
width: 100%;
z-index: 9000;
}


#pagelayer-loader-wrapper .pagelayer-animation-section {
position: absolute;
z-index: 1000;
}

.pagelayer-loader {	
position:relative;
width: 150px;
height: 150px;
margin: 0 auto 50px auto;
z-index: 1001;
}

.pagelayer-loader:before {
content: "";
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
border-radius: 50%;
border: 3px solid transparent;
border-top-color: #3498db;
-webkit-animation: spin 3s linear infinite; 
animation: spin 3s linear infinite;
}

.pagelayer-loader:after {
content: "";
position: absolute;
top: 10px;
left: 10px;
right: 10px;
bottom: 10px;
border-radius: 50%;
border: 3px solid transparent;
border-top-color: #e74c3c;
-webkit-animation: spin 2s linear infinite;
animation: spin 2s linear infinite;
}

.pagelayer-loader .pagelayer-percent-parent{
width:100%;
height:100%;
margin:auto;
display: flex;
align-items: center;
justify-content: center;
text-align:center;
}

.pagelayer-loader .pagelayer-percent-parent:before{
content: "";
position: absolute;
top: 20px;
left: 20px;
right: 20px;
bottom: 20px;
border-radius: 50%;
border: 3px solid transparent;
border-top-color: #f9c922;
-webkit-animation: spin 1.5s linear infinite;
animation: spin 1.5s linear infinite; 
}

.pagelayer-loader .pagelayer-percent-parent .pagelayer-percent{
font-size:30px;
}

@-webkit-keyframes spin {
0%{ 
	-webkit-transform: rotate(0deg);  
	-ms-transform: rotate(0deg);  
	transform: rotate(0deg);  
}
100%{
	-webkit-transform: rotate(360deg);
	-ms-transform: rotate(360deg);
	transform: rotate(360deg);
}
}

@keyframes spin {
0%   { 
	-webkit-transform: rotate(0deg);
	-ms-transform: rotate(0deg);
	transform: rotate(0deg);
}
100% {
	-webkit-transform: rotate(360deg);
	-ms-transform: rotate(360deg);
	transform: rotate(360deg);
}
}

#pagelayer-loader-wrapper .pagelayer-animation-section .pagelayer-txt-loading {
font: bold 7em Poppins,sans-serif;
text-align: center;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}

.pagelayer-txt-loading .letters-loading {
color: rgba(0,0,0,0.2);
position: relative;
}

.pagelayer-txt-loading .letters-loading:before {
-webkit-animation: letters-loading 4s infinite;
animation: letters-loading 4s infinite;
color: #000;
content: attr(data-text-preloader);
left: 0;
opacity: 0;
font-family: "Poppins",sans-serif;
position: absolute;
-webkit-transform: rotateY(-90deg);
transform: rotateY(-90deg);
}

.pagelayer-txt-loading .letters-loading:nth-child(2):before {
-webkit-animation-delay: .2s;
animation-delay: .2s
}
.pagelayer-txt-loading .letters-loading:nth-child(3):before {
-webkit-animation-delay: .4s;
animation-delay: .4s
}
.pagelayer-txt-loading .letters-loading:nth-child(4):before {
-webkit-animation-delay: .6s;
animation-delay: .6s
}
.pagelayer-txt-loading .letters-loading:nth-child(5):before {
-webkit-animation-delay: .8s;
animation-delay: .8s
}
.pagelayer-txt-loading .letters-loading:nth-child(6):before {
-webkit-animation-delay: 1s;
animation-delay: 1s
}
.pagelayer-txt-loading .letters-loading:nth-child(7):before {
-webkit-animation-delay: 1.2s;
animation-delay: 1.2s
}
.pagelayer-txt-loading .letters-loading:nth-child(8):before {
-webkit-animation-delay: 1.4s;
animation-delay: 1.4s
}
.pagelayer-txt-loading .letters-loading:nth-child(9):before {
-webkit-animation-delay: 1.6s;
animation-delay: 1.6s
}
.pagelayer-txt-loading .letters-loading:nth-child(10):before {
-webkit-animation-delay: 1.8s;
animation-delay: 1.8s
}
.pagelayer-txt-loading .letters-loading:nth-child(11):before {
-webkit-animation-delay: 2s;
animation-delay: 2s
}

.pagelayer-loaded .pagelayer-animation-section .pagelayer-loader, .pagelayer-loaded .pagelayer-animation-section .pagelayer-txt-loading{
opacity: 0;
-webkit-transition: all 0.3s ease-out;  
transition: all 0.3s ease-out;
}

@-webkit-keyframes letters-loading {
0%, 75%, 100% {
opacity: 0;
-webkit-transform: rotateY(-90deg);
transform: rotateY(-90deg)
}
25%, 50% {
opacity: 1;
-webkit-transform: rotateY(0deg);
transform: rotateY(0deg)
}
}
@keyframes letters-loading {
0%, 75%, 100% {
opacity: 0;
-webkit-transform: rotateY(-90deg);
transform: rotateY(-90deg)
}
25%, 50% {
opacity: 1;
-webkit-transform: rotateY(0deg);
transform: rotateY(0deg)
}
}

@media screen and (max-width: 767px) {
#pagelayer-loader-wrapper .pagelayer-animation-section .pagelayer-loader {
height: 8em;
width: 8em
}
#pagelayer-loader-wrapper .pagelayer-animation-section .pagelayer-txt-loading {
font: bold 3.5em Poppins, sans-serif
}
.pagelayer-loader .pagelayer-percent-parent .pagelayer-percent{
font-size:20px;
}
}
@media screen and (max-width: 500px) {
#pagelayer-loader-wrapper .pagelayer-animation-section .pagelayer-loader {
height: 7em;
width: 7em
}
#pagelayer-loader-wrapper .pagelayer-animation-section .pagelayer-txt-loading {
font: bold 2em Poppins, sans-serif
}
.pagelayer-loader .pagelayer-percent-parent .pagelayer-percent{
font-size:15px;
}
}

/* Pre-Loading animaiton classes end*/

/* Update Loading animation class start */

.pagelayer-update-button{
width:58px;
height:24px;
}

.pagelayer-update-loader{
display:none;
padding:2px;
}

.pagelayer-update-loader span{
width:8px;
height:8px;
margin: 0 2px;
background-color: #ededede0;
border-radius: 50%;
display:inline-block;
animation: dots 0.9s ease-in-out infinite;
}

.pagelayer-update-loader span:nth-child(2){
animation-delay: 0.3s;
}

.pagelayer-update-loader span:nth-child(3){
animation-delay: 0.6s;
}

@keyframes dots{
50%{
opacity:0;
}
}

/* Update Loading animation class end */

/* Error box css starts */

.pagelayer-errorBox{
position:absolute;
top:10px;
left: 0; 
right: 0; 
margin-left: auto; 
margin-right: auto; 
width:70%;
height:234;
border-radius:20px;
background-color:#fffafa;
box-shadow: 1px 1px 8px #ffc7c7;
z-index:9999;
display:none;
}

.pagelayer-errorBox-close{
position:absolute;
right:10;
top:10;
font-size:20px;
padding:5px;
color:lightgrey;
cursor:pointer;
}

.pagelayer-errorBox-main{
height:180px;
margin:2px 10px;
}

.pagelayer-errorBox-main h2{
color:red;
font-size:20px;
margin:0;
}

.pagelayer-errorBox-main h2 i{
font-size:30px;
margin:10px;
vertical-align:middle;
}

.pagelayer-errorBox-content{
margin-left:90px;
font-size:13px;
overflow:auto;
height:130px;
border-bottom:1px solid lightgrey;
}

.pagelayer-errorBox-resolve{
text-align:right;
padding:10px;
}
.pagelayer-errorBox-resolve p{
display:inline;
margin:10px;
}

.pagelayer-errorBox-resolve .pagelayer-errorBox-support, .pagelayer-errorBox-resolve .pagelayer-errorBox-copy{
cursor:pointer;
padding: 5px;
border-radius: 5px;
color: white;
}

.pagelayer-errorBox-resolve .pagelayer-errorBox-copy{
background-color: #616cf3;
border: 1px solid blue;
}

.pagelayer-errorBox-resolve .pagelayer-errorBox-support{
background-color: #56b45d;
border: 1px solid green;
}

/* Error box css ends */

/* Property modal start*/
.pagelayer-elp-modal-wrapper{
position: fixed;
top: 0;
bottom: 0;
left: 0;
right: 0;
overflow-y: auto;
background: #0000009c;
z-index: 999;
color: #fff;
display:none;
}

.pagelayer-elp-modal-wrap{
width: 500px;
background-color: #fff;
position: relative;
margin: 20px auto;
border-radius: 5px;
box-shadow: 0px 0px 7px 0px #fff;
}

.pagelayer-elp-modal-close{
float:right;
padding: 5px;
cursor:pointer
}

.pagelayer-elp-modal-header{
padding:15px 20px 10px;
margin-top: 10px;
font-size: 13px;
font-weight: bold;
color: #555;
}

.pagelayer-elp-modal-holder{
padding: 5px 20px 10px;
}

/* Property modal end*/
/* Property link start*/

.pagelayer-elp-link-list{
max-height:250px;
overflow:auto;
width: 99%;
top: 35px;
right: 4px;
}

.pagelayer-elp-link-list .pagelayer-elp-link-search{
width:100%;
}

.pagelayer-elp-link-item{
display: flex;
font-size: 13px;
padding: 7px 2px;
margin: 2px 0;
cursor: pointer;
align-items:center;
}

.pagelayer-elp-link-item:hover{
box-shadow: inset 0 0 0 1px #555d66, inset 0 0 0 2px #fff;
border-radius: 4px;
}

.pagelayer-elp-link-item span{
text-overflow: ellipsis;
display: inline-block;
overflow: hidden;
white-space: nowrap;
width: 100%;
padding:3px;
}

.pagelayer-elp-link-item-title{
font-weight:bold;
}

.pagelayer-elp-link-item-perma{
color:#999;
}

.pagelayer-elp-link-title{
width: 73%;
margin-right:2%;
}

.pagelayer-elp-link-info{
width: 20%;
background-color: #ededed;
padding: 2px;
font-size:11px;
}

.pagelayer-elp-link-id{
background-color: #ededed;
padding: 2px 6px;
font-size:12px;
margin-left:5px;
}

.pagelayer-elp-link-info span{
padding: 4px;
}

.pagelayer-elp-link-div .pagelayer-elp-link-addons{
margin-right: 30px;
display: none;
}

.pagelayer-elp-link-div .pagelayer-elp-link-cb-div{
display: flex;
justify-content: space-between;
align-items: center;
padding-top: 5px;	
}

.pagelayer-elp-link-div .pagelayer-elp-link-cb-div:first-child{
margin-top: 10px;
}

.pagelayer-elp-link-div .pagelayer-elp-link-ca{
margin: 5px 0px;	
}

.pagelayer-elp-link-ca input{
width: 100%;
}

/* Property link end*/
/* Editor notice start*/
.pagelayer-editor-notice{
position: fixed;
right: 10px;
top: 10px;
padding-right: 16px;
transition: all 5s ease-out;
pointer-events: none;
}

.sitepad-body .pagelayer-editor-notice{
top:50px;
}

.pagelayer-editor-msg{
position:relative;
font-size: 13px;
background-color: rgba(0,0,0,.8);
border-radius: 4px;
box-shadow: 0 2px 4px rgba(0,0,0,.3);
color: #fff;
padding: 16px 30px 16px 15px;
margin-bottom:7px;
transition: opacity 800ms ease-out;
pointer-events: all;
width:fit-content;
margin-left:auto;
}

.pagelayer-editor-msg.pagelayer-editor-msg-state-success{
background-color: #449d44;
}

.pagelayer-editor-msg.pagelayer-editor-msg-state-error{
background-color: #ef4d4d;
}

.pagelayer-editor-msg.pagelayer-editor-msg-state-warning{
background-color: #cd8500;
}

.pagelayer-notice-x{
position: absolute;
top: 50%;
right: 10px;
transform: translateY(-50%);
cursor:pointer;
}

/* Editor notice end*/
/* Pagelayer post setting modal start*/
.pagelayer-props-modal{
position: fixed;
left: 0;
top: 0;
right: 0;
bottom: 0;
z-index: 1100;
background-color:#2d2d2d8c;
display:none;
}

.pagelayer-props-holder{
position:relative;
height: 100%;
overflow: auto;
display: flex;
justify-content: center;
align-items: center;
width: 100%;
margin:auto;
max-height: 967px;
}

.pagelayer-props-wrap{
position:relative;
height: 90%;
width: 90%;
margin:auto;
overflow: auto;
display: flex;
justify-content: center;
align-items: center;
border-radius: 10px
}

.pagelayer-props-loading-screen{
position:absolute;
border: 8px solid transparent;
border-radius: 50%;
border-top: 8px solid #ebebeb;
width: 80px;
height: 80px;
-webkit-animation: propsLoading 0.5s ease-in-out infinite; /* Safari */
animation: propsLoading 0.5s ease-in-out infinite;
}

/* Safari */
@-webkit-keyframes propsLoading {
0% { -webkit-transform: rotate(0deg); }
100% { -webkit-transform: rotate(360deg); }
}

@keyframes propsLoading {
0% { transform: rotate(0deg); }
100% { transform: rotate(360deg); }
}

.pagelayer-props-wrap .pagelayer-meta-iframe{
position: relative;
width: 100%;
height: 100%;
border: 0px;
}

.pagelayer-props-modal-close{
position: absolute;
top: 20px;
right: 25px;
z-index: 999;
cursor:pointer;
visibility:hidden;
}

@keyframes highlight {
0% {
	background: #dfdfdf;
}
100% {
	background: #fff;
}
}

.highlight {
    animation: highlight 1s;
	animation-iteration-count: 5;
}
/* Pagelayer post setting modal end  */

/* Pagelayer post props(category) start  */
.pagelayer-post-cat-div{
max-height:300px;
overflow:auto;
}

.pagelayer-post-category, .pagelayer-post-category ul{
list-style:none;
padding:0;
margin:0;
margin-left:16px;
}

.pagelayer-post-category li{
margin:8px 0px;	
}

.pagelayer-post-category label, .pagelayer-elp-postCategory *{
font-size:small;
}

.pagelayer-post-category input[type=checkbox]{
margin-right:5px;
background-color:#007cba;
width:16px;
height:16px;
}

.pagelayer-add-cat-btn{
color:#0073aa;
cursor:pointer;
line-height:3;
}

.pagelayer-add-cat-btn:hover{
color:#00a0d2;
}

.pagelayer-elp-postCategory input, .pagelayer-parent-category > select{
margin-top:5px;
margin-bottom:12px;
}

.pagelayer-parent-category{
margin-top:5px;
}

.pagelayer-parent-category > select{
height:32px;
outline:none;
}

.pagelayer-cat-submit{
color: #007cba;
border: 1px solid #007cba;
padding: 10px;
background-color: white;
cursor: pointer;
}

.pagelayer-cat-submit:hover{
color: #006ba1;
border: 1px solid #006ba1;	
}

.pagelayer-dark .pagelayer-cat-submit, 
.pagelayer-elp-postCategory input{
background-color:transparent;
}

.pagelayer-dark .pagelayer-cat-submit:hover{
color:white;
background-color:#007cba;
}

/* Pagelayer post props(category) end  */
/* Pagelayer post props(tags) start  */

.pagelayer-elp-postTags{
border: 1px solid #757575;
border-radius: 2px;
display: flex;
flex-wrap: wrap;
padding:2px;
}

.pagelayer-post-tags{
display: flex;
flex-wrap: wrap;
align-items: flex-start;
}

.pagelayer-elp-tags-ele{
display: flex;
margin: 2px 4px 2px 0;
max-width: 100%;
background-color: #ddd;
border-radius: 2px;	
font-size: 13px;
padding: 5px;
}

.pagelayer-elp-tags-ele .pagelayer-tags-label{
padding: 2px;
}

.pagelayer-elp-tags-ele .pagelayer-elp-tags-remove{
cursor:pointer;
padding: 3px 5px;
}

.pagelayer-elp-postTags-inp{
width:auto;
display: inline-block;
flex: 1;
padding: 5px;
height: 26px;
border: none !important;
outline: none !important;
max-width: 100%;
min-height: 24px;
min-width: 50px;
background: inherit;
color: #1e1e1e;
box-shadow: none;
margin-top:3px;
}

.pagelayer-post-tags .pagelayer-postTags-list{
flex: 1 0 100%;
min-width: 100%;
max-height: 9em;
overflow-y: auto;
transition: all .15s ease-in-out;
list-style: none;
border-top: 1px solid #757575;
outline: none;
border: none;
margin: 0;
margin-top:4px;
padding:0;
}


.pagelayer-post-tags .pagelayer-postTags-list li{
color: #757575;
display: block;
font-size: 13px;
padding: 4px 8px;
margin: 0;
cursor: pointer;
border-top: 1px solid #757575;
}	

.pagelayer-post-tags .pagelayer-postTags-list li:hover{
color:white;
background-color:#007cba;
}

.pagelayer-elp-trash-button-div{
text-align:center;
}

.pagelayer-elp-trash-button{
color: #cc1818;
padding: 6px;
white-space: nowrap;
background: transparent;
text-decoration: none;
font-size: 13px;
cursor: pointer;
border: 1px solid #cc1818;
border-radius: 2px;
}

.pagelayer-elp-trash-button:hover{
background-color: transparent;
color: #710d0d;
box-shadow: inset 0 0 0 1px #710d0d;
}

.pagelayer-dark .pagelayer-elp-trash-button:hover{
color:#ffffff;
background-color: #cc1818;
}


.pagelayer-dark .pagelayer-elp-postdate-div .pagelayer-elp-postdate::-webkit-calendar-picker-indicator{
filter: invert(70%);
}
/* Pagelayer post props(tags) end */
/* Pagelayer widget list tooltip start*/

.pagelayer-widget-tooltip{
position: fixed;
top: 0;
left: 0;
background: #fff;
width: 300px;
max-height: 350px;
min-height: 125px;
height: auto;
overflow-y: auto;
box-shadow: 0 2px 6px rgb(0 0 0 / 5%);
border-radius: 2px;
display: none;
z-index: 999;
}

.pagelayer-widget-search-holder{
position: sticky;
top: 0;
padding: 10px 10%;
z-index: 1;
background: #fff;
}

.pagelayer-widget-search{
position: relative;
}

.pagelayer-pointer.pagelayer-shortcode-text,
.pagelayer-pointer.pagelayer-sc{
cursor: pointer !important;
}

.pagelayer-widget-tooltip .pagelayer-search-field{
border: 2px solid;
}

.pagelayer-widget-tooltip .pagelayer-shortcode-holder{
width: 70px !important;
border: 1px solid transparent;
}

.pagelayer-widget-list-tooltip{
width: 150px !important;
padding: 0px 10px;
}

.pagelayer-shortcode-holder[pagelayer-tag="pl_row"],
.pagelayer-shortcode-holder[pagelayer-tag="pl_col"],
.pagelayer-widget-list-tooltip .pagelayer-widget-group h5,
.pagelayer-widget-list-tooltip .pagelayer-widget-search-holder{
display:none !important;
}

.pagelayer-widget-list-tooltip .pagelayer-shortcode{
width: 24px;
height: 16px;
font-size: 14px;
text-align: left;
}

.pagelayer-widget-list-tooltip .pagelayer-shortcode-holder{
width: 100% !important;
height: auto !important;
float: unset;
margin: 0px;
}

.pagelayer-widget-list-tooltip .pagelayer-sc{
display: flex;
align-items: center;
}

.pagelayer-widget-list-tooltip .pagelayer-shortcode-text{
text-align: left;
}

.pagelayer-widget-list-tooltip .pagelayer-shortcode-inner{
height: auto;
width: 22px;
}

.pagelayer-shortcode-holder.pagelayer-list-widget-active{
border: 1px solid rgb(0, 128, 0);
}

/* Pagelayer widget list tooltip end*/
/* Menu start */
.pagelayer-elp-menu-items-holder{
padding-top: 15px;
}

.pagelayer-drag-highlight{
margin-top: 0;
margin-bottom: 10px;
max-width: calc(100% - 2px);
border: 1px dashed #a7aaad;
height: 33px !important;
}

.pagelayer-menu-depth-1{
margin-left: 10px;
width: calc(100% - 10px) !important;
}

.pagelayer-menu-depth-2{
margin-left: 20px;
width: calc(100% - 20px) !important;
}

.pagelayer-menu-depth-3{
margin-left: 30px;
width: calc(100% - 30px) !important;
}

.pagelayer-menu-depth-4{
margin-left: 40px;
width: calc(100% - 40px) !important;
}

.pagelayer-menu-depth-5{
margin-left: 50px;
width: calc(100% - 50px) !important;
}

.pagelayer-menu-depth-6{
margin-left: 60px;
width: calc(100% - 60px) !important;
}

.pagelayer-menu-depth-7{
margin-left: 70px;
width: calc(100% - 70px) !important;
}

.pagelayer-menu-depth-8{
margin-left: 80px;
width: calc(100% - 80px) !important;
}

.pagelayer-menu-depth-9{
margin-left: 90px;
width: calc(100% - 90px) !important;
}

.pagelayer-menu-depth-10{
margin-left: 100px;
width: calc(100% - 100px) !important;
}

.pagelayer-menu-depth-11{
margin-left: 110px;
width: calc(100% - 110px) !important;
}

.pagelayer-menu-depth-12{
margin-left: 120px;
width: calc(100% - 120px) !important;
}

.pagelayer-menu-depth-13{
margin-left: 130px;
width: calc(100% - 130px) !important;
}

.pagelayer-menu-depth-14{
margin-left: 140px;
width: calc(100% - 140px) !important;
}

.pagelayer-menu-depth-15{
margin-left: 150px;
width: calc(100% - 150px) !important;
}

.pagelayer-menu-item-transport:empty{
display: none;
}

.pagelayer-menu-item-transport{
padding-top: 10px;
}
/* Menu end */

@font-face {
  font-family: 'pagelayer';
  src:  url('/wp-content/plugins/pagelayer/fonts/pagelayer.eot?p8l7ih');
  src:  url('/wp-content/plugins/pagelayer/fonts/pagelayer.eot?p8l7ih#iefix') format('embedded-opentype'),
    url('/wp-content/plugins/pagelayer/fonts/pagelayer.ttf?p8l7ih') format('truetype'),
    url('/wp-content/plugins/pagelayer/fonts/pagelayer.woff?p8l7ih') format('woff'),
    url('/wp-content/plugins/pagelayer/fonts/pagelayer.svg?p8l7ih#pagelayer') format('svg');
  font-weight: normal;
  font-style: normal;
  font-display: block;
}

[class^="pli-"], [class*=" pli-"],
.pagelayer-shortcode,
.trumbowyg-button-group > button, 
.trumbowyg-button-group > button:before,
.trumbowyg-dropdown-formatting > button{
font-family: 'pagelayer', "Font Awesome 5 Free" !important;
speak: none;
font-style: normal;
font-weight: normal;
font-variant: normal;
text-transform: none;
line-height: 1;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
display: inline-block;
text-decoration: inherit;
font-weight: 400;
vertical-align: top;
-webkit-transition: color .1s ease-in 0;
transition: color .1s ease-in 0;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
transition: all 0.3s;
}

.pagelayer-shortcode{
color:#444;
width: 22px;
height: 22px;
font-size: 22px;
line-height: 1;
text-align: center;
}

.pagelayer-dark .pagelayer-shortcode{
color:#fff;
}

.trumbowyg-dropdown-formatting > button:before{
margin-right:10px;
}

.trumbowyg-button-group > button, 
.trumbowyg-button-group > button:before{
font-size: 13px;
}

.pli-files1:before {
content: "\e92f";
}
.pli-note-text:before,
.pagelayer-pl_post_excerpt:before{
content: "\e939";
}
.pli-note-list:before,
.pagelayer-pl_menu_list:before{
content: "\e93c";
}
.pli-document-text:before {
content: "\e940";
}
.pli-document-text1:before,
.pagelayer-pl_post_content:before{
content: "\e941";
}
.pli-documents:before,
.pagelayer-pl_templates:before{
content: "\e944";
}
.pli-stop-watch:before {
content: "\e946";
}
.pli-menu:before,
.pagelayer-pl_row:before{
content: "\f0c9";
}
.pli-quotes-right:before,
.pagelayer-pl_quote:before,
.pagelayer-pl_testimonial:before,
.trumbowyg-blockquote-dropdown-button:before{
content: "\e907";
}
.pli-round:before,
.pagelayer-pl_list:before{
content: "\e908";
}
.pli-download:before,
.pagelayer-pl_download:before{
content: "\e909";
}
.pli-checkbox-unchecked:before,
.pagelayer-pl_btn:before{
content: "\e90b";
}
.pli-ungroup:before,
.pagelayer-pl_splash:before{
content: "\e90c";
}
.pli-window:before,
.pagelayer-pl_modal:before{
content: "\e90e";
}
.pli-type:before,
.pagelayer-pl_heading:before,
.pagelayer-pl_post_title:before,
.pagelayer-pl_archive_title:before{
content: "\e90f";
}
.pli-film2:before {
content: "\e910";
}
.pli-profile:before,
.pagelayer-pl_iconbox:before,
.pagelayer-pl_author_box:before{
content: "\e912";
}
.pli-price-tags:before {
content: "\e913";
}
.pli-clicks:before,
.pagelayer-pl_call:before{
content: "\e916";
}
.pli-img-hotspots:before,
.pagelayer-pl_image_hotspot:before{
content: "\e91c";
}
.pli-map-addon-alt:before,
.pagelayer-pl_google_maps:before{
content: "\e924";
}
.pli-menus:before {
content: "\e92a";
}
.pli-pages:before,
.pagelayer-pl_posts:before{
content: "\e92e";
}
.pli-post-grid:before,
.pagelayer-pl_slides:before{
content: "\e933";
}
.pli-pricing-alt:before,
.pagelayer-pl_pricing:before{
content: "\e937";
}
.pli-service:before {
content: "\e938";
}
.pli-share:before {
content: "\e93a";
}
.pli-slider:before,
.pagelayer-pl_image_slider:before{
content: "\e93f";
}
.pli-spacer:before,
.pagelayer-pl_space:before{
content: "\e942";
}
.pli-tab-alt:before,
.pagelayer-pl_tabs:before{
content: "\e943";
}
.pli-timer:before,
.pagelayer-pl_countdown:before{
content: "\e945";
}
.pli-video-slider:before,
.pagelayer-pl_video_slider:before{
content: "\e947";
}
.pli-widget-area:before,
.pagelayer-pl_inner_row:before{
content: "\e948";
}
.pli-accordion:before,
.pagelayer-pl_accordion:before{
content: "\e949";
}
.pli-categories:before {
content: "\e94a";
}
.pli-chart-bar:before,
.pagelayer-pl_chart:before{
content: "\e94d";
}
.pli-post-sliders2:before {
content: "\e951";
}
.pli-social-button:before,
.pagelayer-pl_share_grp:before{
content: "\e952";
}
.pli-comments:before,
.pagelayer-pl_post_comment:before{
content: "\e970";
}
.pli-star-o:before,
.pagelayer-pl_icon:before{
content: "\f006";
}
.pli-th:before,
.pagelayer-pl_grid_gallery:before{
content: "\f00a";
}
.pli-volume-up:before,
.pagelayer-pl_audio:before{
content: "\f028";
}
.pli-align-left:before,
.pagelayer-pl_text:before{
content: "\f036";
}
.pli-video-camera:before,
.pagelayer-pl_video:before{
content: "\f03d";
}
.pli-image1:before,
.pagelayer-pl_image:before,
.trumbowyg-wpmedia-button:before{
content: "\f03e";
}
.pli-edit:before {
content: "\f044";
}
.pli-calendar:before {
content: "\f073";
}
.pli-table:before,
.pagelayer-pl_table:before{
content: "\f0ce";
}
.pli-code:before,
.pagelayer-pl_embed:before,
.trumbowyg-viewHTML-button:before{
content: "\f121";
}
.pli-clone:before,
.pagelayer-pl_btn_grp:before{
content: "\f24d";
}
.pli-calendar-plus-o:before {
content: "\f271";
}
.pli-wpforms:before,
.pagelayer-pl_contact:before{
content: "\f298";
}
.pli-qrcode:before,
.pagelayer-pl_social_grp:before{
content: "\f029";
}
.pli-plus-circle:before {
content: "\f055";
}
.pli-ellipsis-h:before,
.pagelayer-pl_shortcodes:before{
content: "\f141";
}
.pli-commenting-o:before,
.pagelayer-pl_tooltip:before{
content: "\f27b";
}
.pli-id-badge:before,
.pagelayer-pl_badge:before{
content: "\f2c1";
}
.pli-music_video:before {
content: "\e91d";
}
.pli-contacts:before,
.pagelayer-pl_testimonial_slider:before{
content: "\e91e";
}
.pli-content_copy:before {
content: "\e90a";
}
.pli-view_day:before,
.pagelayer-pl_collapse:before{
content: "\e91f";
}
.pli-minus1:before {
content: "\e911";
}
.pli-starburst:before,
.trumbowyg-backColor-button:before{
content: "\e901";
}
.pli-starburst-outline:before,
.trumbowyg-foreColor-button:before{
content: "\e900";
}
.pli-th-large-outline:before,
.pagelayer-pl_post_folio:before{
content: "\e914";
}
.pli-arrow-forward-outline:before,
.trumbowyg-undo-button:before{
content: "\e905";
}
.pli-arrow-back-outline:before,
.trumbowyg-redo-button:before{
content: "\e904";
}
.pli-message-typing:before,
.pagelayer-pl_review_slider:before{
content: "\e915";
}
.pagelayer-pl_anim_heading:before{
content: "\e902";
}
.pli-social-facebook-circular:before,
.pagelayer-pl_fb_comments:before{
content: "\e918";
}
.pli-files:before,
.pagelayer-pl_archive_posts:before{
content: "\e919";
}
.pli-picture:before,
.pagelayer-pl_service:before{
content: "\e920";
}
.pli-trashcan:before {
content: "\e917";
}
.pli-layout:before,
.pagelayer-pl_col:before{
content: "\e906";
}
.pli-log-out:before {
content: "\e928";
}
.pli-login:before,
.pagelayer-pl_login:before{
content: "\e929";
}
.pli-progress-two:before,
.pagelayer-pl_progress:before{
content: "\e92c";
}
.pli-sound-mix:before,
.pagelayer-pl_flipbox:before{
content: "\e92d";
}
.pli-swap:before,
.pagelayer-pl_post_nav:before{
content: "\e930";
}
.pli-anchor:before,
.pagelayer-pl_anchor:before{
content: "\e931";
}
.pli-news-paper:before {
content: "\e932";
}
.pli-servers:before{
content: "\e934";
}
.pli-pencil:before {
content: "\e935";
}
.pli-image:before {
content: "\e90d";
}
.pli-profile1:before {
content: "\e936";
}
.pli-file-picture:before,
.pagelayer-pl_featured_img:before{
content: "\e93b";
}
.pli-copy:before {
content: "\e93e";
}
.pli-folder-open:before {
content: "\e93d";
}
.pli-history:before {
content: "\e94e";
}
.pli-desktop:before {
content: "\f108";
}
.pli-mobile:before {
content: "\f3cd";
}
.pli-tablet:before {
content: "\f3fa";
}
.pli-search:before,
.pagelayer-pl_search:before{
content: "\e986";
}
.pli-enlarge:before,
.trumbowyg-fullscreen-button:before{
content: "\e989";
}
.pli-equalizer:before {
content: "\e992";
}
.pli-equalizer2:before {
content: "\e993";
}
.pli-clipboard:before {
content: "\e9b8";
}
.pli-list-numbered:before,
.trumbowyg-orderedList-button:before{
content: "\e9b9";
}
.pli-list:before,
.trumbowyg-unorderedList-button:before{
content: "\e9ba";
}
.pli-tree:before,
.pagelayer-pl_sitemap:before{
content: "\e9bc";
}
.pli-link:before,
.trumbowyg-link-button:before{
content: "\e9cb";
}
.pli-attachment:before {
content: "\e9cd";
}
.pli-eye:before {
content: "\e9ce";
}
.pli-eye-blocked:before {
content: "\e9d1";
}
.pli-star-half:before,
.pagelayer-pl_stars:before{
content: "\e9d8";
}
.pli-minus:before,
.pagelayer-pl_divider:before,
.trumbowyg-horizontalRule-button:before{
content: "\ea0b";
}
.pli-info:before,
.pagelayer-pl_alert:before,
.pagelayer-pl_post_info:before{
content: "\ea0c";
}
.pli-cross:before {
content: "\ea0f";
}
.pli-checkmark:before {
content: "\ea10";
}
.pli-stop:before,
.pagelayer-pl_block:before{
content: "\ea1e";
}
.pli-arrow-right:before,
.pagelayer-pl_breadcrumb:before{
content: "\ea34";
}
.pli-arrow-left:before{
content: "\f061";
}
.pli-circle-right:before {
content: "\ea42";
}
.pli-sort-numberic-desc:before,
.pagelayer-pl_counter:before{
content: "\ea4b";
}
.pli-font:before,
.trumbowyg-fontfamily-button:before{
content: "\ea5c";
}
.pli-font-size:before,
.trumbowyg-fontsize-button:before{
content: "\ea61";
}
.pli-bold:before,
.trumbowyg-strong-button:before{
content: "\ea62";
}
.pli-underline:before {
content: "\ea63";
}
.pli-italic:before,
.trumbowyg-em-button:before{
content: "\ea64";
}
.pli-strikethrough:before,
.trumbowyg-del-button:before{
content: "\ea65";
}
.pli-superscript:before,
.trumbowyg-superscript-button:before{
content: "\ea69";
}
.pli-subscript:before,
.trumbowyg-subscript-button:before{
content: "\ea6a";
}
.pli-clear-formatting:before,
.trumbowyg-removeformat-button:before{
content: "\ea6f";
}
.pli-pilcrow:before,
.trumbowyg-formatting-button:before,
.trumbowyg-p-dropdown-button:before{
content: "\ea73";
}
.trumbowyg-h1-dropdown-button:before,
.trumbowyg-h2-dropdown-button:before,
.trumbowyg-h3-dropdown-button:before,
.trumbowyg-h4-dropdown-button:before{
content: "\e902";
}
.pli-paragraph-left:before,
.trumbowyg-justifyLeft-button:before{
content: "\f036";
}
.pli-paragraph-center:before,
.trumbowyg-justifyCenter-button:before{
content: "\f037";
}
.pli-paragraph-right:before,
.trumbowyg-justifyRight-button:before{
content: "\f038";
}
.pli-paragraph-justify:before,
.trumbowyg-justifyFull-button:before{
content: "\f039";
}
.trumbowyg-lineheight-button:before{
content: "\e91a";
font-size: 15px !important;
}
.pli-indent-increase:before {
content: "\ea7b";
}
.pli-indent-decrease:before {
content: "\ea7c";
}
.pli-facebook:before,
.pagelayer-pl_fb_embed:before{
content: "\ea90";
}
.pli-facebook-square:before,
.pagelayer-pl_fb_btn:before,
.pagelayer-pl_fb_page:before{
content: "\ea91";
}
.pli-wordpress:before,
i[class*="pagelayer-pl_wp_"]:before{
content: "\eab4";
}
.pli-caret-right:before{
content: "\f0da";
}

.pli-woo:before,
.pagelayer-pl_add_to_cart:before,
.pagelayer-pl_products:before,
i[class*="pagelayer-pl_woo_"]:before,
i[class*="pagelayer-pl_product_"]:before{
content: "\e03d";
}


/* Add an element box */
.pagelayer-add-ele{
display:block;
vertical-align:middle;
text-align:center;
border:1px dashed #4a4949;
min-height:60px;
padding:5px;
color:#4f4f4f;
font-size: 16px;
line-height: 1.5;
position: relative;
}

.pagelayer-add-ele .fas{
font-size:15px;
color:#4a4949;
cursor:pointer;
}

.pagelayer-add-ele .fas:hover:before{
color:#3e8ef7;
}

.pagelayer-add-ele span,
.pagelayer-add-widget-area p{
font-family: "Open Sans", Arial, Helvetica, sans-serif;
}

.pagelayer-empty-col{
display:table-cell;
}

.pagelayer-row{
min-height:20px;
}

/* Since we have a wrap, we set the cols to the wrap. Hence we need to make the width of the real thing to 100% */
.pagelayer-ele-wrap>.pagelayer-col{
width:100%;
}

.pagelayer-ele-wrap{
position: relative;
}

/*.pagelayer-ele-option{
min-height: 10px;
} */

.pagelayer-wrap-col{
align-content: unset !important;
}

.pagelayer-ele-overlay{
position: absolute;
width: 100%;
height: 100%;
right: 0px;
top: 0px;
z-index: 10;
pointer-events:none;
opacity: 0%;
outline-width:0px;
}

.pagelayer-ele-hover, .pagelayer-drag-ele-hover{/* Both classes are same. but its just that during drag, we use the later */
outline:1px solid #a8a8a8;
opacity: 100%;
transition: transform 0.2s linear, opacity 0.2s linear;
}

.pagelayer-active{
outline:1px solid #999;
opacity: 100%;
}

.pagelayer-hide-active>.pagelayer-ele-overlay{
outline: transparent !important;
opacity: 0 !important;
}

.pagelayer-row-hover{
outline:1px solid #277CF9;
}

.pagelayer-col-hover{
outline:1px solid #42ADE1;
}

.pagelayer-ele-option,
.pagelayer-row-option,
.pagelayer-col-option{
position: absolute;
top:0px;
right:0px;
z-index: 20;
padding:0px;
margin:0px;
line-height: 0;
pointer-events:auto;
}

.pagelayer-eoi{
display:inline-block !important;
font-size:12px !important;
padding:4px !important;
background:#444;
color:#fff;
}

.pagelayer-eoi:hover{
background:#222;
cursor: pointer;
}

.pagelayer-row-option{
top:-20px;
left:calc(50% - 63px/2);
z-index: 30;
}

.pagelayer-row-option-zero>.pagelayer-wrap-row:first-child>.pagelayer-ele-overlay .pagelayer-row-option{
top:0;
}

.pagelayer-row-option .pagelayer-eoi{
background:#277CF9;
}

.pagelayer-row-option .pagelayer-eoi:hover{
background:#1c59b3;
}

.pagelayer-wrap-row > .pagelayer-ele-overlay .pagelayer-move-up,
.pagelayer-col-holder > .pagelayer-wrap-inner-row:first-child > .pagelayer-ele-overlay .pagelayer-move-up,
.pagelayer-col-holder > .pagelayer-wrap-ele:first-child > .pagelayer-ele-overlay .pagelayer-move-up{
display:none !important;
}	

.pagelayer-wrap-row ~ .pagelayer-wrap-row > .pagelayer-ele-overlay .pagelayer-move-up{
display:inline-block !important;
}

.pagelayer-wrap-row:nth-last-of-type(2) > .pagelayer-ele-overlay .pagelayer-move-down,
.pagelayer-col-holder > .pagelayer-wrap-inner-row:last-child > .pagelayer-ele-overlay .pagelayer-move-down,
.pagelayer-col-holder > .pagelayer-wrap-ele:last-child > .pagelayer-ele-overlay .pagelayer-move-down{	
display:none !important;
}

.pagelayer-col-option .pagelayer-eoi{
background:#42ADE1;
}

.pagelayer-col-option .pagelayer-eoi:hover{
background:#1070AA;
}

.pagelayer-col-option{
top:0px;
left:0px;
z-index: 30;
width: 21px;
}

.pagelayer-splash{
background-image:url(/wp-content/plugins/pagelayer/images/splash.png);
height:30px;
background-position: center center;
background-repeat: no-repeat;
background-size: cover;
}

.pagelayer-space-holder{
background:url(/wp-content/plugins/pagelayer/images/space.png);
background-repeat:repeat;
}

.pagelayer-anchor{
background-image:url(/wp-content/plugins/pagelayer/images/anchor.png);
height:30px;
background-position: center center;
background-repeat: no-repeat;
background-size: cover;
}


/* Right Click */
.pagelayer-right-click-options{
position:absolute;
background:#e9eaea;
border-radius: 2px;
box-shadow: 0 0 5px rgba(0,0,0,0.1);
z-index: 99999;
border: 1px solid rgba(0,0,0,0.2);
min-width:135px;
/*max-width:170px;*/
}

.pagelayer-right-click-options ul{
list-style: none;
margin: 0;
padding: 0;
}

.pagelayer-right-click-options a{
color: #4a4949;
padding: 8px 10px;
width: 100%;
display: block;
transition: all 0.2s;
white-space:nowrap;
}

.pagelayer-right-click-options a .far{
margin-right: 5px;
}

.pagelayer-right-click-options a:hover{
background: #449D44;
color:#fff;
}

.pagelayer-right-click-options li{
border-bottom: 1px solid rgb(236, 236, 236);
font-size: 12px;
font-family: Opensans, arial;
cursor:pointer;
}

.pagelayer-right-click-options .pagelayer-right-delete:hover {
background:#EF4D4D;
}

/* Pagelayer add section area */

.pagelayer-add-widget-area{
padding: 10px;
width:100%;
text-align: center;
border: 2px #3e8ef7;
border-style: dashed;
position:relative;
font-family: "Open Sans", Arial,Helvetica,sans-serif;
margin:20px auto;
cursor: pointer;
}

.pagelayer-add-widget-area .pagelayer-add-button{
font-size: 14px;
font-weight: bold;
border: 1px solid #007bff;
background-color: #007bff;
color:#fff;
border-radius:5px;
padding:9px;
margin-right:5px;
cursor:pointer;
display:inline-block;
}

.pagelayer-add-widget-area .pagelayer-add-button:hover{
border: 1px solid #0069d9;
background-color: #0069d9;
}

.pagelayer-add-widget-area .pagelayer-add-section{
border: 1px solid #17a2b8;
background-color: #17a2b8;
}

.pagelayer-add-widget-area .pagelayer-add-section:hover{
border: 1px solid #138496;
background-color: #138496;
}

.pagelayer-add-widget-area p{
margin: 0px !important;
color:#4f4f4f;
font-size: 20px;
line-height: 1.8;
}

.pagelayer-add-widget-drag{
border-color: #111111;
background: #c4d2de;
}

/* Pagelayer Drag stuff */

.pagelayer-is-dragging{
opacity: 0.33;
transition:0.1s;
}

.pagelayer-drag-show{
position:absolute;
top:0px;
left:0px;
display:none;
background: blue;
z-index:1000;
}

.pagelayer-drag-prospect{
height:1px;
background:#00BCD4;
z-index: 1000;
width: 100%;
}

.pagelayer-drag-prospect-col{
position: absolute;
top: 0px;
width: 1px;
height: 100% !important;
}

/* Column resize handler icon */
.pagelayer-resize-handler{
position:absolute;
top:50%;
left:100%;
transform: translate(-43%, -50%);
color: #fff;
font-size: 11px;
z-index: 99;
cursor:ew-resize;
display:none;
pointer-events: all;
}

.pagelayer-resize-icon{
background-color: #42ADE1;
padding: 3px;
border-radius: 4px;
height:30px;
display:inline-block;
}

.pagelayer-resize-handler:before{
content:attr(pre-width);
background: #4f4f4f;
position: absolute;
right: 120%;
top: 50%;
transform: translateY(-50%);
padding: 0 6px;	
border-radius:100%;
}

.pagelayer-resize-handler:after{
content:attr(next-width);
background: #4f4f4f;
position: absolute;
left: 120%;
top: 50%;
transform: translateY(-50%);
padding: 0 6px;	
border-radius:100%;
}

/* Hide resize handler icon from last child*/
.pagelayer-wrap-col:not(:last-child):hover > .pagelayer-ele-hover .pagelayer-resize-handler{
display:block;
}

/* Column resize handler icon end */

/* WordPress media box CSS */
[id^="__wp-uploader"] .screen-reader-text{
display:none;
}

[id^="__wp-uploader"] .media-button-select{
text-transform: uppercase;
font-weight: 700;
letter-spacing: 0.046875em;
}
/* WordPress media box CSS end */


/* image drop zone css start */
.pagelayer-image-drop-zone{
position:absolute;
text-align:center;
width:100%;
height:100%;
z-index:3;
background-color: #2ea5dff0;
display:none;
}

.pagelayer-image-drop-zone *{
pointer-events:none;
}

.pagelayer-image-drop-zone > div{
position: relative;
top: 50%;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
}

.pagelayer-image-drop-zone div *{
color: white !important;
line-height: 1;
}

.pagelayer-image-drop-zone div i{
font-size:50px;
}

.pagelayer-image-drop-zone h4{
margin: 20px;
}

.pagelayer-img-up-progress {
width: 30%;
margin-left: auto;
margin-right: auto;
background-color: transparent;
border: 2px solid white;
border-radius: 30px;
padding: 3px;
}

.pagelayer-img-up-bar {
width: 3%;
height: 7px;
background-color: white;
line-height: 7px;
text-align: center;
border-radius: 30px;
}

@media screen and (max-width: 600px) {
.pagelayer-img-up-progress {
width: 54%;	
}
}
/* image drop zone css start */

.pagelayer-pro-req{
font-size: 10px;
padding: 2px 4px;
display: inline-block;
background-color: #e63131;
color: #fff;
margin-left: 4px;
border-radius: 2px;
cursor: pointer;
}

/* Media upload box css */
.media-modal .media-modal-content h1{
font-size: 22px !important;
line-height: 2.27 !important;
}

.media-modal .media-modal-content h2{
font-size: 13px !important;
line-height: 1 !important;
}

.media-modal .media-modal-content .uploader-inline h2{
font-size: 20px !important;
line-height: 1.4 !important;
font-weight: 400 !important;
}
/* Media upload box css end */

/*Tooltip widget*/
.pagelayer-tooltip-text[contenteditable="true"]{
visibility: visible;
}

.pagelayer-service-details{
position:relative;
z-index:9;
}

.pagelayer-shortcode-plus{
border: none;
margin: auto;
z-index: 11;
cursor: pointer;
font-size: 10px;
position: absolute;
left: 50%;
transform: translateX(-50%);
bottom: -7px;
text-align: center;
pointer-events: all;
display: none;
line-height:1 !important;
padding:0 !important;
}

.pagelayer-show-wiget-list{
opacity:100%;
}

.pagelayer-show-wiget-list .pagelayer-shortcode-plus,
:not(.pagelayer-hide-active) > .pagelayer-ele-hover .pagelayer-shortcode-plus{
display: block !important;
}

.pagelayer-shortcode-plus .fas{
display: inline-block !important;
font-size: 10px !important;
padding: 2px !important;
background: #444;
color: #fff;
}

.pagelayer-shortcode-plus:hover .fas{
background: #0069d9;
}

[contenteditable]:focus{
outline: 0px;
}

[data-placeholder-text]::after{
display:flex;
content: attr(data-placeholder-text);
position:absolute;
top: 50%;
transform: translateY(-50%);
left:3px;
pointer-events:none;
opacity:0.6;
user-select:none;
}


/*!
 * Font Awesome Free 5.15.4 by @fontawesome - https://fontawesome.com
 * License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
 */.fa,.fab,.fad,.fal,.far,.fas{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;display:inline-block;font-style:normal;font-variant:normal;text-rendering:auto;line-height:1}.fa-lg{font-size:1.33333em;line-height:.75em;vertical-align:-.0667em}.fa-xs{font-size:.75em}.fa-sm{font-size:.875em}.fa-1x{font-size:1em}.fa-2x{font-size:2em}.fa-3x{font-size:3em}.fa-4x{font-size:4em}.fa-5x{font-size:5em}.fa-6x{font-size:6em}.fa-7x{font-size:7em}.fa-8x{font-size:8em}.fa-9x{font-size:9em}.fa-10x{font-size:10em}.fa-fw{text-align:center;width:1.25em}.fa-ul{list-style-type:none;margin-left:2.5em;padding-left:0}.fa-ul>li{position:relative}.fa-li{left:-2em;position:absolute;text-align:center;width:2em;line-height:inherit}.fa-border{border:.08em solid #eee;border-radius:.1em;padding:.2em .25em .15em}.fa-pull-left{float:left}.fa-pull-right{float:right}.fa.fa-pull-left,.fab.fa-pull-left,.fal.fa-pull-left,.far.fa-pull-left,.fas.fa-pull-left{margin-right:.3em}.fa.fa-pull-right,.fab.fa-pull-right,.fal.fa-pull-right,.far.fa-pull-right,.fas.fa-pull-right{margin-left:.3em}.fa-spin{-webkit-animation:fa-spin 2s linear infinite;animation:fa-spin 2s linear infinite}.fa-pulse{-webkit-animation:fa-spin 1s steps(8) infinite;animation:fa-spin 1s steps(8) infinite}@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}@keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}.fa-rotate-90{-webkit-transform:rotate(90deg);transform:rotate(90deg)}.fa-rotate-180{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.fa-rotate-270{-webkit-transform:rotate(270deg);transform:rotate(270deg)}.fa-flip-horizontal{-webkit-transform:scaleX(-1);transform:scaleX(-1)}.fa-flip-vertical{-webkit-transform:scaleY(-1);transform:scaleY(-1)}.fa-flip-both,.fa-flip-horizontal.fa-flip-vertical{-webkit-transform:scale(-1);transform:scale(-1)}:root .fa-flip-both,:root .fa-flip-horizontal,:root .fa-flip-vertical,:root .fa-rotate-180,:root .fa-rotate-270,:root .fa-rotate-90{-webkit-filter:none;filter:none}.fa-stack{display:inline-block;height:2em;line-height:2em;position:relative;vertical-align:middle;width:2.5em}.fa-stack-1x,.fa-stack-2x{left:0;position:absolute;text-align:center;width:100%}.fa-stack-1x{line-height:inherit}.fa-stack-2x{font-size:2em}.fa-inverse{color:#fff}.fa-500px:before{content:"\f26e"}.fa-accessible-icon:before{content:"\f368"}.fa-accusoft:before{content:"\f369"}.fa-acquisitions-incorporated:before{content:"\f6af"}.fa-ad:before{content:"\f641"}.fa-address-book:before{content:"\f2b9"}.fa-address-card:before{content:"\f2bb"}.fa-adjust:before{content:"\f042"}.fa-adn:before{content:"\f170"}.fa-adversal:before{content:"\f36a"}.fa-affiliatetheme:before{content:"\f36b"}.fa-air-freshener:before{content:"\f5d0"}.fa-airbnb:before{content:"\f834"}.fa-algolia:before{content:"\f36c"}.fa-align-center:before{content:"\f037"}.fa-align-justify:before{content:"\f039"}.fa-align-left:before{content:"\f036"}.fa-align-right:before{content:"\f038"}.fa-alipay:before{content:"\f642"}.fa-allergies:before{content:"\f461"}.fa-amazon:before{content:"\f270"}.fa-amazon-pay:before{content:"\f42c"}.fa-ambulance:before{content:"\f0f9"}.fa-american-sign-language-interpreting:before{content:"\f2a3"}.fa-amilia:before{content:"\f36d"}.fa-anchor:before{content:"\f13d"}.fa-android:before{content:"\f17b"}.fa-angellist:before{content:"\f209"}.fa-angle-double-down:before{content:"\f103"}.fa-angle-double-left:before{content:"\f100"}.fa-angle-double-right:before{content:"\f101"}.fa-angle-double-up:before{content:"\f102"}.fa-angle-down:before{content:"\f107"}.fa-angle-left:before{content:"\f104"}.fa-angle-right:before{content:"\f105"}.fa-angle-up:before{content:"\f106"}.fa-angry:before{content:"\f556"}.fa-angrycreative:before{content:"\f36e"}.fa-angular:before{content:"\f420"}.fa-ankh:before{content:"\f644"}.fa-app-store:before{content:"\f36f"}.fa-app-store-ios:before{content:"\f370"}.fa-apper:before{content:"\f371"}.fa-apple:before{content:"\f179"}.fa-apple-alt:before{content:"\f5d1"}.fa-apple-pay:before{content:"\f415"}.fa-archive:before{content:"\f187"}.fa-archway:before{content:"\f557"}.fa-arrow-alt-circle-down:before{content:"\f358"}.fa-arrow-alt-circle-left:before{content:"\f359"}.fa-arrow-alt-circle-right:before{content:"\f35a"}.fa-arrow-alt-circle-up:before{content:"\f35b"}.fa-arrow-circle-down:before{content:"\f0ab"}.fa-arrow-circle-left:before{content:"\f0a8"}.fa-arrow-circle-right:before{content:"\f0a9"}.fa-arrow-circle-up:before{content:"\f0aa"}.fa-arrow-down:before{content:"\f063"}.fa-arrow-left:before{content:"\f060"}.fa-arrow-right:before{content:"\f061"}.fa-arrow-up:before{content:"\f062"}.fa-arrows-alt:before{content:"\f0b2"}.fa-arrows-alt-h:before{content:"\f337"}.fa-arrows-alt-v:before{content:"\f338"}.fa-artstation:before{content:"\f77a"}.fa-assistive-listening-systems:before{content:"\f2a2"}.fa-asterisk:before{content:"\f069"}.fa-asymmetrik:before{content:"\f372"}.fa-at:before{content:"\f1fa"}.fa-atlas:before{content:"\f558"}.fa-atlassian:before{content:"\f77b"}.fa-atom:before{content:"\f5d2"}.fa-audible:before{content:"\f373"}.fa-audio-description:before{content:"\f29e"}.fa-autoprefixer:before{content:"\f41c"}.fa-avianex:before{content:"\f374"}.fa-aviato:before{content:"\f421"}.fa-award:before{content:"\f559"}.fa-aws:before{content:"\f375"}.fa-baby:before{content:"\f77c"}.fa-baby-carriage:before{content:"\f77d"}.fa-backspace:before{content:"\f55a"}.fa-backward:before{content:"\f04a"}.fa-bacon:before{content:"\f7e5"}.fa-bacteria:before{content:"\e059"}.fa-bacterium:before{content:"\e05a"}.fa-bahai:before{content:"\f666"}.fa-balance-scale:before{content:"\f24e"}.fa-balance-scale-left:before{content:"\f515"}.fa-balance-scale-right:before{content:"\f516"}.fa-ban:before{content:"\f05e"}.fa-band-aid:before{content:"\f462"}.fa-bandcamp:before{content:"\f2d5"}.fa-barcode:before{content:"\f02a"}.fa-bars:before{content:"\f0c9"}.fa-baseball-ball:before{content:"\f433"}.fa-basketball-ball:before{content:"\f434"}.fa-bath:before{content:"\f2cd"}.fa-battery-empty:before{content:"\f244"}.fa-battery-full:before{content:"\f240"}.fa-battery-half:before{content:"\f242"}.fa-battery-quarter:before{content:"\f243"}.fa-battery-three-quarters:before{content:"\f241"}.fa-battle-net:before{content:"\f835"}.fa-bed:before{content:"\f236"}.fa-beer:before{content:"\f0fc"}.fa-behance:before{content:"\f1b4"}.fa-behance-square:before{content:"\f1b5"}.fa-bell:before{content:"\f0f3"}.fa-bell-slash:before{content:"\f1f6"}.fa-bezier-curve:before{content:"\f55b"}.fa-bible:before{content:"\f647"}.fa-bicycle:before{content:"\f206"}.fa-biking:before{content:"\f84a"}.fa-bimobject:before{content:"\f378"}.fa-binoculars:before{content:"\f1e5"}.fa-biohazard:before{content:"\f780"}.fa-birthday-cake:before{content:"\f1fd"}.fa-bitbucket:before{content:"\f171"}.fa-bitcoin:before{content:"\f379"}.fa-bity:before{content:"\f37a"}.fa-black-tie:before{content:"\f27e"}.fa-blackberry:before{content:"\f37b"}.fa-blender:before{content:"\f517"}.fa-blender-phone:before{content:"\f6b6"}.fa-blind:before{content:"\f29d"}.fa-blog:before{content:"\f781"}.fa-blogger:before{content:"\f37c"}.fa-blogger-b:before{content:"\f37d"}.fa-bluetooth:before{content:"\f293"}.fa-bluetooth-b:before{content:"\f294"}.fa-bold:before{content:"\f032"}.fa-bolt:before{content:"\f0e7"}.fa-bomb:before{content:"\f1e2"}.fa-bone:before{content:"\f5d7"}.fa-bong:before{content:"\f55c"}.fa-book:before{content:"\f02d"}.fa-book-dead:before{content:"\f6b7"}.fa-book-medical:before{content:"\f7e6"}.fa-book-open:before{content:"\f518"}.fa-book-reader:before{content:"\f5da"}.fa-bookmark:before{content:"\f02e"}.fa-bootstrap:before{content:"\f836"}.fa-border-all:before{content:"\f84c"}.fa-border-none:before{content:"\f850"}.fa-border-style:before{content:"\f853"}.fa-bowling-ball:before{content:"\f436"}.fa-box:before{content:"\f466"}.fa-box-open:before{content:"\f49e"}.fa-box-tissue:before{content:"\e05b"}.fa-boxes:before{content:"\f468"}.fa-braille:before{content:"\f2a1"}.fa-brain:before{content:"\f5dc"}.fa-bread-slice:before{content:"\f7ec"}.fa-briefcase:before{content:"\f0b1"}.fa-briefcase-medical:before{content:"\f469"}.fa-broadcast-tower:before{content:"\f519"}.fa-broom:before{content:"\f51a"}.fa-brush:before{content:"\f55d"}.fa-btc:before{content:"\f15a"}.fa-buffer:before{content:"\f837"}.fa-bug:before{content:"\f188"}.fa-building:before{content:"\f1ad"}.fa-bullhorn:before{content:"\f0a1"}.fa-bullseye:before{content:"\f140"}.fa-burn:before{content:"\f46a"}.fa-buromobelexperte:before{content:"\f37f"}.fa-bus:before{content:"\f207"}.fa-bus-alt:before{content:"\f55e"}.fa-business-time:before{content:"\f64a"}.fa-buy-n-large:before{content:"\f8a6"}.fa-buysellads:before{content:"\f20d"}.fa-calculator:before{content:"\f1ec"}.fa-calendar:before{content:"\f133"}.fa-calendar-alt:before{content:"\f073"}.fa-calendar-check:before{content:"\f274"}.fa-calendar-day:before{content:"\f783"}.fa-calendar-minus:before{content:"\f272"}.fa-calendar-plus:before{content:"\f271"}.fa-calendar-times:before{content:"\f273"}.fa-calendar-week:before{content:"\f784"}.fa-camera:before{content:"\f030"}.fa-camera-retro:before{content:"\f083"}.fa-campground:before{content:"\f6bb"}.fa-canadian-maple-leaf:before{content:"\f785"}.fa-candy-cane:before{content:"\f786"}.fa-cannabis:before{content:"\f55f"}.fa-capsules:before{content:"\f46b"}.fa-car:before{content:"\f1b9"}.fa-car-alt:before{content:"\f5de"}.fa-car-battery:before{content:"\f5df"}.fa-car-crash:before{content:"\f5e1"}.fa-car-side:before{content:"\f5e4"}.fa-caravan:before{content:"\f8ff"}.fa-caret-down:before{content:"\f0d7"}.fa-caret-left:before{content:"\f0d9"}.fa-caret-right:before{content:"\f0da"}.fa-caret-square-down:before{content:"\f150"}.fa-caret-square-left:before{content:"\f191"}.fa-caret-square-right:before{content:"\f152"}.fa-caret-square-up:before{content:"\f151"}.fa-caret-up:before{content:"\f0d8"}.fa-carrot:before{content:"\f787"}.fa-cart-arrow-down:before{content:"\f218"}.fa-cart-plus:before{content:"\f217"}.fa-cash-register:before{content:"\f788"}.fa-cat:before{content:"\f6be"}.fa-cc-amazon-pay:before{content:"\f42d"}.fa-cc-amex:before{content:"\f1f3"}.fa-cc-apple-pay:before{content:"\f416"}.fa-cc-diners-club:before{content:"\f24c"}.fa-cc-discover:before{content:"\f1f2"}.fa-cc-jcb:before{content:"\f24b"}.fa-cc-mastercard:before{content:"\f1f1"}.fa-cc-paypal:before{content:"\f1f4"}.fa-cc-stripe:before{content:"\f1f5"}.fa-cc-visa:before{content:"\f1f0"}.fa-centercode:before{content:"\f380"}.fa-centos:before{content:"\f789"}.fa-certificate:before{content:"\f0a3"}.fa-chair:before{content:"\f6c0"}.fa-chalkboard:before{content:"\f51b"}.fa-chalkboard-teacher:before{content:"\f51c"}.fa-charging-station:before{content:"\f5e7"}.fa-chart-area:before{content:"\f1fe"}.fa-chart-bar:before{content:"\f080"}.fa-chart-line:before{content:"\f201"}.fa-chart-pie:before{content:"\f200"}.fa-check:before{content:"\f00c"}.fa-check-circle:before{content:"\f058"}.fa-check-double:before{content:"\f560"}.fa-check-square:before{content:"\f14a"}.fa-cheese:before{content:"\f7ef"}.fa-chess:before{content:"\f439"}.fa-chess-bishop:before{content:"\f43a"}.fa-chess-board:before{content:"\f43c"}.fa-chess-king:before{content:"\f43f"}.fa-chess-knight:before{content:"\f441"}.fa-chess-pawn:before{content:"\f443"}.fa-chess-queen:before{content:"\f445"}.fa-chess-rook:before{content:"\f447"}.fa-chevron-circle-down:before{content:"\f13a"}.fa-chevron-circle-left:before{content:"\f137"}.fa-chevron-circle-right:before{content:"\f138"}.fa-chevron-circle-up:before{content:"\f139"}.fa-chevron-down:before{content:"\f078"}.fa-chevron-left:before{content:"\f053"}.fa-chevron-right:before{content:"\f054"}.fa-chevron-up:before{content:"\f077"}.fa-child:before{content:"\f1ae"}.fa-chrome:before{content:"\f268"}.fa-chromecast:before{content:"\f838"}.fa-church:before{content:"\f51d"}.fa-circle:before{content:"\f111"}.fa-circle-notch:before{content:"\f1ce"}.fa-city:before{content:"\f64f"}.fa-clinic-medical:before{content:"\f7f2"}.fa-clipboard:before{content:"\f328"}.fa-clipboard-check:before{content:"\f46c"}.fa-clipboard-list:before{content:"\f46d"}.fa-clock:before{content:"\f017"}.fa-clone:before{content:"\f24d"}.fa-closed-captioning:before{content:"\f20a"}.fa-cloud:before{content:"\f0c2"}.fa-cloud-download-alt:before{content:"\f381"}.fa-cloud-meatball:before{content:"\f73b"}.fa-cloud-moon:before{content:"\f6c3"}.fa-cloud-moon-rain:before{content:"\f73c"}.fa-cloud-rain:before{content:"\f73d"}.fa-cloud-showers-heavy:before{content:"\f740"}.fa-cloud-sun:before{content:"\f6c4"}.fa-cloud-sun-rain:before{content:"\f743"}.fa-cloud-upload-alt:before{content:"\f382"}.fa-cloudflare:before{content:"\e07d"}.fa-cloudscale:before{content:"\f383"}.fa-cloudsmith:before{content:"\f384"}.fa-cloudversify:before{content:"\f385"}.fa-cocktail:before{content:"\f561"}.fa-code:before{content:"\f121"}.fa-code-branch:before{content:"\f126"}.fa-codepen:before{content:"\f1cb"}.fa-codiepie:before{content:"\f284"}.fa-coffee:before{content:"\f0f4"}.fa-cog:before{content:"\f013"}.fa-cogs:before{content:"\f085"}.fa-coins:before{content:"\f51e"}.fa-columns:before{content:"\f0db"}.fa-comment:before{content:"\f075"}.fa-comment-alt:before{content:"\f27a"}.fa-comment-dollar:before{content:"\f651"}.fa-comment-dots:before{content:"\f4ad"}.fa-comment-medical:before{content:"\f7f5"}.fa-comment-slash:before{content:"\f4b3"}.fa-comments:before{content:"\f086"}.fa-comments-dollar:before{content:"\f653"}.fa-compact-disc:before{content:"\f51f"}.fa-compass:before{content:"\f14e"}.fa-compress:before{content:"\f066"}.fa-compress-alt:before{content:"\f422"}.fa-compress-arrows-alt:before{content:"\f78c"}.fa-concierge-bell:before{content:"\f562"}.fa-confluence:before{content:"\f78d"}.fa-connectdevelop:before{content:"\f20e"}.fa-contao:before{content:"\f26d"}.fa-cookie:before{content:"\f563"}.fa-cookie-bite:before{content:"\f564"}.fa-copy:before{content:"\f0c5"}.fa-copyright:before{content:"\f1f9"}.fa-cotton-bureau:before{content:"\f89e"}.fa-couch:before{content:"\f4b8"}.fa-cpanel:before{content:"\f388"}.fa-creative-commons:before{content:"\f25e"}.fa-creative-commons-by:before{content:"\f4e7"}.fa-creative-commons-nc:before{content:"\f4e8"}.fa-creative-commons-nc-eu:before{content:"\f4e9"}.fa-creative-commons-nc-jp:before{content:"\f4ea"}.fa-creative-commons-nd:before{content:"\f4eb"}.fa-creative-commons-pd:before{content:"\f4ec"}.fa-creative-commons-pd-alt:before{content:"\f4ed"}.fa-creative-commons-remix:before{content:"\f4ee"}.fa-creative-commons-sa:before{content:"\f4ef"}.fa-creative-commons-sampling:before{content:"\f4f0"}.fa-creative-commons-sampling-plus:before{content:"\f4f1"}.fa-creative-commons-share:before{content:"\f4f2"}.fa-creative-commons-zero:before{content:"\f4f3"}.fa-credit-card:before{content:"\f09d"}.fa-critical-role:before{content:"\f6c9"}.fa-crop:before{content:"\f125"}.fa-crop-alt:before{content:"\f565"}.fa-cross:before{content:"\f654"}.fa-crosshairs:before{content:"\f05b"}.fa-crow:before{content:"\f520"}.fa-crown:before{content:"\f521"}.fa-crutch:before{content:"\f7f7"}.fa-css3:before{content:"\f13c"}.fa-css3-alt:before{content:"\f38b"}.fa-cube:before{content:"\f1b2"}.fa-cubes:before{content:"\f1b3"}.fa-cut:before{content:"\f0c4"}.fa-cuttlefish:before{content:"\f38c"}.fa-d-and-d:before{content:"\f38d"}.fa-d-and-d-beyond:before{content:"\f6ca"}.fa-dailymotion:before{content:"\e052"}.fa-dashcube:before{content:"\f210"}.fa-database:before{content:"\f1c0"}.fa-deaf:before{content:"\f2a4"}.fa-deezer:before{content:"\e077"}.fa-delicious:before{content:"\f1a5"}.fa-democrat:before{content:"\f747"}.fa-deploydog:before{content:"\f38e"}.fa-deskpro:before{content:"\f38f"}.fa-desktop:before{content:"\f108"}.fa-dev:before{content:"\f6cc"}.fa-deviantart:before{content:"\f1bd"}.fa-dharmachakra:before{content:"\f655"}.fa-dhl:before{content:"\f790"}.fa-diagnoses:before{content:"\f470"}.fa-diaspora:before{content:"\f791"}.fa-dice:before{content:"\f522"}.fa-dice-d20:before{content:"\f6cf"}.fa-dice-d6:before{content:"\f6d1"}.fa-dice-five:before{content:"\f523"}.fa-dice-four:before{content:"\f524"}.fa-dice-one:before{content:"\f525"}.fa-dice-six:before{content:"\f526"}.fa-dice-three:before{content:"\f527"}.fa-dice-two:before{content:"\f528"}.fa-digg:before{content:"\f1a6"}.fa-digital-ocean:before{content:"\f391"}.fa-digital-tachograph:before{content:"\f566"}.fa-directions:before{content:"\f5eb"}.fa-discord:before{content:"\f392"}.fa-discourse:before{content:"\f393"}.fa-disease:before{content:"\f7fa"}.fa-divide:before{content:"\f529"}.fa-dizzy:before{content:"\f567"}.fa-dna:before{content:"\f471"}.fa-dochub:before{content:"\f394"}.fa-docker:before{content:"\f395"}.fa-dog:before{content:"\f6d3"}.fa-dollar-sign:before{content:"\f155"}.fa-dolly:before{content:"\f472"}.fa-dolly-flatbed:before{content:"\f474"}.fa-donate:before{content:"\f4b9"}.fa-door-closed:before{content:"\f52a"}.fa-door-open:before{content:"\f52b"}.fa-dot-circle:before{content:"\f192"}.fa-dove:before{content:"\f4ba"}.fa-download:before{content:"\f019"}.fa-draft2digital:before{content:"\f396"}.fa-drafting-compass:before{content:"\f568"}.fa-dragon:before{content:"\f6d5"}.fa-draw-polygon:before{content:"\f5ee"}.fa-dribbble:before{content:"\f17d"}.fa-dribbble-square:before{content:"\f397"}.fa-dropbox:before{content:"\f16b"}.fa-drum:before{content:"\f569"}.fa-drum-steelpan:before{content:"\f56a"}.fa-drumstick-bite:before{content:"\f6d7"}.fa-drupal:before{content:"\f1a9"}.fa-dumbbell:before{content:"\f44b"}.fa-dumpster:before{content:"\f793"}.fa-dumpster-fire:before{content:"\f794"}.fa-dungeon:before{content:"\f6d9"}.fa-dyalog:before{content:"\f399"}.fa-earlybirds:before{content:"\f39a"}.fa-ebay:before{content:"\f4f4"}.fa-edge:before{content:"\f282"}.fa-edge-legacy:before{content:"\e078"}.fa-edit:before{content:"\f044"}.fa-egg:before{content:"\f7fb"}.fa-eject:before{content:"\f052"}.fa-elementor:before{content:"\f430"}.fa-ellipsis-h:before{content:"\f141"}.fa-ellipsis-v:before{content:"\f142"}.fa-ello:before{content:"\f5f1"}.fa-ember:before{content:"\f423"}.fa-empire:before{content:"\f1d1"}.fa-envelope:before{content:"\f0e0"}.fa-envelope-open:before{content:"\f2b6"}.fa-envelope-open-text:before{content:"\f658"}.fa-envelope-square:before{content:"\f199"}.fa-envira:before{content:"\f299"}.fa-equals:before{content:"\f52c"}.fa-eraser:before{content:"\f12d"}.fa-erlang:before{content:"\f39d"}.fa-ethereum:before{content:"\f42e"}.fa-ethernet:before{content:"\f796"}.fa-etsy:before{content:"\f2d7"}.fa-euro-sign:before{content:"\f153"}.fa-evernote:before{content:"\f839"}.fa-exchange-alt:before{content:"\f362"}.fa-exclamation:before{content:"\f12a"}.fa-exclamation-circle:before{content:"\f06a"}.fa-exclamation-triangle:before{content:"\f071"}.fa-expand:before{content:"\f065"}.fa-expand-alt:before{content:"\f424"}.fa-expand-arrows-alt:before{content:"\f31e"}.fa-expeditedssl:before{content:"\f23e"}.fa-external-link-alt:before{content:"\f35d"}.fa-external-link-square-alt:before{content:"\f360"}.fa-eye:before{content:"\f06e"}.fa-eye-dropper:before{content:"\f1fb"}.fa-eye-slash:before{content:"\f070"}.fa-facebook:before{content:"\f09a"}.fa-facebook-f:before{content:"\f39e"}.fa-facebook-messenger:before{content:"\f39f"}.fa-facebook-square:before{content:"\f082"}.fa-fan:before{content:"\f863"}.fa-fantasy-flight-games:before{content:"\f6dc"}.fa-fast-backward:before{content:"\f049"}.fa-fast-forward:before{content:"\f050"}.fa-faucet:before{content:"\e005"}.fa-fax:before{content:"\f1ac"}.fa-feather:before{content:"\f52d"}.fa-feather-alt:before{content:"\f56b"}.fa-fedex:before{content:"\f797"}.fa-fedora:before{content:"\f798"}.fa-female:before{content:"\f182"}.fa-fighter-jet:before{content:"\f0fb"}.fa-figma:before{content:"\f799"}.fa-file:before{content:"\f15b"}.fa-file-alt:before{content:"\f15c"}.fa-file-archive:before{content:"\f1c6"}.fa-file-audio:before{content:"\f1c7"}.fa-file-code:before{content:"\f1c9"}.fa-file-contract:before{content:"\f56c"}.fa-file-csv:before{content:"\f6dd"}.fa-file-download:before{content:"\f56d"}.fa-file-excel:before{content:"\f1c3"}.fa-file-export:before{content:"\f56e"}.fa-file-image:before{content:"\f1c5"}.fa-file-import:before{content:"\f56f"}.fa-file-invoice:before{content:"\f570"}.fa-file-invoice-dollar:before{content:"\f571"}.fa-file-medical:before{content:"\f477"}.fa-file-medical-alt:before{content:"\f478"}.fa-file-pdf:before{content:"\f1c1"}.fa-file-powerpoint:before{content:"\f1c4"}.fa-file-prescription:before{content:"\f572"}.fa-file-signature:before{content:"\f573"}.fa-file-upload:before{content:"\f574"}.fa-file-video:before{content:"\f1c8"}.fa-file-word:before{content:"\f1c2"}.fa-fill:before{content:"\f575"}.fa-fill-drip:before{content:"\f576"}.fa-film:before{content:"\f008"}.fa-filter:before{content:"\f0b0"}.fa-fingerprint:before{content:"\f577"}.fa-fire:before{content:"\f06d"}.fa-fire-alt:before{content:"\f7e4"}.fa-fire-extinguisher:before{content:"\f134"}.fa-firefox:before{content:"\f269"}.fa-firefox-browser:before{content:"\e007"}.fa-first-aid:before{content:"\f479"}.fa-first-order:before{content:"\f2b0"}.fa-first-order-alt:before{content:"\f50a"}.fa-firstdraft:before{content:"\f3a1"}.fa-fish:before{content:"\f578"}.fa-fist-raised:before{content:"\f6de"}.fa-flag:before{content:"\f024"}.fa-flag-checkered:before{content:"\f11e"}.fa-flag-usa:before{content:"\f74d"}.fa-flask:before{content:"\f0c3"}.fa-flickr:before{content:"\f16e"}.fa-flipboard:before{content:"\f44d"}.fa-flushed:before{content:"\f579"}.fa-fly:before{content:"\f417"}.fa-folder:before{content:"\f07b"}.fa-folder-minus:before{content:"\f65d"}.fa-folder-open:before{content:"\f07c"}.fa-folder-plus:before{content:"\f65e"}.fa-font:before{content:"\f031"}.fa-font-awesome:before{content:"\f2b4"}.fa-font-awesome-alt:before{content:"\f35c"}.fa-font-awesome-flag:before{content:"\f425"}.fa-font-awesome-logo-full:before{content:"\f4e6"}.fa-fonticons:before{content:"\f280"}.fa-fonticons-fi:before{content:"\f3a2"}.fa-football-ball:before{content:"\f44e"}.fa-fort-awesome:before{content:"\f286"}.fa-fort-awesome-alt:before{content:"\f3a3"}.fa-forumbee:before{content:"\f211"}.fa-forward:before{content:"\f04e"}.fa-foursquare:before{content:"\f180"}.fa-free-code-camp:before{content:"\f2c5"}.fa-freebsd:before{content:"\f3a4"}.fa-frog:before{content:"\f52e"}.fa-frown:before{content:"\f119"}.fa-frown-open:before{content:"\f57a"}.fa-fulcrum:before{content:"\f50b"}.fa-funnel-dollar:before{content:"\f662"}.fa-futbol:before{content:"\f1e3"}.fa-galactic-republic:before{content:"\f50c"}.fa-galactic-senate:before{content:"\f50d"}.fa-gamepad:before{content:"\f11b"}.fa-gas-pump:before{content:"\f52f"}.fa-gavel:before{content:"\f0e3"}.fa-gem:before{content:"\f3a5"}.fa-genderless:before{content:"\f22d"}.fa-get-pocket:before{content:"\f265"}.fa-gg:before{content:"\f260"}.fa-gg-circle:before{content:"\f261"}.fa-ghost:before{content:"\f6e2"}.fa-gift:before{content:"\f06b"}.fa-gifts:before{content:"\f79c"}.fa-git:before{content:"\f1d3"}.fa-git-alt:before{content:"\f841"}.fa-git-square:before{content:"\f1d2"}.fa-github:before{content:"\f09b"}.fa-github-alt:before{content:"\f113"}.fa-github-square:before{content:"\f092"}.fa-gitkraken:before{content:"\f3a6"}.fa-gitlab:before{content:"\f296"}.fa-gitter:before{content:"\f426"}.fa-glass-cheers:before{content:"\f79f"}.fa-glass-martini:before{content:"\f000"}.fa-glass-martini-alt:before{content:"\f57b"}.fa-glass-whiskey:before{content:"\f7a0"}.fa-glasses:before{content:"\f530"}.fa-glide:before{content:"\f2a5"}.fa-glide-g:before{content:"\f2a6"}.fa-globe:before{content:"\f0ac"}.fa-globe-africa:before{content:"\f57c"}.fa-globe-americas:before{content:"\f57d"}.fa-globe-asia:before{content:"\f57e"}.fa-globe-europe:before{content:"\f7a2"}.fa-gofore:before{content:"\f3a7"}.fa-golf-ball:before{content:"\f450"}.fa-goodreads:before{content:"\f3a8"}.fa-goodreads-g:before{content:"\f3a9"}.fa-google:before{content:"\f1a0"}.fa-google-drive:before{content:"\f3aa"}.fa-google-pay:before{content:"\e079"}.fa-google-play:before{content:"\f3ab"}.fa-google-plus:before{content:"\f2b3"}.fa-google-plus-g:before{content:"\f0d5"}.fa-google-plus-square:before{content:"\f0d4"}.fa-google-wallet:before{content:"\f1ee"}.fa-gopuram:before{content:"\f664"}.fa-graduation-cap:before{content:"\f19d"}.fa-gratipay:before{content:"\f184"}.fa-grav:before{content:"\f2d6"}.fa-greater-than:before{content:"\f531"}.fa-greater-than-equal:before{content:"\f532"}.fa-grimace:before{content:"\f57f"}.fa-grin:before{content:"\f580"}.fa-grin-alt:before{content:"\f581"}.fa-grin-beam:before{content:"\f582"}.fa-grin-beam-sweat:before{content:"\f583"}.fa-grin-hearts:before{content:"\f584"}.fa-grin-squint:before{content:"\f585"}.fa-grin-squint-tears:before{content:"\f586"}.fa-grin-stars:before{content:"\f587"}.fa-grin-tears:before{content:"\f588"}.fa-grin-tongue:before{content:"\f589"}.fa-grin-tongue-squint:before{content:"\f58a"}.fa-grin-tongue-wink:before{content:"\f58b"}.fa-grin-wink:before{content:"\f58c"}.fa-grip-horizontal:before{content:"\f58d"}.fa-grip-lines:before{content:"\f7a4"}.fa-grip-lines-vertical:before{content:"\f7a5"}.fa-grip-vertical:before{content:"\f58e"}.fa-gripfire:before{content:"\f3ac"}.fa-grunt:before{content:"\f3ad"}.fa-guilded:before{content:"\e07e"}.fa-guitar:before{content:"\f7a6"}.fa-gulp:before{content:"\f3ae"}.fa-h-square:before{content:"\f0fd"}.fa-hacker-news:before{content:"\f1d4"}.fa-hacker-news-square:before{content:"\f3af"}.fa-hackerrank:before{content:"\f5f7"}.fa-hamburger:before{content:"\f805"}.fa-hammer:before{content:"\f6e3"}.fa-hamsa:before{content:"\f665"}.fa-hand-holding:before{content:"\f4bd"}.fa-hand-holding-heart:before{content:"\f4be"}.fa-hand-holding-medical:before{content:"\e05c"}.fa-hand-holding-usd:before{content:"\f4c0"}.fa-hand-holding-water:before{content:"\f4c1"}.fa-hand-lizard:before{content:"\f258"}.fa-hand-middle-finger:before{content:"\f806"}.fa-hand-paper:before{content:"\f256"}.fa-hand-peace:before{content:"\f25b"}.fa-hand-point-down:before{content:"\f0a7"}.fa-hand-point-left:before{content:"\f0a5"}.fa-hand-point-right:before{content:"\f0a4"}.fa-hand-point-up:before{content:"\f0a6"}.fa-hand-pointer:before{content:"\f25a"}.fa-hand-rock:before{content:"\f255"}.fa-hand-scissors:before{content:"\f257"}.fa-hand-sparkles:before{content:"\e05d"}.fa-hand-spock:before{content:"\f259"}.fa-hands:before{content:"\f4c2"}.fa-hands-helping:before{content:"\f4c4"}.fa-hands-wash:before{content:"\e05e"}.fa-handshake:before{content:"\f2b5"}.fa-handshake-alt-slash:before{content:"\e05f"}.fa-handshake-slash:before{content:"\e060"}.fa-hanukiah:before{content:"\f6e6"}.fa-hard-hat:before{content:"\f807"}.fa-hashtag:before{content:"\f292"}.fa-hat-cowboy:before{content:"\f8c0"}.fa-hat-cowboy-side:before{content:"\f8c1"}.fa-hat-wizard:before{content:"\f6e8"}.fa-hdd:before{content:"\f0a0"}.fa-head-side-cough:before{content:"\e061"}.fa-head-side-cough-slash:before{content:"\e062"}.fa-head-side-mask:before{content:"\e063"}.fa-head-side-virus:before{content:"\e064"}.fa-heading:before{content:"\f1dc"}.fa-headphones:before{content:"\f025"}.fa-headphones-alt:before{content:"\f58f"}.fa-headset:before{content:"\f590"}.fa-heart:before{content:"\f004"}.fa-heart-broken:before{content:"\f7a9"}.fa-heartbeat:before{content:"\f21e"}.fa-helicopter:before{content:"\f533"}.fa-highlighter:before{content:"\f591"}.fa-hiking:before{content:"\f6ec"}.fa-hippo:before{content:"\f6ed"}.fa-hips:before{content:"\f452"}.fa-hire-a-helper:before{content:"\f3b0"}.fa-history:before{content:"\f1da"}.fa-hive:before{content:"\e07f"}.fa-hockey-puck:before{content:"\f453"}.fa-holly-berry:before{content:"\f7aa"}.fa-home:before{content:"\f015"}.fa-hooli:before{content:"\f427"}.fa-hornbill:before{content:"\f592"}.fa-horse:before{content:"\f6f0"}.fa-horse-head:before{content:"\f7ab"}.fa-hospital:before{content:"\f0f8"}.fa-hospital-alt:before{content:"\f47d"}.fa-hospital-symbol:before{content:"\f47e"}.fa-hospital-user:before{content:"\f80d"}.fa-hot-tub:before{content:"\f593"}.fa-hotdog:before{content:"\f80f"}.fa-hotel:before{content:"\f594"}.fa-hotjar:before{content:"\f3b1"}.fa-hourglass:before{content:"\f254"}.fa-hourglass-end:before{content:"\f253"}.fa-hourglass-half:before{content:"\f252"}.fa-hourglass-start:before{content:"\f251"}.fa-house-damage:before{content:"\f6f1"}.fa-house-user:before{content:"\e065"}.fa-houzz:before{content:"\f27c"}.fa-hryvnia:before{content:"\f6f2"}.fa-html5:before{content:"\f13b"}.fa-hubspot:before{content:"\f3b2"}.fa-i-cursor:before{content:"\f246"}.fa-ice-cream:before{content:"\f810"}.fa-icicles:before{content:"\f7ad"}.fa-icons:before{content:"\f86d"}.fa-id-badge:before{content:"\f2c1"}.fa-id-card:before{content:"\f2c2"}.fa-id-card-alt:before{content:"\f47f"}.fa-ideal:before{content:"\e013"}.fa-igloo:before{content:"\f7ae"}.fa-image:before{content:"\f03e"}.fa-images:before{content:"\f302"}.fa-imdb:before{content:"\f2d8"}.fa-inbox:before{content:"\f01c"}.fa-indent:before{content:"\f03c"}.fa-industry:before{content:"\f275"}.fa-infinity:before{content:"\f534"}.fa-info:before{content:"\f129"}.fa-info-circle:before{content:"\f05a"}.fa-innosoft:before{content:"\e080"}.fa-instagram:before{content:"\f16d"}.fa-instagram-square:before{content:"\e055"}.fa-instalod:before{content:"\e081"}.fa-intercom:before{content:"\f7af"}.fa-internet-explorer:before{content:"\f26b"}.fa-invision:before{content:"\f7b0"}.fa-ioxhost:before{content:"\f208"}.fa-italic:before{content:"\f033"}.fa-itch-io:before{content:"\f83a"}.fa-itunes:before{content:"\f3b4"}.fa-itunes-note:before{content:"\f3b5"}.fa-java:before{content:"\f4e4"}.fa-jedi:before{content:"\f669"}.fa-jedi-order:before{content:"\f50e"}.fa-jenkins:before{content:"\f3b6"}.fa-jira:before{content:"\f7b1"}.fa-joget:before{content:"\f3b7"}.fa-joint:before{content:"\f595"}.fa-joomla:before{content:"\f1aa"}.fa-journal-whills:before{content:"\f66a"}.fa-js:before{content:"\f3b8"}.fa-js-square:before{content:"\f3b9"}.fa-jsfiddle:before{content:"\f1cc"}.fa-kaaba:before{content:"\f66b"}.fa-kaggle:before{content:"\f5fa"}.fa-key:before{content:"\f084"}.fa-keybase:before{content:"\f4f5"}.fa-keyboard:before{content:"\f11c"}.fa-keycdn:before{content:"\f3ba"}.fa-khanda:before{content:"\f66d"}.fa-kickstarter:before{content:"\f3bb"}.fa-kickstarter-k:before{content:"\f3bc"}.fa-kiss:before{content:"\f596"}.fa-kiss-beam:before{content:"\f597"}.fa-kiss-wink-heart:before{content:"\f598"}.fa-kiwi-bird:before{content:"\f535"}.fa-korvue:before{content:"\f42f"}.fa-landmark:before{content:"\f66f"}.fa-language:before{content:"\f1ab"}.fa-laptop:before{content:"\f109"}.fa-laptop-code:before{content:"\f5fc"}.fa-laptop-house:before{content:"\e066"}.fa-laptop-medical:before{content:"\f812"}.fa-laravel:before{content:"\f3bd"}.fa-lastfm:before{content:"\f202"}.fa-lastfm-square:before{content:"\f203"}.fa-laugh:before{content:"\f599"}.fa-laugh-beam:before{content:"\f59a"}.fa-laugh-squint:before{content:"\f59b"}.fa-laugh-wink:before{content:"\f59c"}.fa-layer-group:before{content:"\f5fd"}.fa-leaf:before{content:"\f06c"}.fa-leanpub:before{content:"\f212"}.fa-lemon:before{content:"\f094"}.fa-less:before{content:"\f41d"}.fa-less-than:before{content:"\f536"}.fa-less-than-equal:before{content:"\f537"}.fa-level-down-alt:before{content:"\f3be"}.fa-level-up-alt:before{content:"\f3bf"}.fa-life-ring:before{content:"\f1cd"}.fa-lightbulb:before{content:"\f0eb"}.fa-line:before{content:"\f3c0"}.fa-link:before{content:"\f0c1"}.fa-linkedin:before{content:"\f08c"}.fa-linkedin-in:before{content:"\f0e1"}.fa-linode:before{content:"\f2b8"}.fa-linux:before{content:"\f17c"}.fa-lira-sign:before{content:"\f195"}.fa-list:before{content:"\f03a"}.fa-list-alt:before{content:"\f022"}.fa-list-ol:before{content:"\f0cb"}.fa-list-ul:before{content:"\f0ca"}.fa-location-arrow:before{content:"\f124"}.fa-lock:before{content:"\f023"}.fa-lock-open:before{content:"\f3c1"}.fa-long-arrow-alt-down:before{content:"\f309"}.fa-long-arrow-alt-left:before{content:"\f30a"}.fa-long-arrow-alt-right:before{content:"\f30b"}.fa-long-arrow-alt-up:before{content:"\f30c"}.fa-low-vision:before{content:"\f2a8"}.fa-luggage-cart:before{content:"\f59d"}.fa-lungs:before{content:"\f604"}.fa-lungs-virus:before{content:"\e067"}.fa-lyft:before{content:"\f3c3"}.fa-magento:before{content:"\f3c4"}.fa-magic:before{content:"\f0d0"}.fa-magnet:before{content:"\f076"}.fa-mail-bulk:before{content:"\f674"}.fa-mailchimp:before{content:"\f59e"}.fa-male:before{content:"\f183"}.fa-mandalorian:before{content:"\f50f"}.fa-map:before{content:"\f279"}.fa-map-marked:before{content:"\f59f"}.fa-map-marked-alt:before{content:"\f5a0"}.fa-map-marker:before{content:"\f041"}.fa-map-marker-alt:before{content:"\f3c5"}.fa-map-pin:before{content:"\f276"}.fa-map-signs:before{content:"\f277"}.fa-markdown:before{content:"\f60f"}.fa-marker:before{content:"\f5a1"}.fa-mars:before{content:"\f222"}.fa-mars-double:before{content:"\f227"}.fa-mars-stroke:before{content:"\f229"}.fa-mars-stroke-h:before{content:"\f22b"}.fa-mars-stroke-v:before{content:"\f22a"}.fa-mask:before{content:"\f6fa"}.fa-mastodon:before{content:"\f4f6"}.fa-maxcdn:before{content:"\f136"}.fa-mdb:before{content:"\f8ca"}.fa-medal:before{content:"\f5a2"}.fa-medapps:before{content:"\f3c6"}.fa-medium:before{content:"\f23a"}.fa-medium-m:before{content:"\f3c7"}.fa-medkit:before{content:"\f0fa"}.fa-medrt:before{content:"\f3c8"}.fa-meetup:before{content:"\f2e0"}.fa-megaport:before{content:"\f5a3"}.fa-meh:before{content:"\f11a"}.fa-meh-blank:before{content:"\f5a4"}.fa-meh-rolling-eyes:before{content:"\f5a5"}.fa-memory:before{content:"\f538"}.fa-mendeley:before{content:"\f7b3"}.fa-menorah:before{content:"\f676"}.fa-mercury:before{content:"\f223"}.fa-meteor:before{content:"\f753"}.fa-microblog:before{content:"\e01a"}.fa-microchip:before{content:"\f2db"}.fa-microphone:before{content:"\f130"}.fa-microphone-alt:before{content:"\f3c9"}.fa-microphone-alt-slash:before{content:"\f539"}.fa-microphone-slash:before{content:"\f131"}.fa-microscope:before{content:"\f610"}.fa-microsoft:before{content:"\f3ca"}.fa-minus:before{content:"\f068"}.fa-minus-circle:before{content:"\f056"}.fa-minus-square:before{content:"\f146"}.fa-mitten:before{content:"\f7b5"}.fa-mix:before{content:"\f3cb"}.fa-mixcloud:before{content:"\f289"}.fa-mixer:before{content:"\e056"}.fa-mizuni:before{content:"\f3cc"}.fa-mobile:before{content:"\f10b"}.fa-mobile-alt:before{content:"\f3cd"}.fa-modx:before{content:"\f285"}.fa-monero:before{content:"\f3d0"}.fa-money-bill:before{content:"\f0d6"}.fa-money-bill-alt:before{content:"\f3d1"}.fa-money-bill-wave:before{content:"\f53a"}.fa-money-bill-wave-alt:before{content:"\f53b"}.fa-money-check:before{content:"\f53c"}.fa-money-check-alt:before{content:"\f53d"}.fa-monument:before{content:"\f5a6"}.fa-moon:before{content:"\f186"}.fa-mortar-pestle:before{content:"\f5a7"}.fa-mosque:before{content:"\f678"}.fa-motorcycle:before{content:"\f21c"}.fa-mountain:before{content:"\f6fc"}.fa-mouse:before{content:"\f8cc"}.fa-mouse-pointer:before{content:"\f245"}.fa-mug-hot:before{content:"\f7b6"}.fa-music:before{content:"\f001"}.fa-napster:before{content:"\f3d2"}.fa-neos:before{content:"\f612"}.fa-network-wired:before{content:"\f6ff"}.fa-neuter:before{content:"\f22c"}.fa-newspaper:before{content:"\f1ea"}.fa-nimblr:before{content:"\f5a8"}.fa-node:before{content:"\f419"}.fa-node-js:before{content:"\f3d3"}.fa-not-equal:before{content:"\f53e"}.fa-notes-medical:before{content:"\f481"}.fa-npm:before{content:"\f3d4"}.fa-ns8:before{content:"\f3d5"}.fa-nutritionix:before{content:"\f3d6"}.fa-object-group:before{content:"\f247"}.fa-object-ungroup:before{content:"\f248"}.fa-octopus-deploy:before{content:"\e082"}.fa-odnoklassniki:before{content:"\f263"}.fa-odnoklassniki-square:before{content:"\f264"}.fa-oil-can:before{content:"\f613"}.fa-old-republic:before{content:"\f510"}.fa-om:before{content:"\f679"}.fa-opencart:before{content:"\f23d"}.fa-openid:before{content:"\f19b"}.fa-opera:before{content:"\f26a"}.fa-optin-monster:before{content:"\f23c"}.fa-orcid:before{content:"\f8d2"}.fa-osi:before{content:"\f41a"}.fa-otter:before{content:"\f700"}.fa-outdent:before{content:"\f03b"}.fa-page4:before{content:"\f3d7"}.fa-pagelines:before{content:"\f18c"}.fa-pager:before{content:"\f815"}.fa-paint-brush:before{content:"\f1fc"}.fa-paint-roller:before{content:"\f5aa"}.fa-palette:before{content:"\f53f"}.fa-palfed:before{content:"\f3d8"}.fa-pallet:before{content:"\f482"}.fa-paper-plane:before{content:"\f1d8"}.fa-paperclip:before{content:"\f0c6"}.fa-parachute-box:before{content:"\f4cd"}.fa-paragraph:before{content:"\f1dd"}.fa-parking:before{content:"\f540"}.fa-passport:before{content:"\f5ab"}.fa-pastafarianism:before{content:"\f67b"}.fa-paste:before{content:"\f0ea"}.fa-patreon:before{content:"\f3d9"}.fa-pause:before{content:"\f04c"}.fa-pause-circle:before{content:"\f28b"}.fa-paw:before{content:"\f1b0"}.fa-paypal:before{content:"\f1ed"}.fa-peace:before{content:"\f67c"}.fa-pen:before{content:"\f304"}.fa-pen-alt:before{content:"\f305"}.fa-pen-fancy:before{content:"\f5ac"}.fa-pen-nib:before{content:"\f5ad"}.fa-pen-square:before{content:"\f14b"}.fa-pencil-alt:before{content:"\f303"}.fa-pencil-ruler:before{content:"\f5ae"}.fa-penny-arcade:before{content:"\f704"}.fa-people-arrows:before{content:"\e068"}.fa-people-carry:before{content:"\f4ce"}.fa-pepper-hot:before{content:"\f816"}.fa-perbyte:before{content:"\e083"}.fa-percent:before{content:"\f295"}.fa-percentage:before{content:"\f541"}.fa-periscope:before{content:"\f3da"}.fa-person-booth:before{content:"\f756"}.fa-phabricator:before{content:"\f3db"}.fa-phoenix-framework:before{content:"\f3dc"}.fa-phoenix-squadron:before{content:"\f511"}.fa-phone:before{content:"\f095"}.fa-phone-alt:before{content:"\f879"}.fa-phone-slash:before{content:"\f3dd"}.fa-phone-square:before{content:"\f098"}.fa-phone-square-alt:before{content:"\f87b"}.fa-phone-volume:before{content:"\f2a0"}.fa-photo-video:before{content:"\f87c"}.fa-php:before{content:"\f457"}.fa-pied-piper:before{content:"\f2ae"}.fa-pied-piper-alt:before{content:"\f1a8"}.fa-pied-piper-hat:before{content:"\f4e5"}.fa-pied-piper-pp:before{content:"\f1a7"}.fa-pied-piper-square:before{content:"\e01e"}.fa-piggy-bank:before{content:"\f4d3"}.fa-pills:before{content:"\f484"}.fa-pinterest:before{content:"\f0d2"}.fa-pinterest-p:before{content:"\f231"}.fa-pinterest-square:before{content:"\f0d3"}.fa-pizza-slice:before{content:"\f818"}.fa-place-of-worship:before{content:"\f67f"}.fa-plane:before{content:"\f072"}.fa-plane-arrival:before{content:"\f5af"}.fa-plane-departure:before{content:"\f5b0"}.fa-plane-slash:before{content:"\e069"}.fa-play:before{content:"\f04b"}.fa-play-circle:before{content:"\f144"}.fa-playstation:before{content:"\f3df"}.fa-plug:before{content:"\f1e6"}.fa-plus:before{content:"\f067"}.fa-plus-circle:before{content:"\f055"}.fa-plus-square:before{content:"\f0fe"}.fa-podcast:before{content:"\f2ce"}.fa-poll:before{content:"\f681"}.fa-poll-h:before{content:"\f682"}.fa-poo:before{content:"\f2fe"}.fa-poo-storm:before{content:"\f75a"}.fa-poop:before{content:"\f619"}.fa-portrait:before{content:"\f3e0"}.fa-pound-sign:before{content:"\f154"}.fa-power-off:before{content:"\f011"}.fa-pray:before{content:"\f683"}.fa-praying-hands:before{content:"\f684"}.fa-prescription:before{content:"\f5b1"}.fa-prescription-bottle:before{content:"\f485"}.fa-prescription-bottle-alt:before{content:"\f486"}.fa-print:before{content:"\f02f"}.fa-procedures:before{content:"\f487"}.fa-product-hunt:before{content:"\f288"}.fa-project-diagram:before{content:"\f542"}.fa-pump-medical:before{content:"\e06a"}.fa-pump-soap:before{content:"\e06b"}.fa-pushed:before{content:"\f3e1"}.fa-puzzle-piece:before{content:"\f12e"}.fa-python:before{content:"\f3e2"}.fa-qq:before{content:"\f1d6"}.fa-qrcode:before{content:"\f029"}.fa-question:before{content:"\f128"}.fa-question-circle:before{content:"\f059"}.fa-quidditch:before{content:"\f458"}.fa-quinscape:before{content:"\f459"}.fa-quora:before{content:"\f2c4"}.fa-quote-left:before{content:"\f10d"}.fa-quote-right:before{content:"\f10e"}.fa-quran:before{content:"\f687"}.fa-r-project:before{content:"\f4f7"}.fa-radiation:before{content:"\f7b9"}.fa-radiation-alt:before{content:"\f7ba"}.fa-rainbow:before{content:"\f75b"}.fa-random:before{content:"\f074"}.fa-raspberry-pi:before{content:"\f7bb"}.fa-ravelry:before{content:"\f2d9"}.fa-react:before{content:"\f41b"}.fa-reacteurope:before{content:"\f75d"}.fa-readme:before{content:"\f4d5"}.fa-rebel:before{content:"\f1d0"}.fa-receipt:before{content:"\f543"}.fa-record-vinyl:before{content:"\f8d9"}.fa-recycle:before{content:"\f1b8"}.fa-red-river:before{content:"\f3e3"}.fa-reddit:before{content:"\f1a1"}.fa-reddit-alien:before{content:"\f281"}.fa-reddit-square:before{content:"\f1a2"}.fa-redhat:before{content:"\f7bc"}.fa-redo:before{content:"\f01e"}.fa-redo-alt:before{content:"\f2f9"}.fa-registered:before{content:"\f25d"}.fa-remove-format:before{content:"\f87d"}.fa-renren:before{content:"\f18b"}.fa-reply:before{content:"\f3e5"}.fa-reply-all:before{content:"\f122"}.fa-replyd:before{content:"\f3e6"}.fa-republican:before{content:"\f75e"}.fa-researchgate:before{content:"\f4f8"}.fa-resolving:before{content:"\f3e7"}.fa-restroom:before{content:"\f7bd"}.fa-retweet:before{content:"\f079"}.fa-rev:before{content:"\f5b2"}.fa-ribbon:before{content:"\f4d6"}.fa-ring:before{content:"\f70b"}.fa-road:before{content:"\f018"}.fa-robot:before{content:"\f544"}.fa-rocket:before{content:"\f135"}.fa-rocketchat:before{content:"\f3e8"}.fa-rockrms:before{content:"\f3e9"}.fa-route:before{content:"\f4d7"}.fa-rss:before{content:"\f09e"}.fa-rss-square:before{content:"\f143"}.fa-ruble-sign:before{content:"\f158"}.fa-ruler:before{content:"\f545"}.fa-ruler-combined:before{content:"\f546"}.fa-ruler-horizontal:before{content:"\f547"}.fa-ruler-vertical:before{content:"\f548"}.fa-running:before{content:"\f70c"}.fa-rupee-sign:before{content:"\f156"}.fa-rust:before{content:"\e07a"}.fa-sad-cry:before{content:"\f5b3"}.fa-sad-tear:before{content:"\f5b4"}.fa-safari:before{content:"\f267"}.fa-salesforce:before{content:"\f83b"}.fa-sass:before{content:"\f41e"}.fa-satellite:before{content:"\f7bf"}.fa-satellite-dish:before{content:"\f7c0"}.fa-save:before{content:"\f0c7"}.fa-schlix:before{content:"\f3ea"}.fa-school:before{content:"\f549"}.fa-screwdriver:before{content:"\f54a"}.fa-scribd:before{content:"\f28a"}.fa-scroll:before{content:"\f70e"}.fa-sd-card:before{content:"\f7c2"}.fa-search:before{content:"\f002"}.fa-search-dollar:before{content:"\f688"}.fa-search-location:before{content:"\f689"}.fa-search-minus:before{content:"\f010"}.fa-search-plus:before{content:"\f00e"}.fa-searchengin:before{content:"\f3eb"}.fa-seedling:before{content:"\f4d8"}.fa-sellcast:before{content:"\f2da"}.fa-sellsy:before{content:"\f213"}.fa-server:before{content:"\f233"}.fa-servicestack:before{content:"\f3ec"}.fa-shapes:before{content:"\f61f"}.fa-share:before{content:"\f064"}.fa-share-alt:before{content:"\f1e0"}.fa-share-alt-square:before{content:"\f1e1"}.fa-share-square:before{content:"\f14d"}.fa-shekel-sign:before{content:"\f20b"}.fa-shield-alt:before{content:"\f3ed"}.fa-shield-virus:before{content:"\e06c"}.fa-ship:before{content:"\f21a"}.fa-shipping-fast:before{content:"\f48b"}.fa-shirtsinbulk:before{content:"\f214"}.fa-shoe-prints:before{content:"\f54b"}.fa-shopify:before{content:"\e057"}.fa-shopping-bag:before{content:"\f290"}.fa-shopping-basket:before{content:"\f291"}.fa-shopping-cart:before{content:"\f07a"}.fa-shopware:before{content:"\f5b5"}.fa-shower:before{content:"\f2cc"}.fa-shuttle-van:before{content:"\f5b6"}.fa-sign:before{content:"\f4d9"}.fa-sign-in-alt:before{content:"\f2f6"}.fa-sign-language:before{content:"\f2a7"}.fa-sign-out-alt:before{content:"\f2f5"}.fa-signal:before{content:"\f012"}.fa-signature:before{content:"\f5b7"}.fa-sim-card:before{content:"\f7c4"}.fa-simplybuilt:before{content:"\f215"}.fa-sink:before{content:"\e06d"}.fa-sistrix:before{content:"\f3ee"}.fa-sitemap:before{content:"\f0e8"}.fa-sith:before{content:"\f512"}.fa-skating:before{content:"\f7c5"}.fa-sketch:before{content:"\f7c6"}.fa-skiing:before{content:"\f7c9"}.fa-skiing-nordic:before{content:"\f7ca"}.fa-skull:before{content:"\f54c"}.fa-skull-crossbones:before{content:"\f714"}.fa-skyatlas:before{content:"\f216"}.fa-skype:before{content:"\f17e"}.fa-slack:before{content:"\f198"}.fa-slack-hash:before{content:"\f3ef"}.fa-slash:before{content:"\f715"}.fa-sleigh:before{content:"\f7cc"}.fa-sliders-h:before{content:"\f1de"}.fa-slideshare:before{content:"\f1e7"}.fa-smile:before{content:"\f118"}.fa-smile-beam:before{content:"\f5b8"}.fa-smile-wink:before{content:"\f4da"}.fa-smog:before{content:"\f75f"}.fa-smoking:before{content:"\f48d"}.fa-smoking-ban:before{content:"\f54d"}.fa-sms:before{content:"\f7cd"}.fa-snapchat:before{content:"\f2ab"}.fa-snapchat-ghost:before{content:"\f2ac"}.fa-snapchat-square:before{content:"\f2ad"}.fa-snowboarding:before{content:"\f7ce"}.fa-snowflake:before{content:"\f2dc"}.fa-snowman:before{content:"\f7d0"}.fa-snowplow:before{content:"\f7d2"}.fa-soap:before{content:"\e06e"}.fa-socks:before{content:"\f696"}.fa-solar-panel:before{content:"\f5ba"}.fa-sort:before{content:"\f0dc"}.fa-sort-alpha-down:before{content:"\f15d"}.fa-sort-alpha-down-alt:before{content:"\f881"}.fa-sort-alpha-up:before{content:"\f15e"}.fa-sort-alpha-up-alt:before{content:"\f882"}.fa-sort-amount-down:before{content:"\f160"}.fa-sort-amount-down-alt:before{content:"\f884"}.fa-sort-amount-up:before{content:"\f161"}.fa-sort-amount-up-alt:before{content:"\f885"}.fa-sort-down:before{content:"\f0dd"}.fa-sort-numeric-down:before{content:"\f162"}.fa-sort-numeric-down-alt:before{content:"\f886"}.fa-sort-numeric-up:before{content:"\f163"}.fa-sort-numeric-up-alt:before{content:"\f887"}.fa-sort-up:before{content:"\f0de"}.fa-soundcloud:before{content:"\f1be"}.fa-sourcetree:before{content:"\f7d3"}.fa-spa:before{content:"\f5bb"}.fa-space-shuttle:before{content:"\f197"}.fa-speakap:before{content:"\f3f3"}.fa-speaker-deck:before{content:"\f83c"}.fa-spell-check:before{content:"\f891"}.fa-spider:before{content:"\f717"}.fa-spinner:before{content:"\f110"}.fa-splotch:before{content:"\f5bc"}.fa-spotify:before{content:"\f1bc"}.fa-spray-can:before{content:"\f5bd"}.fa-square:before{content:"\f0c8"}.fa-square-full:before{content:"\f45c"}.fa-square-root-alt:before{content:"\f698"}.fa-squarespace:before{content:"\f5be"}.fa-stack-exchange:before{content:"\f18d"}.fa-stack-overflow:before{content:"\f16c"}.fa-stackpath:before{content:"\f842"}.fa-stamp:before{content:"\f5bf"}.fa-star:before{content:"\f005"}.fa-star-and-crescent:before{content:"\f699"}.fa-star-half:before{content:"\f089"}.fa-star-half-alt:before{content:"\f5c0"}.fa-star-of-david:before{content:"\f69a"}.fa-star-of-life:before{content:"\f621"}.fa-staylinked:before{content:"\f3f5"}.fa-steam:before{content:"\f1b6"}.fa-steam-square:before{content:"\f1b7"}.fa-steam-symbol:before{content:"\f3f6"}.fa-step-backward:before{content:"\f048"}.fa-step-forward:before{content:"\f051"}.fa-stethoscope:before{content:"\f0f1"}.fa-sticker-mule:before{content:"\f3f7"}.fa-sticky-note:before{content:"\f249"}.fa-stop:before{content:"\f04d"}.fa-stop-circle:before{content:"\f28d"}.fa-stopwatch:before{content:"\f2f2"}.fa-stopwatch-20:before{content:"\e06f"}.fa-store:before{content:"\f54e"}.fa-store-alt:before{content:"\f54f"}.fa-store-alt-slash:before{content:"\e070"}.fa-store-slash:before{content:"\e071"}.fa-strava:before{content:"\f428"}.fa-stream:before{content:"\f550"}.fa-street-view:before{content:"\f21d"}.fa-strikethrough:before{content:"\f0cc"}.fa-stripe:before{content:"\f429"}.fa-stripe-s:before{content:"\f42a"}.fa-stroopwafel:before{content:"\f551"}.fa-studiovinari:before{content:"\f3f8"}.fa-stumbleupon:before{content:"\f1a4"}.fa-stumbleupon-circle:before{content:"\f1a3"}.fa-subscript:before{content:"\f12c"}.fa-subway:before{content:"\f239"}.fa-suitcase:before{content:"\f0f2"}.fa-suitcase-rolling:before{content:"\f5c1"}.fa-sun:before{content:"\f185"}.fa-superpowers:before{content:"\f2dd"}.fa-superscript:before{content:"\f12b"}.fa-supple:before{content:"\f3f9"}.fa-surprise:before{content:"\f5c2"}.fa-suse:before{content:"\f7d6"}.fa-swatchbook:before{content:"\f5c3"}.fa-swift:before{content:"\f8e1"}.fa-swimmer:before{content:"\f5c4"}.fa-swimming-pool:before{content:"\f5c5"}.fa-symfony:before{content:"\f83d"}.fa-synagogue:before{content:"\f69b"}.fa-sync:before{content:"\f021"}.fa-sync-alt:before{content:"\f2f1"}.fa-syringe:before{content:"\f48e"}.fa-table:before{content:"\f0ce"}.fa-table-tennis:before{content:"\f45d"}.fa-tablet:before{content:"\f10a"}.fa-tablet-alt:before{content:"\f3fa"}.fa-tablets:before{content:"\f490"}.fa-tachometer-alt:before{content:"\f3fd"}.fa-tag:before{content:"\f02b"}.fa-tags:before{content:"\f02c"}.fa-tape:before{content:"\f4db"}.fa-tasks:before{content:"\f0ae"}.fa-taxi:before{content:"\f1ba"}.fa-teamspeak:before{content:"\f4f9"}.fa-teeth:before{content:"\f62e"}.fa-teeth-open:before{content:"\f62f"}.fa-telegram:before{content:"\f2c6"}.fa-telegram-plane:before{content:"\f3fe"}.fa-temperature-high:before{content:"\f769"}.fa-temperature-low:before{content:"\f76b"}.fa-tencent-weibo:before{content:"\f1d5"}.fa-tenge:before{content:"\f7d7"}.fa-terminal:before{content:"\f120"}.fa-text-height:before{content:"\f034"}.fa-text-width:before{content:"\f035"}.fa-th:before{content:"\f00a"}.fa-th-large:before{content:"\f009"}.fa-th-list:before{content:"\f00b"}.fa-the-red-yeti:before{content:"\f69d"}.fa-theater-masks:before{content:"\f630"}.fa-themeco:before{content:"\f5c6"}.fa-themeisle:before{content:"\f2b2"}.fa-thermometer:before{content:"\f491"}.fa-thermometer-empty:before{content:"\f2cb"}.fa-thermometer-full:before{content:"\f2c7"}.fa-thermometer-half:before{content:"\f2c9"}.fa-thermometer-quarter:before{content:"\f2ca"}.fa-thermometer-three-quarters:before{content:"\f2c8"}.fa-think-peaks:before{content:"\f731"}.fa-thumbs-down:before{content:"\f165"}.fa-thumbs-up:before{content:"\f164"}.fa-thumbtack:before{content:"\f08d"}.fa-ticket-alt:before{content:"\f3ff"}.fa-tiktok:before{content:"\e07b"}.fa-times:before{content:"\f00d"}.fa-times-circle:before{content:"\f057"}.fa-tint:before{content:"\f043"}.fa-tint-slash:before{content:"\f5c7"}.fa-tired:before{content:"\f5c8"}.fa-toggle-off:before{content:"\f204"}.fa-toggle-on:before{content:"\f205"}.fa-toilet:before{content:"\f7d8"}.fa-toilet-paper:before{content:"\f71e"}.fa-toilet-paper-slash:before{content:"\e072"}.fa-toolbox:before{content:"\f552"}.fa-tools:before{content:"\f7d9"}.fa-tooth:before{content:"\f5c9"}.fa-torah:before{content:"\f6a0"}.fa-torii-gate:before{content:"\f6a1"}.fa-tractor:before{content:"\f722"}.fa-trade-federation:before{content:"\f513"}.fa-trademark:before{content:"\f25c"}.fa-traffic-light:before{content:"\f637"}.fa-trailer:before{content:"\e041"}.fa-train:before{content:"\f238"}.fa-tram:before{content:"\f7da"}.fa-transgender:before{content:"\f224"}.fa-transgender-alt:before{content:"\f225"}.fa-trash:before{content:"\f1f8"}.fa-trash-alt:before{content:"\f2ed"}.fa-trash-restore:before{content:"\f829"}.fa-trash-restore-alt:before{content:"\f82a"}.fa-tree:before{content:"\f1bb"}.fa-trello:before{content:"\f181"}.fa-trophy:before{content:"\f091"}.fa-truck:before{content:"\f0d1"}.fa-truck-loading:before{content:"\f4de"}.fa-truck-monster:before{content:"\f63b"}.fa-truck-moving:before{content:"\f4df"}.fa-truck-pickup:before{content:"\f63c"}.fa-tshirt:before{content:"\f553"}.fa-tty:before{content:"\f1e4"}.fa-tumblr:before{content:"\f173"}.fa-tumblr-square:before{content:"\f174"}.fa-tv:before{content:"\f26c"}.fa-twitch:before{content:"\f1e8"}.fa-twitter:before{content:"\f099"}.fa-twitter-square:before{content:"\f081"}.fa-typo3:before{content:"\f42b"}.fa-uber:before{content:"\f402"}.fa-ubuntu:before{content:"\f7df"}.fa-uikit:before{content:"\f403"}.fa-umbraco:before{content:"\f8e8"}.fa-umbrella:before{content:"\f0e9"}.fa-umbrella-beach:before{content:"\f5ca"}.fa-uncharted:before{content:"\e084"}.fa-underline:before{content:"\f0cd"}.fa-undo:before{content:"\f0e2"}.fa-undo-alt:before{content:"\f2ea"}.fa-uniregistry:before{content:"\f404"}.fa-unity:before{content:"\e049"}.fa-universal-access:before{content:"\f29a"}.fa-university:before{content:"\f19c"}.fa-unlink:before{content:"\f127"}.fa-unlock:before{content:"\f09c"}.fa-unlock-alt:before{content:"\f13e"}.fa-unsplash:before{content:"\e07c"}.fa-untappd:before{content:"\f405"}.fa-upload:before{content:"\f093"}.fa-ups:before{content:"\f7e0"}.fa-usb:before{content:"\f287"}.fa-user:before{content:"\f007"}.fa-user-alt:before{content:"\f406"}.fa-user-alt-slash:before{content:"\f4fa"}.fa-user-astronaut:before{content:"\f4fb"}.fa-user-check:before{content:"\f4fc"}.fa-user-circle:before{content:"\f2bd"}.fa-user-clock:before{content:"\f4fd"}.fa-user-cog:before{content:"\f4fe"}.fa-user-edit:before{content:"\f4ff"}.fa-user-friends:before{content:"\f500"}.fa-user-graduate:before{content:"\f501"}.fa-user-injured:before{content:"\f728"}.fa-user-lock:before{content:"\f502"}.fa-user-md:before{content:"\f0f0"}.fa-user-minus:before{content:"\f503"}.fa-user-ninja:before{content:"\f504"}.fa-user-nurse:before{content:"\f82f"}.fa-user-plus:before{content:"\f234"}.fa-user-secret:before{content:"\f21b"}.fa-user-shield:before{content:"\f505"}.fa-user-slash:before{content:"\f506"}.fa-user-tag:before{content:"\f507"}.fa-user-tie:before{content:"\f508"}.fa-user-times:before{content:"\f235"}.fa-users:before{content:"\f0c0"}.fa-users-cog:before{content:"\f509"}.fa-users-slash:before{content:"\e073"}.fa-usps:before{content:"\f7e1"}.fa-ussunnah:before{content:"\f407"}.fa-utensil-spoon:before{content:"\f2e5"}.fa-utensils:before{content:"\f2e7"}.fa-vaadin:before{content:"\f408"}.fa-vector-square:before{content:"\f5cb"}.fa-venus:before{content:"\f221"}.fa-venus-double:before{content:"\f226"}.fa-venus-mars:before{content:"\f228"}.fa-vest:before{content:"\e085"}.fa-vest-patches:before{content:"\e086"}.fa-viacoin:before{content:"\f237"}.fa-viadeo:before{content:"\f2a9"}.fa-viadeo-square:before{content:"\f2aa"}.fa-vial:before{content:"\f492"}.fa-vials:before{content:"\f493"}.fa-viber:before{content:"\f409"}.fa-video:before{content:"\f03d"}.fa-video-slash:before{content:"\f4e2"}.fa-vihara:before{content:"\f6a7"}.fa-vimeo:before{content:"\f40a"}.fa-vimeo-square:before{content:"\f194"}.fa-vimeo-v:before{content:"\f27d"}.fa-vine:before{content:"\f1ca"}.fa-virus:before{content:"\e074"}.fa-virus-slash:before{content:"\e075"}.fa-viruses:before{content:"\e076"}.fa-vk:before{content:"\f189"}.fa-vnv:before{content:"\f40b"}.fa-voicemail:before{content:"\f897"}.fa-volleyball-ball:before{content:"\f45f"}.fa-volume-down:before{content:"\f027"}.fa-volume-mute:before{content:"\f6a9"}.fa-volume-off:before{content:"\f026"}.fa-volume-up:before{content:"\f028"}.fa-vote-yea:before{content:"\f772"}.fa-vr-cardboard:before{content:"\f729"}.fa-vuejs:before{content:"\f41f"}.fa-walking:before{content:"\f554"}.fa-wallet:before{content:"\f555"}.fa-warehouse:before{content:"\f494"}.fa-watchman-monitoring:before{content:"\e087"}.fa-water:before{content:"\f773"}.fa-wave-square:before{content:"\f83e"}.fa-waze:before{content:"\f83f"}.fa-weebly:before{content:"\f5cc"}.fa-weibo:before{content:"\f18a"}.fa-weight:before{content:"\f496"}.fa-weight-hanging:before{content:"\f5cd"}.fa-weixin:before{content:"\f1d7"}.fa-whatsapp:before{content:"\f232"}.fa-whatsapp-square:before{content:"\f40c"}.fa-wheelchair:before{content:"\f193"}.fa-whmcs:before{content:"\f40d"}.fa-wifi:before{content:"\f1eb"}.fa-wikipedia-w:before{content:"\f266"}.fa-wind:before{content:"\f72e"}.fa-window-close:before{content:"\f410"}.fa-window-maximize:before{content:"\f2d0"}.fa-window-minimize:before{content:"\f2d1"}.fa-window-restore:before{content:"\f2d2"}.fa-windows:before{content:"\f17a"}.fa-wine-bottle:before{content:"\f72f"}.fa-wine-glass:before{content:"\f4e3"}.fa-wine-glass-alt:before{content:"\f5ce"}.fa-wix:before{content:"\f5cf"}.fa-wizards-of-the-coast:before{content:"\f730"}.fa-wodu:before{content:"\e088"}.fa-wolf-pack-battalion:before{content:"\f514"}.fa-won-sign:before{content:"\f159"}.fa-wordpress:before{content:"\f19a"}.fa-wordpress-simple:before{content:"\f411"}.fa-wpbeginner:before{content:"\f297"}.fa-wpexplorer:before{content:"\f2de"}.fa-wpforms:before{content:"\f298"}.fa-wpressr:before{content:"\f3e4"}.fa-wrench:before{content:"\f0ad"}.fa-x-ray:before{content:"\f497"}.fa-xbox:before{content:"\f412"}.fa-xing:before{content:"\f168"}.fa-xing-square:before{content:"\f169"}.fa-y-combinator:before{content:"\f23b"}.fa-yahoo:before{content:"\f19e"}.fa-yammer:before{content:"\f840"}.fa-yandex:before{content:"\f413"}.fa-yandex-international:before{content:"\f414"}.fa-yarn:before{content:"\f7e3"}.fa-yelp:before{content:"\f1e9"}.fa-yen-sign:before{content:"\f157"}.fa-yin-yang:before{content:"\f6ad"}.fa-yoast:before{content:"\f2b1"}.fa-youtube:before{content:"\f167"}.fa-youtube-square:before{content:"\f431"}.fa-zhihu:before{content:"\f63f"}.sr-only{border:0;clip:rect(0,0,0,0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.sr-only-focusable:active,.sr-only-focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}@font-face{font-family:"Font Awesome 5 Brands";font-style:normal;font-weight:400;font-display:auto;src:url(/wp-content/plugins/pagelayer/fonts/fa-brands-400.eot);src:url(/wp-content/plugins/pagelayer/fonts/fa-brands-400.eot#iefix) format("embedded-opentype"),url(/wp-content/plugins/pagelayer/fonts/fa-brands-400.woff2) format("woff2"),url(/wp-content/plugins/pagelayer/fonts/fa-brands-400.woff) format("woff"),url(/wp-content/plugins/pagelayer/fonts/fa-brands-400.ttf) format("truetype"),url(/wp-content/plugins/pagelayer/fonts/fa-brands-400.svg#fontawesome) format("svg")}.fab{font-family:"Font Awesome 5 Brands"}@font-face{font-family:"Font Awesome 5 Free";font-style:normal;font-weight:400;font-display:auto;src:url(/wp-content/plugins/pagelayer/fonts/fa-regular-400.eot);src:url(/wp-content/plugins/pagelayer/fonts/fa-regular-400.eot#iefix) format("embedded-opentype"),url(/wp-content/plugins/pagelayer/fonts/fa-regular-400.woff2) format("woff2"),url(/wp-content/plugins/pagelayer/fonts/fa-regular-400.woff) format("woff"),url(/wp-content/plugins/pagelayer/fonts/fa-regular-400.ttf) format("truetype"),url(/wp-content/plugins/pagelayer/fonts/fa-regular-400.svg#fontawesome) format("svg")}.far{font-weight:400}@font-face{font-family:"Font Awesome 5 Free";font-style:normal;font-weight:900;font-display:auto;src:url(/wp-content/plugins/pagelayer/fonts/fa-solid-900.eot);src:url(/wp-content/plugins/pagelayer/fonts/fa-solid-900.eot#iefix) format("embedded-opentype"),url(/wp-content/plugins/pagelayer/fonts/fa-solid-900.woff2) format("woff2"),url(/wp-content/plugins/pagelayer/fonts/fa-solid-900.woff) format("woff"),url(/wp-content/plugins/pagelayer/fonts/fa-solid-900.ttf) format("truetype"),url(/wp-content/plugins/pagelayer/fonts/fa-solid-900.svg#fontawesome) format("svg")}.fa,.far,.fas{font-family:"Font Awesome 5 Free"}.fa,.fas{font-weight:900}.fa.fa-address-book-o,.fa.fa-address-card-o,.fa.fa-arrow-circle-o-down,.fa.fa-arrow-circle-o-left,.fa.fa-arrow-circle-o-right,.fa.fa-arrow-circle-o-up,.fa.fa-bar-chart,.fa.fa-bar-chart-o,.fa.fa-bell-o,.fa.fa-bell-slash-o,.fa.fa-bookmark-o,.fa.fa-building-o,.fa.fa-calendar-check-o,.fa.fa-calendar-minus-o,.fa.fa-calendar-o,.fa.fa-calendar-plus-o,.fa.fa-calendar-times-o,.fa.fa-caret-square-o-down,.fa.fa-caret-square-o-left,.fa.fa-caret-square-o-right,.fa.fa-caret-square-o-up,.fa.fa-cc,.fa.fa-check-circle-o,.fa.fa-check-square-o,.fa.fa-circle-o,.fa.fa-circle-thin,.fa.fa-clipboard,.fa.fa-clock-o,.fa.fa-clone,.fa.fa-comment-o,.fa.fa-commenting-o,.fa.fa-comments-o,.fa.fa-compass,.fa.fa-copyright,.fa.fa-credit-card,.fa.fa-diamond,.fa.fa-dot-circle-o,.fa.fa-drivers-license-o,.fa.fa-envelope-o,.fa.fa-envelope-open-o,.fa.fa-eye,.fa.fa-eye-slash,.fa.fa-file-archive-o,.fa.fa-file-audio-o,.fa.fa-file-code-o,.fa.fa-file-excel-o,.fa.fa-file-image-o,.fa.fa-file-movie-o,.fa.fa-file-o,.fa.fa-file-pdf-o,.fa.fa-file-photo-o,.fa.fa-file-picture-o,.fa.fa-file-powerpoint-o,.fa.fa-file-sound-o,.fa.fa-file-text-o,.fa.fa-file-video-o,.fa.fa-file-word-o,.fa.fa-file-zip-o,.fa.fa-files-o,.fa.fa-flag-o,.fa.fa-floppy-o,.fa.fa-folder-o,.fa.fa-folder-open-o,.fa.fa-frown-o,.fa.fa-futbol-o,.fa.fa-hand-grab-o,.fa.fa-hand-lizard-o,.fa.fa-hand-o-down,.fa.fa-hand-o-left,.fa.fa-hand-o-right,.fa.fa-hand-o-up,.fa.fa-hand-paper-o,.fa.fa-hand-peace-o,.fa.fa-hand-pointer-o,.fa.fa-hand-rock-o,.fa.fa-hand-scissors-o,.fa.fa-hand-spock-o,.fa.fa-hand-stop-o,.fa.fa-handshake-o,.fa.fa-hdd-o,.fa.fa-heart-o,.fa.fa-hospital-o,.fa.fa-hourglass-o,.fa.fa-id-badge,.fa.fa-id-card-o,.fa.fa-image,.fa.fa-keyboard-o,.fa.fa-lemon-o,.fa.fa-life-bouy,.fa.fa-life-buoy,.fa.fa-life-ring,.fa.fa-life-saver,.fa.fa-lightbulb-o,.fa.fa-list-alt,.fa.fa-map-o,.fa.fa-meh-o,.fa.fa-minus-square-o,.fa.fa-money,.fa.fa-moon-o,.fa.fa-newspaper-o,.fa.fa-object-group,.fa.fa-object-ungroup,.fa.fa-paper-plane-o,.fa.fa-paste,.fa.fa-pause-circle-o,.fa.fa-pencil-square-o,.fa.fa-photo,.fa.fa-picture-o,.fa.fa-play-circle-o,.fa.fa-plus-square-o,.fa.fa-question-circle-o,.fa.fa-registered,.fa.fa-send-o,.fa.fa-share-square-o,.fa.fa-smile-o,.fa.fa-snowflake-o,.fa.fa-soccer-ball-o,.fa.fa-square-o,.fa.fa-star-half-empty,.fa.fa-star-half-full,.fa.fa-star-half-o,.fa.fa-star-o,.fa.fa-sticky-note-o,.fa.fa-stop-circle-o,.fa.fa-sun-o,.fa.fa-support,.fa.fa-thumbs-o-down,.fa.fa-thumbs-o-up,.fa.fa-times-circle-o,.fa.fa-times-rectangle-o,.fa.fa-toggle-down,.fa.fa-toggle-left,.fa.fa-toggle-right,.fa.fa-toggle-up,.fa.fa-trash-o,.fa.fa-user-circle-o,.fa.fa-user-o,.fa.fa-vcard-o,.fa.fa-window-close-o,.fa.fa-window-maximize,.fa.fa-window-restore{font-family:'Font Awesome 5 Free';font-weight:400}.fa.fa-500px,.fa.fa-adn,.fa.fa-amazon,.fa.fa-android,.fa.fa-angellist,.fa.fa-apple,.fa.fa-bandcamp,.fa.fa-behance,.fa.fa-behance-square,.fa.fa-bitbucket,.fa.fa-bitbucket-square,.fa.fa-bitcoin,.fa.fa-black-tie,.fa.fa-bluetooth,.fa.fa-bluetooth-b,.fa.fa-btc,.fa.fa-buysellads,.fa.fa-cc-amex,.fa.fa-cc-diners-club,.fa.fa-cc-discover,.fa.fa-cc-jcb,.fa.fa-cc-mastercard,.fa.fa-cc-paypal,.fa.fa-cc-stripe,.fa.fa-cc-visa,.fa.fa-chrome,.fa.fa-codepen,.fa.fa-codiepie,.fa.fa-connectdevelop,.fa.fa-contao,.fa.fa-creative-commons,.fa.fa-css3,.fa.fa-dashcube,.fa.fa-delicious,.fa.fa-deviantart,.fa.fa-digg,.fa.fa-dribbble,.fa.fa-dropbox,.fa.fa-drupal,.fa.fa-edge,.fa.fa-eercast,.fa.fa-empire,.fa.fa-envira,.fa.fa-etsy,.fa.fa-expeditedssl,.fa.fa-fa,.fa.fa-facebook,.fa.fa-facebook-f,.fa.fa-facebook-official,.fa.fa-facebook-square,.fa.fa-firefox,.fa.fa-first-order,.fa.fa-flickr,.fa.fa-font-awesome,.fa.fa-fonticons,.fa.fa-fort-awesome,.fa.fa-forumbee,.fa.fa-foursquare,.fa.fa-free-code-camp,.fa.fa-ge,.fa.fa-get-pocket,.fa.fa-gg,.fa.fa-gg-circle,.fa.fa-git,.fa.fa-git-square,.fa.fa-github,.fa.fa-github-alt,.fa.fa-github-square,.fa.fa-gitlab,.fa.fa-gittip,.fa.fa-glide,.fa.fa-glide-g,.fa.fa-google,.fa.fa-google-plus,.fa.fa-google-plus-circle,.fa.fa-google-plus-official,.fa.fa-google-plus-square,.fa.fa-google-wallet,.fa.fa-gratipay,.fa.fa-grav,.fa.fa-hacker-news,.fa.fa-houzz,.fa.fa-html5,.fa.fa-imdb,.fa.fa-instagram,.fa.fa-internet-explorer,.fa.fa-ioxhost,.fa.fa-joomla,.fa.fa-jsfiddle,.fa.fa-lastfm,.fa.fa-lastfm-square,.fa.fa-leanpub,.fa.fa-linkedin,.fa.fa-linkedin-square,.fa.fa-linode,.fa.fa-linux,.fa.fa-maxcdn,.fa.fa-meanpath,.fa.fa-medium,.fa.fa-meetup,.fa.fa-mixcloud,.fa.fa-modx,.fa.fa-odnoklassniki,.fa.fa-odnoklassniki-square,.fa.fa-opencart,.fa.fa-openid,.fa.fa-opera,.fa.fa-optin-monster,.fa.fa-pagelines,.fa.fa-paypal,.fa.fa-pied-piper,.fa.fa-pied-piper-alt,.fa.fa-pied-piper-pp,.fa.fa-pinterest,.fa.fa-pinterest-p,.fa.fa-pinterest-square,.fa.fa-product-hunt,.fa.fa-qq,.fa.fa-quora,.fa.fa-ra,.fa.fa-ravelry,.fa.fa-rebel,.fa.fa-reddit,.fa.fa-reddit-alien,.fa.fa-reddit-square,.fa.fa-renren,.fa.fa-resistance,.fa.fa-safari,.fa.fa-scribd,.fa.fa-sellsy,.fa.fa-shirtsinbulk,.fa.fa-simplybuilt,.fa.fa-skyatlas,.fa.fa-skype,.fa.fa-slack,.fa.fa-slideshare,.fa.fa-snapchat,.fa.fa-snapchat-ghost,.fa.fa-snapchat-square,.fa.fa-soundcloud,.fa.fa-spotify,.fa.fa-stack-exchange,.fa.fa-stack-overflow,.fa.fa-steam,.fa.fa-steam-square,.fa.fa-stumbleupon,.fa.fa-stumbleupon-circle,.fa.fa-superpowers,.fa.fa-telegram,.fa.fa-tencent-weibo,.fa.fa-themeisle,.fa.fa-trello,.fa.fa-tripadvisor,.fa.fa-tumblr,.fa.fa-tumblr-square,.fa.fa-twitch,.fa.fa-twitter,.fa.fa-twitter-square,.fa.fa-usb,.fa.fa-viacoin,.fa.fa-viadeo,.fa.fa-viadeo-square,.fa.fa-vimeo,.fa.fa-vimeo-square,.fa.fa-vine,.fa.fa-vk,.fa.fa-wechat,.fa.fa-weibo,.fa.fa-weixin,.fa.fa-whatsapp,.fa.fa-wheelchair-alt,.fa.fa-wikipedia-w,.fa.fa-windows,.fa.fa-wordpress,.fa.fa-wpbeginner,.fa.fa-wpexplorer,.fa.fa-wpforms,.fa.fa-xing,.fa.fa-xing-square,.fa.fa-y-combinator,.fa.fa-y-combinator-square,.fa.fa-yahoo,.fa.fa-yc,.fa.fa-yc-square,.fa.fa-yelp,.fa.fa-yoast,.fa.fa-youtube,.fa.fa-youtube-play,.fa.fa-youtube-square{font-family:'Font Awesome 5 Brands';font-weight:400}.fa.fa-glass:before{content:"\f000"}.fa.fa-star-o:before{content:"\f005"}.fa.fa-remove:before{content:"\f00d"}.fa.fa-close:before{content:"\f00d"}.fa.fa-gear:before{content:"\f013"}.fa.fa-trash-o:before{content:"\f2ed"}.fa.fa-file-o:before{content:"\f15b"}.fa.fa-clock-o:before{content:"\f017"}.fa.fa-arrow-circle-o-down:before{content:"\f358"}.fa.fa-arrow-circle-o-up:before{content:"\f35b"}.fa.fa-play-circle-o:before{content:"\f144"}.fa.fa-repeat:before{content:"\f01e"}.fa.fa-rotate-right:before{content:"\f01e"}.fa.fa-refresh:before{content:"\f021"}.fa.fa-dedent:before{content:"\f03b"}.fa.fa-video-camera:before{content:"\f03d"}.fa.fa-picture-o:before{content:"\f03e"}.fa.fa-photo:before{content:"\f03e"}.fa.fa-image:before{content:"\f03e"}.fa.fa-pencil:before{content:"\f303"}.fa.fa-map-marker:before{content:"\f3c5"}.fa.fa-pencil-square-o:before{content:"\f044"}.fa.fa-share-square-o:before{content:"\f14d"}.fa.fa-check-square-o:before{content:"\f14a"}.fa.fa-arrows:before{content:"\f0b2"}.fa.fa-times-circle-o:before{content:"\f057"}.fa.fa-check-circle-o:before{content:"\f058"}.fa.fa-mail-forward:before{content:"\f064"}.fa.fa-warning:before{content:"\f071"}.fa.fa-calendar:before{content:"\f073"}.fa.fa-arrows-v:before{content:"\f338"}.fa.fa-arrows-h:before{content:"\f337"}.fa.fa-bar-chart:before{content:"\f080"}.fa.fa-bar-chart-o:before{content:"\f080"}.fa.fa-gears:before{content:"\f085"}.fa.fa-thumbs-o-up:before{content:"\f164"}.fa.fa-thumbs-o-down:before{content:"\f165"}.fa.fa-heart-o:before{content:"\f004"}.fa.fa-sign-out:before{content:"\f2f5"}.fa.fa-linkedin-square:before{content:"\f08c"}.fa.fa-thumb-tack:before{content:"\f08d"}.fa.fa-external-link:before{content:"\f35d"}.fa.fa-sign-in:before{content:"\f2f6"}.fa.fa-lemon-o:before{content:"\f094"}.fa.fa-square-o:before{content:"\f0c8"}.fa.fa-bookmark-o:before{content:"\f02e"}.fa.fa-facebook:before{content:"\f39e"}.fa.fa-facebook-f:before{content:"\f39e"}.fa.fa-feed:before{content:"\f09e"}.fa.fa-hdd-o:before{content:"\f0a0"}.fa.fa-hand-o-right:before{content:"\f0a4"}.fa.fa-hand-o-left:before{content:"\f0a5"}.fa.fa-hand-o-up:before{content:"\f0a6"}.fa.fa-hand-o-down:before{content:"\f0a7"}.fa.fa-arrows-alt:before{content:"\f31e"}.fa.fa-group:before{content:"\f0c0"}.fa.fa-chain:before{content:"\f0c1"}.fa.fa-scissors:before{content:"\f0c4"}.fa.fa-files-o:before{content:"\f0c5"}.fa.fa-floppy-o:before{content:"\f0c7"}.fa.fa-navicon:before{content:"\f0c9"}.fa.fa-reorder:before{content:"\f0c9"}.fa.fa-google-plus:before{content:"\f0d5"}.fa.fa-money:before{content:"\f3d1"}.fa.fa-unsorted:before{content:"\f0dc"}.fa.fa-sort-desc:before{content:"\f0dd"}.fa.fa-sort-asc:before{content:"\f0de"}.fa.fa-linkedin:before{content:"\f0e1"}.fa.fa-rotate-left:before{content:"\f0e2"}.fa.fa-legal:before{content:"\f0e3"}.fa.fa-tachometer:before{content:"\f3fd"}.fa.fa-dashboard:before{content:"\f3fd"}.fa.fa-comment-o:before{content:"\f075"}.fa.fa-comments-o:before{content:"\f086"}.fa.fa-flash:before{content:"\f0e7"}.fa.fa-paste:before{content:"\f328"}.fa.fa-lightbulb-o:before{content:"\f0eb"}.fa.fa-exchange:before{content:"\f362"}.fa.fa-cloud-download:before{content:"\f381"}.fa.fa-cloud-upload:before{content:"\f382"}.fa.fa-bell-o:before{content:"\f0f3"}.fa.fa-cutlery:before{content:"\f2e7"}.fa.fa-file-text-o:before{content:"\f15c"}.fa.fa-building-o:before{content:"\f1ad"}.fa.fa-hospital-o:before{content:"\f0f8"}.fa.fa-tablet:before{content:"\f3fa"}.fa.fa-mobile:before{content:"\f3cd"}.fa.fa-mobile-phone:before{content:"\f3cd"}.fa.fa-circle-o:before{content:"\f111"}.fa.fa-mail-reply:before{content:"\f3e5"}.fa.fa-folder-o:before{content:"\f07b"}.fa.fa-folder-open-o:before{content:"\f07c"}.fa.fa-smile-o:before{content:"\f118"}.fa.fa-frown-o:before{content:"\f119"}.fa.fa-meh-o:before{content:"\f11a"}.fa.fa-keyboard-o:before{content:"\f11c"}.fa.fa-flag-o:before{content:"\f024"}.fa.fa-mail-reply-all:before{content:"\f122"}.fa.fa-star-half-o:before{content:"\f089"}.fa.fa-star-half-empty:before{content:"\f089"}.fa.fa-star-half-full:before{content:"\f089"}.fa.fa-code-fork:before{content:"\f126"}.fa.fa-chain-broken:before{content:"\f127"}.fa.fa-shield:before{content:"\f3ed"}.fa.fa-calendar-o:before{content:"\f133"}.fa.fa-ticket:before{content:"\f3ff"}.fa.fa-minus-square-o:before{content:"\f146"}.fa.fa-level-up:before{content:"\f3bf"}.fa.fa-level-down:before{content:"\f3be"}.fa.fa-pencil-square:before{content:"\f14b"}.fa.fa-external-link-square:before{content:"\f360"}.fa.fa-caret-square-o-down:before{content:"\f150"}.fa.fa-toggle-down:before{content:"\f150"}.fa.fa-caret-square-o-up:before{content:"\f151"}.fa.fa-toggle-up:before{content:"\f151"}.fa.fa-caret-square-o-right:before{content:"\f152"}.fa.fa-toggle-right:before{content:"\f152"}.fa.fa-eur:before{content:"\f153"}.fa.fa-euro:before{content:"\f153"}.fa.fa-gbp:before{content:"\f154"}.fa.fa-usd:before{content:"\f155"}.fa.fa-dollar:before{content:"\f155"}.fa.fa-inr:before{content:"\f156"}.fa.fa-rupee:before{content:"\f156"}.fa.fa-jpy:before{content:"\f157"}.fa.fa-cny:before{content:"\f157"}.fa.fa-rmb:before{content:"\f157"}.fa.fa-yen:before{content:"\f157"}.fa.fa-rub:before{content:"\f158"}.fa.fa-ruble:before{content:"\f158"}.fa.fa-rouble:before{content:"\f158"}.fa.fa-krw:before{content:"\f159"}.fa.fa-won:before{content:"\f159"}.fa.fa-bitcoin:before{content:"\f15a"}.fa.fa-file-text:before{content:"\f15c"}.fa.fa-sort-alpha-asc:before{content:"\f15d"}.fa.fa-sort-alpha-desc:before{content:"\f881"}.fa.fa-sort-amount-asc:before{content:"\f160"}.fa.fa-sort-amount-desc:before{content:"\f884"}.fa.fa-sort-numeric-asc:before{content:"\f162"}.fa.fa-sort-numeric-desc:before{content:"\f886"}.fa.fa-youtube-play:before{content:"\f167"}.fa.fa-bitbucket-square:before{content:"\f171"}.fa.fa-long-arrow-down:before{content:"\f309"}.fa.fa-long-arrow-up:before{content:"\f30c"}.fa.fa-long-arrow-left:before{content:"\f30a"}.fa.fa-long-arrow-right:before{content:"\f30b"}.fa.fa-gittip:before{content:"\f184"}.fa.fa-sun-o:before{content:"\f185"}.fa.fa-moon-o:before{content:"\f186"}.fa.fa-arrow-circle-o-right:before{content:"\f35a"}.fa.fa-arrow-circle-o-left:before{content:"\f359"}.fa.fa-caret-square-o-left:before{content:"\f191"}.fa.fa-toggle-left:before{content:"\f191"}.fa.fa-dot-circle-o:before{content:"\f192"}.fa.fa-try:before{content:"\f195"}.fa.fa-turkish-lira:before{content:"\f195"}.fa.fa-plus-square-o:before{content:"\f0fe"}.fa.fa-institution:before{content:"\f19c"}.fa.fa-bank:before{content:"\f19c"}.fa.fa-mortar-board:before{content:"\f19d"}.fa.fa-spoon:before{content:"\f2e5"}.fa.fa-automobile:before{content:"\f1b9"}.fa.fa-cab:before{content:"\f1ba"}.fa.fa-envelope-o:before{content:"\f0e0"}.fa.fa-file-pdf-o:before{content:"\f1c1"}.fa.fa-file-word-o:before{content:"\f1c2"}.fa.fa-file-excel-o:before{content:"\f1c3"}.fa.fa-file-powerpoint-o:before{content:"\f1c4"}.fa.fa-file-image-o:before{content:"\f1c5"}.fa.fa-file-photo-o:before{content:"\f1c5"}.fa.fa-file-picture-o:before{content:"\f1c5"}.fa.fa-file-archive-o:before{content:"\f1c6"}.fa.fa-file-zip-o:before{content:"\f1c6"}.fa.fa-file-audio-o:before{content:"\f1c7"}.fa.fa-file-sound-o:before{content:"\f1c7"}.fa.fa-file-video-o:before{content:"\f1c8"}.fa.fa-file-movie-o:before{content:"\f1c8"}.fa.fa-file-code-o:before{content:"\f1c9"}.fa.fa-life-bouy:before{content:"\f1cd"}.fa.fa-life-buoy:before{content:"\f1cd"}.fa.fa-life-saver:before{content:"\f1cd"}.fa.fa-support:before{content:"\f1cd"}.fa.fa-circle-o-notch:before{content:"\f1ce"}.fa.fa-ra:before{content:"\f1d0"}.fa.fa-resistance:before{content:"\f1d0"}.fa.fa-ge:before{content:"\f1d1"}.fa.fa-y-combinator-square:before{content:"\f1d4"}.fa.fa-yc-square:before{content:"\f1d4"}.fa.fa-wechat:before{content:"\f1d7"}.fa.fa-send:before{content:"\f1d8"}.fa.fa-paper-plane-o:before{content:"\f1d8"}.fa.fa-send-o:before{content:"\f1d8"}.fa.fa-circle-thin:before{content:"\f111"}.fa.fa-header:before{content:"\f1dc"}.fa.fa-sliders:before{content:"\f1de"}.fa.fa-futbol-o:before{content:"\f1e3"}.fa.fa-soccer-ball-o:before{content:"\f1e3"}.fa.fa-newspaper-o:before{content:"\f1ea"}.fa.fa-bell-slash-o:before{content:"\f1f6"}.fa.fa-trash:before{content:"\f2ed"}.fa.fa-eyedropper:before{content:"\f1fb"}.fa.fa-area-chart:before{content:"\f1fe"}.fa.fa-pie-chart:before{content:"\f200"}.fa.fa-line-chart:before{content:"\f201"}.fa.fa-cc:before{content:"\f20a"}.fa.fa-ils:before{content:"\f20b"}.fa.fa-shekel:before{content:"\f20b"}.fa.fa-sheqel:before{content:"\f20b"}.fa.fa-meanpath:before{content:"\f2b4"}.fa.fa-diamond:before{content:"\f3a5"}.fa.fa-intersex:before{content:"\f224"}.fa.fa-facebook-official:before{content:"\f09a"}.fa.fa-hotel:before{content:"\f236"}.fa.fa-yc:before{content:"\f23b"}.fa.fa-battery-4:before{content:"\f240"}.fa.fa-battery:before{content:"\f240"}.fa.fa-battery-3:before{content:"\f241"}.fa.fa-battery-2:before{content:"\f242"}.fa.fa-battery-1:before{content:"\f243"}.fa.fa-battery-0:before{content:"\f244"}.fa.fa-sticky-note-o:before{content:"\f249"}.fa.fa-hourglass-o:before{content:"\f254"}.fa.fa-hourglass-1:before{content:"\f251"}.fa.fa-hourglass-2:before{content:"\f252"}.fa.fa-hourglass-3:before{content:"\f253"}.fa.fa-hand-rock-o:before{content:"\f255"}.fa.fa-hand-grab-o:before{content:"\f255"}.fa.fa-hand-paper-o:before{content:"\f256"}.fa.fa-hand-stop-o:before{content:"\f256"}.fa.fa-hand-scissors-o:before{content:"\f257"}.fa.fa-hand-lizard-o:before{content:"\f258"}.fa.fa-hand-spock-o:before{content:"\f259"}.fa.fa-hand-pointer-o:before{content:"\f25a"}.fa.fa-hand-peace-o:before{content:"\f25b"}.fa.fa-television:before{content:"\f26c"}.fa.fa-calendar-plus-o:before{content:"\f271"}.fa.fa-calendar-minus-o:before{content:"\f272"}.fa.fa-calendar-times-o:before{content:"\f273"}.fa.fa-calendar-check-o:before{content:"\f274"}.fa.fa-map-o:before{content:"\f279"}.fa.fa-commenting:before{content:"\f4ad"}.fa.fa-commenting-o:before{content:"\f4ad"}.fa.fa-vimeo:before{content:"\f27d"}.fa.fa-credit-card-alt:before{content:"\f09d"}.fa.fa-pause-circle-o:before{content:"\f28b"}.fa.fa-stop-circle-o:before{content:"\f28d"}.fa.fa-wheelchair-alt:before{content:"\f368"}.fa.fa-question-circle-o:before{content:"\f059"}.fa.fa-volume-control-phone:before{content:"\f2a0"}.fa.fa-asl-interpreting:before{content:"\f2a3"}.fa.fa-deafness:before{content:"\f2a4"}.fa.fa-hard-of-hearing:before{content:"\f2a4"}.fa.fa-signing:before{content:"\f2a7"}.fa.fa-google-plus-official:before{content:"\f2b3"}.fa.fa-google-plus-circle:before{content:"\f2b3"}.fa.fa-fa:before{content:"\f2b4"}.fa.fa-handshake-o:before{content:"\f2b5"}.fa.fa-envelope-open-o:before{content:"\f2b6"}.fa.fa-address-book-o:before{content:"\f2b9"}.fa.fa-vcard:before{content:"\f2bb"}.fa.fa-address-card-o:before{content:"\f2bb"}.fa.fa-vcard-o:before{content:"\f2bb"}.fa.fa-user-circle-o:before{content:"\f2bd"}.fa.fa-user-o:before{content:"\f007"}.fa.fa-drivers-license:before{content:"\f2c2"}.fa.fa-id-card-o:before{content:"\f2c2"}.fa.fa-drivers-license-o:before{content:"\f2c2"}.fa.fa-thermometer-4:before{content:"\f2c7"}.fa.fa-thermometer:before{content:"\f2c7"}.fa.fa-thermometer-3:before{content:"\f2c8"}.fa.fa-thermometer-2:before{content:"\f2c9"}.fa.fa-thermometer-1:before{content:"\f2ca"}.fa.fa-thermometer-0:before{content:"\f2cb"}.fa.fa-bathtub:before{content:"\f2cd"}.fa.fa-s15:before{content:"\f2cd"}.fa.fa-times-rectangle:before{content:"\f410"}.fa.fa-window-close-o:before{content:"\f410"}.fa.fa-times-rectangle-o:before{content:"\f410"}.fa.fa-eercast:before{content:"\f2da"}.fa.fa-snowflake-o:before{content:"\f2dc"}

/*v4 Shims Made by Pagelayer Team*/
.fa.fa-star-o,.fa.fa-trash-o,.fa.fa-file-o,.fa.fa-clock-o,.fa.fa-arrow-circle-o-down,.fa.fa-arrow-circle-o-up,.fa.fa-play-circle-o,.fa.fa-list-alt,.fa.fa-picture-o,.fa.fa-photo,.fa.fa-image,.fa.fa-pencil-square-o,.fa.fa-share-square-o,.fa.fa-check-square-o,.fa.fa-times-circle-o,.fa.fa-check-circle-o,.fa.fa-eye,.fa.fa-eye-slash,.fa.fa-bar-chart,.fa.fa-bar-chart-o,.fa.fa-thumbs-o-up,.fa.fa-thumbs-o-down,.fa.fa-heart-o,.fa.fa-lemon-o,.fa.fa-square-o,.fa.fa-bookmark-o,.fa.fa-credit-card,.fa.fa-hdd-o,.fa.fa-hand-o-right,.fa.fa-hand-o-left,.fa.fa-hand-o-up,.fa.fa-hand-o-down,.fa.fa-files-o,.fa.fa-floppy-o,.fa.fa-money,.fa.fa-comment-o,.fa.fa-comments-o,.fa.fa-clipboard,.fa.fa-paste,.fa.fa-lightbulb-o,.fa.fa-bell-o,.fa.fa-file-text-o,.fa.fa-building-o,.fa.fa-hospital-o,.fa.fa-circle-o,.fa.fa-folder-o,.fa.fa-folder-open-o,.fa.fa-smile-o,.fa.fa-frown-o,.fa.fa-meh-o,.fa.fa-keyboard-o,.fa.fa-flag-o,.fa.fa-star-half-o,.fa.fa-star-half-empty,.fa.fa-star-half-full,.fa.fa-calendar-o,.fa.fa-minus-square-o,.fa.fa-compass,.fa.fa-caret-square-o-down,.fa.fa-toggle-down,.fa.fa-caret-square-o-up,.fa.fa-toggle-up,.fa.fa-caret-square-o-right,.fa.fa-toggle-right,.fa.fa-sun-o,.fa.fa-moon-o,.fa.fa-arrow-circle-o-right,.fa.fa-arrow-circle-o-left,.fa.fa-caret-square-o-left,.fa.fa-toggle-left,.fa.fa-dot-circle-o,.fa.fa-plus-square-o,.fa.fa-envelope-o,.fa.fa-file-pdf-o,.fa.fa-file-word-o,.fa.fa-file-excel-o,.fa.fa-file-powerpoint-o,.fa.fa-file-image-o,.fa.fa-file-photo-o,.fa.fa-file-picture-o,.fa.fa-file-archive-o,.fa.fa-file-zip-o,.fa.fa-file-audio-o,.fa.fa-file-sound-o,.fa.fa-file-video-o,.fa.fa-file-movie-o,.fa.fa-file-code-o,.fa.fa-life-ring,.fa.fa-life-bouy,.fa.fa-life-buoy,.fa.fa-life-saver,.fa.fa-support,.fa.fa-paper-plane-o,.fa.fa-send-o,.fa.fa-circle-thin,.fa.fa-futbol-o,.fa.fa-soccer-ball-o,.fa.fa-newspaper-o,.fa.fa-bell-slash-o,.fa.fa-copyright,.fa.fa-cc,.fa.fa-diamond,.fa.fa-object-group,.fa.fa-object-ungroup,.fa.fa-sticky-note-o,.fa.fa-clone,.fa.fa-hourglass-o,.fa.fa-hand-rock-o,.fa.fa-hand-grab-o,.fa.fa-hand-paper-o,.fa.fa-hand-stop-o,.fa.fa-hand-scissors-o,.fa.fa-hand-lizard-o,.fa.fa-hand-spock-o,.fa.fa-hand-pointer-o,.fa.fa-hand-peace-o,.fa.fa-registered,.fa.fa-calendar-plus-o,.fa.fa-calendar-minus-o,.fa.fa-calendar-times-o,.fa.fa-calendar-check-o,.fa.fa-map-o,.fa.fa-commenting-o,.fa.fa-pause-circle-o,.fa.fa-stop-circle-o,.fa.fa-question-circle-o,.fa.fa-handshake-o,.fa.fa-envelope-open-o,.fa.fa-address-book-o,.fa.fa-address-card-o,.fa.fa-vcard-o,.fa.fa-user-circle-o,.fa.fa-user-o,.fa.fa-id-badge,.fa.fa-id-card-o,.fa.fa-drivers-license-o,.fa.fa-window-maximize,.fa.fa-window-restore,.fa.fa-window-close-o,.fa.fa-times-rectangle-o,.fa.fa-snowflake-o{font-family:'Font Awesome 5 Free';font-weight:400;}.fa.fa-meetup,.fa.fa-twitter-square,.fa.fa-facebook-square,.fa.fa-linkedin-square,.fa.fa-github-square,.fa.fa-twitter,.fa.fa-facebook,.fa.fa-facebook-f,.fa.fa-github,.fa.fa-pinterest,.fa.fa-pinterest-square,.fa.fa-google-plus-square,.fa.fa-google-plus,.fa.fa-linkedin,.fa.fa-github-alt,.fa.fa-maxcdn,.fa.fa-html5,.fa.fa-css3,.fa.fa-btc,.fa.fa-bitcoin,.fa.fa-youtube-square,.fa.fa-youtube,.fa.fa-xing,.fa.fa-xing-square,.fa.fa-youtube-play,.fa.fa-dropbox,.fa.fa-stack-overflow,.fa.fa-instagram,.fa.fa-flickr,.fa.fa-adn,.fa.fa-bitbucket,.fa.fa-bitbucket-square,.fa.fa-tumblr,.fa.fa-tumblr-square,.fa.fa-apple,.fa.fa-windows,.fa.fa-android,.fa.fa-linux,.fa.fa-dribbble,.fa.fa-skype,.fa.fa-foursquare,.fa.fa-trello,.fa.fa-gratipay,.fa.fa-gittip,.fa.fa-vk,.fa.fa-weibo,.fa.fa-renren,.fa.fa-pagelines,.fa.fa-stack-exchange,.fa.fa-vimeo-square,.fa.fa-slack,.fa.fa-wordpress,.fa.fa-openid,.fa.fa-yahoo,.fa.fa-google,.fa.fa-reddit,.fa.fa-reddit-square,.fa.fa-stumbleupon-circle,.fa.fa-stumbleupon,.fa.fa-delicious,.fa.fa-digg,.fa.fa-pied-piper-pp,.fa.fa-pied-piper-alt,.fa.fa-drupal,.fa.fa-joomla,.fa.fa-behance,.fa.fa-behance-square,.fa.fa-steam,.fa.fa-steam-square,.fa.fa-deviantart,.fa.fa-soundcloud,.fa.fa-vine,.fa.fa-codepen,.fa.fa-jsfiddle,.fa.fa-rebel,.fa.fa-ra,.fa.fa-resistance,.fa.fa-empire,.fa.fa-ge,.fa.fa-git-square,.fa.fa-git,.fa.fa-hacker-news,.fa.fa-y-combinator-square,.fa.fa-yc-square,.fa.fa-tencent-weibo,.fa.fa-qq,.fa.fa-weixin,.fa.fa-wechat,.fa.fa-slideshare,.fa.fa-twitch,.fa.fa-yelp,.fa.fa-paypal,.fa.fa-google-wallet,.fa.fa-cc-visa,.fa.fa-cc-mastercard,.fa.fa-cc-discover,.fa.fa-cc-amex,.fa.fa-cc-paypal,.fa.fa-cc-stripe,.fa.fa-lastfm,.fa.fa-lastfm-square,.fa.fa-ioxhost,.fa.fa-angellist,.fa.fa-meanpath,.fa.fa-buysellads,.fa.fa-connectdevelop,.fa.fa-dashcube,.fa.fa-forumbee,.fa.fa-leanpub,.fa.fa-sellsy,.fa.fa-shirtsinbulk,.fa.fa-simplybuilt,.fa.fa-skyatlas,.fa.fa-facebook-official,.fa.fa-pinterest-p,.fa.fa-whatsapp,.fa.fa-viacoin,.fa.fa-medium,.fa.fa-y-combinator,.fa.fa-yc,.fa.fa-optin-monster,.fa.fa-opencart,.fa.fa-expeditedssl,.fa.fa-cc-jcb,.fa.fa-cc-diners-club,.fa.fa-creative-commons,.fa.fa-gg,.fa.fa-gg-circle,.fa.fa-tripadvisor,.fa.fa-odnoklassniki,.fa.fa-odnoklassniki-square,.fa.fa-get-pocket,.fa.fa-wikipedia-w,.fa.fa-safari,.fa.fa-chrome,.fa.fa-firefox,.fa.fa-opera,.fa.fa-internet-explorer,.fa.fa-contao,.fa.fa-500px,.fa.fa-amazon,.fa.fa-houzz,.fa.fa-vimeo,.fa.fa-black-tie,.fa.fa-fonticons,.fa.fa-reddit-alien,.fa.fa-edge,.fa.fa-codiepie,.fa.fa-modx,.fa.fa-fort-awesome,.fa.fa-usb,.fa.fa-product-hunt,.fa.fa-mixcloud,.fa.fa-scribd,.fa.fa-bluetooth,.fa.fa-bluetooth-b,.fa.fa-gitlab,.fa.fa-wpbeginner,.fa.fa-wpforms,.fa.fa-envira,.fa.fa-wheelchair-alt,.fa.fa-glide,.fa.fa-glide-g,.fa.fa-viadeo,.fa.fa-viadeo-square,.fa.fa-snapchat,.fa.fa-snapchat-ghost,.fa.fa-snapchat-square,.fa.fa-pied-piper,.fa.fa-first-order,.fa.fa-yoast,.fa.fa-themeisle,.fa.fa-google-plus-official,.fa.fa-google-plus-circle,.fa.fa-font-awesome,.fa.fa-fa,.fa.fa-linode,.fa.fa-quora,.fa.fa-free-code-camp,.fa.fa-telegram,.fa.fa-bandcamp,.fa.fa-grav,.fa.fa-etsy,.fa.fa-imdb,.fa.fa-ravelry,.fa.fa-eercast,.fa.fa-superpowers,.fa.fa-wpexplorer,.fa.fa-spotify{font-family:'Font Awesome 5 Brands';font-weight:400;}.fa.fa-glass:before{content:"\f000";}.fa.fa-star-o:before{content:"\f005";}.fa.fa-remove:before{content:"\f00d";}.fa.fa-close:before{content:"\f00d";}.fa.fa-gear:before{content:"\f013";}.fa.fa-trash-o:before{content:"\f2ed";}.fa.fa-file-o:before{content:"\f15b";}.fa.fa-clock-o:before{content:"\f017";}.fa.fa-arrow-circle-o-down:before{content:"\f358";}.fa.fa-arrow-circle-o-up:before{content:"\f35b";}.fa.fa-play-circle-o:before{content:"\f144";}.fa.fa-repeat:before{content:"\f01e";}.fa.fa-rotate-right:before{content:"\f01e";}.fa.fa-refresh:before{content:"\f021";}.fa.fa-dedent:before{content:"\f03b";}.fa.fa-video-camera:before{content:"\f03d";}.fa.fa-picture-o:before{content:"\f03e";}.fa.fa-photo:before{content:"\f03e";}.fa.fa-image:before{content:"\f03e";}.fa.fa-pencil:before{content:"\f303";}.fa.fa-map-marker:before{content:"\f3c5";}.fa.fa-pencil-square-o:before{content:"\f044";}.fa.fa-share-square-o:before{content:"\f14d";}.fa.fa-check-square-o:before{content:"\f14a";}.fa.fa-arrows:before{content:"\f0b2";}.fa.fa-times-circle-o:before{content:"\f057";}.fa.fa-check-circle-o:before{content:"\f058";}.fa.fa-mail-forward:before{content:"\f064";}.fa.fa-warning:before{content:"\f071";}.fa.fa-calendar:before{content:"\f073";}.fa.fa-arrows-v:before{content:"\f338";}.fa.fa-arrows-h:before{content:"\f337";}.fa.fa-bar-chart:before{content:"\f080";}.fa.fa-bar-chart-o:before{content:"\f080";}.fa.fa-gears:before{content:"\f085";}.fa.fa-thumbs-o-up:before{content:"\f164";}.fa.fa-thumbs-o-down:before{content:"\f165";}.fa.fa-heart-o:before{content:"\f004";}.fa.fa-sign-out:before{content:"\f2f5";}.fa.fa-linkedin-square:before{content:"\f08c";}.fa.fa-thumb-tack:before{content:"\f08d";}.fa.fa-external-link:before{content:"\f35d";}.fa.fa-sign-in:before{content:"\f2f6";}.fa.fa-lemon-o:before{content:"\f094";}.fa.fa-square-o:before{content:"\f0c8";}.fa.fa-bookmark-o:before{content:"\f02e";}.fa.fa-facebook:before{content:"\f39e";}.fa.fa-facebook-f:before{content:"\f39e";}.fa.fa-feed:before{content:"\f09e";}.fa.fa-hdd-o:before{content:"\f0a0";}.fa.fa-hand-o-right:before{content:"\f0a4";}.fa.fa-hand-o-left:before{content:"\f0a5";}.fa.fa-hand-o-up:before{content:"\f0a6";}.fa.fa-hand-o-down:before{content:"\f0a7";}.fa.fa-arrows-alt:before{content:"\f31e";}.fa.fa-group:before{content:"\f0c0";}.fa.fa-chain:before{content:"\f0c1";}.fa.fa-scissors:before{content:"\f0c4";}.fa.fa-files-o:before{content:"\f0c5";}.fa.fa-floppy-o:before{content:"\f0c7";}.fa.fa-navicon:before{content:"\f0c9";}.fa.fa-reorder:before{content:"\f0c9";}.fa.fa-google-plus:before{content:"\f0d5";}.fa.fa-money:before{content:"\f3d1";}.fa.fa-unsorted:before{content:"\f0dc";}.fa.fa-sort-desc:before{content:"\f0dd";}.fa.fa-sort-asc:before{content:"\f0de";}.fa.fa-linkedin:before{content:"\f0e1";}.fa.fa-rotate-left:before{content:"\f0e2";}.fa.fa-legal:before{content:"\f0e3";}.fa.fa-tachometer:before{content:"\f3fd";}.fa.fa-dashboard:before{content:"\f3fd";}.fa.fa-comment-o:before{content:"\f075";}.fa.fa-comments-o:before{content:"\f086";}.fa.fa-flash:before{content:"\f0e7";}.fa.fa-paste:before{content:"\f328";}.fa.fa-lightbulb-o:before{content:"\f0eb";}.fa.fa-exchange:before{content:"\f362";}.fa.fa-cloud-download:before{content:"\f381";}.fa.fa-cloud-upload:before{content:"\f382";}.fa.fa-bell-o:before{content:"\f0f3";}.fa.fa-cutlery:before{content:"\f2e7";}.fa.fa-file-text-o:before{content:"\f15c";}.fa.fa-building-o:before{content:"\f1ad";}.fa.fa-hospital-o:before{content:"\f0f8";}.fa.fa-tablet:before{content:"\f3fa";}.fa.fa-mobile:before{content:"\f3cd";}.fa.fa-mobile-phone:before{content:"\f3cd";}.fa.fa-circle-o:before{content:"\f111";}.fa.fa-mail-reply:before{content:"\f3e5";}.fa.fa-folder-o:before{content:"\f07b";}.fa.fa-folder-open-o:before{content:"\f07c";}.fa.fa-smile-o:before{content:"\f118";}.fa.fa-frown-o:before{content:"\f119";}.fa.fa-meh-o:before{content:"\f11a";}.fa.fa-keyboard-o:before{content:"\f11c";}.fa.fa-flag-o:before{content:"\f024";}.fa.fa-mail-reply-all:before{content:"\f122";}.fa.fa-star-half-o:before{content:"\f089";}.fa.fa-star-half-empty:before{content:"\f089";}.fa.fa-star-half-full:before{content:"\f089";}.fa.fa-code-fork:before{content:"\f126";}.fa.fa-chain-broken:before{content:"\f127";}.fa.fa-shield:before{content:"\f3ed";}.fa.fa-calendar-o:before{content:"\f133";}.fa.fa-ticket:before{content:"\f3ff";}.fa.fa-minus-square-o:before{content:"\f146";}.fa.fa-level-up:before{content:"\f3bf";}.fa.fa-level-down:before{content:"\f3be";}.fa.fa-pencil-square:before{content:"\f14b";}.fa.fa-external-link-square:before{content:"\f360";}.fa.fa-caret-square-o-down:before{content:"\f150";}.fa.fa-toggle-down:before{content:"\f150";}.fa.fa-caret-square-o-up:before{content:"\f151";}.fa.fa-toggle-up:before{content:"\f151";}.fa.fa-caret-square-o-right:before{content:"\f152";}.fa.fa-toggle-right:before{content:"\f152";}.fa.fa-eur:before{content:"\f153";}.fa.fa-euro:before{content:"\f153";}.fa.fa-gbp:before{content:"\f154";}.fa.fa-usd:before{content:"\f155";}.fa.fa-dollar:before{content:"\f155";}.fa.fa-inr:before{content:"\f156";}.fa.fa-rupee:before{content:"\f156";}.fa.fa-jpy:before{content:"\f157";}.fa.fa-cny:before{content:"\f157";}.fa.fa-rmb:before{content:"\f157";}.fa.fa-yen:before{content:"\f157";}.fa.fa-rub:before{content:"\f158";}.fa.fa-ruble:before{content:"\f158";}.fa.fa-rouble:before{content:"\f158";}.fa.fa-krw:before{content:"\f159";}.fa.fa-won:before{content:"\f159";}.fa.fa-bitcoin:before{content:"\f15a";}.fa.fa-file-text:before{content:"\f15c";}.fa.fa-sort-alpha-asc:before{content:"\f15d";}.fa.fa-sort-alpha-desc:before{content:"\f881";}.fa.fa-sort-amount-asc:before{content:"\f160";}.fa.fa-sort-amount-desc:before{content:"\f884";}.fa.fa-sort-numeric-asc:before{content:"\f162";}.fa.fa-sort-numeric-desc:before{content:"\f886";}.fa.fa-youtube-play:before{content:"\f167";}.fa.fa-bitbucket-square:before{content:"\f171";}.fa.fa-long-arrow-down:before{content:"\f309";}.fa.fa-long-arrow-up:before{content:"\f30c";}.fa.fa-long-arrow-left:before{content:"\f30a";}.fa.fa-long-arrow-right:before{content:"\f30b";}.fa.fa-gittip:before{content:"\f184";}.fa.fa-sun-o:before{content:"\f185";}.fa.fa-moon-o:before{content:"\f186";}.fa.fa-arrow-circle-o-right:before{content:"\f35a";}.fa.fa-arrow-circle-o-left:before{content:"\f359";}.fa.fa-caret-square-o-left:before{content:"\f191";}.fa.fa-toggle-left:before{content:"\f191";}.fa.fa-dot-circle-o:before{content:"\f192";}.fa.fa-try:before{content:"\f195";}.fa.fa-turkish-lira:before{content:"\f195";}.fa.fa-plus-square-o:before{content:"\f0fe";}.fa.fa-institution:before{content:"\f19c";}.fa.fa-bank:before{content:"\f19c";}.fa.fa-mortar-board:before{content:"\f19d";}.fa.fa-spoon:before{content:"\f2e5";}.fa.fa-automobile:before{content:"\f1b9";}.fa.fa-cab:before{content:"\f1ba";}.fa.fa-envelope-o:before{content:"\f0e0";}.fa.fa-file-pdf-o:before{content:"\f1c1";}.fa.fa-file-word-o:before{content:"\f1c2";}.fa.fa-file-excel-o:before{content:"\f1c3";}.fa.fa-file-powerpoint-o:before{content:"\f1c4";}.fa.fa-file-image-o:before{content:"\f1c5";}.fa.fa-file-photo-o:before{content:"\f1c5";}.fa.fa-file-picture-o:before{content:"\f1c5";}.fa.fa-file-archive-o:before{content:"\f1c6";}.fa.fa-file-zip-o:before{content:"\f1c6";}.fa.fa-file-audio-o:before{content:"\f1c7";}.fa.fa-file-sound-o:before{content:"\f1c7";}.fa.fa-file-video-o:before{content:"\f1c8";}.fa.fa-file-movie-o:before{content:"\f1c8";}.fa.fa-file-code-o:before{content:"\f1c9";}.fa.fa-life-bouy:before{content:"\f1cd";}.fa.fa-life-buoy:before{content:"\f1cd";}.fa.fa-life-saver:before{content:"\f1cd";}.fa.fa-support:before{content:"\f1cd";}.fa.fa-circle-o-notch:before{content:"\f1ce";}.fa.fa-ra:before{content:"\f1d0";}.fa.fa-resistance:before{content:"\f1d0";}.fa.fa-ge:before{content:"\f1d1";}.fa.fa-y-combinator-square:before{content:"\f1d4";}.fa.fa-yc-square:before{content:"\f1d4";}.fa.fa-wechat:before{content:"\f1d7";}.fa.fa-send:before{content:"\f1d8";}.fa.fa-paper-plane-o:before{content:"\f1d8";}.fa.fa-send-o:before{content:"\f1d8";}.fa.fa-circle-thin:before{content:"\f111";}.fa.fa-header:before{content:"\f1dc";}.fa.fa-sliders:before{content:"\f1de";}.fa.fa-futbol-o:before{content:"\f1e3";}.fa.fa-soccer-ball-o:before{content:"\f1e3";}.fa.fa-newspaper-o:before{content:"\f1ea";}.fa.fa-bell-slash-o:before{content:"\f1f6";}.fa.fa-trash:before{content:"\f2ed";}.fa.fa-eyedropper:before{content:"\f1fb";}.fa.fa-area-chart:before{content:"\f1fe";}.fa.fa-pie-chart:before{content:"\f200";}.fa.fa-line-chart:before{content:"\f201";}.fa.fa-cc:before{content:"\f20a";}.fa.fa-ils:before{content:"\f20b";}.fa.fa-shekel:before{content:"\f20b";}.fa.fa-sheqel:before{content:"\f20b";}.fa.fa-meanpath:before{content:"\f2b4";}.fa.fa-diamond:before{content:"\f3a5";}.fa.fa-intersex:before{content:"\f224";}.fa.fa-facebook-official:before{content:"\f09a";}.fa.fa-hotel:before{content:"\f236";}.fa.fa-yc:before{content:"\f23b";}.fa.fa-battery-4:before{content:"\f240";}.fa.fa-battery:before{content:"\f240";}.fa.fa-battery-3:before{content:"\f241";}.fa.fa-battery-2:before{content:"\f242";}.fa.fa-battery-1:before{content:"\f243";}.fa.fa-battery-0:before{content:"\f244";}.fa.fa-sticky-note-o:before{content:"\f249";}.fa.fa-hourglass-o:before{content:"\f254";}.fa.fa-hourglass-1:before{content:"\f251";}.fa.fa-hourglass-2:before{content:"\f252";}.fa.fa-hourglass-3:before{content:"\f253";}.fa.fa-hand-rock-o:before{content:"\f255";}.fa.fa-hand-grab-o:before{content:"\f255";}.fa.fa-hand-paper-o:before{content:"\f256";}.fa.fa-hand-stop-o:before{content:"\f256";}.fa.fa-hand-scissors-o:before{content:"\f257";}.fa.fa-hand-lizard-o:before{content:"\f258";}.fa.fa-hand-spock-o:before{content:"\f259";}.fa.fa-hand-pointer-o:before{content:"\f25a";}.fa.fa-hand-peace-o:before{content:"\f25b";}.fa.fa-television:before{content:"\f26c";}.fa.fa-calendar-plus-o:before{content:"\f271";}.fa.fa-calendar-minus-o:before{content:"\f272";}.fa.fa-calendar-times-o:before{content:"\f273";}.fa.fa-calendar-check-o:before{content:"\f274";}.fa.fa-map-o:before{content:"\f279";}.fa.fa-commenting:before{content:"\f4ad";}.fa.fa-commenting-o:before{content:"\f4ad";}.fa.fa-vimeo:before{content:"\f27d";}.fa.fa-credit-card-alt:before{content:"\f09d";}.fa.fa-pause-circle-o:before{content:"\f28b";}.fa.fa-stop-circle-o:before{content:"\f28d";}.fa.fa-wheelchair-alt:before{content:"\f368";}.fa.fa-question-circle-o:before{content:"\f059";}.fa.fa-volume-control-phone:before{content:"\f2a0";}.fa.fa-asl-interpreting:before{content:"\f2a3";}.fa.fa-deafness:before{content:"\f2a4";}.fa.fa-hard-of-hearing:before{content:"\f2a4";}.fa.fa-signing:before{content:"\f2a7";}.fa.fa-google-plus-official:before{content:"\f2b3";}.fa.fa-google-plus-circle:before{content:"\f2b3";}.fa.fa-fa:before{content:"\f2b4";}.fa.fa-handshake-o:before{content:"\f2b5";}.fa.fa-envelope-open-o:before{content:"\f2b6";}.fa.fa-address-book-o:before{content:"\f2b9";}.fa.fa-vcard:before{content:"\f2bb";}.fa.fa-address-card-o:before{content:"\f2bb";}.fa.fa-vcard-o:before{content:"\f2bb";}.fa.fa-user-circle-o:before{content:"\f2bd";}.fa.fa-user-o:before{content:"\f007";}.fa.fa-drivers-license:before{content:"\f2c2";}.fa.fa-id-card-o:before{content:"\f2c2";}.fa.fa-drivers-license-o:before{content:"\f2c2";}.fa.fa-thermometer-4:before{content:"\f2c7";}.fa.fa-thermometer:before{content:"\f2c7";}.fa.fa-thermometer-3:before{content:"\f2c8";}.fa.fa-thermometer-2:before{content:"\f2c9";}.fa.fa-thermometer-1:before{content:"\f2ca";}.fa.fa-thermometer-0:before{content:"\f2cb";}.fa.fa-bathtub:before{content:"\f2cd";}.fa.fa-s15:before{content:"\f2cd";}.fa.fa-times-rectangle:before{content:"\f410";}.fa.fa-window-close-o:before{content:"\f410";}.fa.fa-times-rectangle-o:before{content:"\f410";}.fa.fa-eercast:before{content:"\f2da";}.fa.fa-snowflake-o:before{content:"\f2dc";}

/*!
 * Nivo Lightbox v1.3.1
 * http://dev7studios.com/nivo-lightbox
 *
 * Copyright 2013, Dev7studios
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */

.nivo-lightbox-overlay {
	position: fixed;
	top: 0;
	left: 0;
	z-index: 99998;
	width: 100%;
	height: 100%;
	overflow: hidden;
	visibility: hidden;
	opacity: 0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.nivo-lightbox-overlay.nivo-lightbox-open {
	visibility: visible;
	opacity: 1;
}
.nivo-lightbox-wrap  {
	position: absolute;
	top: 10%;
	bottom: 10%;
	left: 10%;
	right: 10%;
}
.nivo-lightbox-content {
	width: 100%;
	height: 100%;
}
.nivo-lightbox-title-wrap {
	position: absolute;
	bottom: 0;
	left: 0;
	width: 100%;
	z-index: 99999;
	text-align: center;
}
.nivo-lightbox-nav { display: none; }
.nivo-lightbox-prev {
	position: absolute;
	top: 50%;
	left: 0;
}
.nivo-lightbox-next {
	position: absolute;
	top: 50%;
	right: 0;
}
.nivo-lightbox-close {
	position: absolute;
	top: 2%;
	right: 2%;
}

.nivo-lightbox-image { text-align: center; }
.nivo-lightbox-image img {
	max-width: 100%;
	max-height: 100%;
	width: auto;
	height: auto;
	vertical-align: middle;
	display: inline-block;
}
.nivo-lightbox-content iframe {
	width: 100%;
	height: 100%;
}
.nivo-lightbox-inline,
.nivo-lightbox-ajax {
	max-height: 100%;
	overflow: auto;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	/* https://bugzilla.mozilla.org/show_bug.cgi?id=308801 */
}
.nivo-lightbox-error {
	display: table;
	text-align: center;
	width: 100%;
	height: 100%;
	color: #fff;
	text-shadow: 0 1px 1px #000;
}
.nivo-lightbox-error p {
	display: table-cell;
	vertical-align: middle;
}

/* Effects
 **********************************************/
.nivo-lightbox-notouch .nivo-lightbox-effect-fade,
.nivo-lightbox-notouch .nivo-lightbox-effect-fadeScale,
.nivo-lightbox-notouch .nivo-lightbox-effect-slideLeft,
.nivo-lightbox-notouch .nivo-lightbox-effect-slideRight,
.nivo-lightbox-notouch .nivo-lightbox-effect-slideUp,
.nivo-lightbox-notouch .nivo-lightbox-effect-slideDown,
.nivo-lightbox-notouch .nivo-lightbox-effect-fall {
	-webkit-transition: all 0.2s ease-in-out;
	   -moz-transition: all 0.2s ease-in-out;
	    -ms-transition: all 0.2s ease-in-out;
	     -o-transition: all 0.2s ease-in-out;
	        transition: all 0.2s ease-in-out;
}

/* fadeScale */
.nivo-lightbox-effect-fadeScale .nivo-lightbox-wrap {
	-webkit-transition: all 0.3s;
	   -moz-transition: all 0.3s;
	    -ms-transition: all 0.3s;
	     -o-transition: all 0.3s;
	        transition: all 0.3s;
	-webkit-transform: scale(0.7);
	   -moz-transform: scale(0.7);
	    -ms-transform: scale(0.7);
	        transform: scale(0.7);
}
.nivo-lightbox-effect-fadeScale.nivo-lightbox-open .nivo-lightbox-wrap {
	-webkit-transform: scale(1);
	   -moz-transform: scale(1);
	    -ms-transform: scale(1);
	        transform: scale(1);
}

/* slideLeft / slideRight / slideUp / slideDown */
.nivo-lightbox-effect-slideLeft .nivo-lightbox-wrap,
.nivo-lightbox-effect-slideRight .nivo-lightbox-wrap,
.nivo-lightbox-effect-slideUp .nivo-lightbox-wrap,
.nivo-lightbox-effect-slideDown .nivo-lightbox-wrap {
	-webkit-transition: all 0.3s cubic-bezier(0.25, 0.5, 0.5, 0.9);
	   -moz-transition: all 0.3s cubic-bezier(0.25, 0.5, 0.5, 0.9);
	    -ms-transition: all 0.3s cubic-bezier(0.25, 0.5, 0.5, 0.9);
	     -o-transition: all 0.3s cubic-bezier(0.25, 0.5, 0.5, 0.9);
	        transition: all 0.3s cubic-bezier(0.25, 0.5, 0.5, 0.9);
}
.nivo-lightbox-effect-slideLeft .nivo-lightbox-wrap {
	-webkit-transform: translateX(-10%);
	   -moz-transform: translateX(-10%);
	    -ms-transform: translateX(-10%);
	        transform: translateX(-10%);
}
.nivo-lightbox-effect-slideRight .nivo-lightbox-wrap {
	-webkit-transform: translateX(10%);
	   -moz-transform: translateX(10%);
	    -ms-transform: translateX(10%);
	        transform: translateX(10%);
}
.nivo-lightbox-effect-slideLeft.nivo-lightbox-open .nivo-lightbox-wrap,
.nivo-lightbox-effect-slideRight.nivo-lightbox-open .nivo-lightbox-wrap {
	-webkit-transform: translateX(0);
	   -moz-transform: translateX(0);
	    -ms-transform: translateX(0);
	        transform: translateX(0);
}
.nivo-lightbox-effect-slideDown .nivo-lightbox-wrap {
	-webkit-transform: translateY(-10%);
	   -moz-transform: translateY(-10%);
	    -ms-transform: translateY(-10%);
	        transform: translateY(-10%);
}
.nivo-lightbox-effect-slideUp .nivo-lightbox-wrap {
	-webkit-transform: translateY(10%);
	   -moz-transform: translateY(10%);
	    -ms-transform: translateY(10%);
	        transform: translateY(10%);
}
.nivo-lightbox-effect-slideUp.nivo-lightbox-open .nivo-lightbox-wrap,
.nivo-lightbox-effect-slideDown.nivo-lightbox-open .nivo-lightbox-wrap {
	-webkit-transform: translateY(0);
	   -moz-transform: translateY(0);
	    -ms-transform: translateY(0);
	        transform: translateY(0);
}

/* fall */
.nivo-lightbox-body-effect-fall .nivo-lightbox-effect-fall {
	-webkit-perspective: 1000px;
	   -moz-perspective: 1000px;
	        perspective: 1000px;
}
.nivo-lightbox-effect-fall .nivo-lightbox-wrap {
	-webkit-transition: all 0.3s ease-out;
	   -moz-transition: all 0.3s ease-out;
	    -ms-transition: all 0.3s ease-out;
	     -o-transition: all 0.3s ease-out;
	        transition: all 0.3s ease-out;
	-webkit-transform: translateZ(300px);
	   -moz-transform: translateZ(300px);
	    -ms-transform: translateZ(300px);
	        transform: translateZ(300px);
}
.nivo-lightbox-effect-fall.nivo-lightbox-open .nivo-lightbox-wrap {
	-webkit-transform: translateZ(0);
	   -moz-transform: translateZ(0);
	    -ms-transform: translateZ(0);
	        transform: translateZ(0);
}
/*
 * Nivo Lightbox Default Theme v1.0
 * http://dev7studios.com/nivo-lightbox
 *
 * Copyright 2013, Dev7studios
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */

.nivo-lightbox-theme-default.nivo-lightbox-overlay { 
	background: #666;
	background: rgba(0,0,0,0.6); 
}
.nivo-lightbox-theme-default .nivo-lightbox-content.nivo-lightbox-loading { background: url(/wp-content/plugins/pagelayer/images/nivo-icons/loading.gif) no-repeat 50% 50%; }

.nivo-lightbox-theme-default .nivo-lightbox-nav {
	top: 10%;
	width: 8%;
	height: 80%;
	text-indent: -9999px;
	background-repeat: no-repeat;
	background-position: 50% 50%;
	opacity: 0.5;
}
.nivo-lightbox-theme-default .nivo-lightbox-nav:hover { 
	opacity: 1; 
	background-color: rgba(0,0,0,0.5);
}
.nivo-lightbox-theme-default .nivo-lightbox-prev { 
	background-image: url(/wp-content/plugins/pagelayer/images/nivo-icons/prev.png); 
	border-radius: 0 3px 3px 0;
}
.nivo-lightbox-theme-default .nivo-lightbox-next { 
	background-image: url(/wp-content/plugins/pagelayer/images/nivo-icons/next.png); 
	border-radius: 3px 0 0 3px;
}

.nivo-lightbox-theme-default .nivo-lightbox-close {
	display: block;
	background: url(/wp-content/plugins/pagelayer/images/nivo-icons/close.png) no-repeat;
	width: 48px;
	height: 48px;
	text-indent: -9999px;
	padding: 5px;
	opacity: 0.5;
}
.nivo-lightbox-theme-default .nivo-lightbox-close:hover { opacity: 1; }

.nivo-lightbox-theme-default .nivo-lightbox-title-wrap { bottom: -7%; }
.nivo-lightbox-theme-default .nivo-lightbox-title {
	font: 14px/20px 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-style: normal;
	font-weight: normal;
	background: #000;
	color: #fff;
	padding: 7px 15px;
	border-radius: 30px;
}

.nivo-lightbox-theme-default .nivo-lightbox-image img {
	background: #fff;
	-webkit-box-shadow: 0px 1px 1px rgba(0,0,0,0.4);
	        box-shadow: 0px 1px 1px rgba(0,0,0,0.4);
}
.nivo-lightbox-theme-default .nivo-lightbox-ajax,
.nivo-lightbox-theme-default .nivo-lightbox-inline {
	background: #fff;
	padding: 40px;
	-webkit-box-shadow: 0px 1px 1px rgba(0,0,0,0.4);
	        box-shadow: 0px 1px 1px rgba(0,0,0,0.4);
}

@media (-webkit-min-device-pixel-ratio: 1.3),
       (-o-min-device-pixel-ratio: 2.6/2),
       (min--moz-device-pixel-ratio: 1.3),
       (min-device-pixel-ratio: 1.3),
       (min-resolution: 1.3dppx) {

	.nivo-lightbox-theme-default .nivo-lightbox-content.nivo-lightbox-loading { 
		background-image: url(/wp-content/plugins/pagelayer/images/nivo-icons/loading@2x.gif); 
		-webkit-background-size: 32px 32px; 
		        background-size: 32px 32px;
	}
	.nivo-lightbox-theme-default .nivo-lightbox-prev { 
		background-image: url(/wp-content/plugins/pagelayer/images/nivo-icons/prev@2x.png); 
		-webkit-background-size: 48px 48px; 
		        background-size: 48px 48px;
	}
	.nivo-lightbox-theme-default .nivo-lightbox-next { 
		background-image: url(/wp-content/plugins/pagelayer/images/nivo-icons/next@2x.png); 
		-webkit-background-size: 48px 48px; 
		        background-size: 48px 48px;
	}
	.nivo-lightbox-theme-default .nivo-lightbox-close { 
		background-image: url(/wp-content/plugins/pagelayer/images/nivo-icons/close@2x.png); 
		-webkit-background-size: 16px 16px; 
		        background-size: 16px 16px;
	}
	
}

/**
 * Owl Carousel v2.3.4
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
.pagelayer-owl-carousel,.pagelayer-owl-carousel .pagelayer-owl-item{-webkit-tap-highlight-color:transparent;position:relative}.pagelayer-owl-carousel{display:none;width:100%;z-index:1}.pagelayer-owl-carousel .pagelayer-owl-stage{position:relative;-ms-touch-action:pan-Y;touch-action:manipulation;-moz-backface-visibility:hidden}.pagelayer-owl-carousel .pagelayer-owl-stage:after{content:".";display:block;clear:both;visibility:hidden;line-height:0;height:0}.pagelayer-owl-carousel .pagelayer-owl-stage-outer{position:relative;overflow:hidden;-webkit-transform:translate3d(0,0,0)}.pagelayer-owl-carousel .pagelayer-owl-item,.pagelayer-owl-carousel .pagelayer-owl-wrapper{-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-webkit-transform:translate3d(0,0,0);-moz-transform:translate3d(0,0,0);-ms-transform:translate3d(0,0,0)}.pagelayer-owl-carousel .pagelayer-owl-item{min-height:1px;float:left;-webkit-backface-visibility:hidden;-webkit-touch-callout:none}.pagelayer-owl-carousel .pagelayer-owl-item img{display:block;width:100%}.pagelayer-owl-carousel .pagelayer-owl-dots.disabled,.pagelayer-owl-carousel .pagelayer-owl-nav.disabled{display:none}.no-js .pagelayer-owl-carousel,.pagelayer-owl-carousel.pagelayer-owl-loaded{display:block}.pagelayer-owl-carousel .pagelayer-owl-dot,.pagelayer-owl-carousel .pagelayer-owl-nav .pagelayer-owl-next,.pagelayer-owl-carousel .pagelayer-owl-nav .pagelayer-owl-prev{cursor:pointer;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.pagelayer-owl-carousel .pagelayer-owl-nav button.pagelayer-owl-next,.pagelayer-owl-carousel .pagelayer-owl-nav button.pagelayer-owl-prev,.pagelayer-owl-carousel button.pagelayer-owl-dot{background:0 0;color:inherit;border:none;padding:0!important;font:inherit}.pagelayer-owl-carousel.pagelayer-owl-loading{opacity:0;display:block}.pagelayer-owl-carousel.pagelayer-owl-hidden{opacity:0}.pagelayer-owl-carousel.pagelayer-owl-refresh .pagelayer-owl-item{visibility:hidden}.pagelayer-owl-carousel.pagelayer-owl-drag .pagelayer-owl-item{-ms-touch-action:pan-y;touch-action:pan-y;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.pagelayer-owl-carousel.pagelayer-owl-grab{cursor:move;cursor:grab}.pagelayer-owl-carousel.pagelayer-owl-rtl{direction:rtl}.pagelayer-owl-carousel.pagelayer-owl-rtl .pagelayer-owl-item{float:right}.pagelayer-owl-carousel .animated{animation-duration:1s;animation-fill-mode:both}.pagelayer-owl-carousel .pagelayer-owl-animated-in{z-index:0}.pagelayer-owl-carousel .pagelayer-owl-animated-out{z-index:1}.pagelayer-owl-carousel .fadeOut{animation-name:fadeOut}@keyframes fadeOut{0%{opacity:1}100%{opacity:0}}.pagelayer-owl-height{transition:height .5s ease-in-out}.pagelayer-owl-carousel .pagelayer-owl-item .pagelayer-owl-lazy{opacity:0;transition:opacity .4s ease}.pagelayer-owl-carousel .pagelayer-owl-item .pagelayer-owl-lazy:not([src]),.pagelayer-owl-carousel .pagelayer-owl-item .pagelayer-owl-lazy[src^=""]{max-height:0}.pagelayer-owl-carousel .pagelayer-owl-item img.pagelayer-owl-lazy{transform-style:preserve-3d}.pagelayer-owl-carousel .pagelayer-owl-video-wrapper{position:relative;height:100%;background:#000}.pagelayer-owl-carousel .pagelayer-owl-video-play-icon{position:absolute;height:80px;width:80px;left:50%;top:50%;margin-left:-40px;margin-top:-40px;background:url(/wp-content/plugins/pagelayer/css/owl.video.play.png) no-repeat;cursor:pointer;z-index:1;-webkit-backface-visibility:hidden;transition:transform .1s ease}.pagelayer-owl-carousel .pagelayer-owl-video-play-icon:hover{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}.pagelayer-owl-carousel .pagelayer-owl-video-playing .pagelayer-owl-video-play-icon,.pagelayer-owl-carousel .pagelayer-owl-video-playing .pagelayer-owl-video-tn{display:none}.pagelayer-owl-carousel .pagelayer-owl-video-tn{opacity:0;height:100%;background-position:center center;background-repeat:no-repeat;background-size:contain;transition:opacity .4s ease}.pagelayer-owl-carousel .pagelayer-owl-video-frame{position:relative;z-index:1;height:100%;width:100%}

/**
 * Owl Carousel v2.3.4
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
.pagelayer-owl-theme .pagelayer-owl-dots,.pagelayer-owl-theme .pagelayer-owl-nav{text-align:center;-webkit-tap-highlight-color:transparent}.pagelayer-owl-theme .pagelayer-owl-nav{margin-top:10px}.pagelayer-owl-theme .pagelayer-owl-nav [class*=owl-]{color:#FFF;font-size:14px;margin:5px;padding:4px 7px;background:#D6D6D6;display:inline-block;cursor:pointer;border-radius:3px}.pagelayer-owl-theme .pagelayer-owl-nav [class*=owl-]:hover{background:#869791;color:#FFF;text-decoration:none}.pagelayer-owl-theme .pagelayer-owl-nav .disabled{opacity:.5;cursor:default}.pagelayer-owl-theme .pagelayer-owl-nav.disabled+.pagelayer-owl-dots{margin-top:10px}.pagelayer-owl-theme .pagelayer-owl-dots .pagelayer-owl-dot{display:inline-block;zoom:1}.pagelayer-owl-theme .pagelayer-owl-dots .pagelayer-owl-dot span{width:10px;height:10px;margin:5px 7px;background:#D6D6D6;display:block;-webkit-backface-visibility:visible;transition:opacity .2s ease;border-radius:30px}.pagelayer-owl-theme .pagelayer-owl-dots .pagelayer-owl-dot.active span,.pagelayer-owl-theme .pagelayer-owl-dots .pagelayer-owl-dot:hover span{background:#869791}

/*
	PageLayer Frontend Framework
*/

[pagelayer-id]{
transition:0.5s;
}

/* Experimental All FLEX code 
.pagelayer-ele,
.pagelayer-ele-wrap,*/

/*Flex - Rows and Cols*/ 
.pagelayer-row,
.pagelayer-inner_row,
.pagelayer-row-holder,
.pagelayer-col,
.pagelayer-col-holder{
box-sizing: border-box;
display: flex;
flex: 1 0 auto;
flex-direction: row;
flex-wrap: wrap;
width:100%;
align-content: stretch;
position: relative;
}

/* The col holder should be flex-start and not stretch because elements in it should take automatic height */
.pagelayer-col,
.pagelayer-col-holder{
align-content: flex-start;
}

/* Each immediate element in the col-holder should have full width */ 
.pagelayer-col-holder>div{
width: 100%;
}

.pagelayer-row.pagelayer-auto .pagelayer-col {
flex-grow: 1; }

.pagelayer-col-1 {
  width: 8.33333%; }

.pagelayer-offset-1 {
  margin-left: 8.33333%; }

.pagelayer-col-2 {
  width: 16.66667%; }

.pagelayer-offset-2 {
  margin-left: 16.66667%; }

.pagelayer-col-3 {
  width: 25%; }

.pagelayer-offset-3 {
  margin-left: 25%; }

.pagelayer-col-4 {
  width: 33.33333%; }

.pagelayer-offset-4 {
  margin-left: 33.33333%; }

.pagelayer-col-5 {
  width: 41.66667%; }

.pagelayer-offset-5 {
  margin-left: 41.66667%; }

.pagelayer-col-6 {
  width: 50%; }

.pagelayer-offset-6 {
  margin-left: 50%; }

.pagelayer-col-7 {
  width: 58.33333%; }

.pagelayer-offset-7 {
  margin-left: 58.33333%; }

.pagelayer-col-8 {
  width: 66.66667%; }

.pagelayer-offset-8 {
  margin-left: 66.66667%; }

.pagelayer-col-9 {
  width: 75%; }

.pagelayer-offset-9 {
  margin-left: 75%; }

.pagelayer-col-10 {
  width: 83.33333%; }

.pagelayer-offset-10 {
  margin-left: 83.33333%; }

.pagelayer-col-11 {
  width: 91.66667%; }

.pagelayer-offset-11 {
  margin-left: 91.66667%; }

.pagelayer-col-12 {
  width: 100%; }

.pagelayer-offset-12 {
  margin-left: 100%; }

.pagelayer-gutters > .pagelayer-col-1 {
  width: calc(8.33333% - 2%); }

.pagelayer-gutters > .pagelayer-offset-1 {
  margin-left: calc(8.33333% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-2 {
  width: calc(16.66667% - 2%); }

.pagelayer-gutters > .pagelayer-offset-2 {
  margin-left: calc(16.66667% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-3 {
  width: calc(25% - 2%); }

.pagelayer-gutters > .pagelayer-offset-3 {
  margin-left: calc(25% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-4 {
  width: calc(33.33333% - 2%); }

.pagelayer-gutters > .pagelayer-offset-4 {
  margin-left: calc(33.33333% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-5 {
  width: calc(41.66667% - 2%); }

.pagelayer-gutters > .pagelayer-offset-5 {
  margin-left: calc(41.66667% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-6 {
  width: calc(50% - 2%); }

.pagelayer-gutters > .pagelayer-offset-6 {
  margin-left: calc(50% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-7 {
  width: calc(58.33333% - 2%); }

.pagelayer-gutters > .pagelayer-offset-7 {
  margin-left: calc(58.33333% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-8 {
  width: calc(66.66667% - 2%); }

.pagelayer-gutters > .pagelayer-offset-8 {
  margin-left: calc(66.66667% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-9 {
  width: calc(75% - 2%); }

.pagelayer-gutters > .pagelayer-offset-9 {
  margin-left: calc(75% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-10 {
  width: calc(83.33333% - 2%); }

.pagelayer-gutters > .pagelayer-offset-10 {
  margin-left: calc(83.33333% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-11 {
  width: calc(91.66667% - 2%); }

.pagelayer-gutters > .pagelayer-offset-11 {
  margin-left: calc(91.66667% + 2%) !important; }

.pagelayer-gutters > .pagelayer-col-12 {
  width: calc(100% - 2%); }

.pagelayer-gutters > .pagelayer-offset-12 {
  margin-left: calc(100% + 2%) !important; }

.pagelayer-first {
  order: -1; }

.pagelayer-last {
  order: 1; }

/**************My Style for front-end *********/
.pagelayer-img{
vertical-align:bottom;
max-width: 100%;
}

/* To give no decoration to a link for a pagelayer element */
.pagelayer-ele-link{
text-decoration:none;
box-shadow:none !important;
border:none;
}

.pagelayer-bgimg-slider{
position: absolute;
top: 0;
left: 0;
height: 100%;
width: 100%;
}

.pagelayer-bgimg-slide {
position: absolute;
width: 100%;
top: 0;
left: 0;
height: 100%;
transition: all 1s ease-in-out;
background-position: center center;
background-repeat: no-repeat;
background-size: cover;
opacity: 0;
}

.pagelayer-slide-show {
opacity: 1;
}

.pagelayer-row-overlay,
.pagelayer-col-overlay{
position: absolute;
width: 100%;
height: 100%;
right: 0px;
top: 0px;
z-index: -1;
pointer-events:none;
}

.pagelayer-row-shape{
width:100%;
position:absolute;
top:0;
left:0;
right:0;
bottom:0;
line-height:0;
overflow:hidden;
}

.pagelayer-row-svg{
position:relative;
height:100%;
}

.pagelayer-row-svg svg{
width:100%;
position:absolute;
}

.pagelayer-row-svg svg.pagelayer-svg-top{
top:-1px;
}

.pagelayer-row-svg svg.pagelayer-svg-bottom{
bottom:-1px;
}

.pagelayer-height-fit{
height:100vh;
}

.pagelayer-row-wrapper{
width:100%;
}

.pagelayer-background-overlay{
position: absolute;
width: 100%;
top: 0;
left:0;
height: 100%;
overflow: hidden;
}

.pagelayer-background-video{
position: absolute;
width: 100%;
top: 0;
height: 100%;
pointer-events: none;
z-index: 0;
overflow: hidden;
left:0;
}

.pagelayer-background-video iframe,
.pagelayer-background-video video{
position: absolute;
top: 50%;
left: 50%;
-webkit-transform: translateX(-50%) translateY(-50%);
-ms-transform: translateX(-50%) translateY(-50%);
transform: translateX(-50%) translateY(-50%);
max-width: none;
}

.pagelayer-service-container{
position:relative;
-webkit-box-align: start;
-webkit-align-items: flex-start;
-ms-flex-align: start;
align-items: flex-start;
}

.pagelayer-service-image{
line-height:0;
overflow:hidden;
}

.pagelayer-service-image img{
height: auto;
max-width: 100%;
}

.pagelayer-service-btn{
display:inline-block;
position:relative;
z-index:9;
}

.pagelayer-service-details{
width:100%;
}

.pagelayer-service-text{
word-break:break-word;
}

.pagelayer-service-align-left{
display:flex;
}

.pagelayer-service-align-right{
display:flex;
text-align: right;
-webkit-box-orient: horizontal;
-webkit-box-direction: reverse;
flex-direction: row-reverse;
}

.pagelayer-service-align-top{
display:block;
text-align: center;
}

.pagelayer-service-align-top .pagelayer-service-image{
margin:0 auto;
text-align:center;
}

.pagelayer-service-box-centered{
text-align: center;
}

.pagelayer-service-box-media-left,
.pagelayer-service-box-media-right{
display: flex;
}

.pagelayer-service-vertical-top{
align-items: flex-start;
-webkit-align-items: flex-start;
-webkit-box-align: start;
-ms-flex-align: start;
}

.pagelayer-service-vertical-middle{
align-items: center;
-webkit-align-items: center;
-webkit-box-align: center;
-ms-flex-align: center;
}

.pagelayer-service-vertical-bottom{
align-items: flex-end;
-webkit-align-items: flex-end;
-webkit-box-align: end;
-ms-flex-align: end;
}

.pagelayer-service-box-media-right .pagelayer-service-box-media-section{
order: 2;
}
.pagelayer-service-box-media-right .pagelayer-service-box-content-section{
order: 1;
}

.pagelayer-service-box-icon-holder{
display: inline-block;
color:#000000;
text-align: center;
line-height: 1;
font-size: 60px;
}

.pagelayer-service-icon{
line-height: 0;
}

.pagelayer-service-icon.pagelayer-service-framed i{
border:4px solid;
background-color:transparent !important;
}

.pagelayer-service-icon.pagelayer-service-stacked i,
.pagelayer-service-icon.pagelayer-service-framed i{
position:relative;
}

.pagelayer-service-icon.pagelayer-service-stacked i:before,
.pagelayer-service-icon.pagelayer-service-framed i:before{
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
}

.pagelayer-service-box-icon-holder.square-holder{ 
padding: 15px;
color:#000000; 
}

.pagelayer-service-box-icon-holder.circle-holder{ 
padding: 15px;
color:#000000;
border-radius:50% !Important; 
}

.pagelayer-service-box-icon-holder i{
position: relative;
display: block;
}

.pagelayer-service-heading{
line-height:1;
}

.pagelayer-box-link{
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}

/* Icon widget */

.pagelayer-icon-mini{
	font-size: 16px !important;
}

.pagelayer-icon-small{
	font-size: 24px !important;
}

.pagelayer-icon-large{
	font-size: 36px !important;
}

.pagelayer-icon-extra-large{
	font-size: 56px !important;
}

.pagelayer-icon-double-large{
	font-size: 78px !important;
}

.pagelayer-icon-circle,
.pagelayer-icon-outline-circle,
.pagelayer-social-shape-circle .pagelayer-icon-holder{
	border-radius: 50%;
}

.pagelayer-icon-rounded,
.pagelayer-icon-outline-rounded,
.pagelayer-social-shape-rounded .pagelayer-share-content,
.pagelayer-social-shape-rounded .pagelayer-icon-holder{
	border-radius: 10px;
}

/* Icon widget end */

/* Icon animation */
.pagelayer-animation-grow{
transition: transform 400ms;
}

.pagelayer-animation-grow:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-grow{
transform: scale(1.1);
}

.pagelayer-animation-shrink{
transition: transform 400ms;
}

.pagelayer-animation-shrink:hover,
.pagelayer-anim-par:hover .pagelayer-animation-shrink{
transform: scale(0.9);
}

@keyframes pagelayer-animation-pulse{25%{transform:scale(1.1)}75%{transform:scale(0.9)}}

.pagelayer-animation-pulse:hover,
.pagelayer-anim-par:hover .pagelayer-animation-pulse{
animation-name: pagelayer-animation-pulse;
animation-duration: 1s;
animation-timing-function: linear;
animation-iteration-count: infinite;
}

@keyframes pagelayer-animation-pulse-grow{to{transform:scale(1.1)}}

.pagelayer-animation-pulse-grow:hover,
.pagelayer-anim-par:hover .pagelayer-animation-pulse-grow{
animation-name: pagelayer-animation-pulse-grow;
animation-duration: 0.4s;
animation-timing-function: linear;
animation-iteration-count: infinite;
animation-direction:alternate;
}

@keyframes pagelayer-animation-pulse-shrink{to{transform:scale(0.9)}}

.pagelayer-animation-pulse-shrink:hover,
.pagelayer-anim-par:hover .pagelayer-animation-pulse-shrink{
animation-name: pagelayer-animation-pulse-shrink;
animation-duration: 0.4s;
animation-timing-function: linear;
animation-iteration-count: infinite;
animation-direction:alternate;
}

@keyframes pagelayer-animation-push{50%{transform:scale(0.8)}100%{transform:scale(1)}}

.pagelayer-animation-push:hover,
.pagelayer-anim-par:hover .pagelayer-animation-push{
animation-name:pagelayer-animation-push;
animation-duration:0.4s;
animation-timing-function:linear;
animation-iteration-count:1
}

@keyframes pagelayer-animation-pop{50%{transform:scale(1.2)}}

.pagelayer-animation-pop:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-pop{
animation-name:pagelayer-animation-pop;
animation-duration:0.4s;
animation-timing-function:linear;
animation-iteration-count:1
}

@keyframes pagelayer-animation-buzz{
50%{
transform:translateX(3px) rotate(2deg)
}
100%{
transform:translateX(-3px) rotate(-2deg)
}
}

.pagelayer-animation-buzz:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-buzz{
animation-name:pagelayer-animation-buzz;
animation-duration:0.15s;
animation-timing-function:linear;
animation-iteration-count:infinite;
}

@keyframes pagelayer-animation-buzz-out{
10%{transform:translateX(3px) rotate(2deg)}
20%{transform:translateX(-3px) rotate(-2deg)}
30%{transform:translateX(3px) rotate(2deg)}
40%{transform:translateX(-3px) rotate(-2deg)}
50%{transform:translateX(2px) rotate(1deg)}
60%{transform:translateX(-2px) rotate(-1deg)}
70%{transform:translateX(2px) rotate(1deg)}
80%{transform:translateX(-2px) rotate(-1deg)}
90%{transform:translateX(1px) rotate(0)}
100%{transform:translateX(-1px) rotate(0)}
}

.pagelayer-animation-buzz-out:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-buzz-out{
animation-name:pagelayer-animation-buzz-out;
animation-duration:0.7s;
animation-timing-function:linear;
animation-iteration-count:1;
}

.pagelayer-animation-float:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-float{
transform:translateY(-8px)
}

.pagelayer-animation-sink:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-sink{
transform:translateY(8px)
}

@keyframes pagelayer-animation-bob{
0%{transform:translateY(-8px)}
50%{transform:translateY(-4px)}
100%{transform:translateY(-8px)}
}

@keyframes pagelayer-animation-bob-up{
100%{transform:translateY(-8px)}
}

.pagelayer-animation-bob:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-bob{
animation-name:pagelayer-animation-bob-up,pagelayer-animation-bob;
animation-duration:0.4s,1.5s;
animation-timing-function:ease-out,ease-in-out;
animation-delay:0s,0.3s;
animation-iteration-count:infinite;
}

@keyframes pagelayer-animation-hang{
0%{transform:translateY(8px)}
50%{transform:translateY(4px)}
100%{transform:translateY(8px)}
}

@keyframes pagelayer-animation-hang-up{
100%{transform:translateY(8px)}
}

.pagelayer-animation-hang:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-hang{
animation-name:pagelayer-animation-hang-up,pagelayer-animation-hang;
animation-duration:0.4s,1.5s;
animation-timing-function:ease-out,ease-in-out;
animation-delay:0s,0.3s;
animation-iteration-count:1,infinite;
animation-direction:normal,alternate;
}

.pagelayer-animation-bounce-in{
transition-duration:0.5s;
}
.pagelayer-animation-bounce-in:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-bounce-in{
transform:scale(1.2);
transition-timing-function:cubic-bezier(0.52,2.07,0.36,-0.41);
}

.pagelayer-animation-bounce-out{
transition-duration:0.5s;
}

.pagelayer-animation-bounce-out:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-bounce-out{
transform:scale(0.8);
transition-timing-function:cubic-bezier(0.52,2.07,0.36,-0.41);
}

.pagelayer-animation-rotate:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-rotate{
transform:rotate(6deg);
}

.pagelayer-animation-grow-rotate:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-grow-rotate{
transform:scale(1.1) rotate(6deg);
}

.pagelayer-animation-skew-forward:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-skew-forward{
transform:skew(-9deg);
}

.pagelayer-animation-skew-backward:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-skew-backward{
transform:skew(9deg);
}

@keyframes pagelayer-animation-wobble-vertical{
17%{transform:translateY(9px)}
33%{transform:translateY(-7px)}
45%{transform:translateY(5px)}
67%{transform:translateY(-3px)}
83%{transform:translateY(1px)}
100%{transform:translateY(0)}
}

.pagelayer-animation-wobble-vertical:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-wobble-vertical{
animation-name:pagelayer-animation-wobble-vertical;
animation-duration:1s;
animation-timing-function:ease-in-out;
animation-iteration-count:1;
}

@keyframes pagelayer-animation-wobble-horizontal{
17%{transform:translateX(9px)}
33%{transform:translateX(-7px)}
50%{transform:translatex(5px)}
67%{transform:translateX(-3px)}
83%{transform:translateX(1px)}
100%{transform:translateX(0)}
}

.pagelayer-animation-wobble-horizontal:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-wobble-horizontal{
animation-name:pagelayer-animation-wobble-horizontal;
animation-duration:1s;
animation-timing-function:ease-in-out;
animation-iteration-count:1;
}

@keyframes pagelayer-animation-wobble-bottom-to-right{
17%{transform:translate(9px,9px)}
33%{transform:translate(-7px,-7px)}
50%{transform:translate(5px,5px)}
67%{transform:translate(-3px,-3px)}
83%{transform:translate(1px,1px)}
100%{transform:translate(0,0)}
}


.pagelayer-animation-wobble-bottom-to-right:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-wobble-bottom-to-right{
animation-name:pagelayer-animation-wobble-bottom-to-right;
animation-duration:1s;
animation-timing-function:ease-in-out;
animation-iteration-count:1;
}

@keyframes pagelayer-animation-wobble-top-to-right{
17%{transform:translate(9px,-9px)}
33%{transform:translate(-7px,7px)}
50%{transform:translate(5px,-5px)}
67%{transform:translate(-3px,3px)}
83%{transform:translate(1px,-1px)}
100%{transform:translate(0,0)}
}


.pagelayer-animation-wobble-top-to-right:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-wobble-top-to-right{
animation-name:pagelayer-animation-wobble-top-to-right;
animation-duration:1s;
animation-timing-function:ease-in-out;
animation-iteration-count:1;
}

.pagelayer-animation-wobble-top{
transform-origin:0 100%;
}

@keyframes pagelayer-animation-wobble-top{
17%{transform:skew(-13deg)}
33%{transform:skew(11deg)}
50%{transform:skew(-7deg)}
67%{transform:skew(5deg)}
83%{transform:skew(-3deg)}
100%{transform:skew(0)}
}

.pagelayer-animation-wobble-top:hover,
.pagelayer-anim-par:hover .pagelayer-animation-wobble-top{
animation-name:pagelayer-animation-wobble-top;
animation-duration:1s;
animation-timing-function:ease-in-out;
animation-iteration-count:1
}

.pagelayer-animation-wobble-bottom{
transform-origin:100% 0;
}

@keyframes pagelayer-animation-wobble-bottom{
17%{transform:skew(-13deg)}
33%{transform:skew(11deg)}
50%{transform:skew(-7deg)}
67%{transform:skew(5deg)}
83%{transform:skew(-3deg)}
100%{transform:skew(0)}
}

.pagelayer-animation-wobble-bottom:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-wobble-bottom{
animation-name:pagelayer-animation-wobble-bottom;
animation-duration:1s;
animation-timing-function:ease-in-out;
animation-iteration-count:1
}

@keyframes pagelayer-animation-wobble-skew{
17%{transform:skew(-13deg)}
33%{transform:skew(11deg)}
50%{transform:skew(-7deg)}
67%{transform:skew(5deg)}
83%{transform:skew(-3deg)}
100%{transform:skew(0)}
}

.pagelayer-animation-wobble-skew:hover, 
.pagelayer-anim-par:hover .pagelayer-animation-wobble-skew{
animation-name:pagelayer-animation-wobble-skew;
animation-duration:1s;
animation-timing-function:ease-in-out;
animation-iteration-count:1
}

/* Icon animation end */

/*Badge widget */
.pagelayer-badge a{
text-decoration: none !important;
}
.pagelayer-badge-btn{
display:none;
padding:10px;
padding: 0.40em 0.36em;
}
 
.pagelayer-badge-details{
margin-left:1px;
border-radius:.25rem;
padding: 0.10rem;
position: relative;
top: -3px;
}
 
.pagelayer-badge-details.pagelayer-badge-normal{
border-radius:.25rem;
}

.pagelayer-badge-details.pagelayer-badge-pills{
border-radius:10rem;
}

.pagelayer-badge-btn .pagelayer-badge-details{
position:relative;
top:-1px;
} 

/*Badge widget end*/

/*Tooltip widget*/
.pagelayer-tooltip-container{
position:relative;
display:inline-block;
line-height: 1;
}

.pagelayer-tooltip-text{
visibility: hidden;
width: 300px;
background-color: #000000;
color: #ffffff;
text-align: center;
border-radius: 6px;
position: absolute;
z-index: 1;
padding:5px;
word-break:break-word;
}

.pagelayer-tooltip-icon{
margin:0px 4px;
}
.pagelayer-tooltip-top{
bottom: calc(100% + 10px);
left: 50%;
transform: translateX(-50%);
}

.pagelayer-tooltip-top:after{
content: "";
position: absolute;
top: 100%;
left: 50%;
margin-left: -5px;
border-width: 5px;
border-style: solid;
border-color: #000000 transparent transparent transparent;
}

.pagelayer-tooltip-right{
top: 50%;
left: calc(100% + 10px);
transform: translateY(-50%);
}

.pagelayer-tooltip-right:after {
content: "";
position: absolute;
top: 50%;
right: 100%;
margin-top: -5px;
border-width: 5px;
border-style: solid;
border-color: transparent #000000 transparent transparent;
}

.pagelayer-tooltip-bottom{
top: calc(100% + 10px);
left: 50%;
transform: translateX(-50%);
}

.pagelayer-tooltip-bottom:after{
content: "";
position: absolute;
bottom: 100%;
left: 50%;
margin-left: -5px;
border-width: 5px;
border-style: solid;
border-color: transparent transparent #000000 transparent;
}

.pagelayer-tooltip-left{
top: 50%;
bottom: auto;
right: calc(100% + 10px);
transform: translateY(-50%);
}

.pagelayer-tooltip-left:after{
content: "";
position: absolute;
top: 50%;
left: 100%;
transform: translateY(-50%);
margin-top: -5px;
border-width: 5px;
border-style: solid;
border-color: transparent transparent transparent #000000;
}

.pagelayer-tooltip-container:hover .pagelayer-tooltip-text{
visibility: visible;
}

.pagelayer-tooltip-on-click{
visibility: visible !important;
}
/*Tooltip widget end*/

/* Button widget */

.pagelayer-btn-holder{
border-radius:5px;
display:inline-block;
line-height:1em;
transition:all 0.3s;
cursor: pointer;
box-sizing:border-box;
}

.pagelayer-btn-default{
background-color:#818a91 !important;
color:#ffffff !important;
}

.pagelayer-btn-primary,
.pagelayer-badge-primary,
.pagelayer-progress-primary{
color:#ffffff !important;
background-color:#007bff !important;
}

.pagelayer-btn-primary:hover{
color:#ffffff !important;
background-color: #0069d9 !important;
}

.pagelayer-btn-secondary,
.pagelayer-badge-secondary,
.pagelayer-progress-secondary{
color:#ffffff !important;
background-color:#6c757d !important;
}

.pagelayer-btn-secondary:hover{
color: #ffffff !important;
background-color: #5a6268 !important;
}

.pagelayer-btn-success,
.pagelayer-badge-success,
.pagelayer-progress-success{
color: #fff;
background-color: #28a745 !important;
}

.pagelayer-btn-success:hover{
color: #ffffff !important;
background-color: #218838 !important;
}

.pagelayer-btn-info,
.pagelayer-badge-info,
.pagelayer-progress-info{
color: #ffffff !important;
background-color: #17a2b8 !important;
}

.pagelayer-btn-info:hover{
color: #ffffff !important;
background-color: #138496 !important;
}

.pagelayer-btn-warning,
.pagelayer-badge-warning,
.pagelayer-progress-warning{
color: #212529 !important;
background-color: #ffc107 !important;
}

.pagelayer-btn-warning:hover{
color: #212529 !important;
background-color: #e0a800 !important;
}

.pagelayer-btn-danger,
.pagelayer-badge-danger,
.pagelayer-progress-danger{
color: #ffffff !important;
background-color: #dc3545 !important;
}

.pagelayer-btn-danger:hover{
color: #ffffff !important;
background-color: #c82333 !important;
}

.pagelayer-btn-dark,
.pagelayer-badge-dark,
.pagelayer-progress-dark{
color: #ffffff !important;
background-color: #343a40 !important;
}

.pagelayer-btn-dark:hover{
color: #ffffff !important;
background-color: #23272b !important;
}

.pagelayer-btn-light,
.pagelayer-badge-light,
.pagelayer-progress-light{
color: #212529 !important;
background-color: #f8f9fa !important;
}

.pagelayer-btn-light:hover{
color: #212529 !important;
background-color: #e2e6ea !important;
}

.pagelayer-btn-link{
color: #007bff !important;
}

.pagelayer-btn-link:hover{
text-decoration: underline !important;
}

.pagelayer-btn-default:hover{
color:#ffffff;
}

.pagelayer-btn-mini{
font-size: 14px;
padding: 10px 20px;
}

.pagelayer-btn-small{
font-size: 16px;
padding: 15px 30px;
}

.pagelayer-btn-large{
font-size: 18px;
padding: 20px 40px;
}

.pagelayer-btn-extra-large{
font-size: 20px;
padding: 25px 50px;
}

.pagelayer-btn-double-large{
font-size: 22px;
padding: 30px 60px;
}

.pagelayer-btn-icon-left .pagelayer-btn-icon:last-child,
.pagelayer-btn-icon-right .pagelayer-btn-icon:first-child,
.pagelayer-btn-icon-left .pagelayer-btn-load-icon:last-child,
.pagelayer-btn-icon-right .pagelayer-btn-load-icon:first-child,
.pagelayer-btn-icon-left .pagelayer-cf-icon-right,
.pagelayer-btn-icon-right .pagelayer-cf-icon-left{
display: none;
}

.pagelayer-btn-icon-left .pagelayer-btn-icon,
.pagelayer-btn-icon-left .pagelayer-btn-load-icon{
padding-left:0 !important;
position: relative;
z-index: 1;
}

.pagelayer-btn-icon-right .pagelayer-btn-icon,
.pagelayer-btn-icon-right .pagelayer-btn-load-icon{
padding-right:0 !important;
position: relative;
z-index: 1;
}

/* Button widget end */

/* Social Profile */
.pagelayer-icon-holder[class*="pagelayer-facebook"] .pagelayer-social-fa{
color:#3B5998;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-facebook"],
.pagelayer-share-content[class*="pagelayer-facebook"]{
background-color:#3B5998;
color:#3B5998;
}

.pagelayer-icon-holder[class*="pagelayer-twitter"] .pagelayer-social-fa{
color:#1DA1F2;	
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-twitter"],
.pagelayer-share-content[class*="pagelayer-twitter"]{
background-color:#1DA1F2;
color:#1DA1F2;
}

.pagelayer-icon-holder[class*="pagelayer-android"] .pagelayer-social-fa{
color:#A4C639
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-android"],
.pagelayer-share_grp[class*="pagelayer-social-shape"] .pagelayer-share-content[class*="pagelayer-android"]{
background-color:#A4C639;
}

.pagelayer-icon-holder[class*="pagelayer-google-plus"] .pagelayer-social-fa{
color:#DD4B39
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-google-plus"],
.pagelayer-share-content[class*="pagelayer-google-plus"]{
background-color:#DD4B39;
color:#DD4B39;
}

.pagelayer-icon-holder[class*="pagelayer-instagram"] .pagelayer-social-fa{
color:#262626;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-instagram"],
.pagelayer-share-content[class*="pagelayer-instagram"]{
background-color:#1DA1F2;
color:#262626;
}

.pagelayer-icon-holder[class*="pagelayer-linkedin"] .pagelayer-social-fa{
color:#0077B5;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-linkedin"],
.pagelayer-share-content[class*="pagelayer-linkedin"]{
background-color:#0077B5;
color:#0077B5;
}

.pagelayer-icon-holder[class*="pagelayer-behance"] .pagelayer-social-fa{
color:#053eff;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-behance"],
.pagelayer-share-content[class*="pagelayer-behance"]{
background-color:#053eff;
color:#053eff;
}

.pagelayer-icon-holder[class*="pagelayer-pinterest"] .pagelayer-social-fa{
color:#c8232c;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-pinterest"],
.pagelayer-share-content[class*="pagelayer-pinterest"]{
background-color:#c8232c;
color:#c8232c;
}

.pagelayer-icon-holder[class*="pagelayer-reddit"] .pagelayer-social-fa{
color:#ff4301;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-reddit"],
.pagelayer-share-content[class*="pagelayer-reddit"]{
background-color:#ff4301;
color:#ff4301;
}

.pagelayer-icon-holder[class*="pagelayer-rss"] .pagelayer-social-fa{
color:#F26522;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-rss"],
.pagelayer-share-content[class*="pagelayer-rss"]{
background-color:#F26522;
color:#F26522;
}

.pagelayer-icon-holder[class*="pagelayer-skype"] .pagelayer-social-fa{
color:#00aff0;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-skype"],
.pagelayer-share-content[class*="pagelayer-skype"]{
background-color:#00aff0;	
color:#00aff0;
}

.pagelayer-icon-holder[class*="pagelayer-slideshare"] .pagelayer-social-fa{
color:#0077b5;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-slideshare"],
.pagelayer-share-content[class*="pagelayer-slideshare"]{
background-color:#0077b5;
color:#0077b5;
}

.pagelayer-icon-holder[class*="pagelayer-snapchat"] .pagelayer-social-fa{
color:#fffc00;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-snapchat"],
.pagelayer-share-content[class*="pagelayer-snapchat"]{
background-color:#fffc00;
color:#fffc00;
}

.pagelayer-icon-holder[class*="pagelayer-soundcloud"] .pagelayer-social-fa{
color:#ff8800;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-soundcloud"],
.pagelayer-share-content[class*="pagelayer-soundcloud"]{
background-color:#ff8800;
color:#ff8800;
}

.pagelayer-icon-holder[class*="pagelayer-spotify"] .pagelayer-social-fa{
color:#1ED760;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-spotify"],
.pagelayer-share-content[class*="pagelayer-spotify"]{
background-color:#1ED760;
color:#1ED760;
}

.pagelayer-icon-holder[class*="pagelayer-stack-overflow"] .pagelayer-social-fa{
color:#F48024;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-stack-overflow"],
.pagelayer-share-content[class*="pagelayer-stack-overflow"]{
background-color:#F48024;
color:#F48024;
}

.pagelayer-icon-holder[class*="pagelayer-steam"] .pagelayer-social-fa{
color:#00adee;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-steam"],
.pagelayer-share-content[class*="pagelayer-steam"]{
background-color:#00adee;
color:#00adee;
}

.pagelayer-icon-holder[class*="pagelayer-stumbleupon"] .pagelayer-social-fa{
color:#EB4924;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-stumbleupon"],
.pagelayer-share-content[class*="pagelayer-stumbleupon"]{
background-color:#EB4924;
color:#EB4924;
}

.pagelayer-icon-holder[class*="pagelayer-telegram"] .pagelayer-social-fa{
color:#0088cc;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-telegram"],
.pagelayer-share-content[class*="pagelayer-telegram"]{
background-color:#0088cc;
color:#0088cc;
}

.pagelayer-icon-holder[class*="pagelayer-thumb-tack"] .pagelayer-social-fa{
color:#1AA1D8;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-thumb-tack"],
.pagelayer-share-content[class*="pagelayer-thumb-tack"]{
background-color:#1AA1D8;
color:#1AA1D8;
}

.pagelayer-icon-holder[class*="pagelayer-tripadvisor"] .pagelayer-social-fa{
color:#00af87;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-tripadvisor"],
.pagelayer-share-content[class*="pagelayer-tripadvisor"]{
background-color:#00af87;
color:#00af87;
}

.pagelayer-icon-holder[class*="pagelayer-tumblr"] .pagelayer-social-fa{
color:#001935;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-tumblr"],
.pagelayer-share-content[class*="pagelayer-tumblr"]{
background-color:#001935;
color:#001935;
}

.pagelayer-icon-holder[class*="pagelayer-twitch"] .pagelayer-social-fa{
color:#6441a5;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-twitch"],
.pagelayer-share-content[class*="pagelayer-twitch"]{
background-color:#6441a5;
color:#6441a5;
}

.pagelayer-icon-holder[class*="pagelayer-vimeo"] .pagelayer-social-fa{
color:#1CB7EA;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-vimeo"],
.pagelayer-share-content[class*="pagelayer-vimeo"]{
background-color:#1CB7EA;
color:#1CB7EA;
}

.pagelayer-icon-holder[class*="pagelayer-vk"] .pagelayer-social-fa{
color:#4C75A3;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-vk"],
.pagelayer-share-content[class*="pagelayer-vk"]{
background-color:#4C75A3;
color:#4C75A3;
}

.pagelayer-icon-holder[class*="pagelayer-weibo"] .pagelayer-social-fa{
color:#DF2029;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-weibo"],
.pagelayer-share-content[class*="pagelayer-weibo"]{
background-color:#DF2029;
color:#DF2029;
}

.pagelayer-icon-holder[class*="pagelayer-weixin"] .pagelayer-social-fa{
color:#7bb32e;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-weixin"],
.pagelayer-share-content[class*="pagelayer-weixin"]{
background-color:#7bb32e;
color:#7bb32e;
}

.pagelayer-icon-holder[class*="pagelayer-whatsapp"] .pagelayer-social-fa{
color:#25D366;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-whatsapp"],
.pagelayer-share-content[class*="pagelayer-whatsapp"]{
background-color:#25D366;
color:#25D366;
}

.pagelayer-icon-holder[class*="pagelayer-wordpress"] .pagelayer-social-fa{
color:#21759b;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-wordpress"],
.pagelayer-share-content[class*="pagelayer-wordpress"]{
background-color:#21759b;
color:#21759b;
}

.pagelayer-icon-holder[class*="pagelayer-xing"] .pagelayer-social-fa{
color:#026466;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-xing"],
.pagelayer-share-content[class*="pagelayer-xing"]{
background-color:#026466;	
color:#026466;
}

.pagelayer-icon-holder[class*="pagelayer-yelp"] .pagelayer-social-fa{
color:#af0606;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-yelp"],
.pagelayer-share-content[class*="pagelayer-yelp"]{
background-color:#af0606;
color:#af0606;
}

.pagelayer-icon-holder[class*="pagelayer-youtube"] .pagelayer-social-fa{
color:#ff0000;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-youtube"],
.pagelayer-share-content[class*="pagelayer-youtube"]{
background-color:#ff0000;
color:#ff0000;
}

.pagelayer-icon-holder[class*="pagelayer-500px"] .pagelayer-social-fa{
color:#0099e5;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-500px"],
.pagelayer-share-content[class*="pagelayer-500px"]{
background-color:#0099e5;
color:#0099e5;
}

.pagelayer-icon-holder[class*="pagelayer-flickr"] .pagelayer-social-fa{
color:#0063dc;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-flickr"],
.pagelayer-share-content[class*="pagelayer-flickr"]{
background-color:#0063dc;
color:#0063dc;
}

.pagelayer-icon-holder[class*="pagelayer-github"] .pagelayer-social-fa{
color:#4078c0;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-github"],
.pagelayer-share-content[class*="pagelayer-github"]{
background-color:#4078c0;	
color:#4078c0;
}

.pagelayer-icon-holder[class*="pagelayer-gitlab"] .pagelayer-social-fa{
color:#fca326;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-gitlab"],
.pagelayer-share-content[class*="pagelayer-gitlab"]{
background-color:#fca326;
color:#fca326;
}

.pagelayer-icon-holder[class*="pagelayer-apple"] .pagelayer-social-fa{
color:#999999;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-apple"],
.pagelayer-share-content[class*="pagelayer-apple"]{
background-color:#999999;
color:#999999;
}

.pagelayer-icon-holder[class*="pagelayer-jsfiddle"] .pagelayer-social-fa{
color:#0084FF;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-jsfiddle"],
.pagelayer-share-content[class*="pagelayer-jsfiddle"]{
background-color:#0084FF;
color:#0084FF;
}

.pagelayer-icon-holder[class*="pagelayer-houzz"] .pagelayer-social-fa{
color:#7ac142;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-houzz"],
.pagelayer-share-content[class*="pagelayer-houzz"]{
background-color:#7ac142;
color:#7ac142;
}

.pagelayer-icon-holder[class*="pagelayer-bitbucket"] .pagelayer-social-fa{
color:#205081;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-bitbucket"],
.pagelayer-share-content[class*="pagelayer-bitbucket"]{
background-color:#205081;
color:#205081;
}

.pagelayer-icon-holder[class*="pagelayer-codepen"] .pagelayer-social-fa{
color:#0ebeff;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-codepen"],
.pagelayer-share-content[class*="pagelayer-codepen"]{
background-color:#0ebeff;
color:#0ebeff;
}

.pagelayer-icon-holder[class*="pagelayer-delicious"] .pagelayer-social-fa{
color:#3399ff;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-delicious"],
.pagelayer-share-content[class*="pagelayer-delicious"]{
background-color:#3399ff;
color:#3399ff;
}

.pagelayer-icon-holder[class*="pagelayer-medium"] .pagelayer-social-fa{
color:#00ab6c;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-medium"],
.pagelayer-share-content[class*="pagelayer-medium"]{
background-color:#00ab6c;	
color:#00ab6c;
}

.pagelayer-icon-holder[class*="pagelayer-meetup"] .pagelayer-social-fa{
color:#e0393e;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-meetup"],
.pagelayer-share-content[class*="pagelayer-meetup"]{
background-color:#e0393e;	
color:#e0393e;
}

.pagelayer-icon-holder[class*="pagelayer-mixcloud"] .pagelayer-social-fa{
color:#52aad8;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-mixcloud"],
.pagelayer-share-content[class*="pagelayer-mixcloud"]{
background-color:#52aad8;	
color:#52aad8;
}

.pagelayer-icon-holder[class*="pagelayer-dribbble"] .pagelayer-social-fa{
color:#444444;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-dribbble"],
.pagelayer-share-content[class*="pagelayer-dribbble"]{
background-color:#444444;
color:#444444;
}

.pagelayer-icon-holder[class*="pagelayer-foursquare"] .pagelayer-social-fa{
color:#f94877;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-icon-holder[class*="pagelayer-foursquare"],
.pagelayer-share-content[class*="pagelayer-foursquare"]{
background-color:#f94877;
color:#f94877;
}

.pagelayer-share_grp .pagelayer-social-fa,
.pagelayer-share_grp .pagelayer-social-fa:before{
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50% , -50%);
}
.pagelayer-share_grp{
font-size: 0;
}
.pagelayer-share_grp > div{
display: inline-block;
}

.pagelayer-share_grp .pagelayer-social-fa{
height:1em;
width:1em;
}

.pagelayer-share_grp .pagelayer-icon-holder{
position: relative;
min-height: 1em;
min-width: 1em;
}

.pagelayer-share-content .pagelayer-social-fa,
.pagelayer-share-content span{
color: inherit;
}

.pagelayer-share_grp.pagelayer-social-bg-none .pagelayer-share-content,
.pagelayer-share_grp.pagelayer-social-outline-border .pagelayer-share-content{
background-color:unset;
}

.pagelayer-share_grp.pagelayer-social-outline-border .pagelayer-share-content{
border:2px solid;
}

.pagelayer-social_grp[class*="pagelayer-social-shape"] .pagelayer-social-fa,
.pagelayer-share_grp[class*="pagelayer-social-shape"] .pagelayer-social-fa,
.pagelayer-share_grp[class*="pagelayer-social-shape"] .pagelayer-icon-name span{
color: #ffffff;
}

.pagelayer-social_grp .pagelayer-icon-holder{
display:inline-block;
line-height: 100%;
text-align: center;
}

.pagelayer-share-content,
.pagelayer-share-content .pagelayer-icon-name{
display:flex;
}

.pagelayer-share-content .pagelayer-icon-name{
align-items:center;
}

.pagelayer-social-shape-circle .pagelayer-share-content{
border-radius:100000px;
}

.pagelayer-icon-name span{
padding:0 20px 0 5px;
}

.pagelayer-share-buttons{
position:relative;
border-radius: inherit;
}

.pagelayer-social-shape-boxed .pagelayer-share-buttons:before{
content: "";
position: absolute;
width: 100%;
height: 100%;
background: rgba(0,0,0,0.15);
border-top-left-radius: inherit;
border-bottom-left-radius: inherit;
left: 0;
}

.pagelayer-share_grp .pagelayer-icon-name span,
.pagelayer-share_grp .pagelayer-icon-holder{
display:none;
}

.pagelayer-share-type-icon .pagelayer-icon-holder,
.pagelayer-share-type-icon-label .pagelayer-icon-holder,
.pagelayer-share-type-label .pagelayer-icon-name span,
.pagelayer-share-type-icon-label .pagelayer-icon-name span{
display:block;
}

/* Social Profile end */

.pagelayer-list-icon-holder{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-align: start;
-webkit-align-items: flex-start;
-ms-flex-align: start;
align-items: flex-start;
}

.pagelayer-list-icon,
.pagelayer-list-item{
-webkit-align-self: center;
-ms-flex-item-align: center;
align-self: center;
}

.pagelayer-list-item{
width:100%;
}

.pagelayer-list-ul{
margin:0;
padding:0;	
}

/* Video */

.pagelayer-video .pagelayer-video-holder{
position:relative;
width: 100%;
height: auto;
overflow: hidden;
}

.pagelayer-video-iframe{
position:absolute;
width:100%;
height:100%;
top:0;
left:0;
}

.pagelayer-video-aspect-1-1{
padding-top:100%;
}

.pagelayer-video-aspect-3-2{
padding-top:66.66%;
}

.pagelayer-video-aspect-4-3{
padding-top: 75%;
}

.pagelayer-video-aspect-8-5{
padding-top:62.5%;
}

.pagelayer-video-aspect-16-9{
padding-top: 56.25%;
}

.pagelayer-video .pagelayer-video-holder .pagelayer-video-overlay{
position:absolute;
top:0;
left:0;
right:0;
bottom:0;
background-size: cover;
background-position: center center;
background-repeat: no-repeat;
cursor: pointer;
}

.pagelayer-video .pagelayer-video-holder a{
position:absolute;
top:0;
left:0;
right:0;
bottom:0;
}

.pagelayer-video .pagelayer-video-holder .pagelayer-video-overlay i{
position: absolute;
top: 50%;
left: 50%;
-webkit-transform: translateX(-50%) translateY(-50%);
-ms-transform: translateX(-50%) translateY(-50%);
transform: translateX(-50%) translateY(-50%);
}
/* Video end */

/** Image **/

.pagelayer-image, .pagelayer-image .pagelayer-image-holder{
position: relative;
}

.pagelayer-image-link{
text-decoration:none;
cursor: pointer;
}

.pagelayer-image-caption{
margin-bottom: unset;
}

.pagelayer-image-overlay{
position: absolute;
width: 100%;
top: 0;
height: 100%;
left: 0;
opacity:0;
overflow:auto;
transition: .5s ease;
}

.pagelayer-image:hover .pagelayer-image-overlay{
opacity:1;
}

.pagelayer-image .pagelayer-image-overlay .pagelayer-image-overlay-content{
width:100%;
}

.pagelayer-image *{
border-radius:inherit;
}

/** Image End **/

.pagelayer-button {
text-align: center
}

.pagelayer-button i{
padding: 0 3px;
}

.pagelayer-audio-container, .pagelayer-audio-container audio{
width:100%;
}

.pagelayer-testimonial-avatar img{
border: 1px solid #eee;
border-radius: 50%;
margin-right: 10px;
}

.pagelayer-alignment-center{
text-align: center;
}

.pagelayer-alignment-left{
text-align: left;
}

.pagelayer-alignment-right{
text-align: right;
}

/* Testimonial */
.pagelayer-testimonial{
padding:0.4em 0.8em;
line-height: normal;
}

.pagelayer-testimonial-image{
-o-object-fit: cover;
object-fit: cover;
display: unset !important;
}

.pagelayer-testimonial-square{
border-radius:0px;
}

.pagelayer-testimonial-circle{
border-radius:50%;
}

.pagelayer-aside-position{
display:inline-block;
vertical-align: middle;
}

.pagelayer-aside-position .pagelayer-testimonial-cite{
text-align: left;
}
.pagelayer-top-position, .pagelayer-testimonial-author{
display:block;
}

.pagelayer-aside-position .pagelayer-testimonial-author{
position: relative;
}

.pagelayer-testimonial-container .pagelayer-testimonial-avatar,
.pagelayer-testimonial-container .pagelayer-testimonial-details{
display: table-cell;
vertical-align: middle;
}

.pagelayer-testimonial-designation{
color: #999;
font-size: 12px;
}

/* Testimonial End */

/* Progress bar */
.pagelayer-progress-goal{
margin-top: 10px;
}

.pagelayer-progress-container{
background-color:#eeeeee;
}

.pagelayer-progress-bar{
overflow:hidden;
}

.pagelayer-progress-percent{
float:right;
padding-right:10px;
}

.pagelayer-progress-text{
float:left;
padding-left:10px;
}

/*Progress bar end*/

/*Stars widget start*/

.pagelayer-stars > *{
vertical-align:middle;
}
.pagelayer-stars-container{
text-align:center;
color: #ccd6df;
font-family: "FontAwesome", "Font Awesome 5 Free";
display: inline-block;
position: relative;
border-color: 1px solid #ccd6df;
}

.pagelayer-stars-container .pagelayer-stars-icon{
position: relative;
display:inline-block;
line-height: 1;
}

.pagelayer-stars-container .pagelayer-stars-icon:before{
content: "\f005";
font-size: inherit;
font-family: inherit;
overflow: hidden;
color: #f0ad4e;
position:absolute;
font-weight:900;
top:0;
left:0;
}

.pagelayer-stars-icon.pagelayer-stars-empty:before{
width:0em;
}

.pagelayer-stars-icon.pagelayer-stars-1:before{
width:0.1em;
}

.pagelayer-stars-icon.pagelayer-stars-2:before{
width:0.2em;
}

.pagelayer-stars-icon.pagelayer-stars-3:before{
width:0.3em;
}

.pagelayer-stars-icon.pagelayer-stars-4:before{
width:0.4em;
}

.pagelayer-stars-icon.pagelayer-stars-5:before{
width:0.5em;
}

.pagelayer-stars-icon.pagelayer-stars-6:before{
width:0.6em;
}

.pagelayer-stars-icon.pagelayer-stars-7:before{
width:0.7em;
}

.pagelayer-stars-icon.pagelayer-stars-8:before{
width:0.8em;
}

.pagelayer-stars-icon.pagelayer-stars-9:before{
width:0.9em;
}

.pagelayer-stars-icon.pagelayer-stars-full:before{
width:1.1em;
}
/*Stars widget end*/

/* Site Title Start */
.pagelayer-wp-title-align-top{
display:block;
text-align: center;
}

.pagelayer-wp-title-heading{
padding:5px 20px;
font-size: 20px;
font-weight: 500;
text-decoration-style: solid !important;
margin: 0px;
transition: all 400ms;
flex-grow:1;
}

.pagelayer-wp-title-img{
box-shadow: none !important;
}

.pagelayer-wp-title-desc{
padding: 5px 20px;
}

.pagelayer-wp-title-align-left,
.pagelayer-wp-title-align-right{
display: flex;
}

.pagelayer-wp-title-align-right{
text-align: right;
-webkit-box-orient: horizontal;
-webkit-box-direction: reverse;
flex-direction: row-reverse;
}

.pagelayer-wp-title-vertical-top{
align-items: flex-start;
-webkit-align-items: flex-start;
-webkit-box-align: start;
-ms-flex-align: start;
}

.pagelayer-wp-title-vertical-middle{
align-items: center;
-webkit-align-items: center;
-webkit-box-align: center;
-ms-flex-align: center;
}

.pagelayer-wp-title-vertical-bottom{
align-items: flex-end;
-webkit-align-items: flex-end;
-webkit-box-align: end;
-ms-flex-align: end;
}

.pagelayer-wp-title-section .pagelayer-wp-title-link{
text-decoration: none !important;
}
/* Site title End */

/*pricing plans*/
.pagelayer-pricing{
text-align:center;
border:2px solid #e8e3e3;
border-radius:6px;
}

.pagelayer-pricing-rate-section{
padding:20px;
}

.pagelayer-pricing-details h1,
.pagelayer-pricing-details h2,
.pagelayer-pricing-details h3,
.pagelayer-pricing-details h4,
.pagelayer-pricing-details h5{
margin:10px 0px; padding:0px;
}

.pagelayer-pricing-details{
position: relative;
background-color:#1e1558;
border-top-left-radius: inherit;
border-top-right-radius: inherit;
}

.pagelayer-pricing-details .pagelayer-pricing-type{
text-transform: uppercase;
}

.pagelayer-pricing-sub-title{
font-weight: normal;
}

.pagelayer-pricing-details .pagelayer-pricing-price{
font-weight:800;
}

.pagelayer-pricing-price.pagelayer-pricing-original{
display:none;
text-decoration: line-through;
margin-right: 10px;
}
  
h2.pagelayer-pricing-price{
display:inline-block;
margin:5px 0px;
}

.pagelayer-pricing-details{
font-size:15px;  
}

.pagelayer-pricing-duration{
font-size:15px;
margin:0px;
}

.pagelayer-pricing-features{
padding:20px;
border-bottom-left-radius: inherit;
border-bottom-right-radius: inherit;
}

.pagelayer-pricing-features .pagelayer-pricing-ul{
padding:0px;
}

.pagelayer-pricing-ul li{
display: inline-block;
list-style-type: none;
padding:5px 0px;
}

.pagelayer-pricing-ul .pagelayer-list_item:after{
border-bottom:2px solid #c5c5c5;
margin-top: 5px;
}

.pagelayer-list-li span i{
margin-right:5px;
}

.pagelayer-pricing-btn{
display: inline-block;
}

.pagelayer-pricing-additional{
margin:20px 0px 0px;
}

.pagelayer-pricing-ribbon-container{
position: absolute;
top: 0;
left: auto;
right: 0;
transform: rotate(90deg);
width: 150px;
overflow: hidden;
height: 150px;
}

.pagelayer-pricing-ribbon{
display: none;
width: 200%;
background-color: #ce4210ff;
position: absolute;
left:0;
text-align: center;
line-height: 2;
letter-spacing: 1px;
color: #f0f0f0;
margin-top: 40px;
transform: translateY(-50%) translateX(-50%) translateX(50px) rotate(-45deg);
}

.pagelayer-pricing-currency-top{
vertical-align: top;
}

.pagelayer-pricing-currency-middle{
vertical-align: middle;
}

.pagelayer-pricing-currency-bottom{
vertical-align: bottom;
}

/*pricing plans end*/

/* Quote */

.pagelayer-quotation-overlay{
position: absolute;
font-size: 70px;
top: 0;
}

.pagelayer-quote-content .fa-quote-right{
display: inline-block;
vertical-align: top;
}

/* Quote end */

.pagelayer-call-icon-section,
.pagelayer-call-content-section,
.pagelayer-call-button-section{
display: table-cell;
vertical-align: middle;	
}

.pagelayer-call-center{
text-align: center;
}

.pagelayer-call-center .pagelayer-call-icon-section,
.pagelayer-call-center .pagelayer-call-content-section,
.pagelayer-call-center .pagelayer-call-button-section{
display: block;
}

.pagelayer-call-3d{
background: #eee;
border-bottom: 5px solid #ddd;
padding: 30px;
}

.pagelayer-call-3d.pagelayer-call-left .pagelayer-call-icon-section{
padding-right: 10px;
}

.pagelayer-call-3d.pagelayer-call-left .pagelayer-call-content-section{
padding-right: 20px
}

.pagelayer-call-3d.pagelayer-call-center .pagelayer-call-icon-section{
margin-bottom: 10px;
}

.pagelayer-call-3d.pagelayer-call-center .pagelayer-call-content-section{
margin-bottom: 20px;	
}

.pagelayer-call-3d .pagelayer-call-title{
font-size: 26px;
font-weight: 700;
/* margin-bottom: 5px; */
}
.pagelayer-call-3d .pagelayer-call-subtitle{
font-size: 18px;
/* margin-bottom: 10px; */
}

/* .pagelayer-call-3d .pagelayer-call-text{
color: #777;
} */

.pagelayer-call-left .pagelayer-call-button{
display:flex;
}

.pagelayer-button-mini{
font-size: 13px;
padding: 8px 12px;
line-height: 13px;
min-height: unset;
}

.pagelayer-button-small{
font-size: 15px;
padding: 10px 18px;
line-height: 15px;
min-height: unset;	
}

.pagelayer-button-middle{
font-size: 17px;
padding: 14px 26px;
line-height: 17px;
min-height: unset;	
}

.pagelayer-button-large{
font-size: 20px;
padding: 18px 35px;
line-height: 20px;
min-height: unset;	
}


.pagelayer-modal-content, 
.pagelayer-splash-container{
display: none;
position: fixed;
padding: 50px;
top: 0;
left: 0;
height: 100%;
width: 100%;
overflow: auto;
color: #000;
opacity: 1;
z-index: 99999;
}

.pagelayer-modal-bottom-content,
.pagelayer-splash-bottom-content{
padding: 50px;
background-color: #fefefe;
}
.pagelayer-modal-body,
.pagelayer-splash-body{
position: absolute;
margin: auto;
box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
-webkit-animation-name: animatetop;
-webkit-animation-duration: 0.4s;
animation-name: animatetop;
animation-duration: 0.4s;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
}

.pagelayer-modal-content-overflow, .pagelayer-splash-content-overflow{
max-height:500px;
overflow:auto;
}

.pagelayer-splash-bg-close, .pagelayer-modal-bg-close{
position: absolute;
top:0;
left:0;
width:100%;
height:100%;
}

.pagelayer-btn-icon-left .pagelayer-icon-right{
display: none;
}

.pagelayer-btn-icon-right .pagelayer-icon-left{
display: none;
}

/* Add Animation */
@-webkit-keyframes pagelayer-animatetop {
from {top:-300px; opacity:0} 
to {top:0; opacity:1}
}

@keyframes pagelayer-animatetop {
from {top:-300px; opacity:0}
to {top:0; opacity:1}
}

.pagelayer-modal-close,
.pagelayer-splash-close{
position: absolute;
right: 10px;
top: 25px;
color: #fff;
font-size: 70px !important;
cursor: pointer;
}

.pagelayer-modal-close:before,
.pagelayer-modal-close:after,
.pagelayer-splash-close:before,
.pagelayer-splash-close:after{
position: absolute;
top: 2px;
right: 38px;
content: ' ';
width: 2px;
background-color: #fff;
}

.pagelayer-modal-close:before,
.pagelayer-splash-close:before{
-webkit-transform: rotate(45deg);
-ms-transform: rotate(45deg);
transform: rotate(45deg);
}

.pagelayer-modal-close:after,
.pagelayer-splash-close:after{
-webkit-transform: rotate(-45deg);
-ms-transform: rotate(-45deg);
transform: rotate(-45deg);
}

.pagelayer-modal-title,
.pagelayer-splash-title{
background-color: #3D54DF;
color: #ffffff;
}


/* Countdown Start */
.pagelayer-countdown-item{
padding:20px 30px;
text-align:center;
}

.pagelayer-countdown-counter{
display: flex;
flex-wrap:wrap;
justify-content: center;
}

.pagelayer-countdown-days,
.pagelayer-countdown-hours,
.pagelayer-countdown-minutes,
.pagelayer-countdown-seconds{
display: inline-block;
vertical-align: middle;
background: #eee;
margin: 0 5px 5px;
flex:1;
}

.pagelayer-countdown-days div,
.pagelayer-countdown-hours div,
.pagelayer-countdown-minutes div,
.pagelayer-countdown-seconds div{
/* display: inline-block; */
line-height: 1;
}

.pagelayer-countdown-inline .pagelayer-countdown-name{
display:inline-block;
}

.pagelayer-countdown-inline .pagelayer-countdown-count{
display:inline-block;
}

.pagelayer-countdown-expired{
display:none;
}

.pagelayer-countdown[display_expired_text="true"] .pagelayer-countdown-expired{
display:block !important;
}

.pagelayer-countdown[display_expired_text="true"] .pagelayer-countdown-counter{
display:none !important;
}
/* Countdown End*/

#pagelayer-header-menu{
display: inline-block;
}


/* splash style */
.pagelayer-splash .pagelayer-splash-dark,
.pagelayer-modal .pagelayer-modal-dark{
background-color:#000000e0;
}

.pagelayer-modal .pagelayer-modal-light,
.pagelayer-splash .pagelayer-splash-light{
background-color:#ffffffe0;
}

.pagelayer-splash-light .pagelayer-splash-close::after,
.pagelayer-splash-light .pagelayer-splash-close::before,
.pagelayer-modal-light .pagelayer-modal-close::after,
.pagelayer-modal-light .pagelayer-modal-close::before{
background-color:#000000;
}

.pagelayer-splash-dark .pagelayer-splash-close::after,
.pagelayer-splash-dark .pagelayer-splash-close::before,
.pagelayer-modal-dark .pagelayer-modal-close::after,
.pagelayer-modal-dark .pagelayer-modal-close::before{
background-color:#fff;
}

.pagelayer-splash-content{
padding:30px;
}

/* splash style end */

.pagelayer-modal-close{
z-index:999;
}

/* Style the tab */
.pagelayer-tabs-holder {
overflow: hidden;
}

/* Style the buttons inside the tab */
.pagelayer-tabs-holder .pagelayer-tablinks {
background-color: inherit;
display:inline-block;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
font-size: 17px;
color:#000000;
}

/* Change background color of buttons on hover */
.pagelayer-tabs-holder .pagelayer-tablinks:hover {
background-color: #ddd;
}

/* Create an active/current tablink class */
.pagelayer-tabs-holder .pagelayer-tablinks.active {
background-color: #ccc;
}

/* Style the tab content */
.pagelayer-tabs .pagelayer-tabcontainer .pagelayer-tab{
display: none;
padding: 6px 12px;
border-top: none;
}
.pagelayer-tabs-holder .pagelayer-tablinks .fa{
line-height:1.5;
}
/* Tabs style end */

/* Divider start */
.pagelayer-divider-holder{
line-height: 0;
font-size: 0;
}
.pagelayer-divider-seperator{
display: inline-block;
}
/* Divider end */

/* Counter style start*/

.pagelayer-counter{
padding: 20px;	
}

.pagelayer-counter-content{
line-height:1;
}

/* Counter style end*/

/*Image Slider style start*/
.pagelayer-image-slider-ul{
display:none;
padding:0;
margin:0;
list-style: none;
}

.pagelayer-image-slider-ul[pagelayer-setup]{
display:block;
}
/*Image Slider style End*/

/*Google Maps start*/
.pagelayer-google-maps-holder{
line-height:0;
}

.pagelayer-google-maps-holder iframe{
margin:0px;
width:100%;
height:100%;
}

/* accordion style */
.pagelayer-accordion_item{
overflow:hidden;
}

.pagelayer-accordion-tabs {
cursor: pointer;
padding: 15px;
width: 100%;
text-align: left;
display:inline-block;
text-decoration:none !important;
}

.pagelayer-accordion-panel {
padding: 0 18px;
display: none;
overflow: hidden;
}

/* accordion style end */

/* Alert Box style start */
.pagelayer-alert{
position: relative;
border: 1px solid transparent;
border-radius:5px;
padding:15px 20px;
}

.pagelayer-alert-title{
display:inline-block;
}

.pagelayer-alert-icon,
.pagelayer-alert-title{
vertical-align: middle;
}

.pagelayer-alert-primary{
color: #004085;
background-color: #cce5ff;
border-color: #b8daff;
}

.pagelayer-alert-secondary{
color: #383d41;
background-color: #e2e3e5;
border-color: #d6d8db;
}

.pagelayer-alert-success{
color: #155724;
background-color: #d4edda;
border-color: #c3e6cb;
}

.pagelayer-alert-info{
color: #0c5460;
background-color: #d1ecf1;
border-color: #bee5eb;
}

.pagelayer-alert-warning{
color: #856404;
background-color: #fff3cd;
border-color: #ffeeba;
}

.pagelayer-alert-danger{
color: #721c24;
background-color: #f8d7da;
border-color: #f5c6cb;
}

.pagelayer-alert-dark{
color: #1b1e21;
background-color: #d6d8d9;
border-color: #c6c8ca;
}

.pagelayer-alert-primary-link {
color: #002752;
}

.pagelayer-alert-secondary-link{
color: #202326;
}

.pagelayer-alert-success-link{
color: #0b2e13;
}

.pagelayer-alert-danger-link{
color: #491217;
}

.pagelayer-alert-warning-link{
color: #533f03;
}

.pagelayer-alert-info-link{
color: #062c33;
}

.pagelayer-alert-secondary-link{
color: #686868;
}

.pagelayer-alert-secondary-link{
color: #040505;
}

.pagelayer-alert-success hr{
background-color: #b1dfbb;	
}

.pagelayer-alert-primary hr{
background-color: #9fcdff;
}

.pagelayer-alert-secondary hr{
background-color: #c8cbcf;
}

.pagelayer-alert-info hr{
background-color: #abdde5;
}

.pagelayer-alert-warning hr{
background-color: #ffe8a1;
}

.pagelayer-alert-danger hr{
background-color: #f1b0b7;
}

.pagelayer-alert-dark hr{
background-color: #b9bbbe;
}

.pagelayer-alert-close {
position: absolute;
top: 0;
right: 0;
color: inherit;
height: 100%;
width:15px;
background:rgba(3,3,3,0.1);
cursor:pointer;
}

.pagelayer-alert-close:before,
.pagelayer-alert-close:after {
position: absolute;
left: 7px;
content: ' ';
height: 13px;
width: 1px;
background-color: #333;
top: calc(50% - 6.5px);
}

.pagelayer-alert-close:before {
transform: rotate(45deg);
}

.pagelayer-alert-close:after {
transform: rotate(-45deg);
}

/* Alert Box Style Ends */

/* Grid Gallery Style Start */

.pagelayer-grid-gallery-ul{
display:block;
list-style:none;
padding:0;
margin:0;
}

.pagelayer-gallery-item{
list-style:none;
border: none;
}

.pagelayer-gallery-item img{
height: 100%;
width: 100%;
object-fit: cover;
}

.pagelayer-grid-gallery-caption{
display:block;
}

.pagelayer-grid-gallery-pagination{
text-align:center;
}

.pagelayer-grid-page-ul{
display: inline-block;
list-style-type: none;
margin-top:10px;
}

.pagelayer-grid-page-ul li.active {
background-color:#00A0D2;
color:white;
}

.pagelayer-grid-page-item{
color: black;
float: left;
padding: 8px 16px;
text-decoration: none;
}

.pagelayer-grid-page-ul li:hover:not(.active){
background-color: #ddd;
cursor:pointer;
}

/* Grid Gallery Style Ends */

.pagelayer-heading-holder *,
.pagelayer-text-holder *{
padding: 0;
margin: 0;
overflow-wrap: break-word;
}

/* animation */

.animated.pagelayer-anim-fast{
-webkit-animation-duration: 0.7s;
animation-duration: 0.7s;
}

.animated.pagelayer-anim-fastest{
-webkit-animation-duration: 0.5s;
animation-duration: 0.5s;
}

.animated.pagelayer-anim-slow{
-webkit-animation-duration: 1.5s;
animation-duration: 1.5s;
}

.animated.pagelayer-anim-slowest{
-webkit-animation-duration: 2s;
animation-duration: 2s;
}

/* animation end */

.pagelayer-parallax-window{
position: absolute;
width: 100%;
height: 100%;
overflow: hidden;
top: 0;
left: 0;
}

.pagelayer-parallax-window .simpleParallax{
height:100%;
}

.pagelayer-parallax-window img{
max-width:unset;
}

/* WooCommerce widget */
.pagelayer-product-images-container{
display:flow-root;
}

.pagelayer-add-to-cart-holder,
.pagelayer-product-rating{
display:inline-block;
}

.pagelayer-product-related-container:not([pagelayer-heading-show]) .products > h2,
.pagelayer-product-related-container:not([pagelayer-sale-flash]) ul.products li.product span.onsale,
.pagelayer-addi-info-container:not([pagelayer-show-heading]) h2 {
display:none;
}

.pagelayer-product-related-container[pagelayer-content-align="right"] ul.products li.product .star-rating{
margin-left: auto;
}

.pagelayer-product-related-container[pagelayer-content-align="center"] ul.products li.product .star-rating{
margin-left: auto;
margin-right: auto;
}

/*******************/

/* PageLayer Owl */

.pagelayer-owl-stage-outer [class^="pagelayer-owl-"],
.pagelayer-owl-carousel .pagelayer-owl-item > .pagelayer-ele-wrap,
.pagelayer-owl-stage-outer{
height: 100%;
}

.pagelayer-owl-prev,
.pagelayer-owl-next{
position: absolute;
top: 50%;
transform: translateY(-50%);
}

.pagelayer-owl-prev{
left: 0;
}

.pagelayer-owl-next{
right: 0;
}

.pagelayer-owl-theme .pagelayer-owl-nav{
margin-top: 0 !important;
}

.pagelayer-owl-nav span{
position:absolute;
transform:translate(-50%, -53%);
}

.pagelayer-owl-dot{
vertical-align: middle;
}

/* PageLayer Owl End */

/* Space Widget */
.pagelayer-space-holder{
height: 10px;
}
/* Space Widget End */

/* Address and Number */

.pagelayer-phone-holder,
.pagelayer-address-holder,
.pagelayer-email-holder{
display:flex;
}

.pagelayer-address-icon,
.pagelayer-address,
.pagelayer-phone-icon,
.pagelayer-phone,
.pagelayer-email-icon,
.pagelayer-email{
margin-top:auto;
margin-bottom:auto;
word-break:break-word;
}

/* Address and Number End */

/****************/
/*** Freemium ***/
/****************/

/*** Breadcrumb ***/

.pagelayer-breadcrumb-section b{
font-weight: 100;
}

/* Breadcrumb End */

/*** Archive Posts ***/
.pagelayer-posts-container{
display: grid;
grid-template-columns: repeat(3,1fr);
grid-column-gap: 20px;
grid-row-gap: 40px;
}

.pagelayer-wposts-meta *{
font-size: 12px;
}

.pagelayer-pagination{
padding: 50px 20px;	
text-align: center;
}

.pagelayer-pagination .page-numbers:not(:last-child){
margin-right: 25px;
}

.pagelayer-pagination a.page-numbers:hover{
color: #36b2d1;
}

.pagelayer-wposts-thumb{
display:inline-block;
position:relative;
background-size:cover !important;
background-position:center !important;
width:100%;
}

@media all and (max-width:599px){	
.pagelayer-posts-container{
grid-template-columns: repeat(1,1fr);
}
}

/*** Archive Posts End ***/

/* WordPress Posts */
.pagelayer-wposts-title{
line-height:1;
}

.pagelayer-wposts-sep{
font-weight:100;
}

.pagelayer-wposts-sep:last-child{
display:none;
}

.pagelayer-wposts-category a:not(:last-child):after,
.pagelayer-wposts-tags a:not(:last-child):after{
content:', ';	
}
/* WordPress Posts End*/

/* Copyright start */
.pagelayer-copyright{
text-align: center;
color: #111;
}

.pagelayer-copyright a{
color: #111;
}
/* Copyright end */

/* Primary Menu */

.pagelayer-wp-menu-container .pagelayer-wp_menu-ul li.menu-item>a{
display:flex;
box-shadow: none;
white-space: nowrap;
position:relative;
}

.pagelayer-menu-type-horizontal .sub-menu{
z-index:999;
}

.pagelayer-wp-menu-container .pagelayer-wp_menu-ul,
.pagelayer-wp-menu-container .sub-menu{
margin:0px;
padding: 0px;
}

.pagelayer-menu-type-horizontal *{
transition: all 0.5s;	
}

.pagelayer-menu-type-horizontal li.menu-item{
display: inline-block;
font-weight: 600;
}

.pagelayer-menu-type-horizontal li.menu-item>a{
box-shadow: none;
border: none;
}

.pagelayer-menu-type-horizontal .sub-menu{
position:absolute;
min-width: 100%;
}

.pagelayer-menu-type-horizontal .sub-menu .sub-menu{
top:0px;
}

.pagelayer-wp-menu-container .pagelayer-wp_menu-ul li.menu-item{
position:relative;
}

.pagelayer-wp-menu-container ul li.menu-item span.after-icon{
height: auto;
width: 100%;
position: relative;
pointer-events: auto;
line-height:inherit;
color: inherit;
font-size: inherit;
margin-left:10px;
padding-left:5px;
padding-right:5px;
}

.pagelayer-wp-menu-container:not([data-align="left"]) .pagelayer-wp_menu-ul span.after-icon{
width:auto;
}

.pagelayer-wp-menu-container[data-align="right"] .pagelayer-wp_menu-ul ul li > ul a{justify-content: flex-end;}
.pagelayer-wp-menu-container[data-align="left"] .pagelayer-wp_menu-ul ul li > ul a{justify-content: left;}
.pagelayer-wp-menu-container[data-align="center"] .pagelayer-wp_menu-ul ul li > ul a{justify-content: center;}

.pagelayer-wp-menu-container ul li.menu-item span.after-icon:before{
position:absolute;
right:0;	
}

.pagelayer-wp-menu-container .sub-menu,
.pagelayer-primary-menu-bar{
display:none;
}

.pagelayer-menu-type-horizontal .sub-menu li.menu-item{
display:block;
}

.pagelayer-primary-menu-bar i{
padding:5px;
}

.pagelayer-menu-type-vertical li.menu-item{
list-style: none;
}

.pagelayer-menu-type-vertical li.menu-item:not(:last-child) > a{
margin-bottom: 6px !important;
box-shadow: none;
border: none;
}

.pagelayer-menu-type-vertical .pagelayer-wp_menu-ul>li>ul.sub-menu{
margin-left:0px;
}

.pagelayer-wp-menu-holder[data-layout="dropdown"] .pagelayer-primary-menu-bar,
.pagelayer-wp-menu-holder.pagelayer-wp-menu-dropdown .pagelayer-primary-menu-bar{
display:block;
}

.pagelayer-wp-menu-holder[data-layout="dropdown"] .pagelayer-wp_menu-ul,
.pagelayer-wp-menu-holder.pagelayer-wp-menu-dropdown .pagelayer-wp_menu-ul{
display:none;	
}

.pagelayer-menu-hover-underline:not(.none) .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-framed:not(.none) .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline:not(.none) .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline:not(.none) .pagelayer-wp_menu-ul>li>a:after,
.pagelayer-menu-hover-overline:not(.none) .pagelayer-wp_menu-ul>li>a:before{
position: absolute;
content: '';
left: 0px;
bottom: 0px;
height: 3px;
width: 0px;
background-color: #2154CF;
transition: all 500ms ease;
-moz-transition: all 500ms ease;
-webkit-transition: all 500ms ease;
-ms-transition: all 500ms ease;
-o-transition: all 500ms ease;
border-width:0px;
}

.pagelayer-menu-hover-doubleline .pagelayer-wp_menu-ul>li>a:after{
left:unset;
right:0;
}

.pagelayer-menu-hover-framed .pagelayer-wp_menu-ul>li>a:before{
background-color:unset !important;
height:100% !important;
}
.pagelayer-menu-hover-framed .pagelayer-wp_menu-ul>li>a:hover:before{
border:3px solid #2154CF;	
}

.pagelayer-menu-hover-overline .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline .pagelayer-wp_menu-ul>li>a:before{
top:0;
bottom:unset;
}

.pagelayer-menu-hover-underline.dropin .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-framed.dropin .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline.dropin .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline.dropin .pagelayer-wp_menu-ul>li>a:after,
.pagelayer-menu-hover-overline.dropin .pagelayer-wp_menu-ul>li>a:before{
width:100%;
opacity:0;
bottom:-5px;
} 

.pagelayer-menu-hover-underline.dropout .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-framed.dropout .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline.dropout .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline.dropout .pagelayer-wp_menu-ul>li>a:after,
.pagelayer-menu-hover-overline.dropout .pagelayer-wp_menu-ul>li>a:before{
width:100%;
opacity:0;
bottom:5px;
} 

.pagelayer-menu-hover-underline.dropin .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-framed.dropin .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-doubleline.dropin .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-doubleline.dropin .pagelayer-wp_menu-ul>li>a:hover:after,
.pagelayer-menu-hover-overline.dropin .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-underline.dropout .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-framed.dropout .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-doubleline.dropout .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-doubleline.dropout .pagelayer-wp_menu-ul>li>a:hover:after,
.pagelayer-menu-hover-overline.dropout .pagelayer-wp_menu-ul>li>a:hover:before{
bottom:0px;
} 

.pagelayer-menu-hover-underline.grow .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-framed.grow .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline.grow .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline.grow .pagelayer-wp_menu-ul>li>a:after,
.pagelayer-menu-hover-overline.grow .pagelayer-wp_menu-ul>li>a:before{
width:100%;
transform:scale(0);
}

.pagelayer-menu-hover-underline.fade .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-framed.fade .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline.fade .pagelayer-wp_menu-ul>li>a:before,
.pagelayer-menu-hover-doubleline.fade .pagelayer-wp_menu-ul>li>a:after,
.pagelayer-menu-hover-overline.fade .pagelayer-wp_menu-ul>li>a:before{
width:100%;
transition-duration:1000ms;
opacity:0;
}

.pagelayer-menu-hover-underline .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-framed .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-doubleline .pagelayer-wp_menu-ul>li>a:hover:before,
.pagelayer-menu-hover-doubleline .pagelayer-wp_menu-ul>li>a:hover:after,
.pagelayer-menu-hover-overline .pagelayer-wp_menu-ul>li>a:hover:before{
transform:scale(1);
opacity:1;
width:100%;
}

.pagelayer-menu-hover-text .pagelayer-wp_menu-ul>li>a:hover{
transform:scale(1.2);
}

.pagelayer-wp_menu .sub-menu,
.pagelayer-menu-type-dropdown{
z-index:999;
}

.pagelayer-menu-type-dropdown{
position:absolute;
}

.pagelayer-togglt-on .pagelayer-wp_menu-ul,
.pagelayer-active-sub-menu:not(.pagelayer-mega-menu-item) > ul.sub-menu,
.pagelayer-menu-type-horizontal .menu-item-has-children:not(.pagelayer-mega-menu-item):hover > ul.sub-menu,
.pagelayer-wp_menu .pagelayer-menu-type-vertical[class*='pagelayer-submenu-position-'] .menu-item-has-children:not(.pagelayer-mega-menu-item):hover > ul.sub-menu{
display:block !important;
}

.pagelayer-menu-type-dropdown.pagelayer-wp_menu-ul,
.pagelayer-menu-type-dropdown.pagelayer-wp_menu-right,
.pagelayer-menu-type-dropdown.pagelayer-wp_menu-left,
.pagelayer-menu-type-dropdown.pagelayer-wp_menu-full{
position: fixed;
z-index: 999;
height: 100%;
top: 0;
transition: all 0.4s;
}

.pagelayer-menu-type-dropdown.pagelayer-wp_menu-right{
right: -100%;	
}

.pagelayer-menu-type-dropdown.pagelayer-wp_menu-left{
left:-100%;
}

.pagelayer-wp_menu-left.pagelayer-togglt-on{
left:0;
}

.pagelayer-wp_menu-right.pagelayer-togglt-on{
right:0;	
}

.pagelayer-menu-type-dropdown.pagelayer-wp_menu-full{
left:0;
right:0;
top:-100%;
}

.pagelayer-wp_menu-full.pagelayer-togglt-on{
top:0;
}

.pagelayer-wp_menu-close{
cursor:pointer;
}

.pagelayer-menu-type-dropdown .pagelayer-wp_menu-close{
display:block;
}

.pagelayer-wp_menu-close,
.pagelayer-wp_menu-down .pagelayer-wp_menu-close{
display:none;
}

.pagelayer-wp_menu-close i{
position:absolute;
z-index:99;
}

.pagelayer-menu-type-dropdown.pagelayer-wp_menu-right .pagelayer-wp_menu-ul,
.pagelayer-menu-type-dropdown.pagelayer-wp_menu-left .pagelayer-wp_menu-ul,
.pagelayer-menu-type-dropdown.pagelayer-wp_menu-full .pagelayer-wp_menu-ul{
position:absolute;
width:100%;
}

.pagelayer-menu-type-dropdown .pagelayer-wp_menu-ul li.menu-item > a{
white-space:normal !important;
}

.pagelayer-menu-type-dropdown .pagelayer-wp_menu-ul{
height:100%;
max-height: -webkit-fill-available;
overflow-y: scroll;
-webkit-overflow-scrolling: touch;
}

.pagelayer-menu-type-dropdown .pagelayer-wp_menu-ul::-webkit-scrollbar {
width:4px;
height:4px;
}

.pagelayer-menu-type-dropdown .pagelayer-wp_menu-ul::-webkit-scrollbar-track  {
background-color: transparent;
}

.pagelayer-menu-type-dropdown .pagelayer-wp_menu-ul::-webkit-scrollbar-thumb {
box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
border-radius:10px;
}
/* Mega menu css start */

.pagelayer-wp_menu-ul .pagelayer-mega-menu{
transition: none;
position: absolute;
max-width: 100vw;
z-index: 999;
padding: 10px;
background: #fff;
color: #000;
display: none;
border-radius: 2px;
left: 0;
text-align: initial;
overflow-y: auto;
}

.pagelayer-wp_menu .pagelayer-menu-type-vertical .pagelayer-mega-menu-item,
.pagelayer-wp-menu-container:not(.pagelayer-menu-type-horizontal) .menu-item > .pagelayer-mega-menu{
position: relative;
width: 100%;
}

.pagelayer-wp_menu-ul .pagelayer-mega-menu *{
transition: none;
}

/* To avoid row widget full width feature */
.pagelayer-wp_menu-ul .pagelayer-mega-menu .pagelayer-wrap-inner-row,
.pagelayer-wp_menu-ul .pagelayer-mega-menu .pagelayer-inner_row{
max-width: 100% !important;
left: auto !important;
}

.pagelayer-wp_menu-ul .pagelayer-set-position{
display: block !important;
visibility: hidden !important;
opacity: 0 !important;
}

.pagelayer-active-sub-menu.pagelayer-mega-menu-item > .pagelayer-mega-menu,
.pagelayer-active-mega-menu.pagelayer-mega-menu-item > .pagelayer-mega-menu,
:not(.pagelayer-ele-wrap) > .pagelayer-wp_menu .pagelayer-menu-type-horizontal .pagelayer-mega-menu-item:hover > .pagelayer-mega-menu,
:not(.pagelayer-ele-wrap) > .pagelayer-wp_menu .pagelayer-menu-type-vertical[class*='pagelayer-submenu-position-'] .pagelayer-mega-menu-item:hover > .pagelayer-mega-menu{
display: block !important;
}

@keyframes pagelayer-submenu-fade{0%{opacity:0}75%{opacity:1}}
@keyframes pagelayer-submenu-pulse{50%{transform: scale3d(1.04, 1.04, 1.04);}100%{transform: scale3d(1, 1, 1);}}
@keyframes pagelayer-submenu-fadeindown{0%{opacity: 0; transform: translate3d(0, -10px, 0); }100%{ opacity: 1; transform: none; }}
@keyframes pagelayer-submenu-fadeinup{0%{opacity: 0;transform: translate3d(0, 20px, 0);}100%{opacity: 1;transform: none;}}
@keyframes pagelayer-submenu-slideindown{0%{transform: translate3d(0, -10px, 0);visibility: visible;}100%{transform: translate3d(0, 0, 0);}}
@keyframes pagelayer-submenu-slideinup{0%{transform: translate3d(0, 20px, 0);visibility: visible;}100%{transform: translate3d(0, 0, 0);}}
@keyframes pagelayer-submenu-zoomin{0%{opacity: 0;transform: scale3d(.5, .5, .5);}50%{opacity: 1;}}
@keyframes pagelayer-submenu-flip{
0%{
transform: perspective(400px) rotate3d(1, 0, 0,90deg);
animation-timing-function: ease-in;
opacity: 0;
}40%{
transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
animation-timing-function: ease-in;
}60%{
transform: perspective(400px) rotate3d(1, 0, 0, 5deg);
opacity: 1;
}80%{
transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
}100% {
transform: perspective(400px);
}
}

.pagelayer-wp-menu-container.pagelayer-menu-type-vertical.pagelayer-submenu-position-right .pagelayer-mega-menu,
.pagelayer-menu-type-vertical.pagelayer-submenu-position-right .sub-menu{
position: absolute;
left: 100%;
top: 0;
right: auto;
}

.pagelayer-wp-menu-container.pagelayer-menu-type-vertical.pagelayer-submenu-position-left .pagelayer-mega-menu,
.pagelayer-menu-type-vertical.pagelayer-submenu-position-left .sub-menu{
position: absolute;
right: 100%;
top: 0;
left: auto;
}

.pagelayer-menu-type-vertical:not(.pagelayer-submenu-position-right, .pagelayer-submenu-position-left) .pagelayer-mega-menu,
.pagelayer-menu-type-vertical:not(.pagelayer-submenu-position-right, .pagelayer-submenu-position-left) .sub-menu{
width:100% !important;
}

.pagelayer-menu-icon{
align-self: center;
text-align: center;
margin: 0 5px 0 0;
}

.pagelayer-nav-menu-icon-right .pagelayer-menu-icon{
margin: 0 0 0 5px;
order:1;
}

.pagelayer-nav-menu-icon-right .pagelayer-menu-icon ~ .pagelayer-nav-menu-title{
order: 0;
}

.pagelayer-nav-menu-icon-right .pagelayer-menu-icon ~ :not(.pagelayer-nav-menu-title, .pagelayer-menu-icon){
order: 2;
}

.pagelayer-menu-highlight{
font-size: 0.7em;
margin-left: 5px;
padding: 3px 6px;
border-radius: 2px;
}

/* Mega menu css ends */

/* Column Menu css*/
.pagelayer-mega-column-item > .sub-menu{
columns: 2;
}

.pagelayer-mega-column-item .sub-menu .sub-menu .pagelayer-nav-menu-title{
font-size: 0.85em;
}

.pagelayer-mega-column-item .sub-menu .sub-menu{
display: block;
position: static;
}

.pagelayer-mega-column-item .sub-menu li.menu-item{
break-inside: avoid;
}

.pagelayer-mega-column-item ul.sub-menu span.after-icon{
display: none;
}
/* Primary Menu End */

/* Contact Form start */
.pagelayer-contact-form-note{
margin-bottom:10px;
}

.pagelayer-contact_item input,
.pagelayer-contact_item textarea,
.pagelayer-contact_item select{
width:100%;
outline:none;
}

.pagelayer-contact_item textarea{
height:auto;
}

.pagelayer-contact-holder input[type="checkbox"] {
visibility: hidden;
display: contents;
}

.pagelayer-contact-holder label {
cursor: pointer;
display: block;
}

.pagelayer-contact-holder input[type="checkbox"] + label:before {
border: 1px solid #333;
content: "\00a0";
display: inline-block;
font: 16px/1em sans-serif;
margin-right: 0.25em;
padding: 0;
vertical-align: middle;
}

.pagelayer-contact-holder input[type="checkbox"]:checked + label:before {
content: "\2713";
text-align: center;
}

.pagelayer-contact-holder input[type="checkbox"]:checked + label:after {
font-weight: bold;
}

.pagelayer-contact-holder input[type="checkbox"]:focus + label::before {
outline: rgb(59, 153, 252) auto 5px;
}

.pagelayer-contact-holder input[type='radio'] {
-webkit-appearance:none;
border-radius:50%;
outline:none;
vertical-align: middle;
box-shadow:0 0 5px 0px gray inset;
padding: 0 !important;
}

.pagelayer-contact-holder input[type="radio"]:checked:before {
  background: #333333;
}

.pagelayer-contact-holder input[type='radio']:hover {
box-shadow:0 0 5px 0px orange inset;
}

.pagelayer-contact-holder input[type='radio']:before {
content:'';
display:block;
width:60%;
height:60%;
margin: 20% auto;    
border-radius:50%;    
}

.pagelayer-contact-submit-btn{
cursor:pointer;
}

.pagelayer-cf-msg-suc,.pagelayer-cf-msg-err{
padding: 10px;
padding: 10px;
margin: 10px 0px;
background: #a4f4ad;
border: 1px solid #6fc16f;
border-radius: 4px;
}

.pagelayer-cf-msg-err{
background: #f9dacb;
border: 1px solid #ff746e;
}
/* Contact Form End */

/*** Post Excerpt ***/

.pagelayer-empty-widget{
height:30px;
width:100%;
background-color: #dedddd;
text-align:center;
}

.pagelayer-empty-widget:after {
font-family: "FontAwesome" , "Font Awesome 5 Free";
font-weight: 900;
}

.pagelayer-post-excerpt.pagelayer-empty-widget:after{
content: '\f15c';	
}

.pagelayer-featured-img.pagelayer-empty-widget:after{
content: '\f03e';
}

/*** Post Excerpt End ***/

/* Post info*/
.pagelayer-post-info-vertical > div{
display:inline-block;
}
/* Post info end*/


/* Post Nav */
.pagelayer-post-nav-container{
display: flex;
align-items: center;
}

.pagelayer-prev-post a,
.pagelayer-next-post a{
display: inline-flex;
align-items: center;
}

.pagelayer-next-post a .pagelayer-post-nav-icon{
padding-left:12px;
}

.pagelayer-prev-post a .pagelayer-post-nav-icon{
padding-right:12px;
}

.pagelayer-next-post{
text-align:right;
}

.pagelayer-prev-post a:hover,
.pagelayer-next-post a:hover{
text-decoration:none;
}

.pagelayer-prev-post, .pagelayer-next-post{
width: calc(50% - 1px);
}

.pagelayer-post-nav-container .pagelayer-prev-holder,
.pagelayer-post-nav-container .pagelayer-next-holder{
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-webkit-flex-direction: column;
-ms-flex-direction: column;
flex-direction: column;
}

.pagelayer-post-nav-separator{
align-self: stretch;
}
/* Post Nav end */

/*Flipbox css start*/
.pagelayer-flipbox-container{
margin:0 auto;
}

.pagelayer-flipbox-flipper{
position: relative;
height: 300px;
perspective: 1000px;
-webkit-perspective: 1000px;
transform-style: preserve-3d;
-webkit-transform-style: preserve-3d;
}

.pagelayer-flipbox-front{
background-color: #bc1a1a;
border-radius: inherit;
}

.pagelayer-flipbox-back{
background-color: #f9e73f;
display: block;
border-radius: inherit;
}

.pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front,
.pagelayer-flipbox-flipper .pagelayer-flipbox-back{
opacity: 0;
}

.pagelayer-flipbox-flipper:hover .pagelayer-flipbox-back{
opacity:1;
}

.pagelayer-flipbox-box{
position: absolute;
width: 100%;
height: 100%;
transition: all .8s ease-in-out;
-webkit-transition: all .8s ease-in-out;
}

.pagelayer-flipbox-box-overlay{
display: flex;
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
width: 100%;
height: 100%;
align-items: stretch;
-webkit-align-items: stretch;
-webkit-box-align: stretch;
flex-direction: column;
-webkit-flex-direction: column;
-webkit-box-direction: normal;
text-align: center;
justify-content: center;
-webkit-justify-content: center;
padding: 35px;
-webkit-box-orient: vertical;
-webkit-box-pack: center;
}

.pagelayer-flipbox-3d .pagelayer-flipbox-box-inner{
transform: translateZ(90px) scale(.91);
-webkit-transform: translateZ(90px) scale(.91);
}

.pagelayer-flipbox-3d .pagelayer-flipbox-box-overlay{
transform-style: preserve-3d;
-webkit-transform-style: preserve-3d;
transform: translateZ(.1px);
-webkit-transform: translateZ(.1px);
}

.pagelayer-flipbox-flip .pagelayer-flipbox-flipper{
transform-style: preserve-3d;
-webkit-transform-style: preserve-3d;
perspective: 1000px;
-webkit-perspective: 1000px;
}

.pagelayer-flipbox-flip .pagelayer-flipbox-box{
transform-style: preserve-3d;
-webkit-transform-style: preserve-3d;
backface-visibility: hidden;
-webkit-backface-visibility: hidden;
}

.pagelayer-flipbox-flip .pagelayer-flipbox-front{
-webkit-transform: none;
-ms-transform: none;
transform: none;
z-index: 1
}

.pagelayer-flipbox-flip .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-back{
transform: none;
-webkit-transform: none;
}

.pagelayer-flipbox-flip.pagelayer-flipbox-direction-right .pagelayer-flipbox-back{
transform: rotateX(0) rotateY(-180deg);
-webkit-transform: rotateX(0) rotateY(-180deg); 
}

.pagelayer-flipbox-flip.pagelayer-flipbox-direction-left .pagelayer-flipbox-back,
.pagelayer-flipbox-flip.pagelayer-flipbox-direction-right .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
transform: rotateX(0) rotateY(180deg);
-webkit-transform: rotateX(0) rotateY(180deg);
}

.pagelayer-flipbox-flip.pagelayer-flipbox-direction-left .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
transform: rotateX(0) rotateY(-180deg);
-webkit-transform: rotateX(0) rotateY(-180deg);
}

.pagelayer-flipbox-flip.pagelayer-flipbox-direction-up .pagelayer-flipbox-back{
transform: rotateX(-180deg) rotateY(0);
-webkit-transform: rotateX(-180deg) rotateY(0);  
}

.pagelayer-flipbox-flip.pagelayer-flipbox-direction-down .pagelayer-flipbox-back,
.pagelayer-flipbox-flip.pagelayer-flipbox-direction-up .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
transform: rotateX(180deg) rotateY(0);
-webkit-transform: rotateX(180deg) rotateY(0);  
}

.pagelayer-flipbox-flip.pagelayer-flipbox-direction-down .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
transform: rotateX(-180deg) rotateY(0);
-webkit-transform: rotateX(-180deg) rotateY(0);  
}

.pagelayer-flipbox-push .pagelayer-flipbox-flipper,
.pagelayer-flipbox-slide .pagelayer-flipbox-flipper{
overflow:hidden;
}

.pagelayer-flipbox-push .pagelayer-flipbox-front{
transform: none;
-webkit-transform: none;
}

.pagelayer-flipbox-push.pagelayer-flipbox-direction-right .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
transform:translateX(100%) translateY(0);
-webkit-transform:translateX(100%) translateY(0);
}

.pagelayer-flipbox-push.pagelayer-flipbox-direction-left .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
transform: translateX(-100%) translateY(0);
-webkit-transform: translateX(-100%) translateY(0);
}

.pagelayer-flipbox-push.pagelayer-flipbox-direction-up .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
transform: translateX(0) translateY(-100%);
-webkit-transform: translateX(0) translateY(-100%);
}

.pagelayer-flipbox-push.pagelayer-flipbox-direction-down .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
transform: translateX(0) translateY(100%);
-webkit-transform: translateX(0) translateY(100%);
}

.pagelayer-flipbox-push .pagelayer-flipbox,
.pagelayer-flipbox-slide .pagelayer-flipbox{
overflow: hidden;
}

.pagelayer-flipbox-push .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-back,
.pagelayer-flipbox-slide .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-back{
transform: none;
-webkit-transform: none;  
}

.pagelayer-flipbox-push.pagelayer-flipbox-direction-right .pagelayer-flipbox-back,
.pagelayer-flipbox-slide.pagelayer-flipbox-direction-right .pagelayer-flipbox-back{
transform: translateX(-100%) translateY(0);
-webkit-transform: translateX(-100%) translateY(0);
}

.pagelayer-flipbox-push.pagelayer-flipbox-direction-left .pagelayer-flipbox-back,
.pagelayer-flipbox-slide.pagelayer-flipbox-direction-left .pagelayer-flipbox-back{
transform: translateX(100%) translateY(0);
-webkit-transform: translateX(100%) translateY(0);  
}

.pagelayer-flipbox-push.pagelayer-flipbox-direction-up .pagelayer-flipbox-back,
.pagelayer-flipbox-slide.pagelayer-flipbox-direction-up .pagelayer-flipbox-back{
transform: translateX(0) translateY(100%);
-webkit-transform: translateX(0) translateY(100%);
}

.pagelayer-flipbox-push.pagelayer-flipbox-direction-down .pagelayer-flipbox-back,
.pagelayer-flipbox-slide.pagelayer-flipbox-direction-down .pagelayer-flipbox-back{
transform: translateX(0) translateY(-100%);
-webkit-transform: translateX(0) translateY(-100%);
}

.pagelayer-flipbox-zoom-out .pagelayer-flipbox-flipper .pagelayer-flipbox-front{
transition: opacity .45s, width .1ms, -webkit-transform .8s;
-webkit-transition: opacity .45s, width .1ms, -webkit-transform .8s;  
transition: transform .8s, opacity .45s, width .1ms;
transition: transform .8s, opacity .45s, width .1ms, -webkit-transform .8s;
opacity: 1;
-webkit-transform: scale(1);
-ms-transform: scale(1);
transform: scale(1);
z-index: 1;
width: 100%
}

.pagelayer-flipbox-zoom-out .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-front{
width: 0;
opacity: 0;
transform: scale(.7);
-webkit-transform: scale(.7);
transition: opacity .8s .1s, width .1ms .8s, -webkit-transform .8s;
-webkit-transition: opacity .8s .1s, width .1ms .8s, -webkit-transform .8s;
transition: transform .8s, opacity .8s .1s, width .1ms .8s;
transition: transform .8s, opacity .8s .1s, width .1ms .8s, -webkit-transform .8s
}

.pagelayer-flipbox-zoom-in .pagelayer-flipbox-flipper .pagelayer-flipbox-back{
-webkit-transition: opacity .5s .2s, -webkit-transform .7s;
transition: opacity .5s .2s, -webkit-transform .7s;
transition: transform .7s, opacity .5s .2s;
transition: transform .7s, opacity .5s .2s, -webkit-transform .7s;
opacity: 0;
transform: scale(.7);
-webkit-transform: scale(.7);  
}

.pagelayer-flipbox-zoom-in .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-back{
-webkit-transition: opacity .5s, -webkit-transform .7s;
transition: opacity .5s, -webkit-transform .7s;
transition: transform .7s, opacity .5s;
transition: transform .7s, opacity .5s, -webkit-transform .7s;
opacity: 1;
transform: scale(1);
-webkit-transform: scale(1);  
}

.pagelayer-flipbox-fade .pagelayer-flipbox-flipper .pagelayer-flipbox-back{
opacity: 0
}

.pagelayer-flipbox-fade .pagelayer-flipbox-flipper:hover .pagelayer-flipbox-back{
opacity: 1
}

.pagelayer-flipbox-container.pagelayer-flipbox-flipped .pagelayer-flipbox-main .pagelayer-flipbox-front{
display: none
}

.pagelayer-flipbox-container.pagelayer-flipbox-flipped .pagelayer-flipbox-main .pagelayer-flipbox-back{
transform: none;
-webkit-transform: none;
opacity: 1;
}

.pagelayer-flipbox-image{
width: 100%;
margin: 0 auto;
object-fit: cover; 
}

.pagelayer-flipbox-image img{
width: 50%;
object-fit: cover;
-o-object-fit: cover;
}

.pagelayer-flipbox[back_section="true"] .pagelayer-flipbox-front{
display:none;
}

.pagelayer-flipbox[back_section="true"] .pagelayer-flipbox-back{
transform: rotateX(0) rotateY(0deg) !important;
-webkit-transform: rotateX(0) rotateY(0deg) !important;
opacity: 1 !important;
}

.pagelayer-flipbox-back .pagelayer-service-btn.pagelayer-btn-link{
background-color:transparent;
}

/*Flipbox End*/

/* Animated Heading */

.pagelayer-aheading-holder {
display: inline-block;
position:relative;
}

.pagelayer-animated-heading{
margin: 0;
padding: 0;
line-height: 1.4;
-webkit-background-clip: text;
}

[class*="pagelayer-blobs"]{
display:block;
position:absolute;
mix-blend-mode:color;
animation:pagelayer-blobs 10s ease-in-out infinite alternate;
}

.pagelayer-blobs_1{
width: 9%;
height: 47%;
top: 12%;
left: 4%;
}

.pagelayer-blobs_2{
width: 10%;
height: 50%;
top: 60%;
left: 34%;
}

.pagelayer-blobs_3{
width: 20%;
height: 46%;
top: 10%;
left: 20%;
}

.pagelayer-blobs_4{
width: 30%;
height: 40%;
top: 30%;
left: 70%;
}

.pagelayer-blobs_5{
width: 12%;
height: 40%;
top: 61%;
left: 12%;
}

.pagelayer-blobs_6{
width: 25%;
height: 45%;
top: 5%;
left: 45%;
}

.pagelayer-blobs_7{
width: 32%;
height: 45%;
top: 67%;
left: 46%;
}

.pagelayer-hEffect-none [class*="pagelayer-blobs"]{
display: none;
}

@keyframes pagelayer-blobs{
0%{border-radius:26% 74% 61% 39% / 54% 67% 33% 46%}
10%{border-radius:74% 26% 47% 53% / 68% 46% 54% 32%}
20%{border-radius:48% 52% 30% 70% / 27% 37% 63% 73%}
30%{border-radius:73% 27% 57% 43% / 28% 67% 33% 72%}
40%{border-radius:63% 37% 56% 44% / 25% 28% 72% 75%}
50%{border-radius:39% 61% 70% 30% / 61% 29% 71% 39%}
60%{border-radius:27% 73% 29% 71% / 73% 51% 49% 27%}
70%{border-radius:39% 61% 65% 35% / 74% 65% 35% 26%}
80%{border-radius:55% 45% 37% 63% / 38% 30% 70% 62%}
90%{border-radius:25% 75% 70% 30% / 39% 50% 50% 61%}
100%{border-radius:66% 34% 33% 67% / 65% 73% 27% 35%}
}

.pagelayer-hEffect-blobs,
.pagelayer-hEffect-none,
.pagelayer-heading-rotating{
-webkit-text-fill-color: transparent;
}

.pagelayer-heading-rotating .pagelayer-animated-heading{
display: inline;
}

.pagelayer-words-wrapper {
  display: inline-block;
  position: relative;
  text-align: left;
}
.pagelayer-words-wrapper span {
  display: inline-block;
  position: absolute;
  white-space: nowrap;
  left: 0;
  top: 0;
}
.pagelayer-words-wrapper span.pagelayer-is-visible {
  position: relative;
}

/*** xrotate-1 ***/
.pagelayer-aheading-rotate1 .pagelayer-words-wrapper {
  -webkit-perspective: 300px;
  -moz-perspective: 300px;
  perspective: 300px;
}
.pagelayer-aheading-rotate1 span {
  opacity: 0;
  -webkit-transform-origin: 50% 100%;
  -moz-transform-origin: 50% 100%;
  -ms-transform-origin: 50% 100%;
  -o-transform-origin: 50% 100%;
  transform-origin: 50% 100%;
  -webkit-transform: rotateX(180deg);
  -moz-transform: rotateX(180deg);
  -ms-transform: rotateX(180deg);
  -o-transform: rotateX(180deg);
  transform: rotateX(180deg);
}
.pagelayer-aheading-rotate1 span.pagelayer-is-visible {
  opacity: 1;
  -webkit-transform: rotateX(0deg);
  -moz-transform: rotateX(0deg);
  -ms-transform: rotateX(0deg);
  -o-transform: rotateX(0deg);
  transform: rotateX(0deg);
  -webkit-animation: pagelayer-rotate-1-in 1.2s;
  -moz-animation: pagelayer-rotate-1-in 1.2s;
  animation: pagelayer-rotate-1-in 1.2s;
}
.pagelayer-aheading-rotate1 span.pagelayer-is-hidden {
  -webkit-transform: rotateX(180deg);
  -moz-transform: rotateX(180deg);
  -ms-transform: rotateX(180deg);
  -o-transform: rotateX(180deg);
  transform: rotateX(180deg);
  -webkit-animation: pagelayer-rotate-1-out 1.2s;
  -moz-animation: pagelayer-rotate-1-out 1.2s;
  animation: pagelayer-rotate-1-out 1.2s;
}

@-webkit-keyframes pagelayer-rotate-1-in {
  0% {
    -webkit-transform: rotateX(180deg);
    opacity: 0;
  }
  35% {
    -webkit-transform: rotateX(120deg);
    opacity: 0;
  }
  65% {
    opacity: 0;
  }
  100% {
    -webkit-transform: rotateX(360deg);
    opacity: 1;
  }
}
@-moz-keyframes pagelayer-rotate-1-in {
  0% {
    -moz-transform: rotateX(180deg);
    opacity: 0;
  }
  35% {
    -moz-transform: rotateX(120deg);
    opacity: 0;
  }
  65% {
    opacity: 0;
  }
  100% {
    -moz-transform: rotateX(360deg);
    opacity: 1;
  }
}
@keyframes pagelayer-rotate-1-in {
  0% {
    -webkit-transform: rotateX(180deg);
    -moz-transform: rotateX(180deg);
    -ms-transform: rotateX(180deg);
    -o-transform: rotateX(180deg);
    transform: rotateX(180deg);
    opacity: 0;
  }
  35% {
    -webkit-transform: rotateX(120deg);
    -moz-transform: rotateX(120deg);
    -ms-transform: rotateX(120deg);
    -o-transform: rotateX(120deg);
    transform: rotateX(120deg);
    opacity: 0;
  }
  65% {
    opacity: 0;
  }
  100% {
    -webkit-transform: rotateX(360deg);
    -moz-transform: rotateX(360deg);
    -ms-transform: rotateX(360deg);
    -o-transform: rotateX(360deg);
    transform: rotateX(360deg);
    opacity: 1;
  }
}
@-webkit-keyframes pagelayer-rotate-1-out {
  0% {
    -webkit-transform: rotateX(0deg);
    opacity: 1;
  }
  35% {
    -webkit-transform: rotateX(-40deg);
    opacity: 1;
  }
  65% {
    opacity: 0;
  }
  100% {
    -webkit-transform: rotateX(180deg);
    opacity: 0;
  }
}
@-moz-keyframes pagelayer-rotate-1-out {
  0% {
    -moz-transform: rotateX(0deg);
    opacity: 1;
  }
  35% {
    -moz-transform: rotateX(-40deg);
    opacity: 1;
  }
  65% {
    opacity: 0;
  }
  100% {
    -moz-transform: rotateX(180deg);
    opacity: 0;
  }
}
@keyframes pagelayer-rotate-1-out {
  0% {
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
    -ms-transform: rotateX(0deg);
    -o-transform: rotateX(0deg);
    transform: rotateX(0deg);
    opacity: 1;
  }
  35% {
    -webkit-transform: rotateX(-40deg);
    -moz-transform: rotateX(-40deg);
    -ms-transform: rotateX(-40deg);
    -o-transform: rotateX(-40deg);
    transform: rotateX(-40deg);
    opacity: 1;
  }
  65% {
    opacity: 0;
  }
  100% {
    -webkit-transform: rotateX(180deg);
    -moz-transform: rotateX(180deg);
    -ms-transform: rotateX(180deg);
    -o-transform: rotateX(180deg);
    transform: rotateX(180deg);
    opacity: 0;
  }
}

/*** xrotate-2 ***/
.pagelayer-aheading-rotate2 .pagelayer-words-wrapper {
  -webkit-perspective: 300px;
  -moz-perspective: 300px;
  perspective: 300px;
}
.pagelayer-aheading-rotate2 strong, .pagelayer-aheading-rotate2 b {
  display: inline-block;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.pagelayer-aheading-rotate2 span {
  opacity: 0;
}
.pagelayer-aheading-rotate2 strong {
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  -ms-transform-style: preserve-3d;
  -o-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-transform: translateZ(-20px) rotateX(90deg);
  -moz-transform: translateZ(-20px) rotateX(90deg);
  -ms-transform: translateZ(-20px) rotateX(90deg);
  -o-transform: translateZ(-20px) rotateX(90deg);
  transform: translateZ(-20px) rotateX(90deg);
  opacity: 0;
}
.pagelayer-is-visible .pagelayer-aheading-rotate2 strong {
  opacity: 1;
}
.pagelayer-aheading-rotate2 strong.pagelayer-aheading-in {
  -webkit-animation: pagelayer-rotate-2-in 0.4s forwards;
  -moz-animation: pagelayer-rotate-2-in 0.4s forwards;
  animation: pagelayer-rotate-2-in 0.4s forwards;
  -webkit-background-clip: text;
}
.pagelayer-aheading-rotate2 strong.pagelayer-aheading-out {
  -webkit-animation: pagelayer-rotate-2-out 0.4s forwards;
  -moz-animation: pagelayer-rotate-2-out 0.4s forwards;
  animation: pagelayer-rotate-2-out 0.4s forwards;
  -webkit-background-clip: text;
}
.pagelayer-aheading-rotate2 b {
  -webkit-transform: translateZ(20px);
  -moz-transform: translateZ(20px);
  -ms-transform: translateZ(20px);
  -o-transform: translateZ(20px);
  transform: translateZ(20px);
  -webkit-text-fill-color: transparent;
}

.pagelayer-no-csstransitions .pagelayer-aheading-rotate2 strong {
  -webkit-transform: rotateX(0deg);
  -moz-transform: rotateX(0deg);
  -ms-transform: rotateX(0deg);
  -o-transform: rotateX(0deg);
  transform: rotateX(0deg);
  opacity: 0;
}
.pagelayer-no-csstransitions .pagelayer-aheading-rotate2 strong b {
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1);
}

.pagelayer-no-csstransitions .pagelayer-aheading-rotate2 .pagelayer-is-visible strong {
  opacity: 1;
}

@-webkit-keyframes pagelayer-rotate-2-in {
  0% {
    opacity: 0;
    -webkit-transform: translateZ(-20px) rotateX(90deg);
  }
  60% {
    opacity: 1;
    -webkit-transform: translateZ(-20px) rotateX(-10deg);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateZ(-20px) rotateX(0deg);
  }
}
@-moz-keyframes pagelayer-rotate-2-in {
  0% {
    opacity: 0;
    -moz-transform: translateZ(-20px) rotateX(90deg);
  }
  60% {
    opacity: 1;
    -moz-transform: translateZ(-20px) rotateX(-10deg);
  }
  100% {
    opacity: 1;
    -moz-transform: translateZ(-20px) rotateX(0deg);
  }
}
@keyframes pagelayer-rotate-2-in {
  0% {
    opacity: 0;
    -webkit-transform: translateZ(-20px) rotateX(90deg);
    -moz-transform: translateZ(-20px) rotateX(90deg);
    -ms-transform: translateZ(-20px) rotateX(90deg);
    -o-transform: translateZ(-20px) rotateX(90deg);
    transform: translateZ(-20px) rotateX(90deg);
  }
  60% {
    opacity: 1;
    -webkit-transform: translateZ(-20px) rotateX(-10deg);
    -moz-transform: translateZ(-20px) rotateX(-10deg);
    -ms-transform: translateZ(-20px) rotateX(-10deg);
    -o-transform: translateZ(-20px) rotateX(-10deg);
    transform: translateZ(-20px) rotateX(-10deg);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateZ(-20px) rotateX(0deg);
    -moz-transform: translateZ(-20px) rotateX(0deg);
    -ms-transform: translateZ(-20px) rotateX(0deg);
    -o-transform: translateZ(-20px) rotateX(0deg);
    transform: translateZ(-20px) rotateX(0deg);
  }
}
@-webkit-keyframes pagelayer-rotate-2-out {
  0% {
    opacity: 1;
    -webkit-transform: translateZ(-20px) rotateX(0);
  }
  60% {
    opacity: 0;
    -webkit-transform: translateZ(-20px) rotateX(-100deg);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateZ(-20px) rotateX(-90deg);
  }
}
@-moz-keyframes pagelayer-rotate-2-out {
  0% {
    opacity: 1;
    -moz-transform: translateZ(-20px) rotateX(0);
  }
  60% {
    opacity: 0;
    -moz-transform: translateZ(-20px) rotateX(-100deg);
  }
  100% {
    opacity: 0;
    -moz-transform: translateZ(-20px) rotateX(-90deg);
  }
}
@keyframes pagelayer-rotate-2-out {
  0% {
    opacity: 1;
    -webkit-transform: translateZ(-20px) rotateX(0);
    -moz-transform: translateZ(-20px) rotateX(0);
    -ms-transform: translateZ(-20px) rotateX(0);
    -o-transform: translateZ(-20px) rotateX(0);
    transform: translateZ(-20px) rotateX(0);
  }
  60% {
    opacity: 0;
    -webkit-transform: translateZ(-20px) rotateX(-100deg);
    -moz-transform: translateZ(-20px) rotateX(-100deg);
    -ms-transform: translateZ(-20px) rotateX(-100deg);
    -o-transform: translateZ(-20px) rotateX(-100deg);
    transform: translateZ(-20px) rotateX(-100deg);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateZ(-20px) rotateX(-90deg);
    -moz-transform: translateZ(-20px) rotateX(-90deg);
    -ms-transform: translateZ(-20px) rotateX(-90deg);
    -o-transform: translateZ(-20px) rotateX(-90deg);
    transform: translateZ(-20px) rotateX(-90deg);
  }
}

/*** xloading-bar ***/
.pagelayer-aheading-loading-bar .pagelayer-words-wrapper {
  overflow: hidden;
  vertical-align: top;
}
.pagelayer-aheading-loading-bar .pagelayer-words-wrapper:after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 0;
  background: #0096a7;
  z-index: 2;
  -webkit-transition: width 0.3s -0.1s;
  -moz-transition: width 0.3s -0.1s;
  transition: width 0.3s -0.1s;
}
.pagelayer-aheading-loading-bar .pagelayer-words-wrapper.pagelayer-is-loading:after {
  width: 100%;
  -webkit-transition: width 3s;
  -moz-transition: width 3s;
  transition: width 3s;
}
.pagelayer-aheading-loading-bar span{
  top: .2em;
  opacity: 0;
  -webkit-transition: opacity 0.3s;
  -moz-transition: opacity 0.3s;
  transition: opacity 0.3s;
}
.pagelayer-aheading-loading-bar span.pagelayer-is-visible {
  opacity: 1;
  top: 0;
}

/*** xslide ***/
.pagelayer-aheading-slide .pagelayer-words-wrapper {
  overflow: hidden;
  vertical-align: top;
}
.pagelayer-aheading-slide span {
  opacity: 0;
  top: .2em;
}
.pagelayer-aheading-slide span.pagelayer-is-visible {
  top: 0;
  opacity: 1;
  -webkit-animation: pagelayer-slide-in 0.6s;
  -moz-animation: pagelayer-slide-in 0.6s;
  animation: pagelayer-slide-in 0.6s;
}
.pagelayer-aheading-slide span.pagelayer-is-hidden {
  -webkit-animation: pagelayer-slide-out 0.6s;
  -moz-animation: pagelayer-slide-out 0.6s;
  animation: pagelayer-slide-out 0.6s;
}

@-webkit-keyframes pagelayer-slide-in {
  0% {
    opacity: 0;
    -webkit-transform: translateY(-100%);
  }
  60% {
    opacity: 1;
    -webkit-transform: translateY(20%);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
  }
}
@-moz-keyframes pagelayer-slide-in {
  0% {
    opacity: 0;
    -moz-transform: translateY(-100%);
  }
  60% {
    opacity: 1;
    -moz-transform: translateY(20%);
  }
  100% {
    opacity: 1;
    -moz-transform: translateY(0);
  }
}
@keyframes pagelayer-slide-in {
  0% {
    opacity: 0;
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    transform: translateY(-100%);
  }
  60% {
    opacity: 1;
    -webkit-transform: translateY(20%);
    -moz-transform: translateY(20%);
    -ms-transform: translateY(20%);
    -o-transform: translateY(20%);
    transform: translateY(20%);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0);
  }
}
@-webkit-keyframes pagelayer-slide-out {
  0% {
    opacity: 1;
    -webkit-transform: translateY(0);
  }
  60% {
    opacity: 0;
    -webkit-transform: translateY(120%);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateY(100%);
  }
}
@-moz-keyframes pagelayer-slide-out {
  0% {
    opacity: 1;
    -moz-transform: translateY(0);
  }
  60% {
    opacity: 0;
    -moz-transform: translateY(120%);
  }
  100% {
    opacity: 0;
    -moz-transform: translateY(100%);
  }
}
@keyframes pagelayer-slide-out {
  0% {
    opacity: 1;
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0);
  }
  60% {
    opacity: 0;
    -webkit-transform: translateY(120%);
    -moz-transform: translateY(120%);
    -ms-transform: translateY(120%);
    -o-transform: translateY(120%);
    transform: translateY(120%);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -ms-transform: translateY(100%);
    -o-transform: translateY(100%);
    transform: translateY(100%);
  }
}

/*** xclip ***/
.pagelayer-aheading-clip .pagelayer-words-wrapper {
  overflow: hidden;
  vertical-align: top;
}
.pagelayer-aheading-clip .pagelayer-words-wrapper:after {
  /* line */
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 3px;
  height: 100%;
  background-color: #aebcb9;
}
.pagelayer-aheading-clip span {
  opacity: 0;
}
.pagelayer-aheading-clip span.pagelayer-is-visible {
  opacity: 1;
}

/*** xzoom ***/
.pagelayer-aheading-zoom .pagelayer-words-wrapper {
  -webkit-perspective: 300px;
  -moz-perspective: 300px;
  perspective: 300px;
}
.pagelayer-aheading-zoom span{
  opacity: 0;
}
.pagelayer-aheading-zoom span.pagelayer-is-visible {
  opacity: 1;
  -webkit-animation: pagelayer-zoom-in 0.8s;
  -moz-animation: pagelayer-zoom-in 0.8s;
  animation: pagelayer-zoom-in 0.8s;
}
.pagelayer-aheading-zoom span.pagelayer-is-hidden {
  -webkit-animation: pagelayer-zoom-out 0.8s;
  -moz-animation: pagelayer-zoom-out 0.8s;
  animation: pagelayer-zoom-out 0.8s;
}

@-webkit-keyframes pagelayer-zoom-in {
  0% {
    opacity: 0;
    -webkit-transform: translateZ(100px);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateZ(0);
  }
}
@-moz-keyframes pagelayer-zoom-in {
  0% {
    opacity: 0;
    -moz-transform: translateZ(100px);
  }
  100% {
    opacity: 1;
    -moz-transform: translateZ(0);
  }
}
@keyframes pagelayer-zoom-in {
  0% {
    opacity: 0;
    -webkit-transform: translateZ(100px);
    -moz-transform: translateZ(100px);
    -ms-transform: translateZ(100px);
    -o-transform: translateZ(100px);
    transform: translateZ(100px);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
  }
}
@-webkit-keyframes pagelayer-zoom-out {
  0% {
    opacity: 1;
    -webkit-transform: translateZ(0);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateZ(-100px);
  }
}
@-moz-keyframes pagelayer-zoom-out {
  0% {
    opacity: 1;
    -moz-transform: translateZ(0);
  }
  100% {
    opacity: 0;
    -moz-transform: translateZ(-100px);
  }
}
@keyframes pagelayer-zoom-out {
  0% {
    opacity: 1;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateZ(-100px);
    -moz-transform: translateZ(-100px);
    -ms-transform: translateZ(-100px);
    -o-transform: translateZ(-100px);
    transform: translateZ(-100px);
  }
}

/*** xrotate-3 ***/
.pagelayer-aheading-rotate3 .pagelayer-words-wrapper {
  -webkit-perspective: 300px;
  -moz-perspective: 300px;
  perspective: 300px;
}
.pagelayer-aheading-rotate3 span {
  opacity: 0;
}
.pagelayer-aheading-rotate3 strong {
  display: inline-block;
  -webkit-transform: rotateY(180deg);
  -moz-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  -o-transform: rotateY(180deg);
  transform: rotateY(180deg);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.pagelayer-is-visible .pagelayer-aheading-rotate3 strong {
  -webkit-transform: rotateY(0deg);
  -moz-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  -o-transform: rotateY(0deg);
  transform: rotateY(0deg);
}
.pagelayer-aheading-rotate3 strong.pagelayer-aheading-in {
  -webkit-animation: pagelayer-rotate-3-in 0.6s forwards;
  -moz-animation: pagelayer-rotate-3-in 0.6s forwards;
  animation: pagelayer-rotate-3-in 0.6s forwards;
}
.pagelayer-aheading-rotate3 strong.pagelayer-aheading-out {
  -webkit-animation: pagelayer-rotate-3-out 0.6s forwards;
  -moz-animation: pagelayer-rotate-3-out 0.6s forwards;
  animation: pagelayer-rotate-3-out 0.6s forwards;
}

.pagelayer-no-csstransitions .pagelayer-aheading-rotate3 strong {
  -webkit-transform: rotateY(0deg);
  -moz-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  -o-transform: rotateY(0deg);
  transform: rotateY(0deg);
  opacity: 0;
}

.pagelayer-no-csstransitions .pagelayer-aheading-rotate3 .pagelayer-is-visible strong {
  opacity: 1;
}

@-webkit-keyframes pagelayer-rotate-3-in {
  0% {
    -webkit-transform: rotateY(180deg);
  }
  100% {
    -webkit-transform: rotateY(0deg);
  }
}
@-moz-keyframes pagelayer-rotate-3-in {
  0% {
    -moz-transform: rotateY(180deg);
  }
  100% {
    -moz-transform: rotateY(0deg);
  }
}
@keyframes pagelayer-rotate-3-in {
  0% {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);
    -ms-transform: rotateY(180deg);
    -o-transform: rotateY(180deg);
    transform: rotateY(180deg);
  }
  100% {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    -o-transform: rotateY(0deg);
    transform: rotateY(0deg);
  }
}
@-webkit-keyframes pagelayer-rotate-3-out {
  0% {
    -webkit-transform: rotateY(0);
  }
  100% {
    -webkit-transform: rotateY(-180deg);
  }
}
@-moz-keyframes pagelayer-rotate-3-out {
  0% {
    -moz-transform: rotateY(0);
  }
  100% {
    -moz-transform: rotateY(-180deg);
  }
}
@keyframes pagelayer-rotate-3-out {
  0% {
    -webkit-transform: rotateY(0);
    -moz-transform: rotateY(0);
    -ms-transform: rotateY(0);
    -o-transform: rotateY(0);
    transform: rotateY(0);
  }
  100% {
    -webkit-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    -o-transform: rotateY(-180deg);
    transform: rotateY(-180deg);
  }
}

/*** xscale ***/
.pagelayer-aheading-scale span {
  opacity: 0;
}
.pagelayer-aheading-scale strong {
  display: inline-block;
  opacity: 0;
  -webkit-transform: scale(0);
  -moz-transform: scale(0);
  -ms-transform: scale(0);
  -o-transform: scale(0);
  transform: scale(0);
}
.pagelayer-is-visible .pagelayer-aheading-scale strong {
  opacity: 1;
}
.pagelayer-aheading-scale strong.pagelayer-aheading-in {
  -webkit-animation: pagelayer-scale-up 0.6s forwards;
  -moz-animation: pagelayer-scale-up 0.6s forwards;
  animation: pagelayer-scale-up 0.6s forwards;
}
.pagelayer-aheading-scale strong.pagelayer-aheading-out {
  -webkit-animation: pagelayer-scale-down 0.6s forwards;
  -moz-animation: pagelayer-scale-down 0.6s forwards;
  animation: pagelayer-scale-down 0.6s forwards;
}

.pagelayer-no-csstransitions .pagelayer-aheading-scale strong {
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1);
  opacity: 0;
}

.pagelayer-no-csstransitions .pagelayer-aheading-scale .pagelayer-is-visible strong {
  opacity: 1;
}

@-webkit-keyframes pagelayer-scale-up {
  0% {
    -webkit-transform: scale(0);
    opacity: 0;
  }
  60% {
    -webkit-transform: scale(1.2);
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(1);
    opacity: 1;
  }
}
@-moz-keyframes pagelayer-scale-up {
  0% {
    -moz-transform: scale(0);
    opacity: 0;
  }
  60% {
    -moz-transform: scale(1.2);
    opacity: 1;
  }
  100% {
    -moz-transform: scale(1);
    opacity: 1;
  }
}
@keyframes pagelayer-scale-up {
  0% {
    -webkit-transform: scale(0);
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    transform: scale(0);
    opacity: 0;
  }
  60% {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
}
@-webkit-keyframes pagelayer-scale-down {
  0% {
    -webkit-transform: scale(1);
    opacity: 1;
  }
  60% {
    -webkit-transform: scale(0);
    opacity: 0;
  }
}
@-moz-keyframes pagelayer-scale-down {
  0% {
    -moz-transform: scale(1);
    opacity: 1;
  }
  60% {
    -moz-transform: scale(0);
    opacity: 0;
  }
}
@keyframes pagelayer-scale-down {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
  60% {
    -webkit-transform: scale(0);
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    transform: scale(0);
    opacity: 0;
  }
}

/*** xpush ***/
.pagelayer-aheading-push span {
  opacity: 0;
}
.pagelayer-aheading-push span.pagelayer-is-visible {
  opacity: 1;
  -webkit-animation: pagelayer-push-in 0.6s;
  -moz-animation: pagelayer-push-in 0.6s;
  animation: pagelayer-push-in 0.6s;
}
.pagelayer-aheading-push span.pagelayer-is-hidden {
  -webkit-animation: pagelayer-push-out 0.6s;
  -moz-animation: pagelayer-push-out 0.6s;
  animation: pagelayer-push-out 0.6s;
}

@-webkit-keyframes pagelayer-push-in {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-100%);
  }
  60% {
    opacity: 1;
    -webkit-transform: translateX(10%);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0);
  }
}
@-moz-keyframes pagelayer-push-in {
  0% {
    opacity: 0;
    -moz-transform: translateX(-100%);
  }
  60% {
    opacity: 1;
    -moz-transform: translateX(10%);
  }
  100% {
    opacity: 1;
    -moz-transform: translateX(0);
  }
}
@keyframes pagelayer-push-in {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-100%);
    -moz-transform: translateX(-100%);
    -ms-transform: translateX(-100%);
    -o-transform: translateX(-100%);
    transform: translateX(-100%);
  }
  60% {
    opacity: 1;
    -webkit-transform: translateX(10%);
    -moz-transform: translateX(10%);
    -ms-transform: translateX(10%);
    -o-transform: translateX(10%);
    transform: translateX(10%);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -ms-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0);
  }
}
@-webkit-keyframes pagelayer-push-out {
  0% {
    opacity: 1;
    -webkit-transform: translateX(0);
  }
  60% {
    opacity: 0;
    -webkit-transform: translateX(110%);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateX(100%);
  }
}
@-moz-keyframes pagelayer-push-out {
  0% {
    opacity: 1;
    -moz-transform: translateX(0);
  }
  60% {
    opacity: 0;
    -moz-transform: translateX(110%);
  }
  100% {
    opacity: 0;
    -moz-transform: translateX(100%);
  }
}
@keyframes pagelayer-push-out {
  0% {
    opacity: 1;
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -ms-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0);
  }
  60% {
    opacity: 0;
    -webkit-transform: translateX(110%);
    -moz-transform: translateX(110%);
    -ms-transform: translateX(110%);
    -o-transform: translateX(110%);
    transform: translateX(110%);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateX(100%);
    -moz-transform: translateX(100%);
    -ms-transform: translateX(100%);
    -o-transform: translateX(100%);
    transform: translateX(100%);
  }
}

/* Animated Heading End */
/* Page Break Start */

.pagelayer-page-links{
text-align: center;
margin-top: 50px;
}

.pagelayer-page-links .post-page-numbers {
padding: 0;
margin: 0 0 .3em .3em;
border: 1px solid;
color: #000;
background: 0 0;
font-size: .8em;
width: 2.5em;
height: 2.5em;
line-height: calc(2.5em - 4px);
display: inline-block;
text-align: center;
transition: all .2s linear;
}

.pagelayer-arc-layout-left .pagelayer-wposts-col .pagelayer-wposts-content,
.pagelayer-arc-layout-right .pagelayer-wposts-col .pagelayer-wposts-featured,
.pagelayer-arc-layout-alt .pagelayer-wposts-col:nth-of-type(2n+1) .pagelayer-wposts-content,
.pagelayer-arc-layout-alt .pagelayer-wposts-col:nth-of-type(2n) .pagelayer-wposts-featured{
width: 48%;
float: left;
}

.pagelayer-arc-layout-right .pagelayer-wposts-col .pagelayer-wposts-content,
.pagelayer-arc-layout-left .pagelayer-wposts-col .pagelayer-wposts-featured,
.pagelayer-arc-layout-alt .pagelayer-wposts-col:nth-of-type(2n) .pagelayer-wposts-content,
.pagelayer-arc-layout-alt .pagelayer-wposts-col:nth-of-type(2n+1) .pagelayer-wposts-featured{
width: 48%;
float: right;
}
  
.pagelayer-arc-layout-left .pagelayer-wposts-thumb,
.pagelayer-arc-layout-right .pagelayer-wposts-thumb,
.pagelayer-arc-layout-alt .pagelayer-wposts-thumb{
display: block;
}
    
.pagelayer-wposts-thumb,
.pagelayer-wposts-featured,
.pagelayer-wposts-col{
overflow: hidden;
}

.pagelayer-loader-holder{
width: auto;
height: auto;
display: none;
}

.pagelayer-post-max,
.pagelayer-infinite-scroll-auto ~ .pagelayer_load_button .pagelayer-btn-load{
display: none;
}
/* Page Break End */

/********************/
/*** Freemium End ***/
/********************/



@charset "UTF-8";

/*!
 * animate.css -http://daneden.me/animate
 * Version - 3.7.0
 * Licensed under the MIT license - http://opensource.org/licenses/MIT
 *
 * Copyright (c) 2018 Daniel Eden
 */

@-webkit-keyframes bounce{0%,20%,53%,80%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);-webkit-transform:translateZ(0);animation-timing-function:cubic-bezier(.215,.61,.355,1);transform:translateZ(0)}40%,43%{-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);-webkit-transform:translate3d(0,-30px,0);animation-timing-function:cubic-bezier(.755,.05,.855,.06);transform:translate3d(0,-30px,0)}70%{-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);-webkit-transform:translate3d(0,-15px,0);animation-timing-function:cubic-bezier(.755,.05,.855,.06);transform:translate3d(0,-15px,0)}90%{-webkit-transform:translate3d(0,-4px,0);transform:translate3d(0,-4px,0)}}@keyframes bounce{0%,20%,53%,80%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);-webkit-transform:translateZ(0);animation-timing-function:cubic-bezier(.215,.61,.355,1);transform:translateZ(0)}40%,43%{-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);-webkit-transform:translate3d(0,-30px,0);animation-timing-function:cubic-bezier(.755,.05,.855,.06);transform:translate3d(0,-30px,0)}70%{-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);-webkit-transform:translate3d(0,-15px,0);animation-timing-function:cubic-bezier(.755,.05,.855,.06);transform:translate3d(0,-15px,0)}90%{-webkit-transform:translate3d(0,-4px,0);transform:translate3d(0,-4px,0)}}.bounce{-webkit-animation-name:bounce;-webkit-transform-origin:center bottom;animation-name:bounce;transform-origin:center bottom}@-webkit-keyframes flash{0%,50%,to{opacity:1}25%,75%{opacity:0}}@keyframes flash{0%,50%,to{opacity:1}25%,75%{opacity:0}}.flash{-webkit-animation-name:flash;animation-name:flash}@-webkit-keyframes pulse{0%{-webkit-transform:scaleX(1);transform:scaleX(1)}50%{-webkit-transform:scale3d(1.05,1.05,1.05);transform:scale3d(1.05,1.05,1.05)}to{-webkit-transform:scaleX(1);transform:scaleX(1)}}@keyframes pulse{0%{-webkit-transform:scaleX(1);transform:scaleX(1)}50%{-webkit-transform:scale3d(1.05,1.05,1.05);transform:scale3d(1.05,1.05,1.05)}to{-webkit-transform:scaleX(1);transform:scaleX(1)}}.pulse{-webkit-animation-name:pulse;animation-name:pulse}@-webkit-keyframes rubberBand{0%{-webkit-transform:scaleX(1);transform:scaleX(1)}30%{-webkit-transform:scale3d(1.25,.75,1);transform:scale3d(1.25,.75,1)}40%{-webkit-transform:scale3d(.75,1.25,1);transform:scale3d(.75,1.25,1)}50%{-webkit-transform:scale3d(1.15,.85,1);transform:scale3d(1.15,.85,1)}65%{-webkit-transform:scale3d(.95,1.05,1);transform:scale3d(.95,1.05,1)}75%{-webkit-transform:scale3d(1.05,.95,1);transform:scale3d(1.05,.95,1)}to{-webkit-transform:scaleX(1);transform:scaleX(1)}}@keyframes rubberBand{0%{-webkit-transform:scaleX(1);transform:scaleX(1)}30%{-webkit-transform:scale3d(1.25,.75,1);transform:scale3d(1.25,.75,1)}40%{-webkit-transform:scale3d(.75,1.25,1);transform:scale3d(.75,1.25,1)}50%{-webkit-transform:scale3d(1.15,.85,1);transform:scale3d(1.15,.85,1)}65%{-webkit-transform:scale3d(.95,1.05,1);transform:scale3d(.95,1.05,1)}75%{-webkit-transform:scale3d(1.05,.95,1);transform:scale3d(1.05,.95,1)}to{-webkit-transform:scaleX(1);transform:scaleX(1)}}.rubberBand{-webkit-animation-name:rubberBand;animation-name:rubberBand}@-webkit-keyframes shake{0%,to{-webkit-transform:translateZ(0);transform:translateZ(0)}10%,30%,50%,70%,90%{-webkit-transform:translate3d(-10px,0,0);transform:translate3d(-10px,0,0)}20%,40%,60%,80%{-webkit-transform:translate3d(10px,0,0);transform:translate3d(10px,0,0)}}@keyframes shake{0%,to{-webkit-transform:translateZ(0);transform:translateZ(0)}10%,30%,50%,70%,90%{-webkit-transform:translate3d(-10px,0,0);transform:translate3d(-10px,0,0)}20%,40%,60%,80%{-webkit-transform:translate3d(10px,0,0);transform:translate3d(10px,0,0)}}.shake{-webkit-animation-name:shake;animation-name:shake}@-webkit-keyframes headShake{0%{-webkit-transform:translateX(0);transform:translateX(0)}6.5%{-webkit-transform:translateX(-6px) rotateY(-9deg);transform:translateX(-6px) rotateY(-9deg)}18.5%{-webkit-transform:translateX(5px) rotateY(7deg);transform:translateX(5px) rotateY(7deg)}31.5%{-webkit-transform:translateX(-3px) rotateY(-5deg);transform:translateX(-3px) rotateY(-5deg)}43.5%{-webkit-transform:translateX(2px) rotateY(3deg);transform:translateX(2px) rotateY(3deg)}50%{-webkit-transform:translateX(0);transform:translateX(0)}}@keyframes headShake{0%{-webkit-transform:translateX(0);transform:translateX(0)}6.5%{-webkit-transform:translateX(-6px) rotateY(-9deg);transform:translateX(-6px) rotateY(-9deg)}18.5%{-webkit-transform:translateX(5px) rotateY(7deg);transform:translateX(5px) rotateY(7deg)}31.5%{-webkit-transform:translateX(-3px) rotateY(-5deg);transform:translateX(-3px) rotateY(-5deg)}43.5%{-webkit-transform:translateX(2px) rotateY(3deg);transform:translateX(2px) rotateY(3deg)}50%{-webkit-transform:translateX(0);transform:translateX(0)}}.headShake{-webkit-animation-name:headShake;-webkit-animation-timing-function:ease-in-out;animation-name:headShake;animation-timing-function:ease-in-out}@-webkit-keyframes swing{20%{-webkit-transform:rotate(15deg);transform:rotate(15deg)}40%{-webkit-transform:rotate(-10deg);transform:rotate(-10deg)}60%{-webkit-transform:rotate(5deg);transform:rotate(5deg)}80%{-webkit-transform:rotate(-5deg);transform:rotate(-5deg)}to{-webkit-transform:rotate(0deg);transform:rotate(0deg)}}@keyframes swing{20%{-webkit-transform:rotate(15deg);transform:rotate(15deg)}40%{-webkit-transform:rotate(-10deg);transform:rotate(-10deg)}60%{-webkit-transform:rotate(5deg);transform:rotate(5deg)}80%{-webkit-transform:rotate(-5deg);transform:rotate(-5deg)}to{-webkit-transform:rotate(0deg);transform:rotate(0deg)}}.swing{-webkit-animation-name:swing;-webkit-transform-origin:top center;animation-name:swing;transform-origin:top center}@-webkit-keyframes tada{0%{-webkit-transform:scaleX(1);transform:scaleX(1)}10%,20%{-webkit-transform:scale3d(.9,.9,.9) rotate(-3deg);transform:scale3d(.9,.9,.9) rotate(-3deg)}30%,50%,70%,90%{-webkit-transform:scale3d(1.1,1.1,1.1) rotate(3deg);transform:scale3d(1.1,1.1,1.1) rotate(3deg)}40%,60%,80%{-webkit-transform:scale3d(1.1,1.1,1.1) rotate(-3deg);transform:scale3d(1.1,1.1,1.1) rotate(-3deg)}to{-webkit-transform:scaleX(1);transform:scaleX(1)}}@keyframes tada{0%{-webkit-transform:scaleX(1);transform:scaleX(1)}10%,20%{-webkit-transform:scale3d(.9,.9,.9) rotate(-3deg);transform:scale3d(.9,.9,.9) rotate(-3deg)}30%,50%,70%,90%{-webkit-transform:scale3d(1.1,1.1,1.1) rotate(3deg);transform:scale3d(1.1,1.1,1.1) rotate(3deg)}40%,60%,80%{-webkit-transform:scale3d(1.1,1.1,1.1) rotate(-3deg);transform:scale3d(1.1,1.1,1.1) rotate(-3deg)}to{-webkit-transform:scaleX(1);transform:scaleX(1)}}.tada{-webkit-animation-name:tada;animation-name:tada}@-webkit-keyframes wobble{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}15%{-webkit-transform:translate3d(-25%,0,0) rotate(-5deg);transform:translate3d(-25%,0,0) rotate(-5deg)}30%{-webkit-transform:translate3d(20%,0,0) rotate(3deg);transform:translate3d(20%,0,0) rotate(3deg)}45%{-webkit-transform:translate3d(-15%,0,0) rotate(-3deg);transform:translate3d(-15%,0,0) rotate(-3deg)}60%{-webkit-transform:translate3d(10%,0,0) rotate(2deg);transform:translate3d(10%,0,0) rotate(2deg)}75%{-webkit-transform:translate3d(-5%,0,0) rotate(-1deg);transform:translate3d(-5%,0,0) rotate(-1deg)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes wobble{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}15%{-webkit-transform:translate3d(-25%,0,0) rotate(-5deg);transform:translate3d(-25%,0,0) rotate(-5deg)}30%{-webkit-transform:translate3d(20%,0,0) rotate(3deg);transform:translate3d(20%,0,0) rotate(3deg)}45%{-webkit-transform:translate3d(-15%,0,0) rotate(-3deg);transform:translate3d(-15%,0,0) rotate(-3deg)}60%{-webkit-transform:translate3d(10%,0,0) rotate(2deg);transform:translate3d(10%,0,0) rotate(2deg)}75%{-webkit-transform:translate3d(-5%,0,0) rotate(-1deg);transform:translate3d(-5%,0,0) rotate(-1deg)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.wobble{-webkit-animation-name:wobble;animation-name:wobble}@-webkit-keyframes jello{0%,11.1%,to{-webkit-transform:translateZ(0);transform:translateZ(0)}22.2%{-webkit-transform:skewX(-12.5deg) skewY(-12.5deg);transform:skewX(-12.5deg) skewY(-12.5deg)}33.3%{-webkit-transform:skewX(6.25deg) skewY(6.25deg);transform:skewX(6.25deg) skewY(6.25deg)}44.4%{-webkit-transform:skewX(-3.125deg) skewY(-3.125deg);transform:skewX(-3.125deg) skewY(-3.125deg)}55.5%{-webkit-transform:skewX(1.5625deg) skewY(1.5625deg);transform:skewX(1.5625deg) skewY(1.5625deg)}66.6%{-webkit-transform:skewX(-.78125deg) skewY(-.78125deg);transform:skewX(-.78125deg) skewY(-.78125deg)}77.7%{-webkit-transform:skewX(.390625deg) skewY(.390625deg);transform:skewX(.390625deg) skewY(.390625deg)}88.8%{-webkit-transform:skewX(-.1953125deg) skewY(-.1953125deg);transform:skewX(-.1953125deg) skewY(-.1953125deg)}}@keyframes jello{0%,11.1%,to{-webkit-transform:translateZ(0);transform:translateZ(0)}22.2%{-webkit-transform:skewX(-12.5deg) skewY(-12.5deg);transform:skewX(-12.5deg) skewY(-12.5deg)}33.3%{-webkit-transform:skewX(6.25deg) skewY(6.25deg);transform:skewX(6.25deg) skewY(6.25deg)}44.4%{-webkit-transform:skewX(-3.125deg) skewY(-3.125deg);transform:skewX(-3.125deg) skewY(-3.125deg)}55.5%{-webkit-transform:skewX(1.5625deg) skewY(1.5625deg);transform:skewX(1.5625deg) skewY(1.5625deg)}66.6%{-webkit-transform:skewX(-.78125deg) skewY(-.78125deg);transform:skewX(-.78125deg) skewY(-.78125deg)}77.7%{-webkit-transform:skewX(.390625deg) skewY(.390625deg);transform:skewX(.390625deg) skewY(.390625deg)}88.8%{-webkit-transform:skewX(-.1953125deg) skewY(-.1953125deg);transform:skewX(-.1953125deg) skewY(-.1953125deg)}}.jello{-webkit-animation-name:jello;-webkit-transform-origin:center;animation-name:jello;transform-origin:center}@-webkit-keyframes heartBeat{0%{-webkit-transform:scale(1);transform:scale(1)}14%{-webkit-transform:scale(1.3);transform:scale(1.3)}28%{-webkit-transform:scale(1);transform:scale(1)}42%{-webkit-transform:scale(1.3);transform:scale(1.3)}70%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes heartBeat{0%{-webkit-transform:scale(1);transform:scale(1)}14%{-webkit-transform:scale(1.3);transform:scale(1.3)}28%{-webkit-transform:scale(1);transform:scale(1)}42%{-webkit-transform:scale(1.3);transform:scale(1.3)}70%{-webkit-transform:scale(1);transform:scale(1)}}.heartBeat{-webkit-animation-duration:1.3s;-webkit-animation-name:heartBeat;-webkit-animation-timing-function:ease-in-out;animation-duration:1.3s;animation-name:heartBeat;animation-timing-function:ease-in-out}@-webkit-keyframes bounceIn{0%,20%,40%,60%,80%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:scale3d(.3,.3,.3);opacity:0;transform:scale3d(.3,.3,.3)}20%{-webkit-transform:scale3d(1.1,1.1,1.1);transform:scale3d(1.1,1.1,1.1)}40%{-webkit-transform:scale3d(.9,.9,.9);transform:scale3d(.9,.9,.9)}60%{-webkit-transform:scale3d(1.03,1.03,1.03);opacity:1;transform:scale3d(1.03,1.03,1.03)}80%{-webkit-transform:scale3d(.97,.97,.97);transform:scale3d(.97,.97,.97)}to{-webkit-transform:scaleX(1);opacity:1;transform:scaleX(1)}}@keyframes bounceIn{0%,20%,40%,60%,80%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:scale3d(.3,.3,.3);opacity:0;transform:scale3d(.3,.3,.3)}20%{-webkit-transform:scale3d(1.1,1.1,1.1);transform:scale3d(1.1,1.1,1.1)}40%{-webkit-transform:scale3d(.9,.9,.9);transform:scale3d(.9,.9,.9)}60%{-webkit-transform:scale3d(1.03,1.03,1.03);opacity:1;transform:scale3d(1.03,1.03,1.03)}80%{-webkit-transform:scale3d(.97,.97,.97);transform:scale3d(.97,.97,.97)}to{-webkit-transform:scaleX(1);opacity:1;transform:scaleX(1)}}.bounceIn{-webkit-animation-duration:.75s;-webkit-animation-name:bounceIn;animation-duration:.75s;animation-name:bounceIn}@-webkit-keyframes bounceInDown{0%,60%,75%,90%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:translate3d(0,-3000px,0);opacity:0;transform:translate3d(0,-3000px,0)}60%{-webkit-transform:translate3d(0,25px,0);opacity:1;transform:translate3d(0,25px,0)}75%{-webkit-transform:translate3d(0,-10px,0);transform:translate3d(0,-10px,0)}90%{-webkit-transform:translate3d(0,5px,0);transform:translate3d(0,5px,0)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes bounceInDown{0%,60%,75%,90%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:translate3d(0,-3000px,0);opacity:0;transform:translate3d(0,-3000px,0)}60%{-webkit-transform:translate3d(0,25px,0);opacity:1;transform:translate3d(0,25px,0)}75%{-webkit-transform:translate3d(0,-10px,0);transform:translate3d(0,-10px,0)}90%{-webkit-transform:translate3d(0,5px,0);transform:translate3d(0,5px,0)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.bounceInDown{-webkit-animation-name:bounceInDown;animation-name:bounceInDown}@-webkit-keyframes bounceInLeft{0%,60%,75%,90%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:translate3d(-3000px,0,0);opacity:0;transform:translate3d(-3000px,0,0)}60%{-webkit-transform:translate3d(25px,0,0);opacity:1;transform:translate3d(25px,0,0)}75%{-webkit-transform:translate3d(-10px,0,0);transform:translate3d(-10px,0,0)}90%{-webkit-transform:translate3d(5px,0,0);transform:translate3d(5px,0,0)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes bounceInLeft{0%,60%,75%,90%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:translate3d(-3000px,0,0);opacity:0;transform:translate3d(-3000px,0,0)}60%{-webkit-transform:translate3d(25px,0,0);opacity:1;transform:translate3d(25px,0,0)}75%{-webkit-transform:translate3d(-10px,0,0);transform:translate3d(-10px,0,0)}90%{-webkit-transform:translate3d(5px,0,0);transform:translate3d(5px,0,0)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.bounceInLeft{-webkit-animation-name:bounceInLeft;animation-name:bounceInLeft}@-webkit-keyframes bounceInRight{0%,60%,75%,90%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:translate3d(3000px,0,0);opacity:0;transform:translate3d(3000px,0,0)}60%{-webkit-transform:translate3d(-25px,0,0);opacity:1;transform:translate3d(-25px,0,0)}75%{-webkit-transform:translate3d(10px,0,0);transform:translate3d(10px,0,0)}90%{-webkit-transform:translate3d(-5px,0,0);transform:translate3d(-5px,0,0)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes bounceInRight{0%,60%,75%,90%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:translate3d(3000px,0,0);opacity:0;transform:translate3d(3000px,0,0)}60%{-webkit-transform:translate3d(-25px,0,0);opacity:1;transform:translate3d(-25px,0,0)}75%{-webkit-transform:translate3d(10px,0,0);transform:translate3d(10px,0,0)}90%{-webkit-transform:translate3d(-5px,0,0);transform:translate3d(-5px,0,0)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.bounceInRight{-webkit-animation-name:bounceInRight;animation-name:bounceInRight}@-webkit-keyframes bounceInUp{0%,60%,75%,90%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:translate3d(0,3000px,0);opacity:0;transform:translate3d(0,3000px,0)}60%{-webkit-transform:translate3d(0,-20px,0);opacity:1;transform:translate3d(0,-20px,0)}75%{-webkit-transform:translate3d(0,10px,0);transform:translate3d(0,10px,0)}90%{-webkit-transform:translate3d(0,-5px,0);transform:translate3d(0,-5px,0)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes bounceInUp{0%,60%,75%,90%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{-webkit-transform:translate3d(0,3000px,0);opacity:0;transform:translate3d(0,3000px,0)}60%{-webkit-transform:translate3d(0,-20px,0);opacity:1;transform:translate3d(0,-20px,0)}75%{-webkit-transform:translate3d(0,10px,0);transform:translate3d(0,10px,0)}90%{-webkit-transform:translate3d(0,-5px,0);transform:translate3d(0,-5px,0)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.bounceInUp{-webkit-animation-name:bounceInUp;animation-name:bounceInUp}@-webkit-keyframes bounceOut{20%{-webkit-transform:scale3d(.9,.9,.9);transform:scale3d(.9,.9,.9)}50%,55%{-webkit-transform:scale3d(1.1,1.1,1.1);opacity:1;transform:scale3d(1.1,1.1,1.1)}to{-webkit-transform:scale3d(.3,.3,.3);opacity:0;transform:scale3d(.3,.3,.3)}}@keyframes bounceOut{20%{-webkit-transform:scale3d(.9,.9,.9);transform:scale3d(.9,.9,.9)}50%,55%{-webkit-transform:scale3d(1.1,1.1,1.1);opacity:1;transform:scale3d(1.1,1.1,1.1)}to{-webkit-transform:scale3d(.3,.3,.3);opacity:0;transform:scale3d(.3,.3,.3)}}.bounceOut{-webkit-animation-duration:.75s;-webkit-animation-name:bounceOut;animation-duration:.75s;animation-name:bounceOut}@-webkit-keyframes bounceOutDown{20%{-webkit-transform:translate3d(0,10px,0);transform:translate3d(0,10px,0)}40%,45%{-webkit-transform:translate3d(0,-20px,0);opacity:1;transform:translate3d(0,-20px,0)}to{-webkit-transform:translate3d(0,2000px,0);opacity:0;transform:translate3d(0,2000px,0)}}@keyframes bounceOutDown{20%{-webkit-transform:translate3d(0,10px,0);transform:translate3d(0,10px,0)}40%,45%{-webkit-transform:translate3d(0,-20px,0);opacity:1;transform:translate3d(0,-20px,0)}to{-webkit-transform:translate3d(0,2000px,0);opacity:0;transform:translate3d(0,2000px,0)}}.bounceOutDown{-webkit-animation-name:bounceOutDown;animation-name:bounceOutDown}@-webkit-keyframes bounceOutLeft{20%{-webkit-transform:translate3d(20px,0,0);opacity:1;transform:translate3d(20px,0,0)}to{-webkit-transform:translate3d(-2000px,0,0);opacity:0;transform:translate3d(-2000px,0,0)}}@keyframes bounceOutLeft{20%{-webkit-transform:translate3d(20px,0,0);opacity:1;transform:translate3d(20px,0,0)}to{-webkit-transform:translate3d(-2000px,0,0);opacity:0;transform:translate3d(-2000px,0,0)}}.bounceOutLeft{-webkit-animation-name:bounceOutLeft;animation-name:bounceOutLeft}@-webkit-keyframes bounceOutRight{20%{-webkit-transform:translate3d(-20px,0,0);opacity:1;transform:translate3d(-20px,0,0)}to{-webkit-transform:translate3d(2000px,0,0);opacity:0;transform:translate3d(2000px,0,0)}}@keyframes bounceOutRight{20%{-webkit-transform:translate3d(-20px,0,0);opacity:1;transform:translate3d(-20px,0,0)}to{-webkit-transform:translate3d(2000px,0,0);opacity:0;transform:translate3d(2000px,0,0)}}.bounceOutRight{-webkit-animation-name:bounceOutRight;animation-name:bounceOutRight}@-webkit-keyframes bounceOutUp{20%{-webkit-transform:translate3d(0,-10px,0);transform:translate3d(0,-10px,0)}40%,45%{-webkit-transform:translate3d(0,20px,0);opacity:1;transform:translate3d(0,20px,0)}to{-webkit-transform:translate3d(0,-2000px,0);opacity:0;transform:translate3d(0,-2000px,0)}}@keyframes bounceOutUp{20%{-webkit-transform:translate3d(0,-10px,0);transform:translate3d(0,-10px,0)}40%,45%{-webkit-transform:translate3d(0,20px,0);opacity:1;transform:translate3d(0,20px,0)}to{-webkit-transform:translate3d(0,-2000px,0);opacity:0;transform:translate3d(0,-2000px,0)}}.bounceOutUp{-webkit-animation-name:bounceOutUp;animation-name:bounceOutUp}@-webkit-keyframes fadeIn{0%{opacity:0}to{opacity:1}}@keyframes fadeIn{0%{opacity:0}to{opacity:1}}.fadeIn{-webkit-animation-name:fadeIn;animation-name:fadeIn}@-webkit-keyframes fadeInDown{0%{-webkit-transform:translate3d(0,-100%,0);opacity:0;transform:translate3d(0,-100%,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes fadeInDown{0%{-webkit-transform:translate3d(0,-100%,0);opacity:0;transform:translate3d(0,-100%,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.fadeInDown{-webkit-animation-name:fadeInDown;animation-name:fadeInDown}@-webkit-keyframes fadeInDownBig{0%{-webkit-transform:translate3d(0,-2000px,0);opacity:0;transform:translate3d(0,-2000px,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes fadeInDownBig{0%{-webkit-transform:translate3d(0,-2000px,0);opacity:0;transform:translate3d(0,-2000px,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.fadeInDownBig{-webkit-animation-name:fadeInDownBig;animation-name:fadeInDownBig}@-webkit-keyframes fadeInLeft{0%{-webkit-transform:translate3d(-100%,0,0);opacity:0;transform:translate3d(-100%,0,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes fadeInLeft{0%{-webkit-transform:translate3d(-100%,0,0);opacity:0;transform:translate3d(-100%,0,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.fadeInLeft{-webkit-animation-name:fadeInLeft;animation-name:fadeInLeft}@-webkit-keyframes fadeInLeftBig{0%{-webkit-transform:translate3d(-2000px,0,0);opacity:0;transform:translate3d(-2000px,0,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes fadeInLeftBig{0%{-webkit-transform:translate3d(-2000px,0,0);opacity:0;transform:translate3d(-2000px,0,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.fadeInLeftBig{-webkit-animation-name:fadeInLeftBig;animation-name:fadeInLeftBig}@-webkit-keyframes fadeInRight{0%{-webkit-transform:translate3d(100%,0,0);opacity:0;transform:translate3d(100%,0,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes fadeInRight{0%{-webkit-transform:translate3d(100%,0,0);opacity:0;transform:translate3d(100%,0,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.fadeInRight{-webkit-animation-name:fadeInRight;animation-name:fadeInRight}@-webkit-keyframes fadeInRightBig{0%{-webkit-transform:translate3d(2000px,0,0);opacity:0;transform:translate3d(2000px,0,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes fadeInRightBig{0%{-webkit-transform:translate3d(2000px,0,0);opacity:0;transform:translate3d(2000px,0,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.fadeInRightBig{-webkit-animation-name:fadeInRightBig;animation-name:fadeInRightBig}@-webkit-keyframes fadeInUp{0%{-webkit-transform:translate3d(0,100%,0);opacity:0;transform:translate3d(0,100%,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes fadeInUp{0%{-webkit-transform:translate3d(0,100%,0);opacity:0;transform:translate3d(0,100%,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.fadeInUp{-webkit-animation-name:fadeInUp;animation-name:fadeInUp}@-webkit-keyframes fadeInUpBig{0%{-webkit-transform:translate3d(0,2000px,0);opacity:0;transform:translate3d(0,2000px,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes fadeInUpBig{0%{-webkit-transform:translate3d(0,2000px,0);opacity:0;transform:translate3d(0,2000px,0)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.fadeInUpBig{-webkit-animation-name:fadeInUpBig;animation-name:fadeInUpBig}@-webkit-keyframes fadeOut{0%{opacity:1}to{opacity:0}}@keyframes fadeOut{0%{opacity:1}to{opacity:0}}.fadeOut{-webkit-animation-name:fadeOut;animation-name:fadeOut}@-webkit-keyframes fadeOutDown{0%{opacity:1}to{-webkit-transform:translate3d(0,100%,0);opacity:0;transform:translate3d(0,100%,0)}}@keyframes fadeOutDown{0%{opacity:1}to{-webkit-transform:translate3d(0,100%,0);opacity:0;transform:translate3d(0,100%,0)}}.fadeOutDown{-webkit-animation-name:fadeOutDown;animation-name:fadeOutDown}@-webkit-keyframes fadeOutDownBig{0%{opacity:1}to{-webkit-transform:translate3d(0,2000px,0);opacity:0;transform:translate3d(0,2000px,0)}}@keyframes fadeOutDownBig{0%{opacity:1}to{-webkit-transform:translate3d(0,2000px,0);opacity:0;transform:translate3d(0,2000px,0)}}.fadeOutDownBig{-webkit-animation-name:fadeOutDownBig;animation-name:fadeOutDownBig}@-webkit-keyframes fadeOutLeft{0%{opacity:1}to{-webkit-transform:translate3d(-100%,0,0);opacity:0;transform:translate3d(-100%,0,0)}}@keyframes fadeOutLeft{0%{opacity:1}to{-webkit-transform:translate3d(-100%,0,0);opacity:0;transform:translate3d(-100%,0,0)}}.fadeOutLeft{-webkit-animation-name:fadeOutLeft;animation-name:fadeOutLeft}@-webkit-keyframes fadeOutLeftBig{0%{opacity:1}to{-webkit-transform:translate3d(-2000px,0,0);opacity:0;transform:translate3d(-2000px,0,0)}}@keyframes fadeOutLeftBig{0%{opacity:1}to{-webkit-transform:translate3d(-2000px,0,0);opacity:0;transform:translate3d(-2000px,0,0)}}.fadeOutLeftBig{-webkit-animation-name:fadeOutLeftBig;animation-name:fadeOutLeftBig}@-webkit-keyframes fadeOutRight{0%{opacity:1}to{-webkit-transform:translate3d(100%,0,0);opacity:0;transform:translate3d(100%,0,0)}}@keyframes fadeOutRight{0%{opacity:1}to{-webkit-transform:translate3d(100%,0,0);opacity:0;transform:translate3d(100%,0,0)}}.fadeOutRight{-webkit-animation-name:fadeOutRight;animation-name:fadeOutRight}@-webkit-keyframes fadeOutRightBig{0%{opacity:1}to{-webkit-transform:translate3d(2000px,0,0);opacity:0;transform:translate3d(2000px,0,0)}}@keyframes fadeOutRightBig{0%{opacity:1}to{-webkit-transform:translate3d(2000px,0,0);opacity:0;transform:translate3d(2000px,0,0)}}.fadeOutRightBig{-webkit-animation-name:fadeOutRightBig;animation-name:fadeOutRightBig}@-webkit-keyframes fadeOutUp{0%{opacity:1}to{-webkit-transform:translate3d(0,-100%,0);opacity:0;transform:translate3d(0,-100%,0)}}@keyframes fadeOutUp{0%{opacity:1}to{-webkit-transform:translate3d(0,-100%,0);opacity:0;transform:translate3d(0,-100%,0)}}.fadeOutUp{-webkit-animation-name:fadeOutUp;animation-name:fadeOutUp}@-webkit-keyframes fadeOutUpBig{0%{opacity:1}to{-webkit-transform:translate3d(0,-2000px,0);opacity:0;transform:translate3d(0,-2000px,0)}}@keyframes fadeOutUpBig{0%{opacity:1}to{-webkit-transform:translate3d(0,-2000px,0);opacity:0;transform:translate3d(0,-2000px,0)}}.fadeOutUpBig{-webkit-animation-name:fadeOutUpBig;animation-name:fadeOutUpBig}@-webkit-keyframes flip{0%{-webkit-animation-timing-function:ease-out;-webkit-transform:perspective(400px) scaleX(1) translateZ(0) rotateY(-1turn);animation-timing-function:ease-out;transform:perspective(400px) scaleX(1) translateZ(0) rotateY(-1turn)}40%{-webkit-animation-timing-function:ease-out;-webkit-transform:perspective(400px) scaleX(1) translateZ(150px) rotateY(-190deg);animation-timing-function:ease-out;transform:perspective(400px) scaleX(1) translateZ(150px) rotateY(-190deg)}50%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) scaleX(1) translateZ(150px) rotateY(-170deg);animation-timing-function:ease-in;transform:perspective(400px) scaleX(1) translateZ(150px) rotateY(-170deg)}80%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) scale3d(.95,.95,.95) translateZ(0) rotateY(0deg);animation-timing-function:ease-in;transform:perspective(400px) scale3d(.95,.95,.95) translateZ(0) rotateY(0deg)}to{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) scaleX(1) translateZ(0) rotateY(0deg);animation-timing-function:ease-in;transform:perspective(400px) scaleX(1) translateZ(0) rotateY(0deg)}}@keyframes flip{0%{-webkit-animation-timing-function:ease-out;-webkit-transform:perspective(400px) scaleX(1) translateZ(0) rotateY(-1turn);animation-timing-function:ease-out;transform:perspective(400px) scaleX(1) translateZ(0) rotateY(-1turn)}40%{-webkit-animation-timing-function:ease-out;-webkit-transform:perspective(400px) scaleX(1) translateZ(150px) rotateY(-190deg);animation-timing-function:ease-out;transform:perspective(400px) scaleX(1) translateZ(150px) rotateY(-190deg)}50%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) scaleX(1) translateZ(150px) rotateY(-170deg);animation-timing-function:ease-in;transform:perspective(400px) scaleX(1) translateZ(150px) rotateY(-170deg)}80%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) scale3d(.95,.95,.95) translateZ(0) rotateY(0deg);animation-timing-function:ease-in;transform:perspective(400px) scale3d(.95,.95,.95) translateZ(0) rotateY(0deg)}to{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) scaleX(1) translateZ(0) rotateY(0deg);animation-timing-function:ease-in;transform:perspective(400px) scaleX(1) translateZ(0) rotateY(0deg)}}.animated.flip{-webkit-animation-name:flip;-webkit-backface-visibility:visible;animation-name:flip;backface-visibility:visible}@-webkit-keyframes flipInX{0%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) rotateX(90deg);animation-timing-function:ease-in;opacity:0;transform:perspective(400px) rotateX(90deg)}40%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) rotateX(-20deg);animation-timing-function:ease-in;transform:perspective(400px) rotateX(-20deg)}60%{-webkit-transform:perspective(400px) rotateX(10deg);opacity:1;transform:perspective(400px) rotateX(10deg)}80%{-webkit-transform:perspective(400px) rotateX(-5deg);transform:perspective(400px) rotateX(-5deg)}to{-webkit-transform:perspective(400px);transform:perspective(400px)}}@keyframes flipInX{0%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) rotateX(90deg);animation-timing-function:ease-in;opacity:0;transform:perspective(400px) rotateX(90deg)}40%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) rotateX(-20deg);animation-timing-function:ease-in;transform:perspective(400px) rotateX(-20deg)}60%{-webkit-transform:perspective(400px) rotateX(10deg);opacity:1;transform:perspective(400px) rotateX(10deg)}80%{-webkit-transform:perspective(400px) rotateX(-5deg);transform:perspective(400px) rotateX(-5deg)}to{-webkit-transform:perspective(400px);transform:perspective(400px)}}.flipInX{-webkit-animation-name:flipInX;-webkit-backface-visibility:visible!important;animation-name:flipInX;backface-visibility:visible!important}@-webkit-keyframes flipInY{0%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) rotateY(90deg);animation-timing-function:ease-in;opacity:0;transform:perspective(400px) rotateY(90deg)}40%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) rotateY(-20deg);animation-timing-function:ease-in;transform:perspective(400px) rotateY(-20deg)}60%{-webkit-transform:perspective(400px) rotateY(10deg);opacity:1;transform:perspective(400px) rotateY(10deg)}80%{-webkit-transform:perspective(400px) rotateY(-5deg);transform:perspective(400px) rotateY(-5deg)}to{-webkit-transform:perspective(400px);transform:perspective(400px)}}@keyframes flipInY{0%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) rotateY(90deg);animation-timing-function:ease-in;opacity:0;transform:perspective(400px) rotateY(90deg)}40%{-webkit-animation-timing-function:ease-in;-webkit-transform:perspective(400px) rotateY(-20deg);animation-timing-function:ease-in;transform:perspective(400px) rotateY(-20deg)}60%{-webkit-transform:perspective(400px) rotateY(10deg);opacity:1;transform:perspective(400px) rotateY(10deg)}80%{-webkit-transform:perspective(400px) rotateY(-5deg);transform:perspective(400px) rotateY(-5deg)}to{-webkit-transform:perspective(400px);transform:perspective(400px)}}.flipInY{-webkit-animation-name:flipInY;-webkit-backface-visibility:visible!important;animation-name:flipInY;backface-visibility:visible!important}@-webkit-keyframes flipOutX{0%{-webkit-transform:perspective(400px);transform:perspective(400px)}30%{-webkit-transform:perspective(400px) rotateX(-20deg);opacity:1;transform:perspective(400px) rotateX(-20deg)}to{-webkit-transform:perspective(400px) rotateX(90deg);opacity:0;transform:perspective(400px) rotateX(90deg)}}@keyframes flipOutX{0%{-webkit-transform:perspective(400px);transform:perspective(400px)}30%{-webkit-transform:perspective(400px) rotateX(-20deg);opacity:1;transform:perspective(400px) rotateX(-20deg)}to{-webkit-transform:perspective(400px) rotateX(90deg);opacity:0;transform:perspective(400px) rotateX(90deg)}}.flipOutX{-webkit-animation-duration:.75s;-webkit-animation-name:flipOutX;-webkit-backface-visibility:visible!important;animation-duration:.75s;animation-name:flipOutX;backface-visibility:visible!important}@-webkit-keyframes flipOutY{0%{-webkit-transform:perspective(400px);transform:perspective(400px)}30%{-webkit-transform:perspective(400px) rotateY(-15deg);opacity:1;transform:perspective(400px) rotateY(-15deg)}to{-webkit-transform:perspective(400px) rotateY(90deg);opacity:0;transform:perspective(400px) rotateY(90deg)}}@keyframes flipOutY{0%{-webkit-transform:perspective(400px);transform:perspective(400px)}30%{-webkit-transform:perspective(400px) rotateY(-15deg);opacity:1;transform:perspective(400px) rotateY(-15deg)}to{-webkit-transform:perspective(400px) rotateY(90deg);opacity:0;transform:perspective(400px) rotateY(90deg)}}.flipOutY{-webkit-animation-duration:.75s;-webkit-animation-name:flipOutY;-webkit-backface-visibility:visible!important;animation-duration:.75s;animation-name:flipOutY;backface-visibility:visible!important}@-webkit-keyframes lightSpeedIn{0%{-webkit-transform:translate3d(100%,0,0) skewX(-30deg);opacity:0;transform:translate3d(100%,0,0) skewX(-30deg)}60%{-webkit-transform:skewX(20deg);opacity:1;transform:skewX(20deg)}80%{-webkit-transform:skewX(-5deg);transform:skewX(-5deg)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes lightSpeedIn{0%{-webkit-transform:translate3d(100%,0,0) skewX(-30deg);opacity:0;transform:translate3d(100%,0,0) skewX(-30deg)}60%{-webkit-transform:skewX(20deg);opacity:1;transform:skewX(20deg)}80%{-webkit-transform:skewX(-5deg);transform:skewX(-5deg)}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.lightSpeedIn{-webkit-animation-name:lightSpeedIn;-webkit-animation-timing-function:ease-out;animation-name:lightSpeedIn;animation-timing-function:ease-out}@-webkit-keyframes lightSpeedOut{0%{opacity:1}to{-webkit-transform:translate3d(100%,0,0) skewX(30deg);opacity:0;transform:translate3d(100%,0,0) skewX(30deg)}}@keyframes lightSpeedOut{0%{opacity:1}to{-webkit-transform:translate3d(100%,0,0) skewX(30deg);opacity:0;transform:translate3d(100%,0,0) skewX(30deg)}}.lightSpeedOut{-webkit-animation-name:lightSpeedOut;-webkit-animation-timing-function:ease-in;animation-name:lightSpeedOut;animation-timing-function:ease-in}@-webkit-keyframes rotateIn{0%{-webkit-transform:rotate(-200deg);-webkit-transform-origin:center;opacity:0;transform:rotate(-200deg);transform-origin:center}to{-webkit-transform:translateZ(0);-webkit-transform-origin:center;opacity:1;transform:translateZ(0);transform-origin:center}}@keyframes rotateIn{0%{-webkit-transform:rotate(-200deg);-webkit-transform-origin:center;opacity:0;transform:rotate(-200deg);transform-origin:center}to{-webkit-transform:translateZ(0);-webkit-transform-origin:center;opacity:1;transform:translateZ(0);transform-origin:center}}.rotateIn{-webkit-animation-name:rotateIn;animation-name:rotateIn}@-webkit-keyframes rotateInDownLeft{0%{-webkit-transform:rotate(-45deg);-webkit-transform-origin:left bottom;opacity:0;transform:rotate(-45deg);transform-origin:left bottom}to{-webkit-transform:translateZ(0);-webkit-transform-origin:left bottom;opacity:1;transform:translateZ(0);transform-origin:left bottom}}@keyframes rotateInDownLeft{0%{-webkit-transform:rotate(-45deg);-webkit-transform-origin:left bottom;opacity:0;transform:rotate(-45deg);transform-origin:left bottom}to{-webkit-transform:translateZ(0);-webkit-transform-origin:left bottom;opacity:1;transform:translateZ(0);transform-origin:left bottom}}.rotateInDownLeft{-webkit-animation-name:rotateInDownLeft;animation-name:rotateInDownLeft}@-webkit-keyframes rotateInDownRight{0%{-webkit-transform:rotate(45deg);-webkit-transform-origin:right bottom;opacity:0;transform:rotate(45deg);transform-origin:right bottom}to{-webkit-transform:translateZ(0);-webkit-transform-origin:right bottom;opacity:1;transform:translateZ(0);transform-origin:right bottom}}@keyframes rotateInDownRight{0%{-webkit-transform:rotate(45deg);-webkit-transform-origin:right bottom;opacity:0;transform:rotate(45deg);transform-origin:right bottom}to{-webkit-transform:translateZ(0);-webkit-transform-origin:right bottom;opacity:1;transform:translateZ(0);transform-origin:right bottom}}.rotateInDownRight{-webkit-animation-name:rotateInDownRight;animation-name:rotateInDownRight}@-webkit-keyframes rotateInUpLeft{0%{-webkit-transform:rotate(45deg);-webkit-transform-origin:left bottom;opacity:0;transform:rotate(45deg);transform-origin:left bottom}to{-webkit-transform:translateZ(0);-webkit-transform-origin:left bottom;opacity:1;transform:translateZ(0);transform-origin:left bottom}}@keyframes rotateInUpLeft{0%{-webkit-transform:rotate(45deg);-webkit-transform-origin:left bottom;opacity:0;transform:rotate(45deg);transform-origin:left bottom}to{-webkit-transform:translateZ(0);-webkit-transform-origin:left bottom;opacity:1;transform:translateZ(0);transform-origin:left bottom}}.rotateInUpLeft{-webkit-animation-name:rotateInUpLeft;animation-name:rotateInUpLeft}@-webkit-keyframes rotateInUpRight{0%{-webkit-transform:rotate(-90deg);-webkit-transform-origin:right bottom;opacity:0;transform:rotate(-90deg);transform-origin:right bottom}to{-webkit-transform:translateZ(0);-webkit-transform-origin:right bottom;opacity:1;transform:translateZ(0);transform-origin:right bottom}}@keyframes rotateInUpRight{0%{-webkit-transform:rotate(-90deg);-webkit-transform-origin:right bottom;opacity:0;transform:rotate(-90deg);transform-origin:right bottom}to{-webkit-transform:translateZ(0);-webkit-transform-origin:right bottom;opacity:1;transform:translateZ(0);transform-origin:right bottom}}.rotateInUpRight{-webkit-animation-name:rotateInUpRight;animation-name:rotateInUpRight}@-webkit-keyframes rotateOut{0%{-webkit-transform-origin:center;opacity:1;transform-origin:center}to{-webkit-transform:rotate(200deg);-webkit-transform-origin:center;opacity:0;transform:rotate(200deg);transform-origin:center}}@keyframes rotateOut{0%{-webkit-transform-origin:center;opacity:1;transform-origin:center}to{-webkit-transform:rotate(200deg);-webkit-transform-origin:center;opacity:0;transform:rotate(200deg);transform-origin:center}}.rotateOut{-webkit-animation-name:rotateOut;animation-name:rotateOut}@-webkit-keyframes rotateOutDownLeft{0%{-webkit-transform-origin:left bottom;opacity:1;transform-origin:left bottom}to{-webkit-transform:rotate(45deg);-webkit-transform-origin:left bottom;opacity:0;transform:rotate(45deg);transform-origin:left bottom}}@keyframes rotateOutDownLeft{0%{-webkit-transform-origin:left bottom;opacity:1;transform-origin:left bottom}to{-webkit-transform:rotate(45deg);-webkit-transform-origin:left bottom;opacity:0;transform:rotate(45deg);transform-origin:left bottom}}.rotateOutDownLeft{-webkit-animation-name:rotateOutDownLeft;animation-name:rotateOutDownLeft}@-webkit-keyframes rotateOutDownRight{0%{-webkit-transform-origin:right bottom;opacity:1;transform-origin:right bottom}to{-webkit-transform:rotate(-45deg);-webkit-transform-origin:right bottom;opacity:0;transform:rotate(-45deg);transform-origin:right bottom}}@keyframes rotateOutDownRight{0%{-webkit-transform-origin:right bottom;opacity:1;transform-origin:right bottom}to{-webkit-transform:rotate(-45deg);-webkit-transform-origin:right bottom;opacity:0;transform:rotate(-45deg);transform-origin:right bottom}}.rotateOutDownRight{-webkit-animation-name:rotateOutDownRight;animation-name:rotateOutDownRight}@-webkit-keyframes rotateOutUpLeft{0%{-webkit-transform-origin:left bottom;opacity:1;transform-origin:left bottom}to{-webkit-transform:rotate(-45deg);-webkit-transform-origin:left bottom;opacity:0;transform:rotate(-45deg);transform-origin:left bottom}}@keyframes rotateOutUpLeft{0%{-webkit-transform-origin:left bottom;opacity:1;transform-origin:left bottom}to{-webkit-transform:rotate(-45deg);-webkit-transform-origin:left bottom;opacity:0;transform:rotate(-45deg);transform-origin:left bottom}}.rotateOutUpLeft{-webkit-animation-name:rotateOutUpLeft;animation-name:rotateOutUpLeft}@-webkit-keyframes rotateOutUpRight{0%{-webkit-transform-origin:right bottom;opacity:1;transform-origin:right bottom}to{-webkit-transform:rotate(90deg);-webkit-transform-origin:right bottom;opacity:0;transform:rotate(90deg);transform-origin:right bottom}}@keyframes rotateOutUpRight{0%{-webkit-transform-origin:right bottom;opacity:1;transform-origin:right bottom}to{-webkit-transform:rotate(90deg);-webkit-transform-origin:right bottom;opacity:0;transform:rotate(90deg);transform-origin:right bottom}}.rotateOutUpRight{-webkit-animation-name:rotateOutUpRight;animation-name:rotateOutUpRight}@-webkit-keyframes hinge{0%{-webkit-animation-timing-function:ease-in-out;-webkit-transform-origin:top left;animation-timing-function:ease-in-out;transform-origin:top left}20%,60%{-webkit-animation-timing-function:ease-in-out;-webkit-transform:rotate(80deg);-webkit-transform-origin:top left;animation-timing-function:ease-in-out;transform:rotate(80deg);transform-origin:top left}40%,80%{-webkit-animation-timing-function:ease-in-out;-webkit-transform:rotate(60deg);-webkit-transform-origin:top left;animation-timing-function:ease-in-out;opacity:1;transform:rotate(60deg);transform-origin:top left}to{-webkit-transform:translate3d(0,700px,0);opacity:0;transform:translate3d(0,700px,0)}}@keyframes hinge{0%{-webkit-animation-timing-function:ease-in-out;-webkit-transform-origin:top left;animation-timing-function:ease-in-out;transform-origin:top left}20%,60%{-webkit-animation-timing-function:ease-in-out;-webkit-transform:rotate(80deg);-webkit-transform-origin:top left;animation-timing-function:ease-in-out;transform:rotate(80deg);transform-origin:top left}40%,80%{-webkit-animation-timing-function:ease-in-out;-webkit-transform:rotate(60deg);-webkit-transform-origin:top left;animation-timing-function:ease-in-out;opacity:1;transform:rotate(60deg);transform-origin:top left}to{-webkit-transform:translate3d(0,700px,0);opacity:0;transform:translate3d(0,700px,0)}}.hinge{-webkit-animation-duration:2s;-webkit-animation-name:hinge;animation-duration:2s;animation-name:hinge}@-webkit-keyframes jackInTheBox{0%{-webkit-transform:scale(.1) rotate(30deg);-webkit-transform-origin:center bottom;opacity:0;transform:scale(.1) rotate(30deg);transform-origin:center bottom}50%{-webkit-transform:rotate(-10deg);transform:rotate(-10deg)}70%{-webkit-transform:rotate(3deg);transform:rotate(3deg)}to{-webkit-transform:scale(1);opacity:1;transform:scale(1)}}@keyframes jackInTheBox{0%{-webkit-transform:scale(.1) rotate(30deg);-webkit-transform-origin:center bottom;opacity:0;transform:scale(.1) rotate(30deg);transform-origin:center bottom}50%{-webkit-transform:rotate(-10deg);transform:rotate(-10deg)}70%{-webkit-transform:rotate(3deg);transform:rotate(3deg)}to{-webkit-transform:scale(1);opacity:1;transform:scale(1)}}.jackInTheBox{-webkit-animation-name:jackInTheBox;animation-name:jackInTheBox}@-webkit-keyframes rollIn{0%{-webkit-transform:translate3d(-100%,0,0) rotate(-120deg);opacity:0;transform:translate3d(-100%,0,0) rotate(-120deg)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}@keyframes rollIn{0%{-webkit-transform:translate3d(-100%,0,0) rotate(-120deg);opacity:0;transform:translate3d(-100%,0,0) rotate(-120deg)}to{-webkit-transform:translateZ(0);opacity:1;transform:translateZ(0)}}.rollIn{-webkit-animation-name:rollIn;animation-name:rollIn}@-webkit-keyframes rollOut{0%{opacity:1}to{-webkit-transform:translate3d(100%,0,0) rotate(120deg);opacity:0;transform:translate3d(100%,0,0) rotate(120deg)}}@keyframes rollOut{0%{opacity:1}to{-webkit-transform:translate3d(100%,0,0) rotate(120deg);opacity:0;transform:translate3d(100%,0,0) rotate(120deg)}}.rollOut{-webkit-animation-name:rollOut;animation-name:rollOut}@-webkit-keyframes zoomIn{0%{-webkit-transform:scale3d(.3,.3,.3);opacity:0;transform:scale3d(.3,.3,.3)}50%{opacity:1}}@keyframes zoomIn{0%{-webkit-transform:scale3d(.3,.3,.3);opacity:0;transform:scale3d(.3,.3,.3)}50%{opacity:1}}.zoomIn{-webkit-animation-name:zoomIn;animation-name:zoomIn}@-webkit-keyframes zoomInDown{0%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.1,.1,.1) translate3d(0,-1000px,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:0;transform:scale3d(.1,.1,.1) translate3d(0,-1000px,0)}60%{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.475,.475,.475) translate3d(0,60px,0);animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:1;transform:scale3d(.475,.475,.475) translate3d(0,60px,0)}}@keyframes zoomInDown{0%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.1,.1,.1) translate3d(0,-1000px,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:0;transform:scale3d(.1,.1,.1) translate3d(0,-1000px,0)}60%{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.475,.475,.475) translate3d(0,60px,0);animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:1;transform:scale3d(.475,.475,.475) translate3d(0,60px,0)}}.zoomInDown{-webkit-animation-name:zoomInDown;animation-name:zoomInDown}@-webkit-keyframes zoomInLeft{0%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.1,.1,.1) translate3d(-1000px,0,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:0;transform:scale3d(.1,.1,.1) translate3d(-1000px,0,0)}60%{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.475,.475,.475) translate3d(10px,0,0);animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:1;transform:scale3d(.475,.475,.475) translate3d(10px,0,0)}}@keyframes zoomInLeft{0%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.1,.1,.1) translate3d(-1000px,0,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:0;transform:scale3d(.1,.1,.1) translate3d(-1000px,0,0)}60%{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.475,.475,.475) translate3d(10px,0,0);animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:1;transform:scale3d(.475,.475,.475) translate3d(10px,0,0)}}.zoomInLeft{-webkit-animation-name:zoomInLeft;animation-name:zoomInLeft}@-webkit-keyframes zoomInRight{0%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.1,.1,.1) translate3d(1000px,0,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:0;transform:scale3d(.1,.1,.1) translate3d(1000px,0,0)}60%{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.475,.475,.475) translate3d(-10px,0,0);animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:1;transform:scale3d(.475,.475,.475) translate3d(-10px,0,0)}}@keyframes zoomInRight{0%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.1,.1,.1) translate3d(1000px,0,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:0;transform:scale3d(.1,.1,.1) translate3d(1000px,0,0)}60%{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.475,.475,.475) translate3d(-10px,0,0);animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:1;transform:scale3d(.475,.475,.475) translate3d(-10px,0,0)}}.zoomInRight{-webkit-animation-name:zoomInRight;animation-name:zoomInRight}@-webkit-keyframes zoomInUp{0%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.1,.1,.1) translate3d(0,1000px,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:0;transform:scale3d(.1,.1,.1) translate3d(0,1000px,0)}60%{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.475,.475,.475) translate3d(0,-60px,0);animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:1;transform:scale3d(.475,.475,.475) translate3d(0,-60px,0)}}@keyframes zoomInUp{0%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.1,.1,.1) translate3d(0,1000px,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:0;transform:scale3d(.1,.1,.1) translate3d(0,1000px,0)}60%{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.475,.475,.475) translate3d(0,-60px,0);animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:1;transform:scale3d(.475,.475,.475) translate3d(0,-60px,0)}}.zoomInUp{-webkit-animation-name:zoomInUp;animation-name:zoomInUp}@-webkit-keyframes zoomOut{0%{opacity:1}50%{-webkit-transform:scale3d(.3,.3,.3);opacity:0;transform:scale3d(.3,.3,.3)}to{opacity:0}}@keyframes zoomOut{0%{opacity:1}50%{-webkit-transform:scale3d(.3,.3,.3);opacity:0;transform:scale3d(.3,.3,.3)}to{opacity:0}}.zoomOut{-webkit-animation-name:zoomOut;animation-name:zoomOut}@-webkit-keyframes zoomOutDown{40%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.475,.475,.475) translate3d(0,-60px,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:1;transform:scale3d(.475,.475,.475) translate3d(0,-60px,0)}to{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.1,.1,.1) translate3d(0,2000px,0);-webkit-transform-origin:center bottom;animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:0;transform:scale3d(.1,.1,.1) translate3d(0,2000px,0);transform-origin:center bottom}}@keyframes zoomOutDown{40%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.475,.475,.475) translate3d(0,-60px,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:1;transform:scale3d(.475,.475,.475) translate3d(0,-60px,0)}to{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.1,.1,.1) translate3d(0,2000px,0);-webkit-transform-origin:center bottom;animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:0;transform:scale3d(.1,.1,.1) translate3d(0,2000px,0);transform-origin:center bottom}}.zoomOutDown{-webkit-animation-name:zoomOutDown;animation-name:zoomOutDown}@-webkit-keyframes zoomOutLeft{40%{-webkit-transform:scale3d(.475,.475,.475) translate3d(42px,0,0);opacity:1;transform:scale3d(.475,.475,.475) translate3d(42px,0,0)}to{-webkit-transform:scale(.1) translate3d(-2000px,0,0);-webkit-transform-origin:left center;opacity:0;transform:scale(.1) translate3d(-2000px,0,0);transform-origin:left center}}@keyframes zoomOutLeft{40%{-webkit-transform:scale3d(.475,.475,.475) translate3d(42px,0,0);opacity:1;transform:scale3d(.475,.475,.475) translate3d(42px,0,0)}to{-webkit-transform:scale(.1) translate3d(-2000px,0,0);-webkit-transform-origin:left center;opacity:0;transform:scale(.1) translate3d(-2000px,0,0);transform-origin:left center}}.zoomOutLeft{-webkit-animation-name:zoomOutLeft;animation-name:zoomOutLeft}@-webkit-keyframes zoomOutRight{40%{-webkit-transform:scale3d(.475,.475,.475) translate3d(-42px,0,0);opacity:1;transform:scale3d(.475,.475,.475) translate3d(-42px,0,0)}to{-webkit-transform:scale(.1) translate3d(2000px,0,0);-webkit-transform-origin:right center;opacity:0;transform:scale(.1) translate3d(2000px,0,0);transform-origin:right center}}@keyframes zoomOutRight{40%{-webkit-transform:scale3d(.475,.475,.475) translate3d(-42px,0,0);opacity:1;transform:scale3d(.475,.475,.475) translate3d(-42px,0,0)}to{-webkit-transform:scale(.1) translate3d(2000px,0,0);-webkit-transform-origin:right center;opacity:0;transform:scale(.1) translate3d(2000px,0,0);transform-origin:right center}}.zoomOutRight{-webkit-animation-name:zoomOutRight;animation-name:zoomOutRight}@-webkit-keyframes zoomOutUp{40%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.475,.475,.475) translate3d(0,60px,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:1;transform:scale3d(.475,.475,.475) translate3d(0,60px,0)}to{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.1,.1,.1) translate3d(0,-2000px,0);-webkit-transform-origin:center bottom;animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:0;transform:scale3d(.1,.1,.1) translate3d(0,-2000px,0);transform-origin:center bottom}}@keyframes zoomOutUp{40%{-webkit-animation-timing-function:cubic-bezier(.55,.055,.675,.19);-webkit-transform:scale3d(.475,.475,.475) translate3d(0,60px,0);animation-timing-function:cubic-bezier(.55,.055,.675,.19);opacity:1;transform:scale3d(.475,.475,.475) translate3d(0,60px,0)}to{-webkit-animation-timing-function:cubic-bezier(.175,.885,.32,1);-webkit-transform:scale3d(.1,.1,.1) translate3d(0,-2000px,0);-webkit-transform-origin:center bottom;animation-timing-function:cubic-bezier(.175,.885,.32,1);opacity:0;transform:scale3d(.1,.1,.1) translate3d(0,-2000px,0);transform-origin:center bottom}}.zoomOutUp{-webkit-animation-name:zoomOutUp;animation-name:zoomOutUp}@-webkit-keyframes slideInDown{0%{-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0);visibility:visible}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes slideInDown{0%{-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0);visibility:visible}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.slideInDown{-webkit-animation-name:slideInDown;animation-name:slideInDown}@-webkit-keyframes slideInLeft{0%{-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0);visibility:visible}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes slideInLeft{0%{-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0);visibility:visible}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.slideInLeft{-webkit-animation-name:slideInLeft;animation-name:slideInLeft}@-webkit-keyframes slideInRight{0%{-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0);visibility:visible}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes slideInRight{0%{-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0);visibility:visible}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.slideInRight{-webkit-animation-name:slideInRight;animation-name:slideInRight}@-webkit-keyframes slideInUp{0%{-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0);visibility:visible}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}@keyframes slideInUp{0%{-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0);visibility:visible}to{-webkit-transform:translateZ(0);transform:translateZ(0)}}.slideInUp{-webkit-animation-name:slideInUp;animation-name:slideInUp}@-webkit-keyframes slideOutDown{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}to{-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0);visibility:hidden}}@keyframes slideOutDown{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}to{-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0);visibility:hidden}}.slideOutDown{-webkit-animation-name:slideOutDown;animation-name:slideOutDown}@-webkit-keyframes slideOutLeft{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}to{-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0);visibility:hidden}}@keyframes slideOutLeft{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}to{-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0);visibility:hidden}}.slideOutLeft{-webkit-animation-name:slideOutLeft;animation-name:slideOutLeft}@-webkit-keyframes slideOutRight{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}to{-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0);visibility:hidden}}@keyframes slideOutRight{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}to{-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0);visibility:hidden}}.slideOutRight{-webkit-animation-name:slideOutRight;animation-name:slideOutRight}@-webkit-keyframes slideOutUp{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}to{-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0);visibility:hidden}}@keyframes slideOutUp{0%{-webkit-transform:translateZ(0);transform:translateZ(0)}to{-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0);visibility:hidden}}.slideOutUp{-webkit-animation-name:slideOutUp;animation-name:slideOutUp}.animated{-webkit-animation-duration:1s;-webkit-animation-fill-mode:both;animation-duration:1s;animation-fill-mode:both}.animated.infinite{-webkit-animation-iteration-count:infinite;animation-iteration-count:infinite}.animated.delay-1s{-webkit-animation-delay:1s;animation-delay:1s}.animated.delay-2s{-webkit-animation-delay:2s;animation-delay:2s}.animated.delay-3s{-webkit-animation-delay:3s;animation-delay:3s}.animated.delay-4s{-webkit-animation-delay:4s;animation-delay:4s}.animated.delay-5s{-webkit-animation-delay:5s;animation-delay:5s}.animated.fast{-webkit-animation-duration:.8s;animation-duration:.8s}.animated.faster{-webkit-animation-duration:.5s;animation-duration:.5s}.animated.slow{-webkit-animation-duration:2s;animation-duration:2s}.animated.slower{-webkit-animation-duration:3s;animation-duration:3s}@media (prefers-reduced-motion),(print){.animated{-webkit-animation:unset!important;-webkit-transition:none!important;animation:unset!important;transition:none!important}}



/* Pagelayer Pen editor*/
.pagelayer-pen{
-webkit-user-select: text;
user-select: text;
}

.pagelayer-pen-holder{
font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
background-color: #ffffff;
position: fixed;
z-index: 9999999999;
top: 50px;
left: 0;
transform: translateY(-100%);
box-shadow: 0 4px 5px 0 rgb(0 0 0 / 14%), 0 1px 10px 0 rgb(0 0 0 / 12%), 0 2px 4px -1px rgb(0 0 0 / 20%);
border-radius: 2px;
line-height: 1;
padding: 8px 2px;
font-size: 15px !important;
display: none;
}

.pagelayer-pen-toolbar{
font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
box-sizing: border-box;
width: max-content;
max-width: 90vw;
background: none;
cursor: pointer;
}

.pagelayer-pen-toolbar .pagelayer-pen-formats{
display: inline-block;
vertical-align: middle;
padding-right: 7px;
padding-left: 7px;
border-left:1px solid #ccc;
font-weight: 700;
}

.pagelayer-pen-toolbar button{
background: none;
border: none;
cursor: pointer;
display: inline-block;
float: left;
height: 24px;
padding: 3px 5px;
width: 28px;
font-size: 14px !important;
font-weight: 700 !important;
color: #444;
}

.pagelayer-pen-toolbar button strong{
font-weight: bold !important;	
}

.pagelayer-pen-toolbar .pagelayer-pen-formats:first-child {
padding-left: 0px !important;
border-left: 0px;
}
/* Start Dropdown picker*/
.pagelayer-pen-picker{
color: #444;
display: inline-block;
float: left;
height: 24px;
position: relative;
vertical-align: middle;
padding:3px 5px;
font-size: 14px !important;
font-weight: 500 !important;
}

.pagelayer-pen-picker-label {
cursor: pointer;
display: inline-block;
height: 100%;
position: relative;
width: 100%;
}

.pagelayer-pen-picker .pagelayer-pen-picker-label:after {
content: "\f0dc";
padding-left: 15px;
font-weight: 600;
font-family: "Font Awesome 5 Free";
font-size: 12px;
}

.pagelayer-pen-picker.pagelayer-pen-font .pagelayer-pen-picker-label:after,
.pagelayer-pen-picker.pagelayer-pen-lineheight .pagelayer-pen-picker-label:after,
.pagelayer-pen-picker.pagelayer-pen-color-picker .pagelayer-pen-picker-label:after {
content: "";
padding-left: 0;
}

.pagelayer-pen-picker-label::before {
display: inline-block;
}

.pagelayer-pen-picker-options {
background-color: #fff;
display: none;
min-width: 100%;
padding: 4px 8px;
position: absolute;
white-space: nowrap;
margin-left: -8px;
max-height: 200px;
overflow: auto;
}

.pagelayer-pen-picker-options::-webkit-scrollbar {
width:3px;
}

.pagelayer-pen-picker-options::-webkit-scrollbar-track {
background: #f1f1f1; 
}

.pagelayer-pen-picker-options::-webkit-scrollbar-thumb {
background: #888; 
}

.pagelayer-pen-picker-options::-webkit-scrollbar-thumb:hover {
background: #555;
cursor:context-menu;
}

.pagelayer-pen-picker-options .pagelayer-pen-picker-item {
cursor: pointer;
display: block;
padding-bottom: 5px;
padding-top: 5px;
}

.pagelayer-pen-picker.pagelayer-pen-expanded .pagelayer-pen-picker-label {
color: #ccc;
z-index: 2;
}

.pagelayer-pen-picker.pagelayer-pen-expanded .pagelayer-pen-picker-label .pagelayer-pen-fill {
fill: #ccc;
}

.pagelayer-pen-picker.pagelayer-pen-expanded .pagelayer-pen-picker-label .pagelayer-pen-stroke {
stroke: #ccc;
}

.pagelayer-pen-picker.pagelayer-pen-expanded .pagelayer-pen-picker-options {
display: block;
margin-top: -1px;
top: 100%;
z-index: 1;
box-shadow: 0px 0px 1px 1px #e4e4e4;
}

.pagelayer-pen-color-picker .pagelayer-pen-picker-labe{
padding: 2px 4px;
}

.pagelayer-pen-icon-picker .pagelayer-pen-picker-options {
padding: 4px 0px;
}

.pagelayer-pen-icon-picker .pagelayer-pen-picker-item {
height: 24px;
width: 24px;
padding: 2px 4px;
}

.pagelayer-pen-color-picker .pagelayer-pen-picker-options {
padding: 3px 5px;
width: 152px;
}

.pagelayer-pen-color-picker .pagelayer-pen-picker-item {
border: 1px solid transparent;
float: left;
height: 16px;
margin: 2px;
padding: 0px;
width: 16px;
}

.pagelayer-pen-size-picker .pagelayer-pen-picker-label:before,
.pagelayer-pen-picker:not(.pagelayer-pen-color-picker) .pagelayer-pen-picker-item:empty:before{
content: attr(data-value);
}

.pagelayer-pen-link-tooltip > *{
margin:0 2px;
}

.pagelayer-pen-link-tooltip input{
min-width: 300px;
font-size: 13px;
padding: 5px;
}

.pagelayer-pen-unlink-btn,
.pagelayer-pen-link-btn{
padding: 7px;
cursor: pointer;
border-radius: 4px;
font-size: 13px;
}

/* End Dropdown picker*/
/* Start HTML viewer*/
.pagelayer-pen-html-viewer{
position: fixed;
top: 0;
bottom: 0;
left: 0;
right: 0;
display: none;
background: #0000009c;
z-index:999999;
}

.pagelayer-pen-html-viewer .pagelayer-pen-html-holder{
width: 90%;
height: 80vh;
margin: auto;
top: 50%;
position: relative;
transform: translateY(-50%);
background: #fff;
box-shadow: 0px 0px 7px 0px #fff;
}

.pagelayer-pen-html-viewer .pagelayer-pen-html-area{
resize: none;
width: 100%;
height: calc(100% - 50px);
border-radius: 0;
padding: 10px;
font-family: courier, courier new, serif;
line-height: 1.5;
}

.pagelayer-pen-html-viewer .pagelayer-pen-html-btn{
height: 40px;
text-align: center;
display: flex;
align-items: center;
justify-content: center;
}

.pagelayer-pen-html-viewer .pagelayer-pen-html-btn button{
margin-right: 10px;
padding: 7px 20px !important;
font-size: 15px !important;
}

.pagelayer-pen-html-viewer .pagelayer-pen-html-area:focus{
border:none;
outline:none;
}

/* End HTML viewer*/
.pagelayer-pen-toolbar .pagelayer-pen-close{
background: #e6e6e6;
position: absolute;
top: 0;
right: 0;
width: auto;
height: auto;
border-radius: 0;
}

.pagelayer-pen-toolbar .pagelayer-pen-close .fas{
font-size: 10px !important;
color: #fb0101;
margin:0;
padding:0;
}

.pagelayer-pen-toolbar svg{
width:18px;
float:left;
}

.pagelayer-pen-stroke{
fill: none;
stroke: #444;
stroke-linecap: round;
stroke-linejoin: round;
stroke-width: 2;
}

.pagelayer-pen-active,
.pagelayer-pen-toolbar button:hover,
.pagelayer-pen-picker-label:hover,
.pagelayer-pen-picker-item:hover,
.pagelayer-pen-active .fas,
.pagelayer-pen-toolbar button:hover .fas,
.pagelayer-pen-picker-label:hover .fas,
.pagelayer-pen-picker-item:hover .fas{
color: #06c;
}

.pagelayer-pen-active .pagelayer-pen-fill,
.pagelayer-pen-toolbar button:hover .pagelayer-pen-fill,
.pagelayer-pen-picker-label:hover .pagelayer-pen-fill,
.pagelayer-pen-picker-item:hover .pagelayer-pen-fill{
fill: #06c;
}

.pagelayer-pen-active .pagelayer-pen-stroke,
.pagelayer-pen-toolbar button:hover .pagelayer-pen-stroke,
.pagelayer-pen-picker-label:hover .pagelayer-pen-stroke,
.pagelayer-pen-picker-item:hover .pagelayer-pen-stroke{
stroke: #06c;
}

.pagelayer-pen-custom-input{
display: block;
width: 100%;
min-width: 75px;
height: 25px;
margin-top: 5px;
margin-bottom: 5px;
font-size: 12px !important;
}

.pagelayer-pen-formating .pagelayer-pen-picker-item[data-value="h1"]:before{
content: "Heading 1" !important;
font-size: 2em;
}

.pagelayer-pen-formating .pagelayer-pen-picker-item[data-value="h2"]:before{
content: "Heading 2" !important;
font-size: 1.5em;
}

.pagelayer-pen-formating .pagelayer-pen-picker-item[data-value="h3"]:before{
content: "Heading 3" !important;
font-size: 1em;
}

.pagelayer-pen-formating .pagelayer-pen-picker-item[data-value="h4"]:before{
content: "Heading 4" !important;
}

.pagelayer-pen-formating .pagelayer-pen-picker-item[data-value="h5"]:before{
content: "Heading 5" !important;
font-size: 0.83em;
}

.pagelayer-pen-formating .pagelayer-pen-picker-item[data-value="h6"]:before{
content: "Heading 6"  !important;
font-size: 0.67em;
}

.pagelayer-pen-formating .pagelayer-pen-picker-item[data-value="p"]:before{
content: "Paragraph"  !important;
}

.pagelayer-pen-formating .pagelayer-pen-picker-item[data-value="blockquote"]:before{
content: "Blockquote" !important;
}

