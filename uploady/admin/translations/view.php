<?php include_once '../session.php'; ?>
<?php include_once './logic/view.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../components/meta.php'; ?>
    <title>View Translations - <?= $st['website_name'] ?></title>
    <?php include_once '../components/css.php'; ?>
    <?php $utils->style(
        'https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'
    ); ?>
</head>

<body class="sb-nav-fixed">
    <?php include_once '../components/navbar.php' ?>
    <div id="layoutSidenav">
        <?php include_once '../components/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <?php if (isset($msg)) : ?>

                        <?php $utils->loadAlerts($msg, "translation");  ?>

                    <?php endif; ?>

                    <form method="POST" action="actions/delete.php">

                        <?= $utils->input('csrf', $_SESSION['csrf']); ?>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                View Translations
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border pl-2 pb-2 pt-2 pr-2 pb-2 rounded">
                                    <table class="table nowrap table-bordered" width="100%" id="dataTable" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="select-all" name="select-all">
                                                        <label class="custom-control-label" for="select-all"></label>
                                                    </div>
                                                </th>
                                                <th>Page Title</th>
                                                <th>Language</th>
                                                <th>Settings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($page_translations as $translation) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="role_<?= $translation->id ?>" name="translations[]" value="<?= $translation->id; ?>" />
                                                            <label class="custom-control-label" for="role_<?= $translation->id; ?>" </label>
                                                        </div>
                                                    </td>
                                                    <td><?= $translation->title; ?>
                                                    </td>
                                                    <td><?= $languages[$translation->language_id - 1]->language; ?></td>
                                                    <td>
                                                        <a type="button" class="btn btn-primary" href="<?= $utils->siteUrl('/admin/translations/edit.php?id=' . $translation->id); ?>">
                                                            Edit Translation
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    Delete Translations
                                </button>
                                <a type="button" class="btn btn-primary" href="<?= $utils->siteUrl('/admin/translations/new.php'); ?>">
                                    Create Translation
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
            <?php include_once '../components/footer.php'; ?>
        </div>
    </div>
    <?php include_once '../components/js.php'; ?>
    <?php $utils->script(
        'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'
    ); ?>
    <?php $utils->script(
        'https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js'
    ); ?>
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $("#dataTable").DataTable({
                ordering: true,

                select: {
                    style: "multi",
                },
                order: [
                    [1, null]
                ],
                columnDefs: [{
                    targets: 0,
                    orderable: false,
                }, ],
            });
        });

        $("#select-all").click(function(event) {
            if (this.checked) {
                $(":checkbox").each(function() {
                    if ($(this).prop('disabled') == false) {
                        this.checked = true;
                    }
                });
            } else {
                $(":checkbox").each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
</body>

</html>