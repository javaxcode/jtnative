<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
</head>
<body>
	<!-- <form action="simpan" method="POST">
         <input type="text" name="namamarketing" placeholder="Nama Marketing"></input>
         <input type="submit" name="submit" value="submit"></input> 
         <button type="submit" name="marketing" value="submit"></button>  
    </form> -->
    <input type="text" name="namamarketing" placeholder="Nama Marketing"></input>
     <button type="button" onclick="insertData()" class="btn btn-primary btn-rounded w-md waves-effect m-b-5" >insert</button> 
     <button id="errorMessangeHere"></button>
    <hr>
	<table id="datatable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                
            </tr>
        </thead>

        <tbody id="load-data-here">

        </tbody>
    </table>
	<hr>
	
	<script type="text/javascript">

        
        loadData();

        function insertData(){
            var namamarketing = $("[name='namamarketing']").val();

            $.ajax({
                type : "POST",
                data : "namamarketing="+namamarketing,
                url : "doInsert.php",
                success : function(result){
                    var resultObj = JSON.parse(result);
                    $("#errorMessangeHere").html(resultObj.message);
                    //console.log(result);
                    loadData();

                    resetForm();
                }
            });
        }
        function loadData(){
            var dataHandler = $("#load-data-here");
            dataHandler.html("");

            $.ajax({
                type : "GET",
                data : "",
                url : "doGetData.php",
                success : function(result){
                    var resultObj = JSON.parse(result);
                    

                    $.each(resultObj,function(key,val){
                        var newRow = $("<tr>");
                        newRow.html("<td>"+val.id+"</td><td>"+val.kodemarketing+"</td><td>"+val.marketing+"</td><td></td><td>Delete</td>");

                        dataHandler.append(newRow);
                    });
                }
            });
        }
        function resetForm(){
            $('[type=text]').val('');
            $('[name=namamarketing]').focus();
        }
    </script>
</body>
</html>