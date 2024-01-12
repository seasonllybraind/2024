var cookieName= "CookieConsent";
var cookieValue= "Cookie consent approved";
var cookieExpireDays= 30;
// when users click accept button
let acceptCookie= document.getElementById("acceptCookie");
acceptCookie.addEventListener('click', function() {
    createCookie(cookieName, cookieValue, cookieExpireDays);
}, false);

// function to set cookie in web browser
let createCookie= function(cookieName, cookieValue, cookieExpireDays){
  let currentDate = new Date();
  currentDate.setTime(currentDate.getTime() + (cookieExpireDays*24*60*60*1000));
  let expires = "expires=" + currentDate.toGMTString();
  document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
  if(document.cookie){
    if(document.querySelector('#cookieModal') != null) {
      UIkit.modal(cookieModal).hide();
    }
    if(document.querySelector('#cookiePopup') != null) {
      document.getElementById("cookiePopup").style.display = "none";
    }
  }else{
    alert("Unable to set cookie. Please allow all cookies site from cookie setting of your browser");
  }
 }
// get cookie from the web browser
let getCookie= function(cookieName){
  let name = cookieName + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
// check cookie is set or not
let checkCookie= function(){
    let check=getCookie(cookieName);
    if(check==""){
      if(document.querySelector('#cookieModal') != null) {
        UIkit.modal(cookieModal).show();
      }
      if(document.querySelector('#cookiePopup') != null) {
        document.getElementById("cookiePopup").style.display = "block";
      }
    }else{
      if(document.querySelector('#cookieModal') != null) {
        UIkit.modal(cookieModal).hide();
      }
      if(document.querySelector('#cookiePopup') != null) {
        document.getElementById("cookiePopup").style.display = "none";
      }
    }
}
checkCookie();

