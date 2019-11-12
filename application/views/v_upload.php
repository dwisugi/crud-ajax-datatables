<html>
<head>
	<title>malasngoding.com</title>
</head>
<body>
	<center><h1>Membuat Upload File Dengan CodeIgniter | MalasNgoding.com</h1></center>
    <!-- <?php //echo $error;?> -->
    <!-- <?php //echo $data;?> -->

	<?php echo form_open_multipart('upload/aksi_upload');?> <!-- mengarahkan form ke controller -->

	<input type="file" name="berkas" /> <!-- kasih nama upload -->

	<br /><br />

	<input type="submit" value="upload" /> <!--jika tombol submit ditekan maka-->

</form>

</body>
</html>