<!DOCTYPE html>
<html lang="en" >

<head>

  <meta charset="UTF-8">
  <title>Receipt</title>

  <style>
@media print {
    .page-break { display: block; page-break-before: always; }
}
      #invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 44mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: .9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
  background-size: 60px 60px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: .5em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}

    </style>

  <script>
  window.console = window.console || function(t) {};
</script>



  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }

  function prints() {
      window.print();
  }
</script>


</head>

<body translate="no" onload="prints()">


  <div id="invoice-POS">

    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>D` Cafe</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <!-- <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            Address : street city, state 0000</br>
            Email   : JohnDoe@gmail.com</br>
            Phone   : 555-555-5555</br>
        </p>
      </div>
    </div> -->
    <!--End Invoice Mid-->

    <div id="bot">

                    <div id="table">
                        <table>
                            <tr class="tabletitle">
                                <td class="item"><h2>Menu</h2></td>
                                <td class="Hours"><h2>Qty</h2></td>
                                <td class="Rate"><h2>Sub Total</h2></td>
                            </tr>
                            @foreach($pesanan->detail as $detail)
                            <tr class="service">
                                <td class="tableitem"><p class="itemtext">{{ $detail->menu->nama }}</p></td>
                                <td class="tableitem"><p class="itemtext">{{ $detail->qty }}</p></td>
                                <td class="tableitem"><p class="itemtext">Rp. {{ number_format($detail->total_harga) }}</p></td>
                            </tr>
                            @endforeach


                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Sub Total</h2></td>
                                <td class="payment"><h2>Rp. {{ number_format($pesanan->total_harga) }}</h2></td>
                            </tr>
                            @if($pesanan->diskon)
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Diskon ({{ $pesanan->diskon }}%)</h2></td>
                                <td class="payment"><h2>Rp. {{ number_format($pesanan->total_harga * $pesanan->diskon / 100) }}</h2></td>
                            </tr>   
                            @endif
                            @if($pesanan->ppn)
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>PPN ({{ $pesanan->ppn }}%)</h2></td>
                                <td class="payment"><h2>Rp. {{ number_format(($pesanan->total_harga - ($pesanan->total_harga * $pesanan->diskon / 100)) * $pesanan->ppn / 100) }}</h2></td>
                            </tr>   
                            @endif
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Grand Total</h2></td>
                                <td class="payment"><h2>Rp. {{ number_format($pesanan->grand_total) }}</h2></td>
                            </tr>

                        </table>
                    </div><!--End Table-->

                    <div id="legalcopy">
                        <p class="legal">#{{ $pesanan->kode }} | Kasir : {{ Auth::user()->name }}</p>
                        <p class="legal"><strong>Terima Kasih Atas Kunjungannya
                        </p>
                    </div>

                </div><!--End InvoiceBot-->
  </div><!--End Invoice-->






</body>

</html>