<html>
 <head>
  <title>Live Inline Update data using X-editable with PHP and Mysql</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>
  
 </head>
 <body>
  <div class="container">
   <h1 align="center">Live Inline Update data using X-editable with PHP and Mysql</h1>
   <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
   <br />
   
   <table class="table table-bordered table-striped">
    <thead>
     <tr>
      <th width="5%" style="text-align:center">No</th>
      <th width="15%" style="text-align:center">Tanggal</th>
      <th width="20%" style="text-align:center">Kode Akun</th>
      <th width="40%" style="text-align:center">Keterangan</th>
      <th width="20%" style="text-align:right">Jumlah</th>
     </tr>
    </thead>
    <tbody id="employee_data">
    </tbody>
   </table>
 </body>
</html>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 function fetch_employee_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   dataType:"json",
   success:function(data)
   {
    // $.each(data, function(i, data){
    //   console.log(data['kodeakun']);
    //   var html_data = '<tr><td>'+data.id+'</td>';
    //  html_data += '<td data-name="tanggal" class="tanggal" data-type="text" style="text-align:center" data-pk="'+data.id+'">'+data.tanggal+'</td>';
    //  html_data += '<td data-name="ketkode3" class="ketkode3" data-type="select" style="text-align:center" data-pk="'+data.id+'">'+data.ketkode3+'</td>';
    //  html_data += '<td data-name="keterangan" class="keterangan" data-type="text" data-pk="'+data.id+'">'+data.keterangan+'</td>';
    //  html_data += '<td data-name="output" class="output" data-type="text" style="text-align:right" data-pk="'+data.id+'">'+data.output+'</td></tr>';
    //  $('#employee_data').append(html_data);
    // });
    
    for(var count=0; count<data.length; count++)
    {
     var html_data = '<tr><td>'+data[count].id+'</td>';
     
     html_data += '<td data-name="tanggal" class="tanggal" data-type="text" style="text-align:center" data-pk="'+data[count].id+'">'+data[count].tanggal+'</td>';
     html_data += '<td data-name="kodeakun" class="kodeakun" data-type="select" style="text-align:center" data-pk="'+data[count].id+'">'+data[count].ketkode3+'</td>';
     html_data += '<td data-name="keterangan" class="keterangan" data-type="text" data-pk="'+data[count].id+'">'+data[count].keterangan+'</td>';
     html_data += '<td data-name="output" class="output" data-type="text" style="text-align:right" data-pk="'+data[count].id+'">'+data[count].output+'</td></tr>';
     $('#employee_data').append(html_data);
    }
   }
  })
 }
 
 fetch_employee_data();
 
 $('#employee_data').editable({
  container: 'body',
  selector: 'td.tanggal',
  url: "update.php",
  title: 'Tanggal',
  type: "POST",
  //dataType: 'json',
  validate: function(value){
   if($.trim(value) == '')
   {
    return 'Kolom ini tidak boleh kosong';
   }
  }
 });
 
 $('#employee_data').editable({
  container: 'body',
  selector: 'td.kodeakun',
  url: "update.php",
  title: 'Kodeakun',
  type: "POST",
  dataType: 'json',
  source: [
            <?php 
                //$conn = mysqli_connect('localhost', 'root','','u1976353_jt');
                //$conn = mysqli_connect('localhost', 'root','','u8953447_jt');
                require '../include/fungsi.php';

                $sql = "SELECT * FROM kodeakun ORDER BY ketkode3";
                $proyek = mysqli_query($conn,$sql);
                //$queryResult = $conn->query("SELECT * FROM marketing ");
                $result = array();
                while ($row = mysqli_fetch_assoc($proyek)){
                  //$result[] = $row;
                  echo "{value: '".$row['kodeakun3']."', text: '".$row['ketkode3']."'},";
                }


                // $je = json_encode($result);
                // $jd = json_decode($je, true);s
                // foreach ($jd as $row) {
  
                //   echo "{value: '".$row['kodemarketing']."', text: '".$row['marketing']."'},";
                // }
             ?>
          ],
  validate: function(value){
   if($.trim(value) == '')
   {
    return 'Kolom ini tidak boleh kosong';
   }
  }
 });
 
 $('#employee_data').editable({
  container: 'body',
  selector: 'td.keterangan',
  url: "update.php",
  title: 'Keterangan',
  type: "POST",
  dataType: 'json',
  validate: function(value){
   if($.trim(value) == '')
   {
    return 'Kolom ini tidak boleh kosong';
   }
  }
 });
 
 $('#employee_data').editable({
  container: 'body',
  selector: 'td.output',
  url: "update.php",
  title: 'Output',
  type: "POST",
  dataType: 'json',
  validate: function(value){
   if($.trim(value) == '')
   {
    return 'Kolom ini tidak boleh kosong';
   }
   // var regex = /^[0-9]+$/;
   // if(! expression.test(value))
   // {
   //  return 'Numbers only!';
   // }
  }
 });
 
 $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#employee_data').prepend(html);
  });
 
});
</script>