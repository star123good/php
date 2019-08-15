<?php

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    
?>
        <footer class="probootstrap_section probootstrap-border-top">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-6">
                        <h3 class="probootstrap_font-18 mb-3">Download Links</h3>
                        <ul class="list-unstyled">
                            <li>
                                <a href="<?php echo SERVICE_URL_ONE ?>" target="_blank">Film indir, Tek Link Film indir | Filmindir46 Tek Link Film Deposu</a>
                            </li>
                            <li>
                                <a href="<?php echo SERVICE_URL_TWO ?>" target="_blank">Yerli Filmler | Film indir, Tek Link Film indir</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h3 class="probootstrap_font-18 mb-3">Sub Links</h3>
                        <ul class="list-unstyled">
                            <li>
                                <a href="/?page=downloaded">Downloaded Films</a>
                            </li>
                            <li>
                                <a href="/?page=downloading">Downloading Films</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-md-12 text-center">
                        <p class="probootstrap_font-14">&copy; <script>document.write(new Date().getFullYear())</script>Download video files from other service. </p>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            var pageTitle = '<?php echo $page; ?>';
        </script>

        <?php
            if(isset($js_files) && count($js_files) > 0){
                foreach($js_files as $js){
                    echo '<script src="'.$js.'"></script>';
                }
            }
        ?>
	</body>
</html>