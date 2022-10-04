<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{
	//PaginationStep
	public function getpegawai()
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.nip = pegawai.nip');
		$this->db->join('departemen', 'pegawai.id_departemen = departemen.departemen_id');
		return $this->db->get();
	}


	function count_cuti()
	{
		$sql = "SELECT count(id_cuti) AS id_cuti FROM cuti";
		$result = $this->db->query($sql);
		return $result;
	}

	function count_sakit($nip)
	{
		$sql = "SELECT jenis_cuti FROM cuti where nip = $nip and jenis_cuti = 'sakit'";
		$result = $this->db->query($sql);
		return $result;
	}

	function count_izin($nip)
	{
		$sql = "SELECT jenis_cuti FROM cuti where nip = $nip and jenis_cuti = 'izin'";
		$result = $this->db->query($sql);
		return $result;
	}
	function count_cuti_($nip)
	{
		$sql = "SELECT jenis_cuti FROM cuti where nip = $nip and jenis_cuti = 'cuti'";
		$result = $this->db->query($sql);
		return $result;
	}


	//API-GET-ABSEN
	function absenapi($tbl1)
	{
		$this->db->select("absen.id_absen, user.nama AS NamaPegawai, absen.waktu AS WaktuMasuk, absen.keterangan AS Keterangan");
		$this->db->from($tbl1);
		$this->db->join(
			"user",
			"user.nip = absen.nip "
		);
		$query = $this->db->get();
		return $query;
	}

	function joinlah($tbl1)
	{
		$this->db->select("cuti.bukti AS bukti, user.nip As NIP, user.password AS Password, user.level AS Level");
		$this->db->from($tbl1);
		$this->db->join(
			"user",
			"user.nip = cuti.nip "
		);
		// $this->db->join();
		$query = $this->db->get();
		return $query;
	}

	//API-GET-DATACUTI
	function datacutiapi($tbl1)
	{
		$this->db->select("cuti.id_cuti, user.nama AS NamaPegawai, 
		cuti.jenis_cuti AS JenisCuti, 
		cuti.waktu_pengajuan AS TanggalPengajuan, cuti.status AS Status, ");
		$this->db->from($tbl1);
		$this->db->join(
			"user",
			"user.nip = cuti.nip "
		);
		// $this->db->join();
		$query = $this->db->get();
		return $query;
	}

	//API-GET-PENGGAJIAN
	function penggajianJoin($tbl1)
	{
		$this->db->select("pegawai.id_pegawai, pegawai.nip, user.nama AS nama, absen.keterangan AS hadir, pegawai.gaji_pokok, pegawai.u_makan, pegawai.u_transport");
		$this->db->from($tbl1);

		$this->db->join(
			"absen",
			"absen.nip = pegawai.nip"
		);
		$this->db->join(
			"user",
			"user.nip = pegawai.nip"
		);


		$query = $this->db->get()->result();
		return $query;
	}

	function GetData($tabel, $where = null, $value = null)
	{
		if ($where === null && $value === null) {
			$query = $this->db->get($tabel);
			return $query;
		} else {
			$query = $this->db->get_where($tabel, [$where => $value]);
			return $query;
		}
	}


	function CheckLoginModel($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('nip', $password);
		$query = $this->db->get('user');

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
	function insertpresensi($tabel, $data = [])
	{
		$this->db->insert($tabel, $data);
		return $this->db->affected_rows();
	}
	function potongan()
	{
		$this->db->select('*');
		$this->db->from('potongan_salary');
		return $this->db->get();
	}

	function pegawai()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('pegawai', 'user.nip = pegawai.nip');
		$this->db->join('departemen', 'pegawai.id_departemen = departemen.departemen_id');
		return $this->db->get();
	}
	function pegawaiid($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('pegawai', 'user.nip = pegawai.nip');
		$this->db->join('departemen', 'pegawai.id_departemen = departemen.departemen_id');
		$this->db->where('user.nip', $id);
		return $this->db->get();
	}
	function absendaily($id, $tahun, $bulan, $hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('nip', $id);
		$this->db->where('year(waktu)', $tahun);
		$this->db->where('month(waktu)', $bulan);
		$this->db->where('day(waktu)', $hari);
		return $this->db->get();
	}
	public function absen()
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai', 'absen.nip = pegawai.nip');
		$this->db->join('user', 'pegawai.nip = user.nip');
		$this->db->order_by('absen.waktu', 'desc');
		return $this->db->get();
	}
	public function absensi_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai', 'absen.nip = pegawai.nip');
		$this->db->join('user', 'pegawai.nip = user.nip');
		$this->db->where('pegawai.nip', $id);
		$this->db->order_by('absen.waktu', 'desc');
		return $this->db->get();
	}
	public function cuti()
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('pegawai', 'cuti.nip = pegawai.nip');
		$this->db->join('user', 'pegawai.nip = user.nip');
		$this->db->order_by('cuti.id_cuti', 'desc');
		return $this->db->get();
	}
	public function cuti_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('pegawai', 'cuti.nip = pegawai.nip');
		$this->db->join('user', 'pegawai.nip = user.nip');
		$this->db->where('pegawai.nip', $id);
		$this->db->order_by('cuti.id_cuti', 'desc');
		return $this->db->get();
	}
	public function laporan($bulan)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai', 'absen.nip = pegawai.nip');
		$this->db->join('user', 'pegawai.nip = user.nip');
		$this->db->where('month(waktu)', $bulan);
		$this->db->order_by('absen.waktu', 'desc');
		return $this->db->get();
	}
	function absenbulan($id, $tahun, $bulan)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('nip', $id);
		$this->db->where('keterangan', 'masuk');
		$this->db->where('year(waktu)', $tahun);
		$this->db->where('month(waktu)', $bulan);
		return $this->db->get();
	}
	// function cutibulan($id, $tahun, $bulan)
	// {

	// 	$this->db->select('* ');
	// 	$this->db->from('cuti');
	// 	$this->db->join('detailcuti', 'cuti.id_cuti = detailcuti.id_cuti');
	// 	$this->db->where('nip', $id);
	// 	$this->db->where('jenis_cuti', 'cuti');
	// 	$this->db->where('status', 'diterima');
	// 	$this->db->where('year(tanggal)', $tahun);
	// 	$this->db->where('month(tanggal)', $bulan);
	// 	return $this->db->get();
	// }
	function sakitbulan($id, $tahun, $bulan)
	{
		$this->db->select('selesai_pengajuan, waktu_pengajuan');
		$this->db->from('cuti');
		$this->db->where('nip', $id);
		$this->db->where('jenis_cuti', 'sakit');
		$this->db->where('status', 'diterima');
		$this->db->where('year(waktu_pengajuan)', $tahun);
		$this->db->where('month(waktu_pengajuan)', $bulan);
		return $this->db->get();
	}
	// function izinbulan($id, $tahun, $bulan)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('cuti');
	// 	$this->db->join('detailcuti', 'cuti.id_cuti = detailcuti.id_cuti');
	// 	$this->db->where('nip', $id);
	// 	$this->db->where('jenis_cuti', 'izin');
	// 	$this->db->where('status', 'diterima');
	// 	$this->db->where('year(tanggal)', $tahun);
	// 	$this->db->where('month(tanggal)', $bulan);
	// 	return $this->db->get();
	// }
	function izinbulanb($id, $tahun, $bulan)
	{
		$this->db->select('selesai_pengajuan, waktu_pengajuan');
		$this->db->from('cuti');
		$this->db->where('nip', $id);
		$this->db->where('jenis_cuti', 'izin');
		$this->db->where('status', 'diterima');
		$this->db->where('month(waktu_pengajuan)', $bulan);
		$this->db->where('year(waktu_pengajuan)', $tahun);

		return $this->db->get();
	}
	function sakitbulanb($id, $tahun, $bulan)
	{
		$this->db->select('selesai_pengajuan, waktu_pengajuan');
		$this->db->from('cuti');
		$this->db->where('nip', $id);
		$this->db->where('jenis_cuti', 'sakit');
		$this->db->where('status', 'diterima');
		$this->db->where('month(waktu_pengajuan)', $bulan);
		$this->db->where('year(waktu_pengajuan)', $tahun);

		return $this->db->get();
	}

	function cutibulanb($id, $tahun, $bulan)
	{
		$this->db->select('selesai_pengajuan, waktu_pengajuan');
		$this->db->from('cuti');
		$this->db->where('nip', $id);
		$this->db->where('jenis_cuti', 'cuti');
		$this->db->where('status', 'diterima');
		$this->db->where('month(waktu_pengajuan)', $bulan);
		$this->db->where('year(waktu_pengajuan)', $tahun);
		return $this->db->get();
	}

	function cutitoday($tahun, $bulan, $hari)
	{
		$this->db->select('waktu_pengajuan, selesai_pengajuan');
		$this->db->from('cuti');
		$this->db->where('jenis_cuti', 'cuti');
		$this->db->where('status', 'diterima');
		$this->db->where('year(waktu_pengajuan)', $tahun);
		$this->db->where('month(waktu_pengajuan)', $bulan);
		$this->db->where('day(waktu_pengajuan)', $hari);
		return $this->db->get();
	}
	function izintoday($tahun, $bulan, $hari)
	{
		$this->db->select('waktu_pengajuan, selesai_pengajuan');
		$this->db->from('cuti');
		$this->db->where('jenis_cuti', 'izin');
		$this->db->where('status', 'diterima');
		$this->db->where('year(waktu_pengajuan)', $tahun);
		$this->db->where('month(waktu_pengajuan)', $bulan);
		$this->db->where('day(waktu_pengajuan)', $hari);
		return $this->db->get();
	}
	function sakittoday($tahun, $bulan, $hari)
	{
		$this->db->select('waktu_pengajuan, selesai_pengajuan');
		$this->db->from('cuti');
		$this->db->where('jenis_cuti', 'sakit');
		$this->db->where('status', 'diterima');
		$this->db->where('year(waktu_pengajuan)', $tahun);
		$this->db->where('month(waktu_pengajuan)', $bulan);
		$this->db->where('day(waktu_pengajuan)', $hari);
		return $this->db->get();
	}


	function CheckLogin($table, $field1, $field2)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where("email", $field1);
		$this->db->where("password", $field2);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			return null;
		} else {
			return $query->result();
		}
	}

	function hari($hari)
	{

		switch ($hari) {
			case 'Sun':
				$hari_ini = "Minggu";
				break;

			case 'Mon':
				$hari_ini = "Senin";
				break;

			case 'Tue':
				$hari_ini = "Selasa";
				break;

			case 'Wed':
				$hari_ini = "Rabu";
				break;

			case 'Thu':
				$hari_ini = "Kamis";
				break;

			case 'Fri':
				$hari_ini = "Jumat";
				break;

			case 'Sat':
				$hari_ini = "Sabtu";
				break;

			default:
				$hari_ini = "Tidak di ketahui";
				break;
		}

		return $hari_ini;
	}
	function tgl_indo($tanggal)
	{
		$bulan = array(
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);

		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun

		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}
	function hadirtoday($tahun, $bulan, $hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('keterangan', 'masuk');
		$this->db->where('year(waktu)', $tahun);
		$this->db->where('month(waktu)', $bulan);
		$this->db->where('day(waktu)', $hari);
		return $this->db->get();
	}
}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */