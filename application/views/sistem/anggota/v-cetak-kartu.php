<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<style>
@font-face {
  font-family: "Quicksand";
  src: url('/slims/files/membercard/classic/fonts/Quicksand/Quicksand-Regular.ttf') format('truetype');
  font-weight: 400;
  font-style: normal;
}
@font-face {
  font-family: "Quicksand";
  src: url('/slims/files/membercard/classic/fonts/Quicksand/Quicksand-Bold.ttf') format('truetype');
  font-weight: 700;
  font-style: bold;
}

body {
  font: 7pt/1.4 'Quicksand', sans-serif;
  color:#000;  ;
}

p,
h1,
strong {
  margin:0;
  padding:0;
}

.personality {
  flex: 0cm      
}
.personality div {
  flex-direction: column;
}

#front-card,
#back-card {
  width: 325px;
  height: 204px;
  border: solid 1px #e4e4e4;
  position: relative;
}

#front-card {
  background-color: #E5E5E5;    
}

#front-card header {
  padding: 15px 10px;
  background-color: #fff;
  text-transform: uppercase;
  color: #000 !important;  
}

#front-card header .brand {
  font-size: 9pt;
  font-weight: bold;
}

#front-card header .sub-brand {
  font-size: 7pt;
}

#front-card header .brand,
#front-card header .sub-brand {
  padding-left: 45px;
}

#front-card .logo img {
  position: absolute;
  top: 12px;
}

.identity {
  padding: 15px;
}

.identity h1 {
  max-width: 80%;
  height: 40px;
  text-transform: uppercase;
}

.photo {
  position: absolute;
  top: 25px;
  right: 15px;
  width: 55px;
  height: 55px;
  overflow: hidden;
  border-radius: 5px;
  border: solid 3px #fff;
}

.photo img {
  width: 55px;
  border-radius: 3px;
}

.personality {      
  display: flex;
  margin-top: 5px;
  margin-bottom: 0;
}

.personality > div {
  width: 33%;      
}

#front-card .address {
  width: 200px;
}

.personality .noid {
  position: relative;
}

.personality .noid:after {
  position: absolute;
  content: '';
  border-right: solid 2px #000;
  height: 25px;
  top: 0;
  right: 15px;
}

.personality .expired {
  margin-top: -10px;
}

.personality strong {      
  margin:0;
  line-height: 0;
}

.code {
  position: absolute;
  right: 10px;
  bottom: 5px;
}

.barcode {
  text-align: center;
  margin:0;
  height: 15px;
  overflow: hidden;
  width: 100px;
  border-top: solid 2px #fff;
  border-bottom: solid 2px #fff;
}

.barcode img {
  margin:0;
  width: 100%;
}

#back-card {
  background: #ffffff url("/slims/files/membercard/classic/images/bg-back.svg") center center no-repeat;
  background-size: cover;
}

#back-card .rules {
  padding: 15px;
}

#back-card .rules ul {
  margin-top: 10px;
  padding: 0 15px;
}

#back-card .sign {
  text-align: center;
  position: absolute;
  right: 15px;
  bottom: 15px;
  line-height: 1;
}

#back-card .signature {
  width: 35px;
}

#back-card .stamp {
  position: absolute;
  top: 15px;
  left: 20px;
  width: 25px;
}

.librarian,
.position {
  font-weight: bold;
}

#back-card footer {
  position: absolute;
  padding-left: 15px;
  bottom: 15px;
}

#back-card .title {
  font-weight: 700;
  text-transform: uppercase;
}
#back-card address {
  font-style: normal;
}
.print_btn {
  background: #333;
  padding: 10px 15px;
  text-decoration: none;
  color: #fff;
  margin-bottom: 5px;
  display: inline-block;
}

@media print {
  .print_btn {
    display: none;
  }  
}
</style>
</head>
<body>
<a class="print_btn" href="#" onclick="window.print()">Print Again</a>
<table cellpadding="0" cellspacing="0">
    <tr>
        <td>
    <!-- Frontcard -->
    <section id="front-card">
      <header>
        <div class="logo">
          <img src="/slims/files\membercard\classic\images\logo.png" alt="No Photo">
          <div class="sub-brand">Library Member Card</div>
          <div class="brand">My Library</div>
        </div>
      </header>
      <main>
        <div class="identity">
          <h1>Masjit Subekti</h1>
                    <div class="photo">
            <img src="/slims/images/persons/member_1234.png" alt="">
          </div>
                              <div class="address">
            <strong>Alamat</strong>
            <p>Bojonegoro</p>
          </div>
                    <div class="personality">
                        <div class="noid">
              <strong>Nomor Identitas</strong>
              <p>23456</p>
            </div>
                                    <div>
              <strong>Nomor Telepon</strong>
              <p>23456</p>
            </div>
                        <div class="code">
              <div class="expired">Exp. <strong>2021-05-02</strong></div>
              <div class="barcode">
                <img src="/slims/images/barcodes/1234.png" alt="No  Barcode">
              </div>
            </div>
          </div>
        </div>
      </main>
    </section>
    <!-- End Frontcard -->
    </td>
    <td>
    <!-- Backcard -->
    <section id="back-card">
        <div class="rules">
          <strong>Library Rules</strong>
          <ul>
<li>This card is published by Library.</li>
<li>Please return this card to its owner if you found it.</li>
</ul>        </div>

        <div class="sign">
          <div class="time">City Name, 02 May 2020</div>
          <div class="position">Library Manager</div>
          <img class="signature" src="/slims/files\membercard\classic\images\signature.png" alt="No signature">
          <img class="stamp" src="/slims/files\membercard\classic\images\stamp.png" alt="No stamp">
          <div class="librarian">Librarian Name</div>
          <div class="uid">Librarian ID</div>
        </div>

        <footer>
          <div class="title">My Library</div>
          <address>
            My Library Full Address and Website          </address>
        </footer>

    </section>
    <!-- End Backcard -->
    </td>
      </tr>
  </table>

<script type="text/javascript">
  self.print();
</script>

</body>
</html>