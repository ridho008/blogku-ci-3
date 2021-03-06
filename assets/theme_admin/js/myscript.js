// Fitur copy link di detail artikel
function copyClipboard()
{
	var link = document.getElementById('clip');
	link.select();
	document.execCommand("copy");
	alert('url berhasil dicopy');
}

$(function() {
	CKEDITOR.replace('editor1');
	$(".datatables").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
	$('[data-toggle="tooltip"]').tooltip();
	$('.tombolTambahKategori').click(function() {
		$('#formModalKategoriLabel').html('Tambah Data Kategori');

		$('#id_kategori').val('');
		$('#kategori').val('');
	});

	$('.tombolUbahKategori').click(function() {
		$('#formModalKategoriLabel').html('Ubah Data Kategori');
		$('.modal-body form').attr('action', 'http://localhost/blogku-ci-3/admin/kategori/ubahKategori');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/blogku-ci-3/admin/kategori/getKategori',
			method: 'post',
			dataType: 'json',
			data: {id: id},
			success: function(data)
			{
				// console.log(data);
				$('#id_kategori').val(data.id_kategori);
				$('#kategori').val(data.nama_kategori);
			}
		});
	});


	$('.tombolTambahPenulis').click(function() {
		$('#formModalPenulisLabel').html('Tambah Data Penulis');
		$('#profile-tab').show();

		$('#id_penulis').val('');
		$('#user').val('');
		$('#nama').val('');
		$('#desk_penulis').val('');
		$('#fotoPenulisLama').val('');
		$('#tampilFotoPenulis').attr('src', '');
	});

	$('.tombolUbahPenulis').click(function() {
		$('#formModalPenulisLabel').html('Ubah Data Penulis');
		$('.modal-penulis button[type=submit]').html('Ubah')
		$('.modal-body form').attr('action', 'http://localhost/blogku-ci-3/admin/penulis/ubahpenulis');
		$('#profile-tab').hide();
		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/blogku-ci-3/admin/penulis/getpenulis',
			method: 'post',
			dataType: 'json',
			data: {id: id},
			success: function(data)
			{
				// console.log(data);
				$('#id_penulis').val(data.id_penulis);
				$('#user').val(data.id_user);
				$('#nama').val(data.nama_penulis);
				$('#desk_penulis').val(data.desk_penulis);
				$('#fotoPenulisLama').val(data.foto_penulis);
				$('#tampilFotoPenulis').attr('src', 'http://localhost/blogku-ci-3/assets/theme_admin/img/penulis/' + data.foto_penulis);
			}
		});
	});


});