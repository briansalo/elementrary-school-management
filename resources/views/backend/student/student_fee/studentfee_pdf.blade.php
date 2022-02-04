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

@if($details->fee_category_id == '2')
<p> <b> Student Registration Fee</b> </p>

@elseif ($details->fee_category_id == '3')
<p> <b> Exam Fee</b> </p>

@elseif ($details->fee_category_id == '4')
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
    <td><b>Father's Name</b></td>
    <td>{{ $details['student']['fathers_name'] }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Session</b></td>
    <td>{{ $details['student_year']['name'] }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Class </b></td>
    <td>{{ $details['student_class']['name'] }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td><b>Registration Fee</b></td>
    <td>₱{{ $details->amount }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td><b>Discount Fee </b></td>
    <td>{{$details->discount}}%</td>
  </tr>

  @if($details->fee_category_id == '2'))
    <tr>
    <td>8</td>
    <td><b>Total Fee For this Student </b></td>
    <td> ₱{{$computation}}</td>
  </tr>
  @else
    <tr>
    <td>8</td>

    @if($details->fee_category_id == '4')
    <td><b>Total Fee For the month of {{$month}} </b></td>
    @else
        <td><b>Total Fee For {{$exam}} Exam </b></td>
    @endif

    <td> ₱{{$details->amount}}</td>
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
    <td><b>Father's Name</b></td>
    <td>{{ $details['student']['fathers_name'] }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Session</b></td>
    <td>{{ $details['student_year']['name'] }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Class </b></td>
    <td>{{ $details['student_class']['name'] }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td><b>Registration Fee</b></td>
    <td>₱{{ $details->amount }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td><b>Discount Fee </b></td>
    <td>{{$details->discount}}%</td>
  </tr>

  @if($details->fee_category_id == '2'))
    <tr>
    <td>8</td>
    <td><b>Total Fee For the month Student </b></td>
    <td> ₱{{$computation}}</td>
  </tr>
  @else
    <tr>
    <td>8</td>
    @if($details->fee_category_id == '4')
    <td><b>Total Fee For the month of {{$month}} </b></td>
    @else
        <td><b>Total Fee For {{$exam}} Exam </b></td>
    @endif
    <td> ₱{{$details->amount}}</td>
  </tr>
 @endif
  
    
   
</table>
<br> <br>
  <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>




</body>

</html>
