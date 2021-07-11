$(function () {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    var minutes = String(today.getMinutes()).padStart(2, '0');
    var hours = String(today.getHours()).padStart(2, '0');

    today = dd + '/' + mm + '/' + yyyy + ' ' + hours + ':' + minutes;

    $.ajax({
        url: "/getnamaadmin",
        type: "GET",
        dataType: "JSON",
        success: function (response) {

            $('#table').DataTable({
                "iDisplayLength": 50,
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        title: 'Laporan Data User',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },
                        className: 'btn btn-inverse-primary'
                    },
                    {
                        extend: 'pdf',
                        download: 'open',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        },
                        title: 'Laporan Data User',
                        className: 'btn btn-inverse-primary',
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 12;
                            doc.styles.title.fontSize = 30;
                            doc.styles.tableHeader.fontSize = 14;
                            doc.styles.tableHeader.alignment = 'left';
                            doc.content[1].table.widths = ['25%', '25%', '25%', '25%',
                                '25%', '25%', '25%'];
                            doc.content.splice(0, 0, {
                                margin: [0, 0, 0, 12],
                                alignment: 'left',
                                image: 'data:image/png;base64,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',
                                width: 200,
                                height: 55
                            });
                            doc.content.splice(3, 0, {
                                margin: [150, 150, 2, 2],
                                alignment: 'right',
                                text: 'Dicetak pada : ' + today + ' oleh ' + response
                            });
                        },
                    },
                ]
            });
        }
    });

    $('body').on('click', '.btn-hapususer', function () {
        var dataId = $(this).attr('data-id');
        Swal.fire({
            icon: 'warning',
            text: 'Apakah anda yakin ingin menghapus data ini?',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            confirmButtonColor: '#58d8a3',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/hapusdatauser/" + dataId,
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