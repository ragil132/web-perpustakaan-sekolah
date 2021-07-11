$(function () {
	$('#table').DataTable({
		"iDisplayLength": 50,
	});

	$('body').on('click', '.btn-kembali', function () {
		var dataId = $(this).attr('data-id');
		Swal.fire({
			icon: 'warning',
			text: 'Apakah buku benar-benar telah dikembalikan?',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			confirmButtonColor: '#58d8a3',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "/pengembalianbuku/" + dataId,
					type: "GET",
					dataType: "JSON",
					success: function (response) {
						switch (response) {
							case 'Berhasil':
								Swal.fire(
									'Berhasil',
									response,
									'success'
								)
								window.location.href = window.location.href;
								break;
							case 'Gagal':
								Swal.fire(
									'Gagal',
									response,
									'error'
								)
						}
					}
				});
			}
		});
	});
});