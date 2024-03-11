<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Assets/css/signup.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="container">
            <div class="form-container">
                <div class="box">
                    <div class="form-content">
                    <?php
    // Check if the form is submitted
    if(isset($_POST["submit"])){
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $country = "Philippines";
        $province = isset($_POST['province']) ? $_POST['province'] : "";
        $city = isset($_POST['city']) ? $_POST['city'] : "";
        $barangay = isset($_POST['barangay']) ? $_POST['barangay'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";
        $confirmpassword = isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : "";
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();

        if (empty($firstname) OR empty($lastname) OR empty($email) OR empty($province) OR empty($city) OR empty($barangay) OR empty($password) OR empty($confirmpassword)) {
            array_push($errors, "All fields are required");
        }
       
        // Validate if the email is not validated
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
       
        // Password should not be less than  8
        if(strlen($password) <  8) {
            array_push($errors, "Password must be at least  8 characters long");
        }
       
        // Check if password is the same
        if ($password != $confirmpassword) {
            array_push($errors, "Password does not match");
        }
        require_once "database.php";
        $sql = "SELECT * FROM registration WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount>0){
            array_push($errors, "Email Already Exists!");
        }
        if (count($errors) >  0) {
            foreach($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // Insert to database
            require_once "database.php";
            $sql = "INSERT INTO registration (firstname, lastname, email, country, province, city, barangay, user_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn); //initializes a statement and returns an object suitable for mysqli_stmt_prepare()
            $preparestmt = mysqli_stmt_prepare($stmt, $sql);
            if ($preparestmt){
              mysqli_stmt_bind_param($stmt, "ssssssss", $firstname, $lastname, $email, $country, $province, $city, $barangay, $passwordHash);
              mysqli_stmt_execute($stmt);
              echo "<div class = 'alert alert-success'> You are Registered Successfully! </div>";
            } else {
              die("Something went wrong!");
            }
        }
    }
?>
                    <div id="successMessage" style="display: none;" class="alert alert-success">Registration Successfully!</div>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="signup-form">
                            <div class="form-group">
                            <div class="animate-input">
                                <span>First Name</span>
                            <input type="text" class="form-control" name="firstname" placeholder="First Name">
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="animate-input">
                            <span>Last Name</span>
                            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="animate-input">
                            <span>Email</span>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="animate-input">
                                <span>Country</span>
                                <select class="form-control" id="countryInput" name="country">
                                    <!-- Options for Country dropdown -->
                                    <option value="Philippines">Philippines</option>
                                </select>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="animate-input">
                                <span>Province</span>
                                <select class="form-control" id="provinceInput" name="province">
                                    <option value="" disabled selected>Select Province</option>
                                    <!-- Options for Province dropdown -->
                                </select>
                            </div>
                            </div>
                            <div class="animate-input">
                            <div class="form-group">
                                <span>City/Municipality</span>
                                <select class="form-control" id="cityInput" name="city">
                                    <option value="" disabled selected>Select Province First</option>
                                    <!-- Options for City/Municipality dropdown -->
                                </select>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="animate-input">
                            <span>Barangay</span>
                                <input type="text" class="form-control" id="barangayInput" name="barangay" placeholder="Enter Barangay/Blk./Street">
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="animate-input">
                            <span>Password</span>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="animate-input">
                            <span>Confirn Password</span>
                                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
                            </div>
                            </div>
                            <div class="btn-group">
                                <button class="btn-signup" type="submit" name="submit">Register</button>
                            </div>
                            <div class="divine">
                                <div></div>
                                <div>or</div>
                                <div></div>
                            </div>
                            <div class="forgot-pw">
                                <a href="login.php">Already have an account? Log in</a>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
</div>
<script>
    const provinces = ["Abra", "Agusan del Norte", "Agusan del Sur", "Abra", "Agusan del Norte", "Agusan del Sur", 
    "Aklan", "Albay", "Antique", "Apayao", "Aurora", "Basilan", "Bataan", "Batanes", "Batangas", 
    "Benguet", "Biliran", "Bohol", "Bukidnon", "Bulacan", "Cagayan", "Camarines Norte", "Camarines Sur", 
    "Camiguin", "Capiz", "Catanduanes", "Cavite", "Cebu", "Compostela Valley", "Cotabato", "Davao del Norte", 
    "Davao del Sur", "Davao Occidental", "Davao Oriental", "Dinagat Islands", "Eastern Samar", 
    "Guimaras", "Ifugao", "Ilocos Norte", "Ilocos Sur", "Iloilo", "Isabela", "Kalinga", "La Union", 
    "Laguna", "Lanao del Norte", "Lanao del Sur", "Leyte", "Maguindanao", "Marinduque", "Masbate", 
    "Metro Manila", "Misamis Occidental", "Misamis Oriental", "Mountain Province", "Negros Occidental", 
    "Negros Oriental", "Northern Samar", "Nueva Ecija", "Nueva Vizcaya", "Occidental Mindoro", 
    "Oriental Mindoro", "Palawan", "Pampanga", "Pangasinan", "Quezon", "Quirino", "Rizal", "Romblon", 
    "Samar", "Sarangani", "Siquijor", "Sorsogon", "South Cotabato", "Southern Leyte", "Sultan Kudarat", 
    "Sulu", "Surigao del Norte", "Surigao del Sur", "Tarlac", "Tawi-Tawi", "Zambales", "Zamboanga del Norte", 
    "Zamboanga del Sur", "Zamboanga Sibugay"];

    const cities = {
    "Abra": ["Bangued", "Boliney", "Bucay", "Bucloc", "Daguioman", "Danglas", "Dolores", "La Paz", "Lacub", "Lagangilang", "Lagayan", "Langiden", "Licuan-Baay", "Luba", "Malibcong", "Manabo", "Peñarrubia", "Pidigan", "Pilar", "Sallapadan", "San Isidro", "San Juan", "San Quintin", "Tayum", "Tineg", "Tubo", "Villaviciosa"],
    "Agusan del Norte": ["Buenavista", "Cabadbaran", "Carmen", "Jabonga", "Kitcharao", "Las Nieves", "Magallanes", "Nasipit", "Remedios T. Romualdez", "Santiago", "Tubay"],
    "Agusan del Sur": ["Bayugan","Bunawan","Esperanza","La Paz","Loreto","Prosperidad","Rosario","San Francisco","San Luis","Santa Josefa","Sibagat","Talacogon","Trento","Veruela"],
    "Aklan": ["Altavas","Balete","Banga","Batan","Buruanga","Ibajay","Kalibo","Lezo","Libacao","Madalag","Makato","Malay","Malinao","Nabas","New Washington","Numancia","Tangalan"],
    "Albay": ["Bacacay","Camalig","Daraga","Guinobatan","Jovellar","Legazpi","Libon","Ligao","Malilipot","Malinao","Manito","Oas","Pio Duran","Polangui","Rapu-Rapu","Santo Domingo","Tabaco","Tiwi"],
    "Antique": ["Anini-y","Barbaza","Belison","Bugasong","Caluya","Culasi","Hamtic","Laua-an","Libertad","Pandan","Patnongon","San Jose de Buenavista","San Remigio","Sebaste","Sibalom","Tibiao","Tobias Fornier","Valderrama"],
    "Apayao": ["Calanasan", "Conner", "Flora", "Kabugo", "Luna", "Pudtol", "Santa Marcela"],
    "Aurora": ["Baler", "Casiguran", "Dilasag", "Dinalungan", "Dingalan", "Dipaculao", "Maria Aurora", "San Luis"],
    "Basilan": ["Akbar","Al-Barka","Hadji Mohammad Ajul","Hadji Muhtamad","Isabela City","Lamitan","Lantawan","Maluso","Sumisip","Tabuan-Lasa","Tipo-Tipo","Tuburan","Ungkaya Pukan"],
    "Bataan": ["Abucay","Bagac","Balanga","Dinalupihan","Hermosa","Limay","Mariveles","Morong","Orani","Orion","Pilar","Samal"],
    "Batanes": ["Basco","Itbayat","Ivana","Mahatao","Sabtang","Uyugan"],
    "Batangas": ["Agoncillo","Alitagtag","Balayan","Balete","Batangas City","Bauan","Calaca","Calatagan","Cuenca","Ibaan","Laurel","Lemery","Lian","Lipa","Lobo","Mabini","Malvar","Mataasnakahoy","Nasugbu","Padre Garcia","Rosario","San Jose","San Juan","San Luis","San Nicolas","San Pascual","Santa Teresita","Santo Tomas","Taal","Talisay","Tanauan","Taysan","Tingloy","Tuy"],
    "Benguet": ["Atok","Bakun","Bokod","Buguias","Itogon","Kabayan","Kapangan","Kibungan","La Trinidad","Mankayan","Sablan","Tuba","Tublay"],
    "Biliran": ["Almeria","Biliran","Cabucgayan","Caibiran","Culaba","Kawayan","Maripipi","Naval"],
    "Bohol": ["Alburquerque","Alicia","Anda","Antequera","Baclayon","Balilihan","Batuan","Bien Unido","Bilar","Buenavista","Calape","Candijay","Carmen","Catigbian","Clarin","Corella","Cortes","Dagohoy","Danao","Dauis","Dimiao","Duero","Garcia Hernandez","Getafe","Guindulman","Inabanga","Jagna","Lila","Loay","Loboc","Loon","Mabini","Maribojoc","Panglao","Pilar","President Carlos P. Garcia","Sagbayan","San Isidro","San Miguel","Sevilla","Sierra Bullones","Sikatuna","Tagbilaran","Talibon","Trinidad","Tubigon","Ubay","Valencia"],
    "Bukidnon": ["Baungon","Cabanglasan","Damulog","Dangcagan","Don Carlos","Impasugong","Kadingilan","Kalilangan","Kibawe","Kitaotao","Lantapan","Libona","Malaybalay","Malitbog","Manolo Fortich","Maramag","Pangantucan","Quezon","San Fernando","Sumilao","Talakag","Valencia"],
    "Bulacan": ["Angat","Balagtas","Baliuag","Bocaue","Bulakan","Bustos","Calumpit","Doña Remedios Trinidad","Guiguinto","Hagonoy","Malolos","Marilao","Meycauayan","Norzagaray","Obando","Pandi","Paombong","Plaridel","Pulilan","San Ildefonso","San Jose del Monte","San Miguel","San Rafael","Santa Maria"],
    "Cagayan": ["Abulug","Alcala","Allacapan","Amulung","Aparri","Baggao","Ballesteros","Buguey","Calayan","Camalaniugan","Claveria","Enrile","Gattaran","Gonzaga","Iguig","Lal-lo","Lasam","Pamplona","Peñablanca","Piat","Rizal","Sanchez-Mira","Santa Ana","Santa Praxedes","Santa Teresita","Santo Niño","Solana","Tuao","Tuguegarao"],
    "Camarines Norte": ["Basud","Capalonga","Daet","Jose Panganiban","Labo","Mercedes","Paracale","San Lorenzo Ruiz","San Vicente","Santa Elena","Talisay","Vinzons"],
    "Camarines Sur": ["Baao","Balatan","Bato","Bombon","Buhi","Bula","Cabusao","Calabanga","Camaligan","Canaman","Caramoan","Del Gallego","Gainza","Garchitorena","Goa","Iriga","Lagonoy","Libmanan","Lupi","Magarao","Milaor","Minalabac","Nabua","Naga","Ocampo","Pamplona","Pasacao","Pili","Presentacion","Ragay","Sagñay","San Fernando","San Jose","Sipocot","Siruma","Tigaon","Tinambac"],
    "Camiguin": ["Catamaran", "Guinsiliban", "Mahinog", "Mambajao", "Sagay"],
    "Capiz": ["Cuartero","Dao","Dumalag","Dumarao","Ivisan","Jamindan","Maayon","Mambusao","Panay","Panitan","Pilar","Pontevedra","President Roxas","Roxas City","Sapian","Sigma","Tapaz"],
    "Catanduanes": ["Bagamanoc","Baras","Bato","Caramoran","Gigmoto","Pandan","Panganiban","San Andres","San Miguel","Viga","Virac"],
    "Cavite": ["Alfonso","Amadeo","Bacoor","Carmona","Cavite City","Dasmariñas","General Emilio Aguinaldo","General Mariano Alvarez","General Trias","Imus","Indang","Kawit","Magallanes","Maragondon","Mendez","Naic","Noveleta","Rosario","Silang","Tagaytay","Tanza","Ternate","Trece Martires"],
    "Cebu": ["Alcantara","Alcoy","Alegria","Aloguinsan","Argao","Asturias","Badian","Balamban","Bantayan","Barili","Bogo","Boljoon","Borbon","Carcar","Carmen","Catmon","Compostela","Consolacion","Cordova","Daanbantayan","Dalaguete","Danao","Dumanjug","Ginatilan","Liloan","Madridejos","Malabuyoc","Medellin","Minglanilla","Moalboal","Naga","Oslob","Pilar","Pinamungajan","Poro","Ronda","Samboan","San Fernando","San Francisco","San Remigio","Santa Fe","Santander","Sibonga","Sogod","Tabogon","Tabuelan","Talisay","Toledo","Tuburan","Tudela"],
    "North Cotabato": ["Alamada","Aleosan","Antipas","Arakan","Banisilan","Carmen","Kabacan","Kidapawan","Libungan","Magpet","Makilala","Matalam","Midsayap","M'lang","Pigcawayan","Pikit","President Roxas","Tulunan"],
    "Davao de Oro (Compostela Valley)": ["Compostela","Laak","Mabini","Maco","Maragusan","Mawab","Monkayo","Montevista","Nabunturan","New Bataan","Pantukan"],
    "Davao del Norte": ["Asuncion","Braulio E. Dujali","Carmen","Kapalong","New Corella","Panabo","Samal","San Isidro","Santo Tomas","Tagum","Talaingod"],
    "Davao del Sur": ["Bansalan","Digos","Hagonoy","Kiblawan","Magsaysay","Malalag","Matanao","Padada","Santa Cruz","Sulop"],
    "Davao Occidental": ["Don Marcelino","Jose Abad Santos","Malita","Santa Maria","Sarangani"],
    "Davao Oriental": ["Baganga","Banaybanay","Boston","Caraga","Cateel","Governor Generoso","Lupon","Manay","Mati","San Isidro","Tarragona"],
    "Dinagat Islands": ["Basilisa","Cagdianao","Dinagat","Libjo","Loreto","San Jose","Tubajon"],
    "Eastern Samar": ["Arteche","Balangiga","Balangkayan","Borongan","Can-avid","Dolores","General MacArthur","Giporlos","Guiuan","Hernani","Jipapad","Lawaan","Llorente","Maslog","Maydolong","Mercedes","Oras","Quinapondan","Salcedo","San Julian","San Policarpo","Sulat","Taft"],
    "Guimaras": ["Buenavista","Jordan","Nueva Valencia","San Lorenzo","Sibunag"],
    "Ifugao": ["Aguinaldo","Alfonso Lista","Asipulo","Banaue","Hingyon","Hungduan","Kiangan","Lagawe","Lamut","Mayoyao","Tinoc"],
    "Ilocos Norte": ["Adams","Bacarra","Badoc","Bangui","Banna","Batac","Burgos","Carasi","Currimao","Dingras","Dumalneg","Laoag","Marcos","Nueva Era","Pagudpud","Paoay","Pasuquin","Piddig","Pinili","San Nicolas","Sarrat","Solsona","Vintar"],
    "Ilocos Sur": ["Alilem","Banayoyo","Bantay","Burgos","Cabugao","Candon","Caoayan","Cervantes","Galimuyod","Gregorio del Pilar","Lidlidda","Magsingal","Nagbukel","Narvacan","Quirino","Salcedo","San Emilio","San Esteban","San Ildefonso","San Juan","San Vicente","Santa","Santa Catalina","Santa Cruz","Santa Lucia","Santa Maria","Santiago","Santo Domingo","Sigay","Sinait","Sugpon","Suyo","Tagudin","Vigan"],
    "Iloilo": ["Ajuy","Alimodian","Anilao","Badiangan","Balasan","Banate","Barotac Nuevo","Barotac Viejo","Batad","Bingawan","Cabatuan","Calinog","Carles", "Concepcion","Dingle","Dueñas","Dumangas","Estancia","Guimbal","Igbaras","Janiuay","Lambunao","Leganes","Lemery","Leon","Maasin","Miagao","Mina","New Lucena","Oton","Passi","Pavia","Pototan","San Dionisio","San Enrique","San Joaquin","San Miguel","San Rafael","Santa Barbara","Sara","Tigbauan","Tubungan","Zarraga"],
    "Isabela": ["Alicia","Angadanan","Aurora","Benito Soliven","Burgos","Cabagan","Cabatuan","Cauayan","Cordon","Delfin Albano","Dinapigue","Divilacan","Echague","Gamu","Ilagan","Jones","Luna","Maconacon","Mallig","Naguilian","Palanan","Quezon","Quirino","Ramon","Reina Mercedes","Roxas","San Agustin","San Guillermo","San Isidro","San Manuel","San Mariano","San Mateo","San Pablo","Santa Maria","Santiago","Santo Tomas","Tumauini"],
    "Kalinga": ["Balbalan","Lubuagan","Pasil","Pinukpuk","Rizal","Tabuk","Tanudan","Tinglayan"],
    "La Union": ["Agoo","Aringay","Bacnotan","Bagulin","Balaoan","Bangar","Bauang","Burgos","Caba","Luna","Naguilian","Pugo","Rosario","San Fernando","San Gabriel","San Juan","Santo Tomas","Santol","Sudipen","Tubao"],
    "Laguna": ["Alaminos","Bay","Biñan","Cabuyao","Calamba","Calauan","Cavinti","Famy","Kalayaan","Liliw","Los Baños","Luisiana","Lumban","Mabitac","Magdalena","Majayjay","Nagcarlan","Paete","Pagsanjan","Pakil","Pangil","Pila","Rizal","San Pablo","San Pedro","Santa Cruz","Santa Maria","Santa Rosa","Siniloan","Victoria"],
    "Lanao del Norte": ["Bacolod","Baloi","Baroy","Kapatagan","Kauswagan","Kolambugan","Lala","Linamon","Magsaysay","Maigo","Matungao","Munai","Nunungan","Pantao Ragat","Pantar","Poona Piagapo","Salvador","Sapad","Sultan Naga Dimaporo","Tagoloan","Tangcal","Tubod"],
    "Lanao del Sur": ["Amai Manabilang","Bacolod-Kalawi","Balabagan","Balindong","Bayang","Binidayan","Buadiposo-Buntong","Bubong","Butig","Calanogas","Ditsaan-Ramain","Ganassi","Kapai","Kapatagan","Lumba-Bayabao","Lumbaca-Unayan","Lumbatan","Lumbayanague","Madalum","Madamba","Maguing","Malabang","Marantao","Marawi","Marogong","Masiu","Mulondo","Pagayawan","Piagapo","Picong","Poona Bayabao","Pualas","Saguiaran","Sultan Dumalondong","Tagoloan II","Tamparan","Taraka","Tubaran","Tugaya","Wao"],
    "Leyte": ["Abuyog","Alangalang","Albuera","Babatngon","Barugo","Bato","Baybay","Burauen","Calubian","Capoocan","Carigara","Dagami","Dulag","Hilongos","Hindang","Inopacan","Isabel","Jaro","Javier","Julita","Kananga","La Paz","Leyte","MacArthur","Mahaplag","Matag-ob","Matalom","Mayorga","Merida","Ormoc","Palo","Palompon","Pastrana","San Isidro","San Miguel","Santa Fe","Tabango","Tabontabon","Tanauan","Tolosa","Tunga","Villaba"],
    "Maguindanao": ["Ampatuan","Barira","Buldon","Buluan","Datu Abdullah Sangki","Datu Anggal Midtimbang","Datu Blah T. Sinsuat","Datu Hoffer Ampatuan","Datu Montawal","Datu Odin Sinsuat","Datu Paglas","Datu Piang","Datu Salibo","Datu Saudi-Ampatuan","Datu Unsay","General Salipada K. Pendatun","Guindulungan","Kabuntalan","Mamasapano","Mangudadatu","Matanog","Northern Kabuntalan","Pagalungan","Paglat","Pandag","Parang","Rajah Buayan","Shariff Aguak","Shariff Saydona Mustapha","South Upi","Sultan Kudarat","Sultan Mastura","Sultan sa Barongis","Sultan Sumagka","Talayan","Upi"],
    "Marinduque": ["Boac", "Buenavista", "Gasan", "Mogpog", "Santa Cruz", "Torrijos"],
    "Masbate": ["Aroroy", "Baleno", "Balud", "Batuan", "Cataingan", "Cawayan", "Claveria", "Dimasalang", "Esperanza", "Mandaon", "Masbate City", "Milagros", "Mobo", "Monreal", "Palanas", "Pio V. Corpuz", "Placer", "San Fernando", "San Jacinto", "San Pascual", "Uson"],
    "Misamis Occidental": ["Aloran", "Baliangao", "Bonifacio", "Calamba", "Clarin", "Concepcion", "Don Victoriano Chiongbian", "Jimenez", "Lopez Jaena", "Oroquieta", "Ozamiz", "Panaon", "Plaridel", "Sapang Dalaga", "Sinacaban", "Tangub", "Tudela"],
    "Misamis Oriental": ["Alubijid","Balingasag","Balingoan","Binuangan","Claveria","El Salvador","Gingoog","Gitagum","Initao","Jasaan","Kinoguitan","Lagonglong","Laguindingan","Libertad","Lugait","Magsaysay","Manticao","Medina","Naawan","Opol","Salay","Sugbongcogon","Tagoloan","Talisayan","Villanueva"],
    "Mountain Province": ["Barlig","Bauko","Besao","Bontoc","Natonin","Paracelis","Sabangan","Sadanga","Sagada","Tadian"],
    "Negros Occidental": ["Bago","Binalbagan","Calatrava","Candoni","Cauayan","Enrique B. Magalona","Hinigaran","Hinoba-an","Ilog","Isabela","La Carlota","La Castellana","Manapla","Moises Padilla","Murcia","Pontevedra","Pulupandan","Salvador Benedicto","San Enrique","Talisay","Toboso","Valladolid","Victorias"],
    "Negros Oriental": ["Amlan","Ayungon","Bacong","Bais","Basay","Bayawan","Bindoy","Canlaon","Dauin","Dumaguete","Guihulngan","Jimalalud","La Libertad","Mabinay","Manjuyod","Pamplona","San Jose","Santa Catalina","Siaton","Sibulan","Tanjay","Tayasan","Valencia","Vallehermoso","Zamboanguita"],
    "Northern Samar": ["Allen","Biri","Bobon","Capul","Catarman","Catubig","Gamay","Laoang","Lapinig","Las Navas","Lavezares","Lope de Vega","Mapanas","Mondragon","Palapag","Pambujan","Rosario","San Antonio","San Isidro","San Jose","San Roque","San Vicente","Silvino Lobos","Victoria" ],
    "Nueva Ecija": ["Aliaga","Bongabon","Cabanatuan","Cabiao","Carranglan","Cuyapo","Gabaldon","Gapan","General Mamerto Natividad","General Tinio","Guimba","Jaen","Laur","Licab","Llanera","Lupao","Muñoz","Nampicuan","Palayan","Pantabangan","Peñaranda","Quezon","Rizal","San Antonio","San Isidro","San Jose","San Leonardo","Santa Rosa","Santo Domingo","Talavera","Talugtug","Zaragoza"],
    "Nueva Vizcaya": ["Alfonso Castañeda","Ambaguio","Aritao","Bagabag","Bambang","Bayombong","Diadi","Dupax del Norte","Dupax del Sur","Kasibu","Kayapa","Quezon","Santa Fe","Solano","Villaverde"],
    "Occidental Mindoro": ["Abra de Ilog","Calintaan","Looc","Lubang","Magsaysay","Mamburao","Paluan","Rizal","Sablayan","San Jose","Santa Cruz"],
    "Oriental Mindoro": ["Baco","Bansud","Bongabong","Bulalacao","Calapan","Gloria","Mansalay","Naujan","Pinamalayan","Pola","Puerto Galera","Roxas","San Teodoro","Socorro","Victoria"],
    "Palawan": [ "Aborlan","Agutaya","Araceli","Balabac","Bataraza","Brooke's Point","Busuanga","Cagayancillo","Coron","Culion","Cuyo","Dumaran","El Nido","Kalayaan","Linapacan","Magsaysay","Narra","Quezon","Rizal","Roxas","San Vicente","Sofronio Española","Taytay"],
    "Pampanga": ["Apalit","Arayat","Bacolor","Candaba","Floridablanca","Guagua","Lubao","Mabalacat","Macabebe","Magalang","Masantol","Mexico","Minalin","Porac","San Fernando","San Luis","San Simon","Santa Ana","Santa Rita","Santo Tomas","Sasmuan"],
    "Pangasinan": ["Agno","Aguilar","Alaminos","Alcala","Anda","Asingan","Balungao","Bani","Basista","Bautista","Bayambang","Binalonan","Binmaley","Bolinao","Bugallon","Burgos","Calasiao","Dagupan","Dasol","Infanta","Labrador","Laoac","Lingayen","Mabini","Malasiqui","Manaoag","Mangaldan","Mangatarem","Mapandan","Natividad","Pozorrubio","Rosales","San Carlos","San Fabian","San Jacinto","San Manuel","San Nicolas","San Quintin","Santa Barbara","Santa Maria","Santo Tomas","Sison","Sual","Tayug","Umingan","Urbiztondo","Urdaneta","Villasis"],
    "Quezon": ["Agdangan","Alabat","Atimonan","Buenavista","Burdeos","Calauag","Candelaria","Catanauan","Dolores","General Luna","General Nakar","Guinayangan","Gumaca","Infanta","Jomalig","Lopez","Lucban","Macalelon","Mauban","Mulanay","Padre Burgos","Pagbilao","Panukulan","Patnanungan","Perez","Pitogo","Plaridel","Polillo","Quezon","Real","Sampaloc","San Andres","San Antonio","San Francisco","San Narciso","Sariaya","Tagkawayan","Tayabas","Tiaong","Unisan"],
    "Quirino": ["Aglipay","Cabarroguis","Diffun","Maddela","Nagtipunan","Saguday"],
    "Rizal": ["Angono","Antipolo","Baras","Binangonan","Cainta","Cardona","Jalajala","Morong","Pililla","Rodriguez","San Mateo","Tanay","Taytay","Teresa"],
    "Romblon": ["Alcantara","Banton","Cajidiocan","Calatrava","Concepcion","Corcuera","Ferrol","Looc","Magdiwang","Odiongan","Romblon","San Agustin","San Andres","San Fernando","San Jose","Santa Fe","Santa Maria"],
    "Samar": ["Almagro","Basey","Calbayog City","Calbiga","Catbalogan City","Daram","Gandara","Hinabangan","Jiabong","Marabut","Matuguinao","Motiong","Pagsanghan","Paranas","Pinabacdao","San Jorge","San Jose de Buan","San Sebastian","Santa Margarita","Santa Rita","Santo Niño","Tagapul-an","Talalora","Tarangnan","Villareal","Zumarraga"],
    "Sarangani": ["Alabel","Glan","Kiamba","Maasim","Maitum","Malapatan","Malungon"],
    "Siquijor": ["Enrique Villanueva","Larena","Lazi","Maria","San Juan","Siquijor" ],
    "Sorsogon": ["Barcelona","Bulan","Bulusan","Casiguran","Castilla","Donsol","Gubat","Irosin","Juban","Magallanes","Matnog","Pilar","Prieto Diaz","Santa Magdalena","Sorsogon City"],
    "South Cotabato": ["Banga","Koronadal City","Lake Sebu","Norala","Polomolok","Santo Niño","Surallah","Tampakan","Tantangan","T'Boli","Tupi"],
    "Southern Leyte": ["Anahawan","Bontoc","Hinunangan","Hinundayan","Libagon","Liloan","Limasawa","Maasin City","Macrohon","Malitbog","Padre Burgos","Pintuyan","Saint Bernard","San Francisco","San Juan","San Ricardo","Silago","Sogod","Tomas Oppus"],
    "Sultan Kudarat": ["Bagumbayan","Columbio","Esperanza","Isulan","Kalamansig","Lambayong","Lebak","Lutayan","Palimbang","President Quirino","Senator Ninoy Aquino","Tacurong"],
    "Sulu": ["Banguingui","Hadji Panglima Tahil","Indanan","Jolo","Kalingalan Caluang","Lugus","Luuk","Maimbung","Old Panamao","Omar","Pandami","Panglima Estino","Pangutaran","Parang","Pata","Patikul","Siasi","Talipao","Tapul"],
    "Surigao del Norte": ["Alegria","Bacuag","Burgos","Claver","Dapa","Del Carmen","General Luna","Gigaquit","Mainit","Malimono","Pilar","Placer","San Benito","San Francisco","San Isidro","Santa Monica","Sison","Socorro","Surigao City","Tagana-an","Tubod"],
    "Surigao del Sur": ["Barobo","Bayabas","Bislig","Cagwait","Cantilan","Carmen","Carrascal","Cortes","Hinatuan","Lanuza","Lianga","Lingig","Madrid","Marihatag","San Agustin","San Miguel","Tagbina","Tago","Tandag"],
    "Tarlac": ["Anao","Bamban","Camiling","Capas","Concepcion","Gerona","La Paz","Mayantoc","Moncada","Paniqui","Pura","Ramos","San Clemente","San Jose","San Manuel","Santa Ignacia","Tarlac City","Victoria"],
    "Tawi-Tawi": ["Bongao","Languyan","Mapun","Panglima Sugala","Sapa-Sapa","Sibutu","Simunul","Sitangkai","South Ubian","Tandubas","Turtle Islands"],
    "Zambales": ["Botolan","Cabangan", "Candelaria","Castillejos","Iba","Masinloc","Palauig","San Antonio","San Felipe","San Marcelino","San Narciso","Santa Cruz","Subic"],
    "Zamboanga del Norte": ["Baliguian","Dapitan (City)","Dipolog (City)","Godod","Gutalac","Jose Dalman","Kalawit","Katipunan","La Libertad","Labason","Leon B. Postigo","Liloy","Manukan","Mutia","Piñan","Polanco","President Manuel A. Roxas","Rizal","Salug","Sergio Osmeña Sr.","Siayan","Sibuco","Sibutad","Sindangan","Siocon","Sirawai","Tampilisan"],
    "Zamboanga del Sur": ["Aurora","Bayog","Dimataling","Dinas","Dumalinao","Dumingag","Guipos","Josefina","Kumalarang","Labangan","Lakewood","Lapuyan","Mahayag","Margosatubig","Midsalip","Molave","Pagadian (City)","Pitogo","Ramon Magsaysay","San Miguel","San Pablo","Sominot","Tabina","Tambulig","Tigbao","Tukuran","Vincenzo A. Sagun"],
    "Zamboanga Sibugay": ["Alicia","Buug","Diplahan","Imelda","Ipil (Capital)","Kabasalan","Mabuhay","Malangas","Naga","Olutanga","Payao","Roseller Lim","Siay","Talusan","Titay","Tungawan"]
    };

            function populateProvinceDropdown() {
        const provinceDropdown = document.getElementById('provinceInput');
        const cityDropdown = document.getElementById('cityInput');

        provinces.forEach(province => {
            const option = document.createElement('option');
            option.text = province;
            option.value = province;
            provinceDropdown.appendChild(option);
        });
    }

    function populateCityDropdown(selectedProvince) {
        const cityDropdown = document.getElementById('cityInput');
        cityDropdown.innerHTML = ''; 
        if (selectedProvince in cities) {
            cities[selectedProvince].forEach(city => {
                const option = document.createElement('option');
                option.text = city;
                option.value = city;
                cityDropdown.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.text = 'Select Province First';
            option.value = '';
            cityDropdown.appendChild(option);
        }
    }

    document.getElementById('provinceInput').addEventListener('change', function() {
        const selectedProvince = this.value;
        populateCityDropdown(selectedProvince);
    });

    populateProvinceDropdown();
</script>
</body>
</html>