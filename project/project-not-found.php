<?php
echo '
<script>
document.head.innerHTML += `<link rel="stylesheet" href="/stylesheets/404.css">`;

document.body.innerHTML=`
  <h1>PROJECT NOT FOUND</h1>
      <div class="box">
      <div class="top">
      <p>Sorry, please contact me at : <br>
       <a href="mailto:hope.fanasina2@gmail.com" class="email-link">hope.fanasina2@gmail.com</a>
      </p></div>
      <a href="/" class="button">
        <div class="icon">
          <svg fill="#fff" width="30px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <path d="M216.4,163.7c5.1,5,5.1,13.3,0.1,18.4L155.8,243h231.3c7.1,0,12.9,5.8,12.9,13s-5.8,13-12.9,13H155.8l60.8,60.9 c5,5.1,4.9,13.3-0.1,18.4c-5.1,5-13.2,5-18.3-0.1l-82.4-83c0,0,0,0,0,0c-1.1-1.2-2-2.5-2.7-4.1c-0.7-1.6-1-3.3-1-5 c0-3.4,1.3-6.6,3.7-9.1l82.4-83C203.1,158.8,211.3,158.7,216.4,163.7z" />
          </svg>
        </div>
        <div class="text">
          Back home
        </div>
      </a>
    </div>`;
  </script>
<script>document.title = "RAF | NOT FOUND"</script>
';