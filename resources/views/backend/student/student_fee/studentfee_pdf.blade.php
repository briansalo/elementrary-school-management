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
</style>
</head>
<body>




<table id="customers">
  <tr>
    <td><h2>
      
  <img src="{{url('upload/school_logo.jpg')}}" width="200" height="100">

    </h2></td>
    <td><h2>Easy School ERP</h2>
<p>School Address</p>
<p>Phone : 343434343434</p>
<p>Email : support@easylerningbd.com</p>

@if($fee_category_id == '2')
<p> <b> Student Registration Fee</b> </p>

@elseif ($fee_category_id == '3')
<p> <b> Exam Fee</b> </p>

@elseif ($fee_category_id == '4')
<p> <b> Monthly Fee</b> </p>

@endif

    </td> 
  </tr>
  
   
</table>


<table id="customers">
  <tr>
    <th width="10%">Sl</th>
    <th width="45%">Student Details</th>
    <th width="45%">Student Data</th>
  </tr>
  <tr>
    <td>1</td>
    <td><b>Student ID No</b></td>
    <td>{{ $details['student']['id_no'] }}</td>
  </tr>
    <tr>
    <td>2</td>
    <td><b>Student Name</b></td>
    <td>{{ $details['student']['name'] }}</td>
  </tr>

  <tr>
    <td>3</td>
    <td><b>Grade</b></td>
    <td>{{ $details['student_grade']['name'] }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Class </b></td>
    <td>{{ $details['student_class']['name'] }}</td>
  </tr>

  @if($fee_category_id == '2'))
    <tr>
      <td>5</td>
      <td><b>Registration Fee</b></td>
      <td>₱{{ number_format($details->amount,2) }}</td>
    </tr>
    <tr>
      <td>6</td>
      <td><b>Discount Fee </b></td>
      <td>{{$details->discount}}%</td>
    </tr>
    <tr>
      <td>7</td>
      <td><b>Total Amount</b></td>
      <td>{{number_format($computation,2)}}</td>
    </tr>
  @endif

  @if($fee_category_id == '3'))
    <tr>
      <td>5</td>
      <td><b>Total fee for the {{$exam}} exam </b></td>
      <td> ₱{{number_format($amount,2)}}</td>
    </tr>
  @endif

  @if($fee_category_id == '4')
    <tr>
      <td>5</td>
      <td><b>Total Fee For the month of {{$month}} </b></td>
      <td>{{$amount}}</td>
    </tr>
  @endif
 
</table>

<br> <br>
  <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>

<hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px">



<table id="customers">
  <tr>
    <th width="10%">Sl</th>
    <th width="45%">Student Details</th>
    <th width="45%">Student Data</th>
  </tr>
  <tr>
    <td>1</td>
    <td><b>Student ID No</b></td>
    <td>{{ $details['student']['id_no'] }}</td>
  </tr>
    <tr>
    <td>2</td>
    <td><b>Student Name</b></td>
    <td>{{ $details['student']['name'] }}</td>
  </tr>

  <tr>
    <td>3</td>
    <td><b>Grade</b></td>
    <td>{{ $details['student_grade']['name'] }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Class </b></td>
    <td>{{ $details['student_class']['name'] }}</td>
  </tr>

  @if($fee_category_id == '2'))
    <tr>
      <td>5</td>
      <td><b>Registration Fee</b></td>
      <td>₱{{ number_format($details->amount,2) }}</td>
    </tr>
    <tr>
      <td>6</td>
      <td><b>Discount Fee </b></td>
      <td>{{$details->discount}}%</td>
    </tr>
    <tr>
      <td>7</td>
      <td><b>Total Amount</b></td>
      <td>{{number_format($computation,2)}}</td>
    </tr>
  @endif

  @if($fee_category_id == '3'))
    <tr>
      <td>5</td>
      <td><b>Total fee for the {{$exam}} exam </b></td>
      <td> ₱{{number_format($amount,2)}}</td>
    </tr>
  @endif

  @if($fee_category_id == '4')
    <tr>
      <td>5</td>
      <td><b>Total Fee For the month of {{$month}} </b></td>
      <td>{{$amount}}</td>
    </tr>
  @endif
 
</table>



<br> <br>
  <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>




</body>

</html>
