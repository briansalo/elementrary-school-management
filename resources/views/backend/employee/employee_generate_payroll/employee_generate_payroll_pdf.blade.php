
<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers tr:hover {background-color: #ddd;}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}


</style>

</head>
<body>
<button class="button" onclick="window.print()">Print this page</button>

<button class="button" onclick="window.print()">Save as pdf</button>


<table id="customers">
  <tr>
    <td><h2>
      
  <img src="{{url('upload/school_logo.jpg')}}" width="200" height="100">

    </h2></td>
    <td><h2>Easy School ERP</h2>
<p>Address: Butuan City </p>
<p>Phone : 343434343434</p>
<p>Email : support@easylerningbd.com</p>

    </td> 
  </tr>
  
   
</table>



<table id="customers">
  <tr>
    <th >Employee Name</th>
    <th >Covered Date</th>
    <th >Salary</th>
    <th >No. of days</th>
    <th >Sub Total</th>
    <th >Late</th>
    <th >Overtime</th>
    <th >Deduction</th>
    <th >Total Salary</th>
  </tr>

@foreach($details as $key => $detail )

  

 
  <tr>
    <td>{{$detail->user->name}}</td> <!--employee name -->

    <td>{{$firstdate->date}} to {{$lastdate->date}}</td> <!--Covered Date  -->

    <td>{{$detail->user->salary}}</td> <!--Salary -->

    <td>{{$no_of_days[$key]}}</td> <!--No. of days -->

    <td>{{ $detail->user->salary * $no_of_days[$key]  }}</td>  <!--subtotal -->

    <td>{{ $get_late[$key] }}</td>  <!--Late -->

    <td>{{ $get_overtime[$key] }}</td> <!--overtime -->

    <td>{{ number_format($deduction,) }}</td>  <!--deduction -->

    <td>{{ $total_salary[$key]}}</td>   <!--total salary -->
    
  </tr>

@endforeach     

</table>




<br> <br>
  <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>

</body>
</html>
