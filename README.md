# BabarCode beta 1.1
BabarCode adalah super micro framework yang dapat membantu Anda membuat aplikasi web dan API dengan mudah dan cepat. Hanya dengan beberapa langkah mudah, aplikasi Anda dapat berjalan!
<br>
<p><strong>1. Load Framework</strong></p>
<pre>
require 'system/babar.php';
use system\Babar;
</pre>
<p><strong>2. Daftarkan Route</strong></p>
<pre>
Babar::route('/',function(){
&nbsp;&nbsp;&nbsp;echo 'Hello World!';
});

Babar::route('/test',function(){
&nbsp;&nbsp;&nbsp;echo 'This is test page!';
});
</pre>
<p><strong>3. Jalankan Aplikasi</strong></p>
<pre>
Babar::run();
</pre>
<p><strong>4. .htaccess</strong></p>
<pre>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
</pre>

Buka halaman <code>localhost/babarcode</code> dari browser.
Voila!

<p><strong>Via Composer</strong></p>
<pre>
composer require bar/babarcode dev-beta-1.1
</pre>
