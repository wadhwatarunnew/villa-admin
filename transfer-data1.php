<?php
error_reporting(0);

if (isset($_POST['sub'])) {
    $checkedArr = isset($_POST['check']) ? $_POST['check'] : array();
    $count = count($checkedArr);

    if ($count > 10) {
        ?>
        <script>
            alert("You can only select 10 photos!");
        </script>
        <?php
    } else {
        $types = isset($_POST['state22']) ? $_POST['state22'] : '';
        $category = isset($_POST['category22']) ? $_POST['category22'] : '';

        if (isset($_POST['city22']) && $_POST['city22'] != '') {
            $title = $_POST['city22'];
        } else {
            $title = $category;
        }

        include "db.php";

        $query40 = mysqli_query($con, "select * from add_gallery where title='$title' ");
        $counti = 1;
        $countRow = mysqli_num_rows($query40);

        $path1 = isset($_POST['check'][0]) ? $_POST['check'][0] : '';
        $path3 = isset($_POST['check'][1]) ? $_POST['check'][1] : '';
        $path5 = isset($_POST['check'][2]) ? $_POST['check'][2] : '';
        $path7 = isset($_POST['check'][3]) ? $_POST['check'][3] : '';
        $path9 = isset($_POST['check'][4]) ? $_POST['check'][4] : '';
        $path11 = isset($_POST['check'][5]) ? $_POST['check'][5] : '';
        $path13 = isset($_POST['check'][6]) ? $_POST['check'][6] : '';
        $path15 = isset($_POST['check'][7]) ? $_POST['check'][7] : '';
        $path17 = isset($_POST['check'][8]) ? $_POST['check'][8] : '';
        $path19 = isset($_POST['check'][9]) ? $_POST['check'][9] : '';

        if ($countRow == 0) {
            $page = "Update";
            mysqli_query($con, "insert into add_gallery (types,title,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,dateTime) values ('$types','$title','$path1','$path3','$path5','$path7','$path9','$path11','$path13','$path15','$path17','$path19',NOW())");
            header("refresh:2; url=transfer-data.php");
        } else {
            while ($ee = mysqli_fetch_assoc($query40)) {
                $filters = array();
                for ($i = 1; $i <= 10; $i++) {
                    $key = 'p' . $i;
                    $pic = isset($ee[$key]) ? $ee[$key] : '';
                    if (!$pic) {
                        $filters[] = 'none';
                    } else {
                        $filters[] = preg_replace('/\d/', '', substr(strrchr($pic, '/'), 1));
                    }
                }

                $postedFilters = array();
                for ($i = 0; $i < 10; $i++) {
                    $dic = isset($_POST['check'][$i]) ? $_POST['check'][$i] : '';
                    $postedFilters[] = $dic ? preg_replace('/\d/', '', substr(strrchr($dic, '/'), 1)) : '';
                }

                $hasDuplicate = false;
                foreach ($postedFilters as $pf) {
                    if ($pf !== '' && in_array($pf, $filters, true)) {
                        $hasDuplicate = true;
                        break;
                    }
                }

                if ($hasDuplicate) {
                    ?>
                    <script>
                        alert("Photo Already in Gallery.Please select again!");
                    </script>
                    <?php
                    break;
                } else {
                    if ($counti == $countRow) {
                        $page = "Update";
                        mysqli_query($con, "insert into add_gallery (types,title,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,dateTime) values ('$types','$title','$path1','$path3','$path5','$path7','$path9','$path11','$path13','$path15','$path17','$path19',NOW())");
                        header("refresh:2; url=transfer-data.php");
                    } else {
                        $counti++;
                        continue;
                    }
                }
            }
        }
    }
}
?>

<?php $PageTitle = "Villatent: Gallery"; ?>
<?php include_once('common/header.php'); ?>
<style>
    #galcs {
        max-width: 100%;
    }
</style>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="listing-page-head">
                        <div class="listing-title-wrap">
                            <h1>Transfer Gallery Photos</h1>
                            <div class="listing-breadcrumb">
                                <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Gallery</span><span class="crumb-sep">&gt;</span><span>Transfer</span>
                            </div>
                        </div>
                        <div class="listing-cta">
                            <a href="add-gallery.php" class="btn btn-outline-primary btn-sm"><i class="feather icon-plus"></i> Add</a>
                            <a href="update-gallery.php" class="btn btn-outline-secondary btn-sm"><i class="feather icon-edit"></i> Update</a>
                            <a href="delete-gallery.php" class="btn btn-outline-danger btn-sm"><i class="feather icon-trash-2"></i> Delete</a>
                        </div>
                    </div>

                    <?php include "alert-insert.php" ?>

                    <div class="card mb-30">
                        <div class="card-header">Transfer Photos</div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="commonSection">
                                            <label>Gallery Type <span class="required">*</span></label>
                                            <select name="state" class="form-control country input" required>
                                                <option value="">--Select--</option>
                                                <option value="Resort Tents">Resort Tents</option>
                                                <option value="Projects">Projects</option>
                                            </select>
                                        </div>

                                        <div id="categories" class="mb-20"></div>
                                        <div id="response" class="mb-20"></div>
                                        <div id="response1"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("select.country").change(function() {
            var selectedCountry = $(".country option:selected").val();
            $.ajax({
                type: "POST",
                url: "getSelectedCategoryTransfer.php",
                data: {
                    country: selectedCountry
                }
            }).done(function(data) {
                $("#categories").html('');
                $("#response").html('');
                $("#response1").html('');
                $("#categories").html(data);
            });
        });
    });
</script>

<script>
    var limit = 3;
    $('input.single-checkbox').on('change', function(evt) {
        if ($(this).find('.single-checkbox:checked').length >= limit) {
            this.checked = false;
        }
    });
</script>

<?php include_once('common/footer.php'); ?>