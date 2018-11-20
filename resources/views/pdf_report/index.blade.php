<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
</head>
<body>

<h1>Report</h1>


<table class="table" border="1" >

    <thead>



    <tr>
        <th>Campaign Name : &nbsp <font color="red" >Bojan</font></th>
    </tr>

    <tr>
        <th>Launching Date : &nbsp  <font color="red" >24.9.2018</font></th>
    </tr>

    <tr>
        <th>Sent From Name & Address : &nbsp <font color="red" >Petar Petrovic [ petar@netpp.rs ]</font> </th>
    </tr>

    <tr>
        <th>Subject : &nbsp <font color="red" >Mrketing upecaj Me </font></th>
    </tr>

    <tr>
        <th>Recipients in Group : &nbsp  <font color="red" >dev</font></th>
    </tr>
    <tr>
        <th>Campaign created and launched by : &nbsp  <font color="red" ><?= Auth::user()->username ?: Auth::user()->first_name ?></font></th>
    </tr>


    <tr>
        <th>Total sent emails: &nbsp <font color="red" >20</font></th>
    </tr>

    <tr>
        <th>Opened  : &nbsp <font color="red" > 12</font></th>
    </tr>

    <tr>
        <th>Link clicked : &nbsp <font color="red" >8</font></th>
    </tr>

    <tr>
        <th>Creditental submited : &nbsp <font color="red" >5</font></th>
    </tr>
    </thead>
</table>

</body>
</html>