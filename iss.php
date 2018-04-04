<html>

<head>
<title>Tee Chayanunt</title>

<script language="JavaScript">

function gcd (a, b)
{
   var r;
   while (b>0)
   {
      r=a%b;
      a=b;
      b=r;
   }
   return a;
}

function rel_prime(phi)
{
   var rel=5;

   while (gcd(phi,rel)!=1)
      rel++;
   return rel;
}

function power(a, b)
{
   var temp=1, i;
   for(i=1;i<=b;i++)
      temp*=a;
    return temp;
}

function encrypt(N, e, M)
{
   var r,i=0,prod=1,rem_mod=0;
   while (e>0)
   {
      r=e % 2;
      if (i++==0)
         rem_mod=M % N;
      else
         rem_mod=power(rem_mod,2) % N;
      if (r==1)
      {
         prod*=rem_mod;
         prod=prod % N;
      }
      e=parseInt(e/2);
   }
   return prod;
}

function calculate_d(phi,e)
{
   var x,y,x1,x2,y1,y2,temp,r,orig_phi;
   orig_phi=phi;
   x2=1;x1=0;y2=0;y1=1;
   while (e>0)
   {
      temp=parseInt(phi/e);
      r=phi-temp*e;
      x=x2-temp*x1;
      y=y2-temp*y1;
      phi=e;e=r;
      x2=x1;x1=x;
      y2=y1;y1=y;
      if (phi==1)
      {
         y2+=orig_phi;
         break;
      }
   }
   return y2;
}

function decrypt(c, d, N)
{
   var r,i=0,prod=1,rem_mod=0;
   while (d>0)
   {
      r=d % 2;
      if (i++==0)
         rem_mod=c % N;
      else
         rem_mod = power(rem_mod,2) % N;
      if (r==1)
      {
         prod*=rem_mod;
         prod=prod % N;
      }
      d=parseInt(d/2);
   }
   return prod;
}


function openNew()
{
   var p=parseInt(document.Input.p.value);
   var q=parseInt(document.Input.q.value);
   var M=parseInt(document.Input.M.value);
   var N=p * q;
   var phi=(p-1)*(q-1);
   var e=rel_prime(phi);
   var c=encrypt(N,e,M);
   var d=calculate_d(phi,e);
   alert("N = p * q >> "+N+"\n"+"phi = ( p - 1 ) * ( q - 1) >> "+phi+"\n"+"GCD ( phi , e ) = 1 >>"+e+"\n"+"Encrypted Text ( c ) = M^e * ( mod N )>>"+c+"\n"+" e * d = 1 * ( mod phi ) >>"+d+"\n"+"Decrypted Text = cd * ( mod N )"+decrypt(c,d,N));
   document.getElementById("one").innerHTML = N;
   document.getElementById("two").innerHTML = phi;
   document.getElementById("three").innerHTML = e;
   document.getElementById("four").innerHTML = c;
   document.getElementById("five").innerHTML = d;
   document.getElementById("six").innerHTML = decrypt(c,d,N);
}

// end scripting here -->
</script>

</head>

<body>

<p><font size="6"><h2>Input Form</h2></font></p>
<hr>
<form name="Input">
<table border="0" width="100%" height="109">
  <tr>
    <td width="24%" height="23">
        <font color="Green"><h4>Enter P : </h4></font></td>
    <td width="76%" height="23">
         <input type="text" name="p" size="20"></td>
  </tr>
  <tr>
    <td width="24%" height="23"><font color="blue">
             <h4>Enter Q : </h4></font></td>
    <td width="76%" height="23">
          <input type="text" name="q" size="20"></td>
  </tr>
  <tr>
    <td width="24%" height="20">
           <font color="red"><h4>Enter any Number ( M )</h4></font></td>
    <td width="76%" height="20"><input type="text" name="M" size="20">
        <font size="1" color="#FF0000">(1-1000)</font></td>
  </tr>
  <tr>
    <td width="24%" height="19"><input type="button"

         value="Submit" name="Submit" onClick="openNew()"></td>
    <td width="76%" height="19"><input type="reset"

          value="Reset" name="Reset"></td>
  </tr>
</table>
</form>
<hr>
<p>
  <font size="6"><h2>Output Form</h2></font>
</p>
<hr>
<p>
  <font color="#FF3399">
    1.&nbsp;&nbsp;&nbsp; N = p * q |  ANS :<div id="one"></div>
  </font>
</p>
<p>
  <font color="#FF6600">
    2.&nbsp;&nbsp;&nbsp; phi = ( p - 1 ) * ( q - 1)&nbsp;&nbsp;&nbsp;&nbsp; | ANS : <div id="two"></div>
  </font>
</p>
<p>
  <font color="#FF00FF">
    3.&nbsp;&nbsp;&nbsp; GCD( phi , e ) = 1 |  ANS :<div id="three"></div>
  </font>
</p>
<p>
  <font color="#CC3300">
    4.&nbsp;&nbsp;&nbsp;Encrypted Text ( c ) = M<sup>e</sup>* ( mod N ) |  ANS :<div id="four"></div>
  </font>
</p>
<p>
  <font color="#00FF00">
    5.&nbsp;&nbsp;&nbsp;e * d =&nbsp; 1 * ( mod phi ) |  ANS :<div id="five"></div>
  </font>
</p>
<p>
  <font color="#000000">
    6.&nbsp;&nbsp;&nbsp;Decrypted Text = c<sup>d</sup> * (mod N ) |  ANS : <div id="six"></div>
  </font>
</p>

<p>&nbsp;</p>

</body>

</html>
