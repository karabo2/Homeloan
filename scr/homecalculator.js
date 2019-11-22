var monthyPayments=0;
var depositPaid=0;
var presentValue=0;
var interestRate=0;
var years=0;
var totalpay=0;
var interestpay=0;
var presentValue1=0

function price() {
  if (parseInt(document.getElementById("deposit").value)>parseInt(document.getElementById("price").value)){
    document.getElementById("err2").innerHTML="Deposit should be less than Purchase";
  }else {
    document.getElementById("err2").innerHTML="";
  }
  if (document.getElementById("price").value<5000 || document.getElementById("price").value>300000){
      document.getElementById("err1").innerHTML="Amount must lie between 5000 & 300000";
      document.getElementById('calculate').disabled = true;
  }else {
    document.getElementById("err1").innerHTML="";
    if(document.getElementById('price').value> 4999 && document.getElementById('yrs').value >1 && document.getElementById('rate').value>9)  {
    document.getElementById('calculate').disabled = false;}
  }
}

function years1() {
  if (document.getElementById("yrs").value<2 || document.getElementById("yrs").value>15){
      document.getElementById("err3").innerHTML="Years must lie between 2 & 15";
      document.getElementById('calculate').disabled = true;
  }else {
    document.getElementById("err3").innerHTML="";
    if(document.getElementById('price').value> 4999 && document.getElementById('yrs').value >1 && document.getElementById('rate').value>9)  {
    document.getElementById('calculate').disabled = false;}
  }
}
function rate() {
  if (document.getElementById("rate").value<10 || document.getElementById("rate").value>28){
      document.getElementById("err4").innerHTML="Rate must lie between 10 & 28";
      document.getElementById('calculate').disabled = true;
  }else {
    document.getElementById("err4").innerHTML="";
    if(document.getElementById('price').value> 4999 && document.getElementById('yrs').value >1 && document.getElementById('rate').value>9)  {
    document.getElementById('calculate').disabled = false;}
  }
}
function deposi() {
  if (parseInt(document.getElementById("deposit").value)>parseInt(document.getElementById("price").value)){
      document.getElementById("err2").innerHTML="Deposit should be less than Purchase";
      document.getElementById('calculate').disabled = true;
  }else {
    document.getElementById("err2").innerHTML="";
    if(document.getElementById('price').value> 4999 && document.getElementById('yrs').value >1 && document.getElementById('rate').value>9)  {
    document.getElementById('calculate').disabled = false;}
  }
}


function stoppedTyping(id){
  if (id=="price"){
    price();
  }if (id=="deposit") {
    deposi();
  }if (id=="yrs"){
    years1();
  }if (id=="rate") {
    rate();
  }
}

function calculate(){
  //getting data
  depositPaid=parseFloat(document.getElementById("deposit").value);
  if (Number.isNaN(depositPaid)){depositPaid=0;}
  presentValue=parseFloat(document.getElementById("price").value)-depositPaid;
  interestRate=parseFloat(document.getElementById("rate").value)/100/12;
  years=parseFloat(document.getElementById("yrs").value)*12;

  //fixed rate mortgage formula
  var deno= Math.pow(1+interestRate,years);
  monthyPayments=(((presentValue*deno*interestRate)/(deno-1))).toFixed(0);
  interestRate=parseFloat(document.getElementById("rate").value)/100;
  totalpay=(monthyPayments*years).toFixed(0);
  interestpay=(totalpay-presentValue).toFixed(0);

  //printing results

  document.getElementById("popTitile").innerHTML = "ESTIMATIONS";
  document.getElementById("montlyTitile").innerHTML = "Monthly Payments";
  document.getElementById("Payment").innerHTML = "R"+monthyPayments.toString()+"pm";
  document.getElementById("interest").innerHTML= "Total Interest: R"+interestpay.toString();
  document.getElementById("total").innerHTML= "Total Amount: R"+totalpay.toString();
  presentValue1=presentValue+depositPaid;

  years/=12;

  //delete button
  var but = document.getElementById('but');
  if(but) but.parentNode.removeChild(but);

  //creating a button
  var divbun= document.getElementById("btnq");

  var btn=document.createElement('button');
  var text=document.createTextNode('Save');
  btn.appendChild(text);
  btn.setAttribute("class","btn btn-primary");
  btn.setAttribute("data-toggle","modal");
  btn.setAttribute("data-target","#exampleModalLong");
  btn.setAttribute("type","button");
  btn.setAttribute("id","but")
  divbun.appendChild(btn);
  //table
  table();
}
var inteY=[];
var capY=[];
var s=113;
function table() {
  var interestPay=0;
  var capitalPay=0;
  var rate=(1+interestRate/years)-1;
  //deliting table if their was one
  var tbl = document.getElementById('customers');
  if(tbl) tbl.parentNode.removeChild(tbl);
  //creating table
  var div= document.getElementById("table");
  var table = document.createElement("table");
  table.setAttribute("id", "customers");
  var row = table.insertRow(0);
  var th1 = document.createElement("th");
  var th2 = document.createElement("th");
  var th3 = document.createElement("th");
  th1.innerHTML='Year';
  th2.innerHTML = 'Interest %';
  th3.innerHTML = 'Capital %';
  row.appendChild(th1);
  row.appendChild(th2);
  row.appendChild(th3);
  var cell1 = null;
  var cell2 = null;
  var cell3 = null;

  inteY=[];
  capY=[];
  //intrest rate and capital rate on table
  for (i=1; i <= years; i++){

    row = table.insertRow(i);
    //interestPay=presentValue*interestRate;
    //presentValue-=monthyPayments*12;
    //capitalPay=monthyPayments*12-interestPay;
    interestPay=(interestRate)*presentValue;
    capitalPay=monthyPayments*12-interestPay;
    presentValue=presentValue-(monthyPayments*12-interestPay);
    cell1 = row.insertCell(0);
    cell2 = row.insertCell(1);
    cell3 = row.insertCell(2);
    cell1.innerHTML = i;
    cell2.innerHTML = ((interestPay*100)/(monthyPayments*12)).toFixed(0);
    cell3.innerHTML = ((capitalPay*100)/(monthyPayments*12)).toFixed(0) ;
    inteY.push({ y: parseInt(((interestPay*100)/(monthyPayments*12)).toFixed(0)), label: i.toString() });
    capY.push({ y: parseInt(((capitalPay*100)/(monthyPayments*12)).toFixed(0)), label: i.toString() });
    //s=8888;
  }
  div.appendChild(table);
  graph();
}

function graph(){
  var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    text: "Interest% vs Capital%"
  },
  axisY: {
    title: "%"
  },
  legend: {
    cursor:"pointer",
    itemclick : toggleDataSeries
  },
  toolTip: {
    shared: true,
    content: toolTipFormatter
  },
  data: [{
    type: "bar",
    showInLegend: true,
    name: "Interest%",
    color: "gold",
    dataPoints:inteY

  },
  {
    type: "bar",
    showInLegend: true,
    name: "Capital%",
    color: "silver",
    dataPoints: capY
  }]
  });
  chart.render();

  function toolTipFormatter(e) {
  var str = "";
  var total = 0 ;
  var str3;
  var str2 ;
  for (var i = 0; i < e.entries.length; i++){
    var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
    total = e.entries[i].dataPoint.y + total;
    str = str.concat(str1);
  }
  str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
  str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
  return (str2.concat(str)).concat(str3);
  }

  function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else {
    e.dataSeries.visible = true;
  }
  chart.render();
  }
}


function post() {
  var name= document.getElementById("recipient-name").value;
  window.location.href = "http://localhost/mydatabase/connector.php?name=" + name + "&presentValue=" + presentValue1 + "&depositPaid="+ depositPaid+ "&years="+years+ "&interestRate="+ interestRate+ "&monthyPayments="+ monthyPayments+ "&interestpay="+ interestpay+ "&totalpay="+totalpay;
}

function postStuff() {
  var name= document.getElementById("recipient-name").value;
  var vars= "name=" + name + "&presentValue=" + presentValue1 + "&depositPaid="+ depositPaid+ "&years="+years+ "&interestRate="+ interestRate+ "&monthyPayments="+ monthyPayments+ "&interestpay="+ interestpay+ "&totalpay="+totalpay;
  $.ajax({
    url:"connector.php",
    data:vars,
    success:function(data) {
      $('#cont').html;
    }
  });

}
