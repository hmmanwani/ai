 <!DOCTYPE html>
 <html>

 <head>
     <title>Access Restricted</title>
     <style>
         body {
             font-family: Arial, sans-serif;
             text-align: center;
             padding: 50px;
         }

         h1 {
             font-size: 24px;
         }

         p {
             font-size: 18px;
         }
     </style>
 </head>

 <body>
     <div>
         <h1>Access Restricted</h1>
         <p>This website is not accessible on mobile devices. Please use a desktop browser to access the site.</p>
     </div>
     <script>
         // Check if screen width is below a certain threshold, indicating a mobile device
         if (window.innerWidth <= 800) {
             window.location.href = '/no-mobile';
         }
     </script>
 </body>

 </html>
