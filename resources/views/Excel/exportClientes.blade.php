<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <table>
    <thead>
       <tr>  
         <th style="background-color: #A5A2A2"><b>No.</b></th>

         <th style="background-color: #A5A2A2"><b>Cliente</b></th>
         <th style="background-color: #A5A2A2"><b>Dato</b></th>
       </tr>
    </thead>
    <tbody>
      @foreach ($cliente as $item)
         <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->nombre }}</td>
          @php($dato = App\Models\Dato::findOrNew($item->dato_id)->date)
          <td>{{ $dato }}</td>
         
          
        </tr>
      @endforeach

    </tbody>
   

</body>
</html>

