<?php  
 function fetch_data()  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "dreamhome");  
      $sql = "SELECT client.clientno,client.fname,client.lname,viewing.viewdate,propertyforrent.city  FROM client INNER JOIN viewing ON (client.clientno = viewing.clientno) INNER JOIN propertyforrent ON (viewing.propertyno = propertyforrent.propertyno) " ;  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '<tr>  
                          <td>'.$row["clientno"].'</td>  
                          <td>'.$row["fname"].'</td>  
                          <td>'.$row["lname"].'</td>  
                          <td>'.$row["viewdate"].'</td>  
                          <td>'.$row["city"].'</td>  
                     </tr>  
                          ';  
      }  
      return $output;  
 }  
 if(isset($_POST["export"]))  
 {  
 	if($_POST['selectFile'] == "pdf"){
		
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="20%">Client no.</th>  
                <th width="20%">Firstname</th>  
                <th width="20%">Lastname</th>  
                <th width="20%">View date</th>  
                <th width="20%">City</th>  
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('sample.pdf', 'I');  
	}
	else if($_POST['selectFile'] == "excel"){
		header('Location: export.php');
	}
 }  
 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Export HTML Table data to PDF using TCPDF in PHP</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                <h3 align="center">LAB7</h3><br />  
                <div class="table-responsive">  
                     <table class="table table-bordered" >  
                          <tr>  
                               <th width="18%">Client no.</th>  
                               <th width="22%">Firstname</th>  
                               <th width="23%">Lastname</th>  
                               <th width="20%">View date</th>  
                               <th width="17%">City</th>  
                          </tr>  
                     <?php  
                     echo fetch_data();  
                     ?>   
                     </table>  
                     <br />  
                     <form method="post" >  
                     <select name="selectFile">
                     	<option value="pdf">PDF</option>
                        <option value="excel">Excel</option>
                        </select><br>
                          <input type="submit" name="export" class="btn btn-success" value="Export" />  
                     </form>  
                </div>  
           </div>  
      </body>  
 </html>  