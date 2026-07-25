var csslink = document.createElement("link");

csslink.type = "text/css";
csslink.rel = "stylesheet";
csslink.href = "/wchat/wapiachat.css";
csslink.onload= function(){
    var wIcon = '<svg class="svgshadow" width="70px" height="70px" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 302 298" xml:space="preserve" enable-background="new 0 0 302 298"><linearGradient id="a" gradientUnits="userSpaceOnUse" x1="157.3" y1="24.3" x2="157.3" y2="270.4"><stop offset="0" stop-color="#4ac14b"/><stop offset="1" stop-color="#06853a"/></linearGradient><path d="M157.3 24.3c-68.4 0-124 55.2-124 123.1 0 26.9 8.8 51.9 23.6 72.2l-15.5 45.7 47.7-15.1a124.3 124.3 0 0 0 192.2-102.7c0-68-55.6-123.2-124-123.2z" fill-rule="evenodd" clip-rule="evenodd" fill="url(#a)"/><path d="M297.1 146.3a140 140 0 0 1-140.5 139.4c-24.6 0-47.8-6.3-67.9-17.4L10.9 293l25.4-74.8a138 138 0 0 1-20.2-72A140 140 0 0 1 156.6 6.9a140 140 0 0 1 140.5 139.4zM156.6 29.1A117.8 117.8 0 0 0 38.4 146.3c0 25.6 8.4 49.4 22.5 68.7l-14.8 43.5 45.4-14.4c18.7 12.2 41 19.4 65 19.4 65.1 0 118.1-52.6 118.1-117.2a117.6 117.6 0 0 0-118-117.2zm71 149.3c-.9-1.4-3.2-2.3-6.6-4-3.4-1.7-20.4-10-23.5-11.1-3.2-1.1-5.5-1.7-7.7 1.7-2.3 3.4-8.9 11.1-10.9 13.4-2 2.3-4 2.6-7.5.9-3.5-1.7-14.6-5.3-27.7-17-10.2-9.1-17.1-20.3-19.2-23.7-2-3.4-.2-5.3 1.5-7 1.6-1.5 3.5-4 5.2-6 1.7-2 2.3-3.4 3.4-5.7 1.1-2.3.6-4.3-.3-6-.9-1.7-7.7-18.5-10.6-25.4-2.9-6.8-5.7-6.6-7.7-6.6s-5.7.6-5.7.6-6.9.9-10.1 4.3c-3.2 3.4-12.1 11.7-12.1 28.5s12.3 33.1 14.1 35.3c1.7 2.3 23.8 37.9 58.8 51.6 35 13.7 35 9.1 41.3 8.5 6.3-.6 20.4-8.3 23.3-16.2 2.8-7.8 2.8-14.6 2-16.1zm0 0" fill-rule="evenodd" clip-rule="evenodd" fill="#fff"/></svg>';
    var wapia_default_msg ="سلام در رابطه با سایت " + window.location.hostname + " سوالی داشتم";
    var wDiv = document.createElement('div');
    wDiv.id = "wapiachatbtn";
    wDiv.innerHTML = `<a target='_blank' rel='nofollow' href='https://api.whatsapp.com/send?phone=${wapia_support_phone}&text=${wapia_default_msg}'><span class="wchatlbl"><span class="wchatlbli">پشتیبانی واتساپ</span></span></a><div class="wchaticon">${wIcon}</div>`;
    document.body.append(wDiv);    
}
document.head.appendChild(csslink);