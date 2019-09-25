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
composer require bar/babarcode dev-beta-1.0
</pre>

<p><strong>Request Helper</strong></p>
Load Request Helper
<pre>
use system\helper\Request;
</pre>

GET Parameter
<pre>
// Check if request is GET or not
Request::is_get(); // true or false

 // All GET Parameters (Array)
Request::get(); 

// Spesific GET Parameter
// Ex: domain.com/whatever?id=123
Request::get('id'); // result => 123
</pre>

POST Parameter
<pre>
// Check if request is POST or not
Request::is_post(); // true or false

 // All POST Parameters (Array)
Request::post(); 

// Spesific POST Parameter
Request::post('id');
</pre>

SERVER Variable
<pre>
// All SERVER Parameters (Array)
Request::server(); 

// Spesific SERVER Parameter
Request::server('SERVER_NAME');
</pre>

HEADER Variable
<pre>
// All HEADER Parameters (Array)
Request::header(); 

// Spesific HEADER Parameter
Request::header('User-Agent');
</pre>

URI Segment
<pre>
// All URI Segements (Array)
Request::uri_segment(); 

// Spesific URI Segment
// Ex: domain.com/articles/2017/02/whatever-articles-title
Request::uri_segment(2); // return => 2017 
</pre>

<p><strong>JSON Helper</strong></p>
Load JSON Helper
<pre>
use system\helper\Json;
</pre>

Encode Decode
<pre>
// Encode
Json::encode('your text or array here'); 

// Decode
Json::decode('your text or array json encoded here');
</pre>

<p><strong>View Helper</strong></p>
Load View Helper
<pre>
use system\helper\View;
</pre>

Set View Path
<pre>
// Ex: <code>view/</code> is your view path 
View::set_path('view/');
</pre>

Render View
<pre>
// Render view without passing parameter
// Ex: <code>sampleview.php</code> is your view
View::render('sampleview');

// Render view with passing parameter
// Ex: <code>sampleview.php</code> is your view
$data['product_id'] = 15;
$data['product_title'] = 'Whatever Product';
View::render('sampleview',$data);

// Accessing Parameter in view
&lt;?=$product_id;?&gt; // return => 15
&lt;?=$product_title;?&gt; // return => Whatever Product
</pre>

<p><strong>Database</strong></p>
Database Support:
MySQL & SQL Server

Database Driver:
<br>
MYSQL => <code>mysql</code>
<br>
SQL Server => <code>sqlsrv</code>

Load DB Class
<pre>
use system\db\DB;
</pre>

Setup Config
<pre>
// Set Default DB Config
$config['database']['default'] = array(
  'host' => 'localhost',
  'db' => 'test',
  'user' => 'root',
  'password' => 'root',
  'port' => 3306,
  'driver' => 'mysql'
);

// Set another DB Config
$config['database']['second'] = array(
  'host' => 'localhost',
  'db' => 'test',
  'user' => 'sa',
  'password' => 'sa123',
  'driver' => 'sqlsrv'
);
</pre>

Register Config
<pre>
Babar::reg_config($config);
</pre>

Read Config
<pre>
$cfg = Babar::read_config('database');
</pre>

Database Initialize
<pre>
DB::init($cfg['default']); // Initialize For default
DB::init($cfg['second']); // Initialize For second
</pre>

Fetch Data
<pre>
// Fetch First Row of Data
$single = DB::query('SELECT * FROM user')->first();
// OR
$single = DB::query('SELECT * FROM user ORDER BY id DESC')->first();

// Fetch Multiple Rows Data
$list = DB::query('select * from user')->fetchAll();
</pre>

Insert / Update / Delete Data
<pre>
return => 0 / 1
$ok = DB::query("INSERT INTO user (nama) VALUES ('Fulana')")->result();
</pre>
