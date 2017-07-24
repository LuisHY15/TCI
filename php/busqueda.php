<div class="container">
     <div class="col-md-9 col-md-offset-1">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="60"><center>Clave</center></th>
                    <th width="200"><center>Customer Number</center></th>
                    <th width="150"><center>Date</center></th>
                    <th width="90"><center>Invoice Number</center></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><center>Clave</center></th>
                    <th><center>Customer Number</center></th>
                    <th><center>Date</center></th>
                    <th><center>Invoice Number</center></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
        $sqlTable = "SELECT * FROM invinfo Order by invid desc";
        $query = $db->prepare($sqlTable);
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_OBJ))
        {
            //$arr = array("InvCruDateCrossing"=>$row->DateCrossing,"InvCruTrailerNumber"=>$row->trailerNumber,"InvCruAmount"=>$row->CruAmount,"InvCruDescription"=>$row->Description,"txtInvCruFrom"=>$row->CruFrom,"InvNum"=>$row->InvNum);
                echo    "<tr>";
                echo    "<td><center>".$row->InvId."</center></td>";
                echo    "<td><center>".$row->InvCustomerNum."</center></td>";
                echo    "<td><center>".$row->InvDate."</center></td>";
                echo   "<td><center>".$row->InvNum."</center></td>";
                echo   "<td><a class='btn btn-primary' href='admin.php?m=modificar&id=".$row->InvId."'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
                echo   "<a target='_blanck' style='margin-left:5px;' class='btn btn-primary' href='php/reporte.php?id=".$row->InvId."'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></a></td>";
                echo   "</tr>";
        }
    ?>
            </tbody>
        </table>
     </div>
</div>
