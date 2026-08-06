<?php
   include "db.php";
?>
        <!---->
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#mydiv').delay(1000).hide(0);

                $(".br-menu-link11").click(function() {
                   $(".br-menu-sub").toggleClass('show')
                });
            });
        </script> 
        <!---->
   </body>
</html>