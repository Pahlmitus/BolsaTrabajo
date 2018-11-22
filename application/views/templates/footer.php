</div> <!-- #main -->
<p>Copyright © <?php echo date("Y");?></p>
    <?php if (!!$js_files) { foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; } ?>
</body>
</html>