<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>{{ $title }}</title>
</head>
<style>

table {
  border-collapse: collapse;
  width: 100%;
}

table, th, td {
  border: 1px solid black;
}

th, td {
  text-align: center;
  padding: 1px;
  white-space: nowrap;
}

tr:nth-child(even) {background-color: #f2f2f2;}

div
{
  overflow-x: auto;
}
</style>
<body>
  <h1 style="text-align:center">{{ $heading}}</h1>
  <div>
        <table width="100%" style="width:100%">
            <tr>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Address</th>
                <th>Contact No.</th>
            </tr>
            @foreach ($content as $c)
            <tr>
                <td>{{$c->student_no}}</td>
                <td>{{$c->first_name . " " . $c->middle_name[0] . '.' . " ". $c->last_name }}</td>
                <td>{{$c->gender}}</td>
                <td>{{($c->birthdate)->format('F d, Y')}}</td>
                <td>{{$c->address}}</td>
                <td>{{$c->contact}}</td>
            </tr>
            @endforeach
        </table>
  </div>
</body>
</body>
</html>