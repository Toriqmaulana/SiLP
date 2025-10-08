<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SILP - <?= $judul; ?></title>

    <!-- Favicons -->
    <link href="<?= base_url('assets/') ?>img/logo-surat.png" rel="icon">
    <link href="<?= base_url('assets/') ?>img/logo-surat.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Drag and Drop Multi File Upload -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

    <!-- Text Editor -->
    <script src="<?= base_url('assets/'); ?>tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            license_key: 'gpl|<your-license-key>'
        });
    </script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .timeline {
            position: relative;
            list-style: none;
            padding-left: 30px;
        }

        .timeline::before {
            content: "";
            position: absolute;
            top: 0;
            left: 10px;
            width: 4px;
            height: 100%;
            background: #ccc;
        }

        .timeline-item {
            position: relative;
            padding: 10px 10px;
            margin-bottom: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            display: block;
            align-items: center;
        }

        .timeline-item small {
            display: block;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: -15px;
            width: 14px;
            height: 14px;
            background: #ccc;
            border-radius: 50%;
            border: 2px solid white;
        }

        .timeline-item.completed::before {
            background: #28a745;
        }

        /* .timeline-item.current::before {
            background: #ffc107;
        } */

        .timeline-item i {
            font-size: 20px;
            margin-right: 10px;
        }

        .file-preview {
            margin-top: 10px;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 5px;
            background-color: #f8f9fa;
        }

        .file-actions {
            display: flex;
            gap: 5px;
        }

        .file-name {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .file-name i {
            color: #dc3545;
        }

        .existing-files {
            margin-bottom: 15px;
        }
    </style>

</head>

<body id="page-top">