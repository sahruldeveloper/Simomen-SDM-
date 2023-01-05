<!DOCTYPE html>
<html>
<head>
	<title>Surat Keputusan Pimpinan Yayasan Lembaga Pendidikan Islam</title>
	<style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right !important;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
		}
          .isi-mail  {
            text-indent: 50px;
          }

	</style>
</head>
<body>
	<center>
		<table>
                    <tr>
                         <td><img src="http://ylpi.or.id/wp-content/uploads/2019/12/cropped-YLPI-1.png" width="90" height="90"></td>
                         <td>
                         <center>
                              <font size="4">Surat Pemberitahuan Keputusan Pimpinan</font><br>
                              <font size="5"><b>Yayasan Lembaga Pendidikan Islam Riau</b></font><br>
                              <font size="2"><i>Jalan Kaharuddin Nasution, Simpang Tiga, Bukit Raya, Kota Pekanbaru, Riau 28284, Indonesia</i></font>
                         </center>
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2"><hr></td>
                    </tr>
               <table>
                   
               </table>
		</table>
		<table>
               <tr>
				<td colspan="1"></td>
				<td class="text2" style="text-align: right;">{{ $data->updated_at->format('d M Y') }}</td>
			</tr>
			<tr class="text2">
				<td>Nomer</td>
				<td width="572">: -</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td width="564">: -</td>
			</tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Kpd yth.<br>Bapak/Ibu {{$data->nama_pegawai }}<br>Di tempat</font>
		       </td>
		    </tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2"> <p class="isi-mail">Dengan ini memberitahukan kepada pegawai dengan nama <strong class="nama_pegawai">{{ $data->nama_pegawai}}</strong> pada tanggal {{ $data->updated_at->format('d M Y')}} berakhir tugas sebagai pegawai
                         pada Yayasan Lembaga Pendidikan Islam Riau.
                         Untuk itu kami sebagai pihak Yayasan perlu menyampaikan kepada bapak/ibu untuk menyelesaikan Administrasi untuk kelancaran validasi data. 
                    </p> </font>
		       </td>
                 
		    </tr>
		</table>
		<br>
		</table>
		
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Demikianlah surat pemberitahuan ini kami sampaikan kepada bapak/ibu untuk ditindak
                         lanjuti, sebelumnya diucapkan terimakasih.<br><br>Wassalamu'alaikum wr.wb.
</font>
		       </td>
		    </tr>
		</table>
		<br>
		<table width="625">
			<tr>
				<td width="430"><br><br><br><br></td>
				<td class="text" align="center">Pimpinan Yayasan<br><br><br><br></td>
			</tr>
	     </table>
	</center>
</body>
</html>