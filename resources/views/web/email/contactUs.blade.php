<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mail from everspice</title>
      
      
    <style>
          table#table1 {
    width:50%; 
    /*margin-left:15%; */
    /*margin-right:15%;*/
   color: #5F5D53;
    text-align:left;
    margin:10px;
  }
  
  .div-1 {
        background-color: #313131  ;
    }
        
    </style>  
      
</head>
<body>


<div  class="div-1">  
<br>
<h3 style=" text-align: center;  color: #F3F3F3;" >Message From jobshelp Customer</h3><br>
</div>

<table  id="table1" >
  <tr>
    <th>Customer Name</th>
    <td>{{ $contact['name'] }} </th>

  </tr>
  <tr>
    <th>Customer Email</td>
    <td> {{ $contact['email'] }}  </td>
  
  </tr>
  <tr>
    <th>Subject</td>
    <td> {{ $contact['subject'] }} </td>
    
  </tr>
</table>





<h4 style="color:#5F5D53;    margin:10px; ">Customer Message</h4>
<p style="color:#5F5D53;    margin:10px; "> {{ $contact['message'] }} <p>





    
</body>
</html>



























